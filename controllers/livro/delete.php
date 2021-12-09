<?php
// Cabeçalhos
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

// Instanciação do Banco de dados
$database = new Database();
$db = $database->connect();

// Instanciação do livro
$livro = new LivroModel($db);

// Pega o codigo
$livro->codigo = $parametro;

// Deleta livro
if ($livro->delete()) {
    echo json_encode(
        array('mensagem' => 'Livro deletado')
    );
} else {
    echo json_encode(
        array('mensagem' => 'Livro não foi deletado')
    );
}
