<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["nome"]) && isset($_POST["contato"]) && isset($_POST["endereco"])) {
        require_once "conexao.php";

        $sql = "INSERT INTO produtos.fornecedor (nome, contato, endereco) VALUES (:nome, :contato, :endereco)";

        if ($stmt = $pdo->prepare($sql)) {
            $stmt->bindParam(":nome", $_POST["nome"], PDO::PARAM_STR);
            $stmt->bindParam(":contato", $_POST["contato"], PDO::PARAM_STR);
            $stmt->bindParam(":endereco", $_POST["endereco"], PDO::PARAM_STR);

            if ($stmt->execute()) {
                header("location: welcome.php");
                exit();
            } else {
                echo "Erro ao tentar inserir o fornecedor.";
            }
        }
        unset($pdo);
    }
}
?>
