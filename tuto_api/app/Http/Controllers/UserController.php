<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $users = User::all();
        return response()->json($users, 200);
    }

    /**
     * Display information about the resource
     *
     * @return JsonResponse
     */
    public function show($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User with id ' . $id . 'not found'
            ],200);
        }

        return response()->json([
            'success' => true,
            'data' => $user
        ], 200);
    }

    /**
     * Delete the resource.
     *
     * @return JsonResponse
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
     * @return JsonResponse
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

        $userData = $request->all();
        $updated = $user->fill($userData)->save();

        if ($updated)
            return response()->json([
                'success' => true,
                'data' => $userData
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
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $userData = $request->all();
        $user = User::create($userData);

        return response()->json([
            'succes'=> true,
        ], 200);
    }

}
