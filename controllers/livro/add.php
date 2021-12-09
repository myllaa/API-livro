<?php
// Cabeçalhos
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

// Instanciação do Banco de dados
$database = new Database();
$db = $database->connect();

// Instanciação do livro
$livro = new LivroModel($db);

// Pega os dados da requisição
$data = json_decode(file_get_contents("php://input"));

$livro->titulo = $data->titulo;
$livro->autor = $data->autor;
$livro->editora = $data->editora;
$livro->anoPublicacao = $data->anoPublicacao;
$livro->ISBN = $data->ISBN;

// Cria Livro
if ($livro->create()) {
    echo json_encode(
        array('mensagem' => 'Livro criado')
    );
} else {
    echo json_encode(
        array('mensagem' => 'Livro não foi criado')
    );
}
