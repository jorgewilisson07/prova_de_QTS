<?php
session_start();
require_once("conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['senha']) && isset($_POST['perfil'])) {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $perfil = $_POST['perfil'];

        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

        $query = "INSERT INTO usuarios (nome, email, senha, perfil) VALUES (?, ?, ?, ?)";
        if ($stmt = mysqli_prepare($conn, $query)) {
            mysqli_stmt_bind_param($stmt, "sssi", $nome, $email, $senha_hash, $perfil);
            if (mysqli_stmt_execute($stmt)) {
                $_SESSION['success_message'] = "Usuário cadastrado com sucesso!";
            } else {
                $_SESSION['error_message'] = "Erro ao cadastrar usuário!";
            }
            mysqli_stmt_close($stmt);
        } else {
            $_SESSION['error_message'] = "Erro ao preparar a query!";
        }

        mysqli_close($conn);
    } else {
        $_SESSION['error_message'] = "Todos os campos são obrigatórios!";
    }
    header("location: cadastro.php");
    exit();
}
?>
