<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CompanyUser;

class Role extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = ['name', 'description'];

    public function userCompanies()
    {
        return $this->hasMany(CompanyUser::class);
    }
}
