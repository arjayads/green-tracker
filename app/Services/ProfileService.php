<?php
/**
 * Created by PhpStorm.
 * User: gwdev1
 * Date: 10/7/15
 * Time: 10:41 PM
 */

namespace app\Services;


use app\Dto\SaleDto;
use app\Http\Requests;
use app\Models\File;
use app\Models\User;
use app\Repositories\SaleRepo;
use app\ResponseEntity;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;


class ProfileService implements BaseService {


    public function __construct(SaleRepo $saleRepo) {
        $this->saleRepo = $saleRepo;
    }

    function save(array $params)
    {
        $response = new ResponseEntity();

        $user = User::find(Auth::user()->id);
        if ($user) {
            $user->alias = $params['alias'];
            $user->email = $params['email'];
            $user->mood = $params['mood'];

            if (isset($params['password'])) {
                $user->password = bcrypt($params['password']);
            }

            if ($user->save()) {
                $response->setMessage('Profile info successfully saved!');
                $response->setSuccess(true);
            } else {
                $response->setMessage('Failed to save info');
            }
        } else {
            $response->setMessage('User not available!');
        }

        return $response;
    }

    function updatePhoto(array $params)
    {
        $response = new ResponseEntity();

        try {

            $image = $params['image'];
            $user = User::find(Auth::user()->id);

            if ($image && $user) {
                $img = str_replace('data:image/png;base64,', '', $image);
                $img = str_replace(' ', '+', $img);
                $data = base64_decode($img);

                $file = env('FILE_UPLOAD_PATH') . md5($img) . '.png';
                $success = file_put_contents($file, $data);

                if ($success) {
                    $f = new File();
                    $f->new_filename = md5($img) . '.png';
                    $f->mime_type = 'image/png';

                    if ($f->save()) {

                        // delete previous profile photo
                        $prevFile = File::find($user->profile_photo_file_id);
                        if ($prevFile) {
                            \File::delete(env('FILE_UPLOAD_PATH').$prevFile->new_filename);
                            $prevFile->delete();
                        }

                        // save new profile photo
                        $user->profile_photo_file_id = $f->id;
                        $user->save();

                        $response->setSuccess(true);
                    };
                }
            }
        }catch (\Exception $e) {
            $response->setMessages([$e->getMessage()]);
        }

        return $response;
    }

    function updateCover(array $params)
    {
        $response = new ResponseEntity();

        try {

            $image = $params['image'];
            $user = User::find(Auth::user()->id);

            if ($image && $user) {
                $dataImageBase64Type = 'data:image/png;base64,';
                $validImage = false;
                $test = strpos($image, $dataImageBase64Type); // png
                if ($test !== FALSE) { // yeah, its png
                    $validImage = true;
                } else {
                    $dataImageBase64Type = 'data:image/jpeg;base64,';
                    $test = strpos($image, $dataImageBase64Type); // jpeg
                    if ($test !== FALSE) { // yeah, its jpeg
                        $validImage = true;
                    }
                }

                if ($validImage) {
                    $img = str_replace($dataImageBase64Type, '', $image);

                    $pos = strpos($image, ';');
                    $typeArr = explode(':', substr($image, 0, $pos));

                    if (is_array($typeArr) && count($typeArr) == 2) {
                        $type = $typeArr[1];
                        $types = ['image/png' => '.png', 'image/jpeg' => '.jpg'];

                        if (array_key_exists($type, $types)) {
                            $data = base64_decode($img);

                            $file = env('FILE_UPLOAD_PATH') . md5($img) . $types[$type];
                            $success = file_put_contents($file, $data);

                            if ($success) {
                                $f = new File();
                                $f->new_filename = md5($img) . $types[$type];
                                $f->mime_type = $type;

                                if ($f->save()) {

                                    // delete previous cover photo
                                    $prevFile = File::find($user->cover_photo_file_id);
                                    if ($prevFile) {
                                        \File::delete(env('FILE_UPLOAD_PATH').$prevFile->new_filename);
                                        $prevFile->delete();
                                    }

                                    // save new cover photo
                                    $user->cover_photo_file_id = $f->id;
                                    $user->save();

                                    $response->setSuccess(true);
                                };
                            }
                        }
                    }
                }

            }
        }catch (\Exception $e) {
            $response->setMessages([$e->getMessage()]);
        }

        return $response;
    }

    function getCover($userId)
    {
        $user = User::find($userId);

        try {

            if ($user) {
                $imageFile = File::find($user->cover_photo_file_id);
                if ($imageFile) {
                    $img = Image::make(env('FILE_UPLOAD_PATH') . $imageFile->new_filename);
                    $types = ['image/png' => 'png', 'image/jpeg' => 'jpg'];
                    return $img->response($types[$imageFile->mime_type]);
                }
            }
        }catch (\Exception $e) {
        }

        $img = Image::make('images/cover.png');
        return $img->response('png');
    }


    function getPhoto($userId)
    {
        $user = User::find($userId);

        try {

            if ($user) {
                $imageFile = File::find($user->profile_photo_file_id);
                if ($imageFile) {
                    $img = Image::make(env('FILE_UPLOAD_PATH') . $imageFile->new_filename);
                    $img->resize(300, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    return $img->response('png');
                }
            }
        }catch (\Exception $e) {
        }

        $img = Image::make('images/avatar_2x.png');
        return $img->response('png');
    }

    function getTeammates($userId)
    {
        $user = User::find($userId);
        if ($user) {
            $users = User::where('supervisor_id', $user->id)->select(['id', 'email'])->get(); // get subs
            if (count($users) == 0) { // no subs
                // same level
                $users = User::where('supervisor_id', $user->supervisor_id)->where('id','!=',$user->id)->select(['id', 'email'])->get();
            }

            // include your tl too
            $tl = User::where('id', $user->supervisor_id)->select(['id', 'email'])->first();

            if ($users->count() > 0) {
                if ($tl) $users->prepend($tl);
                return $users;
            } else if ($tl) {
                return [$tl];
            }
        }

        return [];
    }

    function getIncentive($userId, $date = null)
    {
        $saleCount = $this->saleRepo->countByAgentAndDate($userId, $date);
        if ($saleCount > 0) {
            if ($saleCount <= 3) {
                return $saleCount * 25;
            } else if ($saleCount <= 7) {
                return $saleCount * 50;
            } else {
                return $saleCount * 80;
            }
        }
        return 0;
    }
}