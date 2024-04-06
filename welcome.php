<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

require_once "conexao.php";

$sql = "SELECT id_produto, nome, descricao, preco, quantidade FROM produtos.produto";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Bem vindo</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body { font: 14px sans-serif; text-align: center; }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            var produtosSelecionados = [];
            $("#btnAtualizarProdutos").click(function() {
                $.ajax({
                    url: "ajax/atualizar_produto.php",
                    dataType: "json",
                    success: function(data) {
                        $("#areaDadosProdutos").empty();
                        data.forEach(function(produto) {
                            $("#areaDadosProdutos").append("<tr><td>" + produto.id_produto + "</td><td>" + produto.nome + "</td><td>" + produto.descricao + "</td><td>" + produto.preco + "</td><td>" + produto.quantidade + "</td></tr>");
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });

            $("#btnAtualizarFornecedores").click(function() {
                $.ajax({
                    url: "ajax/atualizar_fornecedor.php",
                    dataType: "json",
                    success: function(data) {
                        $("#areaDadosFornecedores").empty();
                        data.forEach(function(fornecedor) {
                            $("#areaDadosFornecedores").append("<tr><td>" + fornecedor.id_fornecedor + "</td><td>" + fornecedor.nome + "</td><td>" + fornecedor.contato + "</td><td>" + fornecedor.endereco + "</td></tr>");
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });

            $("#btnAdicionarCesta").click(function() {
                produtosSelecionados = [];

                $.each($("input[name='selecionados[]']:checked"), function() {
                    var idProduto = $(this).val();
                    var nomeProduto = $(this).closest('tr').find('td:eq(1)').text();
                    var descricaoProduto = $(this).closest('tr').find('td:eq(2)').text();
                    var precoProduto = $(this).closest('tr').find('td:eq(3)').text();
                    var quantidadeProduto = $(this).closest('tr').find('td:eq(4)').text();

                    produtosSelecionados.push({
                        id: idProduto,
                        nome: nomeProduto,
                        descricao: descricaoProduto,
                        preco: precoProduto,
                        quantidade: quantidadeProduto
                    });
                });

                exibirProdutosNaCesta(produtosSelecionados);
            });

            $("#btnAtualizarCestas").click(function() {
                exibirProdutosNaCesta(produtosSelecionados);
            });

            function exibirProdutosNaCesta(produtos) {
                var areaCestas = $("#areaDadosCestas");
                areaCestas.empty();

                $.each(produtos, function(index, produto) {
                    var precoTotal = parseFloat(produto.preco) * parseFloat(produto.quantidade); // Calcula o preço total
                    areaCestas.append("<tr><td>" + produto.nome + "</td><td>" + produto.descricao + "</td><td>" + produto.preco + "</td><td>" + produto.quantidade + "</td><td>" + precoTotal.toFixed(2) + "</td></tr>");
                });
            }

        });
    </script>

</head>
<body>
    <h1 class="my-5">Bem vindo meu site.</h1>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h2>Cadastrar Produto</h2>
                <p><a href="cadastrar_produto.php" class="btn btn-primary">Cadastrar Produto</a></p>
            </div>
            <div class="col-md-4">
                <h2>Cadastrar Fornecedor</h2>
                <p><a href="cadastrar_fornecedor.php" class="btn btn-primary">Cadastrar Fornecedor</a></p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <h2>Atualizar Produtos</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Descrição</th>
                            <th>Preço</th>
                            <th>Quantidade</th>
                        </tr>
                    </thead>
                    <tbody id="areaDadosProdutos"></tbody>
                </table>
                <button id="btnAtualizarProdutos" class="btn btn-primary">Atualizar Produtos</button>
            </div>
            <div class="col-md-4">
                <h2>Atualizar Fornecedores</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Contato</th>
                            <th>Endereço</th>
                        </tr>
                    </thead>
                    <tbody id="areaDadosFornecedores"></tbody>
                </table>
                <button id="btnAtualizarFornecedores" class="btn btn-primary">Atualizar Fornecedores</button>
            </div>
            <div class="col-md-4">
                <h2>Atualizar Cestas</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Produto</th>
                            <th>Descricao</th>
                            <th>Preço</th>
                            <th>Quantidade</th>
                            <th>Preço Total</th>
                        </tr>
                    </thead>
                    <tbody id="areaDadosCestas"></tbody>
                </table>
                <button id="btnAtualizarCestas" class="btn btn-primary">Atualizar Cestas</button>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
            <h2>Produtos Disponíveis</h2>
                <table class="table">
                <tbody>
                    <?php foreach ($produtos as $produto) : ?>
                        <tr data-id="<?php echo $produto['id_produto']; ?>">
                            <td><?php echo $produto['id_produto']; ?></td>
                            <td><?php echo $produto['nome']; ?></td>
                            <td><?php echo $produto['descricao']; ?></td>
                            <td><?php echo $produto['preco']; ?></td>
                            <td><?php echo $produto['quantidade']; ?></td>
                            <td><input type="checkbox" name="selecionados[]" value="<?php echo $produto['id_produto']; ?>"></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                </table>
                <button id="btnAdicionarCesta" class="btn btn-primary">Adicionar à Cesta</button>
            </div>
        </div>
    </div>
    <p>
        <a href="logout.php" class="btn btn-danger ml-3">Sair da conta</a>
    </p>
</body>
</html>
