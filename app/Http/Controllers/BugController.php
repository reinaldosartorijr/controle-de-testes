<?php

namespace App\Http\Controllers;

use App\Http\Requests\BugRequest;
use App\Models\Bug;
use App\Models\Item;
use App\Models\Status;
use App\Models\System;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class BugController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $item = Item::with('system', 'type', 'status', 'tester', 'developer', 'createdBy')
                    ->findOrFail($request->item);
        $system = System::findOrFail($item->system_id);

        if(Gate::denies('create_bug', [Bug::class, $item])){
            return redirect()->route('items.index', ['system_id' => $system->id])->with('error', 'Você não tem permissão para visualizar bugs deste item');
        }
        
        $bugs = Bug::with('item', 'status', 'createdBy')
                    ->where('item_id', $request->item)
                    ->orderBy('id', 'asc')
                    ->paginate(16);
        
        

        

        return view('bugs.index', compact('bugs', 'item', 'system'));
            
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $item = Item::with('system', 'type', 'status', 'tester', 'developer', 'createdBy')
                    ->findOrFail($request->item);

        if(Gate::denies('create_bug', [Bug::class, $item])){
            return redirect()->route('items.bugs.index', $request->item)->with('error', 'Você não tem permissão para criar bugs');
        }

        $statuses = Status::all();

        return view('bugs.create', compact('item', 'statuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BugRequest $request)
    {
        $item = Item::with('system', 'type', 'status', 'tester', 'developer', 'createdBy')
                    ->findOrFail($request->item);

        if(Gate::denies('create_bug', [Bug::class, $item])){
            return redirect()->route('items.bugs.index', $request->item)->with('error', 'Você não tem permissão para criar bugs');
        }

        try {
            DB::beginTransaction();
            Bug::create($request->validated());
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('items.bugs.index', $request->item)->with('error', 'Erro ao criar bug: ' . $e->getMessage());
        }
        return redirect()->route('items.bugs.index', $request->item)->with('success', 'Bug criado com sucesso');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $item, string $bug)
    {
        $bug = Bug::with('item', 'status', 'createdBy')
                    ->findOrFail($bug);

        $item = Item::with('system', 'type', 'status', 'tester', 'developer', 'createdBy')
                    ->findOrFail($item);

        if(Gate::denies('view_bug', $bug)){
            return redirect()->route('items.bugs.index', $item)->with('error', 'Você não tem permissão para visualizar este bug');
        }
        
        $statuses = Status::all();

        return view('bugs.show', compact('bug', 'item', 'statuses'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $item, string $bug)
    {

        $bug = Bug::with('item', 'status', 'createdBy')
                    ->findOrFail($bug);
        $item = Item::with('system', 'type', 'status', 'tester', 'developer', 'createdBy')
                    ->findOrFail($item);

        if(Gate::denies('update_bug', $bug)){
            return redirect()->route('items.bugs.index', $item)->with('error', 'Você não tem permissão para atualizar este bug');
        }
        
        $statuses = Status::all();
        return view('bugs.edit', compact('bug', 'item', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BugRequest $request, string $item, string $bug)
    {
        $bug = Bug::with('item', 'status', 'createdBy')
                    ->findOrFail($bug);

        if(Gate::denies('update_bug', $bug)){
            return redirect()->route('items.bugs.index', $item)->with('error', 'Você não tem permissão para atualizar este bug');
        }

        try {
            DB::beginTransaction();
            Bug::findOrFail($bug)->update($request->validated());
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('items.bugs.index', $item)->with('error', 'Erro ao atualizar bug: ' . $e->getMessage());
        }
        return redirect()->route('items.bugs.index', $item)->with('success', 'Bug atualizado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $item, string $bug)
    {
        $bug = Bug::with('item', 'status', 'createdBy')
                    ->findOrFail($bug);

        if(Gate::denies('delete_bug', $bug)){
            return redirect()->route('items.bugs.index', $item)->with('error', 'Você não tem permissão para deletar este bug');
        }

        try {
            DB::beginTransaction();
            $bug->delete($bug->id);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('items.bugs.index', $item)->with('error', 'Erro ao excluir bug: ' . $e->getMessage());
        }
        return redirect()->route('items.bugs.index', $item)->with('success', 'Bug excluído com sucesso');
    }
}
