<?php
session_start();
require_once("conexao.php");

if (isset($_POST['login']) && isset($_POST['senha'])) {
    $usuario = $_POST['login'];
    $senha = $_POST['senha'];

    $query = "SELECT * FROM usuarios WHERE email = ?";
    if ($stmt = mysqli_prepare($conn, $query)) {
        mysqli_stmt_bind_param($stmt, "s", $usuario);
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);
        $usuarioData = mysqli_fetch_assoc($resultado);

        if ($usuarioData && password_verify($senha, $usuarioData['senha'])) {
            $_SESSION['login'] = $usuarioData['email'];
            $_SESSION['usuarioPerfilID'] = $usuarioData['perfil'];

            mysqli_stmt_close($stmt);

            mysqli_close($conn);

            if ($_SESSION['usuarioPerfilID'] == 1) { // Admin
                header("location: dash.php");
            } else { 
                header("location: visitante.php");
            }
            exit();
        } else {
            $_SESSION['loginError'] = "Usuário ou senha incorretos!";
            header("location: index.php");
            exit();
        }
    } else {
        $_SESSION['loginError'] = "Erro ao preparar a consulta!";
        header("location: index.php");
        exit();
    }
} else {
    $_SESSION['loginError'] = "Preencha todos os campos!";
    header("location: index.php");
    exit();
}
?>
