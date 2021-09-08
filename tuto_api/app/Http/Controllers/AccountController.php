<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccountPostRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Account;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $account = Account::all();
        return response()->json([
            'success' => true,
            'data' => $account
        ], 200);
    }

    /**
     * Display information about the resource
     *
     * @param $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        $account = Account::find($id);
        if (!$account) {
            return response()->json([
                'success' => false,
                'message' => 'account with id ' . $id . ' not found'
            ], 400);
        }

        return response()->json([
            'success' => true,
            'data' => $account
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AccountPostRequest $request
     * @return JsonResponse
     */
    public function store(AccountPostRequest $request): JsonResponse
    {
        $accountData = $request->all();
        $account = Account::create($accountData);

        return response()->json([
            'success' => true,
            'account' => $account
        ], 201);
    }

    /**
     * Delete the resource.
     *
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id) : JsonResponse
    {
        $account = Account::find($id);
        if (!$account) {
            return response()->json([
                'success' => false,
                'message' => 'account with id ' . $id . ' not found'
            ], 400);
        }else {
            $account->delete();
            return response()->json([
                'success' => true,
                'message' => 'successfull deleted'
            ], 200);
        }
    }

    /**
     * Update/edit the resource.
     *
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function update(Request $request, $id): JsonResponse
    {
        $account = Account::find($id);
        if (!$account) {
            return response()->json([
                'success' => false,
                'message' => 'account with id ' . $id . 'not found'
            ], 400);
        }

        $updated = $account->fill($request->all())->save();

        if ($updated)
            return response()->json([
                'success' => true
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'account could not be updated'
        ], 500);
    }

}
