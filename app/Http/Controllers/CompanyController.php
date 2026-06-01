<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use App\Models\Company;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Company::with('users')
                        ->orderBy('name', 'asc')
                        ->paginate(16);

        return view('companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompanyRequest $request)
    {
        try {
            Company::create($request->validated());
        } catch (\Exception $e) {
            return redirect()->route('companies.index')->with('error', 'Erro ao criar empresa: ' . $e->getMessage());
        }

        return redirect()->route('companies.index')->with('success', 'Empresa criada com sucesso');  
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $company = Company::findOrFail($id);

        return view('companies.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $company = Company::findOrFail($id);

        return view('companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CompanyRequest $request, string $id)
    {
        $company = Company::findOrFail($id);

        $company->update($request->validated());

        return redirect()->route('companies.index')->with('success', 'Empresa atualizada com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $company = Company::findOrFail($id);

        $company->delete();

        return redirect()->route('companies.index')->with('success', 'Empresa excluída com sucesso');
    }
}
