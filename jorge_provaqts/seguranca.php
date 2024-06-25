<?php
session_start();

function verificarAutenticacao() {
    if (!isset($_SESSION['login'])) {
        $_SESSION['negacao'] = "Você precisa estar logado para acessar esta página.";
        header("location: index.php");
        exit();
    }
}

function verificarAutorizacao($perfilNecessario) {
    if ($_SESSION['usuarioPerfilID'] != $perfilNecessario) {
        $_SESSION['negacao'] = "Acesso negado!";
        header("location: index.php");
        exit();
    }
}
?>
