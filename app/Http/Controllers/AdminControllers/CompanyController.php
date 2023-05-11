<?php

namespace App\Http\Controllers\AdminControllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $company = Company::select(
                'id',
                'name',
                'city',
                'state',
                'zip_code',
                'country',
                'address',
                'phone_number',
                'email',
                'logo'
            )->first();

            return response()->json([
                'company' => $company,
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
            DB::beginTransaction();

            $company = Company::first() ?? new Company();
            $company->fill($request->all());

            if ($request->hasFile('logo')) {
                Storage::disk('users')->deleteDirectory('company');

                $path = $request->file('logo')->store('company', 'users');
               // $file_name = basename($path);

                $company->logo = $path;
            }
            $company->save();
            DB::commit();

            return response()->json([
                'company' => $company,
                'message' => 'El registro se agregó con éxito',
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

    public function getCompanyLogo(Request $request)
    {
        try {
            $url_image = $request->path;
            $url = basename(Storage::url("{$url_image}"));
            return response()->json([
                'url' => $url,
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
