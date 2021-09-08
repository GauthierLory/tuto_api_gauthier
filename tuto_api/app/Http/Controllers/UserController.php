<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return response()->json([
            'success' => true,
            'data' => $users
        ], 200);
    }

    /**
     * Display information about the resource
     * 
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User with id ' . $id . 'not found'
            ], 400);
        }

        return response()->json([
            'success' => true,
            'data' => $user
        ], 200);
    }

    /**
     * Delete the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User with id ' . $id . 'not found'
            ], 400);
        }else {
            $user->delete();
            return response()->json([
                'success' => true,
                'message' => 'successfull deleted'
            ], 200);
        }
    }

    /**
     * Update/edit the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User with id ' . $id . 'not found'
            ], 400);
        }

        $updated = $user->fill($request->all())->save();

        if ($updated)
            return response()->json([
                'success' => true
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'User could not be updated'
        ], 500);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userData = $request->all();
        $user = User::create($userData);
  
        return $user;
    }

}