<?php

namespace App\Models\ViewModels;

use App\Models\UserModel;

class UserViewModel{
    /**
     * @var UserModel[]
     */

    public array $users;

    public function __construct(array $users = []){
        $this->users = $users;
    }
}