<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\CONTA_USUARIO;
use App\Models\TRANSACOES;
use DB;

class transacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(['teste']);
    }

    public function postTransacao(Request $request){
        if(empty($request->all())){
            return response()->json(['Nenhuma transação pode ser realizada, pois nenhum parâmetro de transação foi inserido!']);
        }

        //valida existencia das contas
        $conta_origem = CONTA_USUARIO::where('num_conta', $request->num_conta_origem)->first();
        $conta_destino = CONTA_USUARIO::where('num_conta', $request->num_conta_destino)->first();
        if(empty($conta_origem) || empty($conta_destino)){
            return response()->json([
                'status' => 'erro',
                'mensagem' => 'Conta de origem ou destino inexistentes, verifique o número da conta e tente novamente.'
            ], 400); 
        }

        $valor = $request->valor;

        // valida o saldo
        if ($conta_origem->saldo < $valor) {
            return response()->json([
                'status' => 'erro',
                'mensagem' => 'Saldo insuficiente para realizar a transferência.'
            ], 400);
        }
        
        $valor = str_replace(',', '.', $valor);
        try {
            DB::beginTransaction();
            $conta_origem->saldo = $conta_origem->saldo - $valor ;
            $conta_destino->saldo = $valor + $conta_destino->saldo;
            $conta_origem->save();
            $conta_destino->save();
            $codigoUnico = (string) Str::uuid(); // Laravel usa UUID para códigos únicos
            
            //salva log de transacao
            $transacao = TRANSACOES::create([
                'num_conta_origem' => $request->num_conta_origem,
                'num_conta_destino' => $request->num_conta_destino,
                'valor' => $valor,
                'cod_unico_transacao' => $codigoUnico,
                'status' => 1,
                'data_transacao' => now()
            ]);
            DB::commit(); 

            return response()->json([
                'status' => 'sucesso',
                'mensagem' => 'Transferência realizada com sucesso.',
                'codigo_operacao' => $codigoUnico,
                'transacao' => $transacao,
            ], 200);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => 'erro',
                'mensagem' => 'Falha na transação. Nenhuma conta foi alterada.',
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
