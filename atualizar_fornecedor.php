<?php
    require_once "../conexao.php";

    $sql_fornecedores = "SELECT * FROM Fornecedor";
    $resultado_fornecedores = $pdo->query($sql_fornecedores);

    $fornecedores = [];
    while ($fornecedor = $resultado_fornecedores->fetch(PDO::FETCH_ASSOC)) {
        $fornecedores[] = $fornecedor;
    }

    echo json_encode($fornecedores);
?>
