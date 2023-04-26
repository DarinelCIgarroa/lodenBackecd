<?php

namespace App\Http\Controllers\AdminControllers;
use App\Models\Team;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TeamController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $Teams = Team::select('id', 'name', 'description', 'start_date', 'end_date', 'place', 'address', 'city', 'image')->get();
            return response()->json([
                'Teams' => $Teams,
                'success' => true
            ], 202);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Error al obteber los Teamos',
                'error' => $e->getMessage(),
                'success' => false
            ], 404);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $Team = new Team();
            $Team->fill($request->all());
            $Team->save();

            return response()->json([
                'Team' => $Team,
                'success' => true
            ], 202);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Error al crear el Teamo',
                'error' => $e->getMessage(),
                'success' => false
            ], 404);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Team $Team)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Team $Team)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Team $Team)
    {
        try {
            $Team->fill($request->all());
            $Team->save();

            return response()->json([
                'Team' => $Team,
                'success' => true
            ], 202);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Error al actulizar el Teamo',
                'error' => $e->getMessage(),
                'success' => false
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Team $Team)
    {
        try {
            $Team->delete();

            return response()->json([
                'success' => true
            ], 202);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Error al eliminar el Teamo',
                'error' => $e->getMessage(),
                'success' => false
            ], 404);
        }
    }
}
