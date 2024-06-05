@extends('layouts.app')

@section('content')
<script>
    setTimeout(() => {
        window.open("/resumo", "_blank");
    }, 1000);
</script>
<div class="flex items-center justify-center min-h-screen bg-gray-200">
    <div class="w-3/5 bg-yellow-400 border-2 border-yellow-200 rounded-lg shadow-md text-center py-20">
        <h2 class="text-8xl drop-shadow-md font-bold">419 | página expirada </h2>
        <p class="text-xl font-medium">Aguarde um momento encaminharemos você!</p>
        <div class="mt-10 p-4">
            <i class="fa-solid fa-circle-notch text-6xl animate-spin text-yellow-200"></i>
        </div>
    </div>
</div>
@endsection