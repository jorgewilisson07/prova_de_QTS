<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="prova.css">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form action="valida.php" method="post">
        <label for="login">Email:</label><br>
        <input type="text" id="login" name="login" required><br>
        
        <label for="senha">Senha:</label><br>
        <input type="password" id="senha" name="senha" required><br>
        
        <input type="submit" value="Entrar" >
        <a href="cadastro.php">Cadastre-se</a>
    </form>
    <?php
    if (isset($_SESSION['loginError'])) {
        echo "<p style='color: red;'>" . $_SESSION['loginError'] . "</p>";
        unset($_SESSION['loginError']);
    }
    if (isset($_SESSION['negacao'])) {
        echo "<p style='color: red;'>" . $_SESSION['negacao'] . "</p>";
        unset($_SESSION['negacao']);
    }
    ?>
</body>
</html>
