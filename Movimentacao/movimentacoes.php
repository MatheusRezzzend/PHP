<?php include "enviomovi.php"; ?>
<html>

<head>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="movimentacoes.css">
    <meta charset="UTF-8">
    <title>Fazer Movimentacao</title>
    <link>
</head>
<style>
    input[type="radio"] {
        transform: scale(2);
        margin: 10px;
    }
</style>
<st>

    <body>
        <p>Selecione o tipo de movimentação que deseja fazer</p>

        <div class="form1">
            <form method='post'>
                <input required type="radio" class="radio" name="movimento" checked value="deposito">
                0 <label>Depósito</label>
                <input required type="radio" name="movimento" value="saque">
                <label>Saque</label>
                <input required type="radio" name="movimento" value="transf">
                <label>Transferênci</label>
                <br>
                <div class="conf">
                    <input required type="submit" value="Confirmar">
                </div>
            </form>
        </div>
        <?php
        testamovi($conectar); ?>
    </body>

</html>