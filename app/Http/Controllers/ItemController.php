<?php

namespace App\Http\Controllers;

use App\Models\CompanyUser;
use App\Models\Item;
use App\Models\Status;
use App\Models\System;
use App\Models\Type;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::with('system', 'type', 'status', 'tester', 'developer', 'created_by')
                    ->where(function($query) {
                        $query->where('created_by', Auth::user()->id)
                            ->orWhere('tester_id', Auth::user()->id)
                            ->orWhere('developer_id', Auth::user()->id);
                    })
                    ->orderBy('number', 'asc')
                    ->paginate(16);
        
        return view('items.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $system =  System::with('company')
                        ->findOrFail($request->query('system_id'));

        $systems = collect([$system]);

        $users = $system->company->members()
                    ->withPivot('role_id')
                    ->orderBy('name')
                    ->get();

        $testers = $users->where('pivot.role_id', 4);
        $developers = $users->where('pivot.role_id', 3);

        $types = Type::all();
        $statuses = Status::all();

        return view('items.create', compact('systems', 'types', 'statuses', 'testers', 'developers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $item = Item::with('system', 'type', 'status', 'tester', 'developer', 'created_by')
                    ->findOrFail($id);

        return view('items.show', compact('item', 'systems', 'types', 'statuses', 'testers', 'developers'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
