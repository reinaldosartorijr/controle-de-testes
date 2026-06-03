<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemRequest;
use App\Models\Item;
use App\Models\Status;
use App\Models\System;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $system_id = request()->query('system_id');
        $items = Item::with('system', 'type', 'status', 'tester', 'developer', 'createdBy')
                    ->where(function($query) {
                        $query->where('created_by', Auth::user()->id)
                            ->orWhere('tester_id', Auth::user()->id)
                            ->orWhere('developer_id', Auth::user()->id);
                    })
                    ->where('system_id', $system_id)
                    ->orderBy('number', 'asc')
                    ->paginate(16);
        
        return view('items.index', compact('items', 'system_id'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $system =  System::with('company')
                        ->findOrFail($request->query('system_id'));

        if(Gate::denies('system_items_analyst', $system)){
            return redirect()->route('systems.index')->with('error', 'Você não tem permissão para criar itens para este sistema');
        }

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
    public function store(ItemRequest $request)
    {

        $system = System::with('company')
                        ->findOrFail($request->input('system_id'));

        if(Gate::denies('system_items_analyst', $system)){
            return redirect()->route('systems.index')->with('error', 'Você não tem permissão para criar itens para este sistema');
        }

        try {
            DB::beginTransaction();
            Item::create($request->validated());

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('items.index', ['system_id' => $system->id])->with('error', 'Erro ao criar item: ' . $e->getMessage());
        }

        return redirect()->route('items.index', ['system_id' => $system->id])->with('success', 'Item criado com sucesso');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $item = Item::with('system', 'type', 'status', 'tester', 'developer', 'createdBy')
                    ->findOrFail($id);

        if(Gate::denies('view_item', $item)){
            return redirect()->route('items.index', ['system_id' => $item->system_id])->with('error', 'Você não tem permissão para visualizar este item');
        }

        return view('items.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = Item::with('system', 'type', 'status', 'tester', 'developer', 'createdBy')
                    ->findOrFail($id);

        if(Gate::denies('update_item', $item)){
            return redirect()->route('items.index', ['system_id' => $item->system_id])->with('error', 'Você não tem permissão para editar este item');
        }

        $systems = collect([$item->system]);

        $users = $item->system->company->members()
                    ->withPivot('role_id')
                    ->orderBy('name')
                    ->get();

        $testers = $users->where('pivot.role_id', 4);
        $developers = $users->where('pivot.role_id', 3);

        $types = Type::all();
        $statuses = Status::all();

        return view('items.edit', compact('item', 'systems', 'types', 'statuses', 'testers', 'developers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ItemRequest $request, string $id)
    {
        $item = Item::with('system', 'type', 'status', 'tester', 'developer', 'createdBy')
                    ->findOrFail($id);

        if(Gate::denies('update_item', $item)){
            return redirect()->route('items.index')->with('error', 'Você não tem permissão para atualizar este item')->with('system_id', $item->system_id);
        }

        $item->update($request->validated());

        return redirect()->route('items.index', ['system_id' => $item->system_id])->with('success', 'Item atualizado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Item::with('system', 'type', 'status', 'tester', 'developer', 'createdBy')
                    ->findOrFail($id);

        if(Gate::denies('delete_item', $item)){
            return redirect()->route('items.index', ['system_id' => $item->system_id])->with('error', 'Você não tem permissão para deletar este item');
        }

        $item->delete();
        return redirect()->route('items.index', ['system_id' => $item->system_id])->with('success', 'Item deletado com sucesso');
    }
}
