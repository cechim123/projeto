<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["nome"], $_POST["preco"], $_POST["descricao"], $_POST["quantidade"])) {
    $nome = trim($_POST["nome"]);
    $preco = trim($_POST["preco"]);
    $descricao = trim($_POST["descricao"]);
    $quantidade = trim($_POST["quantidade"]);

    if (!is_numeric($preco)) {
        echo "O preço deve ser um número válido.";
        exit;
    }

    require_once "conexao.php";

    $sql_inserir = "INSERT INTO produtos.produto (nome, preco, descricao, quantidade) VALUES (:nome, :preco, :descricao, :quantidade)";

    if ($stmt = $pdo->prepare($sql_inserir)) {
        $stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
        $stmt->bindParam(":preco", $preco, PDO::PARAM_STR);
        $stmt->bindParam(":descricao", $descricao, PDO::PARAM_STR);
        $stmt->bindParam(":quantidade", $quantidade, PDO::PARAM_STR);

        if ($stmt->execute()) {
            header("location: welcome.php");
            exit;
        } else {
            echo "Erro ao tentar inserir o produto.";
        }
    } else {
        echo "Erro ao preparar a declaração SQL para inserção.";
    }

    unset($pdo);
}
?>