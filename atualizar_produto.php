<?php
    require_once "../conexao.php";

    $sql_produtos = "SELECT id_produto, nome, descricao, preco, quantidade FROM Produto";
    $resultado_produtos = $pdo->query($sql_produtos);

    $produtos = [];
    while ($produto = $resultado_produtos->fetch(PDO::FETCH_ASSOC)) {
        $produtos[] = $produto;
    }

    echo json_encode($produtos);
?>
