<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Company::with('owner')
                        ->where('user_id', '=', Auth::user()->id)
                        ->orWhereHas('members', function($query){
                            $query->where('user_id', '=', Auth::user()->id);
                        })
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
            DB::beginTransaction();
            $company = Company::create($request->validated());
            $company->members()->attach(Auth::user()->id, ['role_id' => 1]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
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

        if(Gate::denies('update_company', $company)){
            return redirect()->route('companies.index')->with('error', 'Você não tem permissão para atualizar esta empresa');
        }

        return view('companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CompanyRequest $request, string $id)
    {
        $company = Company::findOrFail($id);

        if(Gate::denies('update_company', $company)){
            return redirect()->route('companies.index')->with('error', 'Você não tem permissão para atualizar esta empresa');
        }

        $company->update($request->validated());

        return redirect()->route('companies.index')->with('success', 'Empresa atualizada com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {   
        $company = Company::findOrFail($id);

        if(Gate::denies('delete_company', $company)){
            return redirect()->route('companies.index')->with('error', 'Você não tem permissão para excluir esta empresa');
        }

        $company->delete();

        return redirect()->route('companies.index')->with('success', 'Empresa excluída com sucesso');
    }
}
