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
                $user['employee_id'] = $data->employee_id;
                $user['first_name'] = $data->first_name;
                $user['last_name'] = $data->last_name;
                $user['birthday'] = $data->birthday;
                $user['sex'] = $data->sex;
                $user['position'] = $data->position;
                $user['department'] = $data->department;

                $result[] = $user;
            }
        }

        return $result;
    }
}