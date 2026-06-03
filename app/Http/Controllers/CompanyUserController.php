<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyUserRequest;
use App\Models\Company;
use App\Models\CompanyUser;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;    
use Illuminate\Support\Facades\Gate;

class CompanyUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id)
    {
        $company = Company::findOrFail($id);

        if(Gate::denies('view_company_users', $company)){
            return redirect()->route('companies.index')->with('error', 'Você não tem permissão para visualizar os usuários desta empresa');
        }

        $roles = Role::all()->except(1);
        $users = User::whereNotIn('id', CompanyUser::whereCompanyId($id)->pluck('user_id'))->get();
        $companyUsers = CompanyUser::whereCompanyId($id)->with('user', 'role')->get();
        return view('companies.users.index', compact('company', 'roles', 'users', 'companyUsers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompanyUserRequest $request)
    {
        $company = Company::findOrFail($request->company_id);
        if(Gate::denies('store_company_user', $company)){
            return redirect()->route('companies.index')->with('error', 'Você não tem permissão para vincular usuários a esta empresa');
        }

        try {
            CompanyUser::create($request->validated());
        } catch (\Exception $e) {
            return redirect()->route('companyUsers.index', $request->company_id)->with('error', 'Erro ao vincular usuário: ' . $e->getMessage());
        }
        return redirect()->route('companies.companyUsers.index', $request->company_id)->with('success', 'Usuário vinculado com sucesso');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $company_id, string $company_user_id)
    {
        $company = Company::findOrFail($company_id);
        if(Gate::denies('update_company_user', $company)){
            return redirect()->route('companies.index')->with('error', 'Você não tem permissão para atualizar este usuário');
        }

        
        $companyUser = CompanyUser::findOrFail($company_user_id);
        $roles = Role::all();
        return view('companies.users.edit', compact('company', 'companyUser', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $company_id, string $company_user_id)
    {
        $company = Company::findOrFail($company_id);
        if(Gate::denies('update_company_user', $company)){
            return redirect()->route('companies.index')->with('error', 'Você não tem permissão para atualizar este usuário');
        }

        $companyUser = CompanyUser::findOrFail($company_user_id);
        
        if($companyUser->role_id == 1){
            return redirect()->route('companies.companyUsers.index', $company_id)->with('error', 'Usuário não pode ser atualizado');
        }

        try {
            $companyUser->role_id = $request->role_id;
            $companyUser->save();
        } catch (\Exception $e) {
            return redirect()->route('companies.companyUsers.index', $company_id)->with('error', 'Erro ao atualizar papel: ' . $e->getMessage());
        }
        return redirect()->route('companies.companyUsers.index', $company_id)->with('success', 'Papel atualizado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $company_id, string $company_user_id)
    {
        $company = Company::findOrFail($company_id);
        if(Gate::denies('delete_company_user', $company)){
            return redirect()->route('companies.index')->with('error', 'Você não tem permissão para excluir este usuário');
        }

        $company_user = CompanyUser::findOrFail($company_user_id);
        if($company_user->role_id == 1){
            return redirect()->route('companyUsers.index', $company_id)->with('error', 'Usuário não pode ser removido');
        }
        
        try {
            $company_user->delete();
        } catch (\Exception $e) {
            return redirect()->route('companyUsers.index', $company_id)->with('error', 'Erro ao remover usuário: ' . $e->getMessage());
        }
        return redirect()->route('companies.companyUsers.index', $company_id)->with('success', 'Usuário removido com sucesso');
    }
}
