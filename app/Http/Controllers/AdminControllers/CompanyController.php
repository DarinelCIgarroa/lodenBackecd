<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $companies = Company::select('id', 'name', 'address', 'phone_number', 'email', 'logo')->get();

            return response()->json([
                'pagination' => [
                    'total' => $companies->total(),
                    'current_page' => $companies->currentPage(),
                    'per_page' => $companies->perPage(),
                    'last_page' => $companies->lastPage(),
                    'from' => $companies->firstItem(),
                    'to' => $companies->lastPage(),
                ],
                'companies' => $companies,
                'success' => true
            ], 202);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => $e->getMessage(),
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
            $company = new Company();
            $company->fill($request->all());
            $company->save();

            return response()->json([
                'messages' => $company,
                'success' => true
            ], 202);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'success' => false
            ], 404);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        try {
            return response()->json([
                'messages' => $company,
                'success' => true
            ], 202);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'success' => false
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company)
    {
        try {
            $company->fill($request->all());
            $company->save();
            return response()->json([
                'messages' => $company,
                'success' => true
            ], 202);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'success' => false
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        try {
            $company->delete();
            return response()->json([
                'success' => true
            ], 202);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'success' => false
            ], 404);
        }
    }
}
