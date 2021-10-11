<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class MeController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $repository;

    /**
     * @var User
     */
    private $user;

    /**
     * MeController constructor.
     *
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
        $this->user = auth()->user();
    }

    /**
     * Get profile
     * 
     * @param ShowRequest $request
     * @return mixed
     */
    public function show(Request $request)
    {
        $data = $this->repository->find($this->user->id);
        return $this->respond($data);
    }
}
