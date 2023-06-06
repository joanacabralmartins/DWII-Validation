<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Veterinario;
use App\Models\Especialidade;

class VeterinarioController extends Controller
{
    public function index()
    {
        $dados = Veterinario::all();
        return view ('veterinarios.index', compact('dados'));
    }

    public function create()
    {
        $dados_esp = Especialidade::all();
        return view ('veterinarios.create', compact('dados_esp'));
    }

    public function store(Request $request)
    {
        $regras = [
            'nome' => 'required|max:100|min:10',
            'crmv' => 'required|max:10|min:5|unique:veterinarios',
            'especialidade_id' => 'required',
        ];

        $msgs = [
            "required" => "O preenchimento do campo :attribute é obrigatório!",
            "max" => "O campo :attribute possui tamanho máximo de :max caracteres!",
            "min" => "O campo :attribute possui tamanho mínimo de :min caracteres!",
            "unique" => "Esse :attribute já foi cadastrado!"
        ];

        $request->validate($regras, $msgs);

        Veterinario::create([
            'nome' => mb_strtoupper($request->nome, 'UTF-8'),
            'crmv' => $request->crmv,
            'especialidade_id' => $request->especialidade_id,
        ]);

        return redirect()->route('veterinarios.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $dados = Veterinario::find($id);
        $dados_esp = Especialidade::all();

        if(!isset($dados)) { return "<h1>ID: $id não encontrado!</h1>"; }

        return view('veterinarios.edit', compact('dados', 'dados_esp')); 
    }

    public function update(Request $request, $id)
    {
        $obj = Veterinario::find($id);

        if(!isset($obj)) { return "<h1>ID: $id não encontrado!"; }

        $obj->fill([
            'nome' => mb_strtoupper($request->nome, 'UTF-8'),
            'crmv' => $request->crmv,
            'especialidade_id' => $request->especialidade_id,
        ]);

        $obj->save();

        return redirect()->route('veterinarios.index');
    }

    public function destroy($id)
    {
        Veterinario::destroy($id);

        return redirect()->route('veterinarios.index');
    }
}
