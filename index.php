<?php
// Carrega configurações
include "./config/env.php";

// Pega parametro casa um exista
if (isset($_GET["path"])) {
    $path = rtrim($_GET["path"], "/");
    $path = explode("/", $path);

    if (isset($path[0])) {
        $parametro = $path[0];
    }
}

// Carrega classes automaticamente
spl_autoload_register(function ($classe) {
    // Separa as palavras no nome da classe em um array
    preg_match_all("/((?:^|[A-Z])[a-z]+)/", $classe, $palavras);
    if (end($palavras[0]) == "Model") {
        include MODELS_PATH . "$classe.php";
    } else {
        include CONFIG_PATH . "$classe.php";
    }
});

// GET
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    // GET /
    if (!(isset($parametro))) {
        include VIEWS_PATH . "home.php";
        exit;
    }

    // GET /all
    if ($parametro == "all") {
        include CONTROLLERS_PATH . "livro/all.php";
        exit;
    }

    // GET /<codigo>
    if (is_numeric($parametro) && $parametro > 0) {
        include CONTROLLERS_PATH . "/livro/byCodigo.php";
        exit;
    }
}
// POST
else if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // POST /
    include CONTROLLERS_PATH . "livro/add.php";
    exit;
}
// PUT
else if ($_SERVER['REQUEST_METHOD'] == "PUT") {
    // PUT /<codigo>
    if (isset($parametro) && is_numeric($parametro) && $parametro > 0) {
        include CONTROLLERS_PATH . "livro/update.php";
        exit;
    }
}
// DELETE
else if ($_SERVER['REQUEST_METHOD'] == "DELETE") {
    // DELETE /<codigo>
    if (isset($parametro) && is_numeric($parametro) && $parametro > 0) {
        include CONTROLLERS_PATH . "livro/delete.php";
        exit;
    }
}

// Renderiza em caso de erro
include VIEWS_PATH . "urlerror.php";
