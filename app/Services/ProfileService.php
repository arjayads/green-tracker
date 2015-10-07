<?php
/**
 * Created by PhpStorm.
 * User: gwdev1
 * Date: 10/7/15
 * Time: 10:41 PM
 */

namespace app\Services;


use app\Http\Requests;
use app\Models\File;
use app\Models\User;
use app\ResponseEntity;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;


class ProfileService implements BaseService {

    function save(array $params)
    {
        // TODO: Implement save() method.
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

    function getPhoto()
    {
        $user = User::find(Auth::user()->id);

        try {

            if ($user) {
                $imageFile = File::find($user->profile_photo_file_id);
                if ($imageFile) {
                    $img = Image::make(env('FILE_UPLOAD_PATH') . $imageFile->new_filename);
                    return $img->response('png');
                }
            }
        }catch (\Exception $e) {
        }

        $img = Image::make('images/avatar_2x.png');
        return $img->response('png');
    }
}