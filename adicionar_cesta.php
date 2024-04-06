<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["produtos"]) && is_array($_POST["produtos"])) {
        require_once "conexao.php";

        $stmt = $pdo->prepare("INSERT INTO cesta (id_usuario, id_produto, quantidade, preco_total) VALUES (?, ?, ?, ?)");
        $id_usuario = $_SESSION["id_usuario"];

        foreach ($_POST["produtos"] as $id_produto) {
            $stmt_produto = $pdo->prepare("SELECT preco, quantidade FROM produto WHERE id_produto = ?");
            $stmt_produto->execute([$id_produto]);
            $produto = $stmt_produto->fetch(PDO::FETCH_ASSOC);
            
            $preco_total = $produto['preco'] * $produto['quantidade'];

            $stmt->execute([$id_usuario, $id_produto, $produto['quantidade'], $preco_total]);
        }

        unset($pdo);

        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["error" => "Nenhum produto selecionado"]);
    }
} else {
    echo json_encode(["error" => "Método de solicitação inválido"]);
}
?>
