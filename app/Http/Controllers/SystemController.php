<?php

namespace App\Http\Controllers;

use App\Http\Requests\SystemRequest;
use App\Models\Company;
use App\Models\System;
use App\Models\SystemStatus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class SystemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $systems = System::with(['company', 'systemStatus'])
                        ->whereHas('company', function($query){
                            $query->where('user_id', Auth::user()->id);
                        })->orWhereHas('company.members', function($query){
                            $query->where('user_id', Auth::user()->id);
                        })
                        ->orderBy('name', 'asc')
                        ->paginate(16);

        return view('systems.index', compact('systems'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        $companies = Company::query()->where('user_id', '=', Auth::user()->id)->get();
        $systemStatuses = SystemStatus::all();
        return view('systems.create', compact('companies', 'systemStatuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SystemRequest $request)
    {
        try {
            System::create($request->validated());
        } catch (\Exception $e) {
            return redirect()->route('systems.index')->with('error', 'Erro ao criar sistema: ' . $e->getMessage());
        }

        return redirect()->route('systems.index')->with('success', 'Sistema criado com sucesso');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $system = System::with('company', 'systemStatus')->findOrFail($id);

        if(Gate::denies('view_system', $system)){
            return redirect()->route('systems.index')->with('error', 'Você não tem permissão para visualizar este sistema');
        }

        return view('systems.show', compact('system'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $system = System::with('company', 'systemStatus')->findOrFail($id);

        if(Gate::denies('update_system', $system)){
            return redirect()->route('systems.index')->with('error', 'Você não tem permissão para atualizar este sistema');
        }

        $companies = Company::query()->where('user_id', '=', Auth::user()->id)->get();
        $systemStatuses = SystemStatus::all();
        return view('systems.edit', compact('system', 'companies', 'systemStatuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SystemRequest $request, string $id)
    {
        $system = System::with(['company', 'systemStatus'])->findOrFail($id);

        if(Gate::denies('update_system', $system)){
            return redirect()->route('systems.index')->with('error', 'Você não tem permissão para atualizar este sistema');
        }

        try {
            $system->update($request->validated());
        } catch (\Exception $e) {
            return redirect()->route('systems.index')->with('error', 'Erro ao atualizar sistema: ' . $e->getMessage());
        }

        return redirect()->route('systems.index')->with('success', 'Sistema atualizado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $system = System::findOrFail($id);
        
        if(Gate::denies('delete_system', $system)){
            return redirect()->route('systems.index')->with('error', 'Você não tem permissão para deletar este sistema');
        }
        
        $system->delete();
        return redirect()->route('systems.index')->with('success', 'Sistema excluído com sucesso');
    }
}
