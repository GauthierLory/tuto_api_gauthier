<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Immeuble;

class ImmeubleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $immeuble = Immeuble::all();
        return response()->json([
            'success' => true,
            'data' => $immeuble
        ], 200);
    }

    /**
     * Display information about the resource
     * 
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
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
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $immeuble = new Immeuble();
        
        $validated = $request->validate([
            'address' => 'required',
            'name' => 'required',
            'code_im' => 'required',
            'code_soc' => 'required'
        ]);

        if ($validated){

            $immeubleData = $request->all();
            $immeuble = Immeuble::create($immeubleData);

            return response()->json([
                'success' => true,
                'data' => $immeuble->toArray()
            ]);
        }
        else
        return response()->json([
            'success' => false,
            'message' => 'Immeuble could not be added'
        ], 500);
    }
}
