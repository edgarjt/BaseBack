<?php

namespace App\Http\Controllers;

use App\Libraries\UsersLibrary;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    protected $userLibrary;

    /**
     * UserController constructor.
     * @param UsersLibrary $usersLibrary
     */
    public function __construct(UsersLibrary $usersLibrary) {
        $this->userLibrary = $usersLibrary;
    }

    /**
     * @return \App\User[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index() {
        return $this->userLibrary->index();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request) {
        return $this->userLibrary->create($request);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(Request $request) {
        return $this->userLibrary->edit($request);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request) {
        return $this->userLibrary->destroy($request);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function theme(Request $request) {
        return $this->userLibrary->theme($request);
    }
}
