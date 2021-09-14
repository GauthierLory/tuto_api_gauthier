<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImmeublePostRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Immeuble;

class ImmeubleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $immeuble = Immeuble::all();
        return response()->json($immeuble, 200);
    }

    /**
     * Display information about the resource
     *
     * @param $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        $immeuble = Immeuble::find($id);
        if (!$immeuble) {
            return response()->json([
                'success' => false,
                'message' => 'immeuble with id ' . $id . ' not found'
            ], 400);
        }

        return response()->json([
            'success' => true,
            'data' => $immeuble
        ], 200);
    }

    /**
     * Delete the resource.
     *
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $immeuble = Immeuble::find($id);
        if (!$immeuble) {
            return response()->json([
                'success' => false,
                'message' => 'immeuble with id ' . $id . ' not found'
            ], 400);
        }else {
            $immeuble->delete();
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
        $immeuble = Immeuble::find($id);
        if (!$immeuble) {
            return response()->json([
                'success' => false,
                'message' => 'immeuble with id ' . $id . ' not found'
            ], 400);
        }

        $updated = $immeuble->fill($request->all())->save();

        if ($updated)
            return response()->json([
                'success' => true
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'immeuble could not be updated'
        ], 500);
    }

    /**
    * Store a newly created resource in storage.
    * @param ImmeublePostRequest $request
    * @return JsonResponse
    */
    public function store(ImmeublePostRequest $request): JsonResponse
    {

            $immeubleData = $request->all();
            $immeuble = Immeuble::create($immeubleData);

            return response()->json([
                'success' => true,
                'data' => $immeuble->toArray()
            ]);
    }
}
