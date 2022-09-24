<?php

namespace App\Libraries;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserLibrary
{
    public function index()
    {
        try {
            return response(User::with('role')->get());
        }catch (\Exception $exception) {
            logger($exception->getMessage());
            return response(['status' => false, 'message' => 'Internal server error'], 500);
        }
    }

    public function create()
    {
        //
    }

    public function store($request)
    {
        try {
            $password = Hash::make($request->password);
            $request['theme'] = 'light-theme';
            $request['password'] = $password;

            $data = User::create($request->all());
            $data->role;

            return $data;
        }catch (\Exception $exception) {
            logger($exception->getMessage());
            return response(['status' => false, 'message' => 'Internal server error'], 500);
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update($request, $id)
    {
        try {
            $data = User::find($id);

            if (is_null($data))
                return response(['status' => false, 'message' => 'Usuario no encontrado'], 404);

            $data->fill($request->all());
            $data->update();
            $data->role;

            return $data;
        }catch (\Exception $exception) {
            logger($exception->getMessage());
            return response(['status' => false, 'message' => 'Internal server error'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $data = User::find($id);

            if (is_null($data))
                return response(['status' => false, 'message' => 'Usuario no encontrado'], 404);

            $data->delete();
            return response(['status' => true, 'message' => 'Usuario eliminado correctamente'], 200);
        }catch (\Exception $exception) {
            logger($exception->getMessage());
            return response(['status' => false, 'message' => 'Internal server error'], 500);
        }
    }
}
