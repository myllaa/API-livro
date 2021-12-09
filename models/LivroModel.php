<?php
/*
+---------------+--------------+------+-----+---------+----------------+
| Field         | Type         | Null | Key | Default | Extra          |
+---------------+--------------+------+-----+---------+----------------+
| codigo        | int(11)      | NO   | PRI | <null>  | auto_increment |
| titulo        | varchar(255) | YES  |     | <null>  |                |
| autor         | varchar(255) | YES  |     | <null>  |                |
| editora       | varchar(255) | YES  |     | <null>  |                |
| anoPublicacao | varchar(255) | YES  |     | <null>  |                |
| ISBN          | varchar(255) | YES  |     | <null>  |                |
+---------------+--------------+------+-----+---------+----------------+
 */
class LivroModel {
    // Banco de dados
    private $connection;
    private $table = "livro";

    // Propriedades de livro
    public $codigo;
    public $titulo;
    public $autor;
    public $editora;
    public $anoPublicacao;
    public $ISBN;

    // Construtor, recebe banco de dados
    public function __construct($db) {
        $this->connection = $db;
    }

    // Pega livros
    public function all() {
        // Query
        $query = "SELECT 
                    codigo, 
                    titulo, 
                    autor, 
                    editora, 
                    anoPublicacao, 
                    ISBN 
                FROM $this->table";

        // Preparação da declaração
        $stmt = $this->connection->prepare($query);

        // Executa query
        $stmt->execute();

        return $stmt;
    }

    // Pegar livro
    public function single() {
        // Query
        $query = "SELECT 
                    codigo, 
                    titulo, 
                    autor, 
                    editora, 
                    anoPublicacao, 
                    ISBN 
                FROM $this->table
                WHERE codigo=?
                LIMIT 0,1";

        // Preparação da declaração
        $stmt = $this->connection->prepare($query);

        // Atrela codigo
        $stmt->bindParam(1, $this->codigo);

        // Executa query
        $stmt->execute();

        $livro = $stmt->fetch(PDO::FETCH_ASSOC);

        // Atribui propriedades
        $this->titulo = $livro["titulo"];
        $this->autor = $livro["autor"];
        $this->editora = $livro["editora"];
        $this->anoPublicacao = $livro["anoPublicacao"];
        $this->ISBN = $livro["ISBN"];
    }

    // Cria livro
    public function create() {
        // Query
        $query = "INSERT INTO $this->table SET
                    titulo = :titulo, 
                    autor = :autor, 
                    editora = :editora, 
                    anoPublicacao=:anoPublicacao, 
                    ISBN = :ISBN";

        // Preparação da declaração
        $stmt = $this->connection->prepare($query);

        // Limpeza de dados
        $this->titulo = htmlspecialchars(strip_tags($this->titulo));
        $this->autor = htmlspecialchars(strip_tags($this->autor));
        $this->editora = htmlspecialchars(strip_tags($this->editora));
        $this->anoPublicacao = htmlspecialchars(strip_tags($this->anoPublicacao));
        $this->ISBN = htmlspecialchars(strip_tags($this->ISBN));

        // Atrela dados
        $stmt->bindParam(":titulo", $this->titulo);
        $stmt->bindParam(":autor", $this->autor);
        $stmt->bindParam(":editora", $this->editora);
        $stmt->bindParam(":anoPublicacao", $this->anoPublicacao);
        $stmt->bindParam(":ISBN", $this->ISBN);

        // Execução da query
        if ($stmt->execute()) {
            return true;
        }

        // Caso aconteça erros o retorna
        printf("Erro: %s.\n", $stmt->error);

        return false;
    }

    // Atualiza Livro
    public function update() {
        // Query
        $query = "UPDATE $this->table SET 
                    titulo = :titulo, 
                    autor = :autor, 
                    editora = :editora, 
                    anoPublicacao = :anoPublicacao, 
                    ISBN = :ISBN 
                WHERE codigo = :codigo";

        // Prepara declaração
        $stmt = $this->connection->prepare($query);

        // Limpeza dos dados
        $this->codigo = htmlspecialchars(strip_tags($this->codigo));
        $this->titulo = htmlspecialchars(strip_tags($this->titulo));
        $this->autor = htmlspecialchars(strip_tags($this->autor));
        $this->editora = htmlspecialchars(strip_tags($this->editora));
        $this->anoPublicacao = htmlspecialchars(strip_tags($this->anoPublicacao));
        $this->ISBN = htmlspecialchars(strip_tags($this->ISBN));

        // Atrela dados
        $stmt->bindParam(":codigo", $this->codigo);
        $stmt->bindParam(":titulo", $this->titulo);
        $stmt->bindParam(":autor", $this->autor);
        $stmt->bindParam(":editora", $this->editora);
        $stmt->bindParam(":anoPublicacao", $this->anoPublicacao);
        $stmt->bindParam(":ISBN", $this->ISBN);

        // Execução da query
        if ($stmt->execute()) {
            return true;
        }

        // Caso aconteça erros o retorna
        printf("Erro: %s.\n", $stmt->error);

        return false;
    }

    // Deleta livro
    public function delete() {
        // Query
        $query = "DELETE FROM $this->table WHERE codigo = :codigo";

        // Prepara declaração
        $stmt = $this->connection->prepare($query);

        // Limpeza dos dados
        $this->codigo = htmlspecialchars(strip_tags($this->codigo));

        // Atrela codigo
        $stmt->bindParam(":codigo", $this->codigo);

        // Executa query
        if ($stmt->execute()) {
            return true;
        }

        // Caso aconteça erros o retorna
        printf("Erro: %s.\n", $stmt->error);

        return false;
    }
}
