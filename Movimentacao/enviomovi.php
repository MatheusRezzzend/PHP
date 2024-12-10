<?php
include "bancomovi.php";
function testamovi($conectar)
{

    // O que isso faz? verifica o metodo post e valida  o saldo 
    if (isset($_POST['movimento']) && $_POST['movimento'] != " ") {
        $movimento = $_POST['movimento'];
        // var_dump(allAccounts($conectar)[0][4]);

        if ($movimento == 'deposito') {
            if (isset($_POST['numconta']) && isset($_POST['cpf']) && isset($_POST['agencianum']) && isset($_POST['saldo'])) {
                echo ($_POST);
                // Atribui todos os valores antes mesmo de verificar o saldo????? (coisa de viado)
                $agencianum = $_POST['agencianum'];
                $cpf = $_POST['cpf'];
                $numconta = $_POST['numconta'];
                $valor = $_POST['saldo']; /// <- essa merda faz sla o q

                if ($_POST['saldo'] <= 0) { // Se vem do session por que verifca?
                    echo "Impossível fazer o depósito com valor nulo ou negativo";
                } else {
                    //@TODO arrumar de depositar sem agencia_num4
                    depositar($valor, $numconta, $conectar);

                    echo "Depósito efeutado com sucesso, para outra transação selecione a opção acima.";
                }
            } else {
                //Número da conta: <input required type='text' name='numconta'> <- guardando pro almoço
                echo "<form method='post'>
                            <fieldset>
                                <label>Número da conta: </label>
                     <select  name='numconta'>";
                foreach (allAccounts($conectar) as $conta) {

                    echo "<option value='$conta[4]'>{$conta[4]}</option>";
                }
                echo   "</select>
                    <label> CPF do titular: <input required type='text' name='cpf'> </label> 
                                <label>Número da Agência: <input required type='text' name='agencianum'></label> 
                                <label>Valor a ser depositado: <input required type='number' name='valor'></label> 
                                <div class='depo'>
                                    <input type='submit' value='Depositar'>
                                </div>
                                <input type='hidden' name='movimento' value='{$movimento}'>
                            </fieldset> 
                        </form>";
            }
        } else if ($movimento == 'saque') {
            if (isset($_POST['numconta']) && isset($_POST['cpf']) && isset($_POST['agencianum']) && isset($_POST['saldo'])) {
                $agencianum = $_POST['agencianum'];
                $cpf = $_POST['cpf'];
                $numconta = $_POST['numconta'];
                $valor = $_POST['saldo'];
                $saldo = saldo($cpf, $numconta, $conectar);

                if ($_POST['saldo'] <= 0 || $_POST['saldo'] > $saldo) {
                    echo "Impossível fazer o saque com valor nulo, negativo ou maior que o saldo atual.";
                } else {
                    sacar($valor, $numconta, $conectar);
                    echo "Saque efeutado com sucesso, para outra transação selecione a opção acima.";
                }
            } else {
                echo "<form method='post'>
                            <fieldset>
                                <label>Número da conta: <input required type='text' name='numconta'></label> 
                                <label> CPF do titular: <input required type='text' name='cpf'> </label> 
                                <label>Número da Agência: <input required type='text' name='agencianum'></label> 
                                <label>Valor a sacar: <input required type='number' name='valor'></label>
                                <div class='sacar'> 
                                    <input type='submit' value='Sacar'>
                                </div>    
                                <input type='hidden' name='movimento' value='{$movimento}'>
                            </fieldset> 
                        </form>";
            }
        } else {
            if (isset($_POST['numconta']) && isset($_POST['cpf']) && isset($_POST['agencianum']) && isset($_POST['valor']) && isset($_POST['numconta2']) && isset($_POST['cpf2']) && isset($_POST['agencianum2'])) {
                $agencianum = $_POST['agencianum'];
                $cpf = $_POST['cpf'];
                $numconta = $_POST['numconta'];
                $saldo = saldo($cpf, $numconta, $conectar);

                $agencianum2 = $_POST['agencianum'];
                $cpf2 = $_POST['cpf'];
                $numconta2 = $_POST['numconta'];
                $valor = $_POST['saldo'];


                if ($_POST['saldo'] <= 0 || $_POST['saldo'] > $saldo) {
                    echo "Impossível fazer a transferência com valor nulo, negativo ou maior que o saldo atual.";
                } else {
                    sacar($valor, $numconta, $conectar);
                    transferencia2($valor, $numconta2, $conectar);
                    echo "Transferencia efeutada com sucesso, para outra transação selecione a opção acima.";
                }
            } else {
                echo "<form method='post'>
                                <fieldset>
                                    <legend>Remetente</legend>
                                    <label>Número da conta: <input required type='text' name='numconta'></label> 
                                    <label> CPF do titular: <input required type='text' name='cpf'> </label> 
                                    <label>Número da Agência: <input required type='text' name='agencianum'></label> 
                                </fieldset> 
                                <fieldset>
                                    <legend>Destinatário</legend>
                                    <label>Número da conta: <input required type='text' name='numconta2'></label> 
                                    <label> CPF do titular: <input required type='text' name='cpf2'> </label> 
                                    <label>Número da Agência: <input required type='text' name='agencianum2'></label> 
                                </fieldset>
                                <fieldset>
                                    <legend>Valor</legend>
                                    <label>Valor a transferir: <input required type='number' name='valor'></label>
                                    <div class='transf'> 
                                        <input type='submit' value='Transferir'>
                                    </div>    
                                    <input type='hidden' name='movimento' value='{$movimento}'>
                                </fieldset>

                                
                            </form>";
            }
        }
    }
}
