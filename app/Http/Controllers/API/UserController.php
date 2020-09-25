<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(User::where('status', 'active')
            ->where('id', '!=', '1')->get(), 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::create([
            "status" => "draft"
        ]);
        return response()->json(['user' => $user]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(["messgae" => "User record not found"], 404);
        }
        if ($user->file) {
            $user["file"] = $user->file;
        }
        return response()->json($user, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(["message" => "record not found"], 404);
        }
        $rules = [
            'name' => ['required', Rule::unique('users')->ignore($id)],
            'email' => ['required', Rule::unique('users')->ignore($id)],
            'password' => 'required',
        ];
        // $data = json_decode($request->all(), true);
        $data = $request->all();
        return $data;
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $data['password'] = Hash::make($data['password']);
        $data['status'] = 'active';
        // unset($data['file']);
        $user->update($data);

        return response()->json(["message" => "User updated successfully", "user" => $user]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($id == 1) {
            throw ValidationException::withMessages([
                'mesage' => 'Sorry! this user cannot be deleted'
            ]);
        }
        $user = User::find($id);
        if (!$user) {
            return response()->json(["message" => "record not found"], 404);
        }
        $user->delete();
        return response()->json(["message" => "User deleted successfully"]);
    }
}
