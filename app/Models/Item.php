<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'number', 
        'ticket', 
        'client', 
        'system_id', 
        'title', 
        'version', 
        'description', 
        'preconditions', 
        'steps', 
        'expected_result', 
        'actual_result', 
        'observations', 
        'tester_id', 
        'developer_id', 
        'created_by',
        'start_date',
        'end_date',
        'type_id', 
        'status_id'
    ];

    public function system()
    {
        return $this->belongsTo(System::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function tester()
    {
        return $this->belongsTo(User::class, 'tester_id');
    }

    public function developer()
    {
        return $this->belongsTo(User::class, 'developer_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    
}
