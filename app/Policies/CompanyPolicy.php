<?php

namespace App\Policies;

use App\Models\Company;
use App\Models\User;
use Illuminate\Auth\Access\Response;


class CompanyPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function delete_company(User $user, Company $company)
    {
        if($company->systems()->count() > 0) {
            return Response::deny('Você não tem permissão para excluir esta empresa porque ela possui sistemas');
        }

        if($company->members()->count() > 0) {
            return Response::deny('Você não tem permissão para excluir esta empresa porque ela possui usuários');
        } 
        
        return$user->id === $company->user_id ? Response::allow() : Response::deny('Você não tem permissão para excluir esta empresa');
    }

    public function update_company(User $user, Company $company)
    {
        return $user->id === $company->user_id ? Response::allow() : Response::deny('Você não tem permissão para atualizar esta empresa');
    }

    public function view_company(User $user, Company $company)
    {
        return $user->id === $company->user_id || $company->members()->where('user_id', $user->id)->exists() ? Response::allow() : Response::deny('Você não tem permissão para visualizar esta empresa');
    }

    public function view_company_users(User $user, Company $company)
    {
        return $user->id === $company->user_id ? Response::allow() : Response::deny('Você não tem permissão para visualizar os usuários desta empresa');
    }

    public function store_company_user(User $user, Company $company)
    {
        return $user->id === $company->user_id ? Response::allow() : Response::deny('Você não tem permissão para vincular usuários a esta empresa');
    }

    public function update_company_user(User $user, Company $company)
    {
        return $user->id === $company->user_id ? Response::allow() : Response::deny('Você não tem permissão para atualizar este usuário');
    }

    public function delete_company_user(User $user, Company $company)
    {
        return $user->id === $company->user_id ? Response::allow() : Response::deny('Você não tem permissão para excluir este usuário');
    }
}
