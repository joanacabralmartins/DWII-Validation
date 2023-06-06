<?php

namespace App\Http\Controllers;
use App\Models\Cliente;
use GuzzleHttp\Psr7\Request as Psr7Request;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        $dados = Cliente::all();
        return view ('clientes.index', compact('dados'));
    }

    public function create()
    {
        return view('clientes.create');
    }

    public function store(Request $request)
    {
        $regras = [
            'nome' => 'required|max:100|min:10',
            'email' => 'required|max:150|min:15|unique:clientes',
        ];

        $msgs = [
            "required" => "O preenchimento do campo :attribute é obrigatório!",
            "max" => "O campo :attribute possui tamanho máximo de :max caracteres!",
            "min" => "O campo :attribute possui tamanho mínimo de :min caracteres!",
            "unique" => "Já existe um cliente cadastrado com esse :attribute!"
        ];

        $request->validate($regras, $msgs);

        Cliente::create([
            'nome' => mb_strtoupper($request->nome, 'UTF-8'),
            'email' => $request->email,
        ]);

        return redirect()->route('clientes.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $dados = Cliente::find($id);

        if(!isset($dados)) { return "<h1>ID: $id não encontrado!</h1>"; }

        return view('clientes.edit', compact('dados'));  
    }

    public function update(Request $request, $id)
    {
        $obj = Cliente::find($id);

        if(!isset($obj)) { return "<h1>ID: $id não encontrado!"; }

        $obj->fill([
            'nome' => mb_strtoupper($request->nome, 'UTF-8'),
            'email' => $request->email,
        ]);

        $obj->save();

        return redirect()->route('clientes.index');
    }

    public function destroy($id)
    {
        Cliente::destroy($id);

        return redirect()->route('clientes.index');
    }
}
