<!-- Herda o layout padrão definido no template "main" -->
@extends('templates.main', ['titulo' => "Veterinarios", 'rota' => "veterinarios.create"])
<!-- Preenche o conteúdo da seção "titulo" -->
@section('titulo') Veterinarios @endsection
<!-- Preenche o conteúdo da seção "conteudo" -->
@section('conteudo')

    <div class="row">
        <div class="col">
            <x-datalist 
                title="Veterinario" 
                crud="veterinarios" 
                :header="['id', 'nome', 'crmv', 'ações']" 
                :data="$dados"
                :hide="[true, false, true, false]" 
            /> 
        </div>
    </div>
@endsection