@extends('layouts.default')
@section('style')
<style>
    .erro {
        color: red;
        font-size: 0.9em;
    }
</style>
@endsection
@section('content')
<div class="card d-flex justify-content-center align-items-center" >
    <form action="{{route('usuario.store')}}" id="meuFormulario" method="post">
        <div class="input-group mb-3 d-grid">
            <div class="input-group">
                <span class="input-group-text" id="basic-addon1">CPF:</span>
                <input type="text" class="form-control" maxlength="11" name="cpf" id="cpf" placeholder="">
            </div>
            <span id="cpfErro" class="erro col-6"></span><br>
        </div>
        <div class="input-group mb-3">
            <div class="input-group">
                <span class="input-group-text" id="basic-addon1">data de nascimento:</span>
                <input type="date" class="form-control"  name="data" id="data" placeholder="20/10/1990">
            </div>
            <span id="dataErro" class="erro col-6"></span><br>
        </div>
        <div class="input-group mb-3">
            <div class="input-group">
                <span class="input-group-text" id="basic-addon1">Numero de Telefone:</span>
                <input type="tel" class="form-control"  name="numero" id="numero" placeholder="Username">
            </div>
            <span id="numeroErro" class="erro col-6"></span><br>
        </div>
        <button type="submit" class="btn btn-success">Salvar</button>
    </form>
</div>
@endsection
@section('script')
<script>
document.getElementById('meuFormulario').addEventListener('submit', function(event) {
    event.preventDefault(); 
    
    let formularioValido = true; 

    if (!validarCPF()) {
        formularioValido = false;
    }

    if (!validarDataNascimento()) {
        formularioValido = false;
    }

    if (!validarTelefone()) {
        formularioValido = false;
    }

    if (formularioValido) {
        alert('Formulário validado com sucesso! Pronto para envio.');
    }
});

function validarCPF() {
    const cpfInput = document.getElementById('cpf');
    const cpfErro = document.getElementById('cpfErro');
        const cpfLimpo = cpfInput.value.replace(/\D/g, ''); 

    cpfErro.textContent = ''; 
    if (cpfLimpo.length !== 11) {
        cpfErro.textContent = 'O CPF deve conter exatamente 11 dígitos.';
        return false;
    }
    
        
    return true;
}

function validarDataNascimento() {
    const dataInput = document.getElementById('data');
    const dataErro = document.getElementById('dataErro');
    const dataValor = dataInput.value;

    dataErro.textContent = ''; 
    if (dataValor === "") {
        dataErro.textContent = 'A data de nascimento é obrigatória.';
        return false;
    }

        const data = new Date(dataValor);
    const hoje = new Date();
    
        hoje.setHours(0, 0, 0, 0); 
    
        if (isNaN(data.getTime())) {
         dataErro.textContent = 'Data de nascimento inválida.';
         return false;
    }

        if (data >= hoje) {
        dataErro.textContent = 'A data de nascimento não pode ser futura.';
        return false;
    }

    return true;
}

function validarTelefone() {
    const telefoneInput = document.getElementById('numero');
    const numeroErro = document.getElementById('numeroErro');
    const telefoneValor = telefoneInput.value;

    numeroErro.textContent = ''; 
    const regexTelefone = /^\s*(\(?\d{2}\)?\s*)?(\d{4,5}[-.\s]?\d{4})\s*$/;
    
    const telefoneLimpo = telefoneValor.trim().replace(/[()\s-.]/g, '');
    
    if (telefoneLimpo.length < 8 || telefoneLimpo.length > 11) {
        numeroErro.textContent = 'O telefone deve ter entre 8 e 11 dígitos.';
        return false;
    }

        if (!regexTelefone.test(telefoneValor)) {
         numeroErro.textContent = 'Formato de telefone inválido.';
         return false;
    }

    return true;
}
</script>
@endsection
