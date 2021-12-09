<?php
include VIEWS_PATH . "layout.php";
echo "
<body>
    <h1>API - Livros</h1>
    <h2>Explicação:</h2>
    <p>Está é uma API feita para ler, adicionar, atualizar e deletar liros no banco de dados</p>
    <p>Cada livro é composto por um codigo, titulo, autor, editora, ano de publicação e ISBN</p>
    <h2>Rotas:</h2>

    <h3>-   GET</h3>

    <h4>Rota: /</h4>
    <p>Retorna está pagina de explicação</p>

    <h4>Rota: /all</h4>
    <p>Retorna todos os livros</p>

    <h4>Rota: /&ltcodigo&gt</h4>
    <p>Retorna unico livro de mesmo codigo</p>

    <h3>- POST</h3>

    <h4>Rota: /</h4>
    <h4>Body da Requisição: Livro em Json</h4>
    <p>Insere o livro na base de dados</p>

    <h3>- PUT</h3>

    <h4>Rota: /&ltcodigo&gt</h4>
    <h4>Body da Requisição: Livro em Json</h4>
    <p>Substitui o livro de mesmo codigo com o especificado na requisição</p>

    <h3>- DELETE</h3>

    <h4>Rota: /&ltcodigo&gt</h4>
    <p>Deleta o livro de mesmo codigo</p>
</body>";
