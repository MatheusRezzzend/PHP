<?php
$servidor = '127.0.0.1';
$usuario = 'root';
$senha = '';
$banco = 'bancos';

$conectar = mysqli_connect($servidor, $usuario, $senha, $banco);

if (mysqli_connect_errno()) {
    echo "Não foi possível acessar o banco de dados. Verifique com o provedor.";
    die();
}

function allAccounts($conectar)
{
    $sqlbusca = "SELECT * FROM contas";
    $resultado = mysqli_query($conectar, $sqlbusca);
    $contas = mysqli_fetch_all($resultado);

    return $contas;
}

function depositar($valor, $numconta, $conectar)
{
    $sqlbusca = "SELECT saldo FROM contas WHERE numconta LIKE '{$numconta}'";
    $resultado = mysqli_query($conectar, $sqlbusca);
    $contas = mysqli_fetch_object($resultado);
    $deposito = $contas->saldo + $valor;

    $salvarsaldo = "
        UPDATE contas SET
            saldo = '{$deposito}'
        WHERE numconta = '{$numconta}' 
        ";

    mysqli_query($conectar, $salvarsaldo);
}

function sacar($valor, $numconta, $conectar)
{
    $sqlbusca = "SELECT saldo FROM contas WHERE id LIKE '{$numconta}'";
    $resultado = mysqli_query($conectar, $sqlbusca);
    $contas = mysqli_fetch_object($resultado);
    $saque = $contas->saldo - $valor;

    $salvarsaldo = " 
        UPDATE contas SET
            saldo = '{$saque}'
        WHERE id = '{$numconta}'
        "; // atualiza o saldo

    mysqli_query($conectar, $salvarsaldo);
}

function transferencia2($valor, $numconta2, $conectar)
{
    $sqlbusca = "SELECT saldo FROM contas WHERE id LIKE '{$numconta2}'";
    $resultado = mysqli_query($conectar, $sqlbusca);
    $contas = mysqli_fetch_object($resultado);
    $saldopessoa2 = $contas->saldo + $valor;

    $salvarsaldo2 = " 
        UPDATE contas SET
            saldo = '{$saldopessoa2}'
        WHERE id = '{$numconta2}'
        "; // atualiza o saldo

    mysqli_query($conectar, $salvarsaldo2);
}

function saldo($cpf, $numconta, $conectar)
{
    $sqlbusca = "SELECT saldo FROM contas WHERE id LIKE '{$numconta}'";
    $resultado = mysqli_query($conectar, $sqlbusca);
    $contas = mysqli_fetch_object($resultado);
    $saldo = $contas->saldo;
    return $saldo;
}

/*CREATE TABLE contas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(45),
    cpf VARCHAR(11),
    endereco VARCHAR(45),
    numconta VARCHAR(5),
    agencianum INTEGER(5),                                        
    saldo DOUBLE*/
