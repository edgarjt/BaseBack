<?php


namespace App\Libraries;


use App\Constants\UserConstant;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsersLibrary
{
    public function index() {
        try {
            $users = User::with('role')->get();

            if (is_null($users))
                return response()->json(['status' => false, 'message' => 'Ocurrio un error inesperado'], 404);

            return $users;

        } catch (\Throwable $e) {
            logger($e->getMessage());
            return  response()->json(['status' => false, 'message' => 'Internal server error', 'code'=>500], 500);
        }
    }

    public function create($request) {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'first_surname' => 'required',
                'last_surname' => 'required',
                'email' => 'required|unique:users',
                'password' => 'required',
                'role_id' => 'required'
            ]);

            if ($validator->fails()) {
                return response()->json(['status' => false, 'message' => 'Datos inválidos','error' => $validator->errors()], 404);
            }

            $request['password'] = Hash::make($request->password);
            $request['theme'] = UserConstant::THEME;
            $data = User::create($request->all());

            if (is_null($data))
                return response()->json(['status' => false, 'message' => 'Ocurrio un error inesperado al guardar los datos'],404);

            $data->role;
            return response()->json(['status' => true, 'message' => 'Datos guardados correctamente', 'data' => $data]);

        } catch (\Throwable $e) {
            logger($e->getMessage());
            return  response()->json(['status' => false, 'message' => 'Internal server error', 'code'=> 500], 500);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        //
    }

    /**
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($request) {
        try {
            $validator = Validator::make($request->all(), [
                'id' => 'required',
                'name' => 'required',
                'first_surname' => 'required',
                'last_surname' => 'required',
                'email' => "required|unique:users,email,{$request->id}",
                'role_id' => 'required'
            ]);

            if ($validator->fails())
                return response()->json(['status' => false, 'message' => 'Datos inválidos','error' => $validator->errors()], 404);

            $user = User::find($request->id);

            if (is_null($user))
                return response()->json(['status' => false, 'message' => 'Usuario no encontrado'], 404);

            $user->fill($request->all());
            $user->update();

            if (is_null($user))
                return response()->json(['status' => false, 'message' => 'Ocurrió un error inesperado al guardar los datos'],404);

            $user->role;
            return response()->json(['status' => true, 'message' => 'Datos actualizados correctamente', 'data'=> $user]);

        } catch (\Throwable $e) {
            logger($e->getMessage());
            return  response()->json(['status' => false, 'message' => 'Internal server error', 'code'=>500], 500);
        }

    }

    /**
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($request) {
        try {
            $validator = Validator::make($request->all(), [
                'id' => 'required',
            ]);

            if ($validator->fails())
                return response()->json(['status' => false, 'message' => 'Datos inválidos','error' => $validator->errors()], 404);

            $user = User::find($request->id);

            if (is_null($user))
                return response()->json(['status' => false, 'message' => 'Usuario no encontrado'], 404);

            $user->delete();

            if (!is_null($user))
                return response()->json(['status' => true, 'message' => 'Datos Eliminados correctamente', 'data' => $user]);

            return response()->json(['status' => false, 'message' => 'Ocurrio un error inesperado'],404);

        } catch (\Throwable $e) {
            logger($e->getMessage());
            return response()->json(['status' => true, 'message' => 'Internal Server error', 'data' => $user],500);
        }
    }


    /**
     * @param $request
     * @return \Illuminate\Http\JsonResponse|void
     */
    public function theme($request){
        try {
            $validator = Validator::make($request->all(), [
                'id' => 'required',
                'theme' => 'required',
            ]);

            if ($validator->fails())
                return response()->json(['status' => false, 'message' => 'Datos inválidos','error' => $validator->errors()], 404);

            $user = User::where('id', $request->id)->first();

            if (is_null($user))
                return response()->json(['status' => false, 'message' => 'Usuario no encontrado'], 404);

            $user->fill($request->all());
            $user->update();

            if (!is_null($user)){
                return response()->json(['status' => true, 'message' => 'Theme modified']);
            }

            return response()->json(['status' => false, 'message' => 'Ocurrió un error inesperado al guardar los datos'],404);

        } catch (\Throwable $e) {
            logger('Update user' . $e);

        }
    }

}
