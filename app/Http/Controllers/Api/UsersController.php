<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ResourceController;
use App\Repositories\UserRepository;

class UsersController extends ResourceController
{
    protected $pagination = true;

    public function repository()
    {
        return UserRepository::class;
    }

    public function entityName()
    {
        return 'User';
    }
}