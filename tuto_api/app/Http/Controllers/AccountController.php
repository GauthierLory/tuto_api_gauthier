<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccountPostRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Account;
use App\User;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $idUser = $request->user()->id;
        //$user = User::findOrFail($idUSer);
        
        $immeuble = DB::table('immeubles')
            ->join('accounts', 'immeubles.id', '=', 'accounts.immeuble_id')
            ->where('accounts.user_id', $idUser)
            ->get();
        return response()->json($immeuble, 200);
    }

    

    /**
     * Display information about the resource
     *
     * @param $id
     * @return JsonResponse
     */
    public function show(Request $request, $id): JsonResponse
    {
        $idUser = $request->user()->id;
        $immeuble = DB::table('immeubles')
            ->join('accounts', 'immeubles.id', '=', 'accounts.immeuble_id')
            ->join('users', 'users.id', '=', 'accounts.user_id')
            ->where('accounts.user_id', $idUser)
            ->where('accounts.immeuble_id', $id)
            ->select('users.id','users.pseudo', 'users.email', 'users.address', 'users.city', 'users.phone', 'immeubles.id', 'immeubles.name', 'immeubles.code_im', 'immeubles.code_soc', 'accounts.id', 'accounts.content')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $immeuble
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AccountPostRequest $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
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
