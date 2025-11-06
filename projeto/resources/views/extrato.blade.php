@extends('layouts.default')
@section('style')
<style>
    .extrato-positivo-destaque{
        background-color: #6aff9966;
    }
    .extrato-negativo-destaque{
        background-color: #fd5c5c66;
    }
</style>
@endsection
@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-center align-item-center">
        <h3 class="card-title">Extrato</h3>
    </div>
    <div class="card-body">
        @if($extrato_usuario->isNotEmpty())
        @foreach($extrato_usuario as $extrato)

            @if($extrato->num_conta == $extrato->num_conta_origem)
                <a href="{{ route('extrato.detalhes', $extrato->cod_transacao) }}" class="card mb-2 {{$extrato->valor >= 5000 ? 'extrato-negativo-destaque' : ''}}">
                    <div class="card-body">
                        <div class="row d-flex">
                            <div class="col-6">
                                {{$extrato->data_transacao}}
                            </div>
                            <div class="col-6 d-flex justify-content-end">
                                <span class="text-danger"> {{$extrato->valor}}</span>
                            </div>
                        </div>
                    </div>
                </a>
            @else
                <a href="{{ route('extrato.detalhes', $extrato->cod_transacao) }}" class="card mb-2 {{$extrato->valor >= 5000 ? 'extrato-positivo-destaque' : ''}}">
                    <div class="card-body">
                        <div class="row d-flex">
                            <div class="col-6">
                                {{$extrato->data_transacao}}
                            </div>
                            <div class="col-6 d-flex justify-content-end">
                                <span class="text-success"> {{$extrato->valor}}</span>
                            </div>
                        </div>
                    </div>
                </a>
            @endif
        @endforeach
        @endif
    </div>
</div>
@endsection
