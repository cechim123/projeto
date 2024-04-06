<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["produto"]) && isset($_POST["valor_total"])) {
        require_once "conexao.php";

        $sql = "INSERT INTO produtos.cesta (id_usuario, id_produto, valor_total) VALUES (:id_usuario, :id_produto, :valor_total)";

        if ($stmt = $pdo->prepare($sql)) {
            session_start();
            $id_usuario = $_SESSION["id_usuario"];

            $stmt->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
            $stmt->bindParam(":id_produto", $_POST["produto"], PDO::PARAM_INT);

            if ($stmt->execute()) {
                header("location: welcome.php");
                exit();
            } else {
                echo "Erro ao tentar adicionar o produto à cesta.";
            }
        }
        unset($pdo);
    }
}
?>
