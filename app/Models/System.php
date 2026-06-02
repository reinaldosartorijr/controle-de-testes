<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class System extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = ['name', 'code', 'description', 'active', 'company_id', 'system_status_id'];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'active' => 'boolean',
        ];
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function systemStatus()
    {
        return $this->belongsTo(SystemStatus::class);
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
