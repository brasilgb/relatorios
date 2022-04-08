@extends('layouts.app')

@section('content')

<div class="container mx-auto py-5">
    <h1 class="text-3xl uppercase font-bold text-gray-500">Gerar relatorios pdf</h1>
</div>
<div class="container mx-auto bg-gray-50 my-5 p-10 rounded-md shadow-md">

    <form action="{{ route('resumo') }}" method="POST">
        @method('POST')
        @csrf
        <div class="flex flex-row justify-start items-center">
            <label class="pr-12 text-gray-600 text-xl">Gera relatório de resumo Naturovos</label>
            <button type="submit" name="relatorio" class="w-auto bg-blue-400 border-2 border-white py-2 px-6 text-white rounded-md shadow-md">Gerar</button>
        </div>
    </form>
</div>

@endsection