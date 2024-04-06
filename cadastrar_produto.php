<?php
session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Produto</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Cadastrar Produto</h2>
        <form action="processar_produto.php" method="post">
            <div class="form-group">
                <label>Nome do Produto</label>
                <input type="text" name="nome" class="form-control">
            </div>
            <div class="form-group">
                <label>Descrição</label>
                <textarea name="descricao" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label>Quantidade</label>
                <textarea type="number" name="quantidade" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label>Preço</label>
                <input type="number" name="preco" class="form-control">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Cadastrar">
            </div>
        </form>
    </div>
</body>
</html>
