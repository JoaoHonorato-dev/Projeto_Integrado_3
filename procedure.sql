BEGIN
DECLARE v_saldo_atual DECIMAL(10, 2);

    SELECT
        (

            (SELECT saldo FROM CONTA_USUARIO WHERE num_conta = p_num_conta)
        )
        +
        (
 
            SELECT SUM(valor)
            FROM TRANSACOES
            WHERE num_conta_destino = p_num_conta
            AND data_transacao BETWEEN p_data_inicio AND p_data_fim
        )
        -
        (
  
            SELECT SUM(valor)
            FROM TRANSACOES
            WHERE num_conta_origem = p_num_conta
            AND data_transacao BETWEEN p_data_inicio AND p_data_fim
        )
      INTO v_saldo_atual;


    SELECT 
        p_num_conta AS Conta, 
        v_saldo_atual AS Saldo_Atual;
        
    SELECT
        cod_transacao,
        num_conta_origem,
        num_conta_destino,
        valor,
        data_transacao
    FROM 
        TRANSACOES
    WHERE 
        data_transacao BETWEEN p_data_inicio AND p_data_fim
        AND (
            num_conta_origem = p_num_conta OR num_conta_destino = p_num_conta
        )
    ORDER BY 
        data_transacao DESC 
    LIMIT 10;
    
END 