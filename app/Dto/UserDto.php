<?php

namespace app\Dto;


use app\Repositories\UserRepo;

class UserDto
{

    private $userRepo;

    public function __construct()
    {
        $this->userRepo = new UserRepo();
    }

    function lists()
    {
        $rows = $this->userRepo->findAll();

        $result = [];
        if ($rows)
        {
            foreach($rows as $data)
            {
                $user['id_number'] = $data->id_number;
                $user['first_name'] = $data->first_name;
                $user['last_name'] = $data->last_name;
                $user['sex'] = $data->sex;
                $user['email'] = $data->email;
                $user['middle_name'] = $data->middle_name;
                $user['shift'] = $data->shift;

                $result[] = $user;
            }
        }

        return $result;
    }
}