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
    public function index(Request $request)
    {
        try {

            $rows_page = $request->rows_page;
            // return $test;
            $teams = Team::select('id', 'name', 'last_name', 'second_last_name', 'email', 'phone_number', 'instagram_link', 'facebook_link', 'intro', 'occupation')
                ->paginate($rows_page);

            return response()->json([
                'pagination' => [
                    'total' => $teams->total(),
                    'current_page' => $teams->currentPage(),
                    'per_page' => $teams->perPage(),
                    'last_page' => $teams->lastPage(),
                    'from' => $teams->firstItem(),
                    'to' => $teams->lastPage(),
                ],
                'members' => $teams,
                'success' => true
            ], 202);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Error al obtener los registros',
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
                'member' => $Team,
                'success' => true
            ], 202);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Error al crear el registro',
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
                'member' => $Team,
                'success' => true
            ], 202);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Error al actulizar el registro',
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
                'message' => 'Error al eliminar el registro',
                'error' => $e->getMessage(),
                'success' => false
            ], 404);
        }
    }
}
