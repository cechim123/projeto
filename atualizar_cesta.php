<?php
require_once "../conexao.php";

$sql_cestas = "SELECT c.id_cesta, c.id_usuario, p.nome AS nome_produto, c.quantidade FROM cesta c
               JOIN produto p ON c.id_produto = p.id_produto";
$resultado_cestas = $pdo->query($sql_cestas);

$cestas = [];
while ($cesta = $resultado_cestas->fetch(PDO::FETCH_ASSOC)) {
    $cestas[] = $cesta;
}

echo json_encode($cestas);
?>
