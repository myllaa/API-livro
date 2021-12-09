<?php
// Cabeçalhos
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

// Instanciação do Banco de dados
$database = new Database();
$db = $database->connect();

// Instanciação do livro
$livro = new LivroModel($db);

// Pega o codigo
$livro->codigo = $parametro;

// Pega o livro
$livro->single();

// Cria Array Associativo
$livroR = array(
    'codigo' => $livro->codigo,
    'titulo' => $livro->titulo,
    'autor' => $livro->autor,
    'editora' => $livro->editora,
    'anoPublicacao' => $livro->anoPublicacao,
    'ISBN' => $livro->ISBN
);

// Make JSON
print_r(json_encode($livroR));
