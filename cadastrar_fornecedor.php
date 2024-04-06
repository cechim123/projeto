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
    <title>Cadastrar Fornecedor</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Cadastrar Fornecedor</h2>
        <form action="processar_fornecedor.php" method="post">
            <div class="form-group">
                <label>Nome do Fornecedor</label>
                <input type="text" name="nome" class="form-control">
            </div>
            <div class="form-group">
                <label>Contato</label>
                <textarea name="contato" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label>Endereço</label>
                <input type="text" name="endereco" class="form-control">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Cadastrar">
            </div>
        </form>
    </div>
</body>
</html>
