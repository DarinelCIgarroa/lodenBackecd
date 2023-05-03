<?php

namespace App\Http\Controllers\AdminControllers;
use Exception;

use App\Models\Team;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTeamRequest;
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
            $teams = Team::select('id', 'name', 'last_name', 'second_last_name', 'email', 'phone_number', 'instagram_link', 'facebook_link', 'intro', 'occupation')
                ->paginate($rows_page);

            return response()->json([
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
    public function store(StoreTeamRequest $request)
    {
        try {
            $team = new team();
            $team->fill($request->all());
            $team->save();

            return response()->json([
                'message' => 'Registro creado con éxito',
                'integrant' => $team,
                'success' => true
            ], 202);

        } catch (Exception $e) {
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
    public function update(Request $request, Team $team)
    {
        try {
            $team->fill($request->all());
            $team->save();

            return response()->json([
                'integrant' => $team,
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
    public function destroy(Team $team)
    {
        try {
            $team->delete();

            return response()->json([
                'integrant' => $team,
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
