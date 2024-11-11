<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Company::all();

        return response()->json($companies);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompanyRequest $request, Company $company)
    {
        $this->authorize('create', $company);

        $data = $request->validated();
        $company = Company::create($data);

        return response()->json($company);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $company = Company::find($id);

        return response()->json($company);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(CompanyRequest $request, $id, Company $company)
    {
        $company = Company::find($id);

        $this->authorize('update', $company);
        $company->update($request->validated());

        return response()->json($company);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $company = Company::find($id);

        $this->authorize('delete', $company);
        $company->delete();

        return response()->json("Company deleted successfuly!");

    }
}
