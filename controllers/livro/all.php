<?php
// Cabeçalhos
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

// Instanciação do Banco de dados
$database = new Database();
$db = $database->connect();

// Instanciação do livro
$livro = new LivroModel($db);

// Query
$result = $livro->all();
// Contagem de livros na tabela
$livrosCount = $result->rowCount();

// Verifica se existe livros na tabela
if ($livrosCount > 0) {
    // Array de livros
    $livros = array();

    while ($query = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($query);

        $livro = array(
            "codigo" => $codigo,
            "titulo" => $titulo,
            "autor" => $autor,
            "editora" => $editora,
            "anoPublicacao" => $anoPublicacao,
            "ISBN" => $ISBN,
        );

        // Adiciona livro a livros
        array_push($livros, $livro);
    }

    // Transforma em JSON depois o retorna
    echo json_encode($livros);
} else {
    // Caso não tenha livros
    echo json_encode(
        array("mensagem" => "nenhum livro encontrado")
    );
}
