<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ResourceController;
use App\Repositories\AddressRepository;

class AddressesController extends ResourceController
{
    protected $pagination = true;

    public function repository()
    {
        return AddressRepository::class;
    }

    public function entityName()
    {
        return 'Address';
    }
}