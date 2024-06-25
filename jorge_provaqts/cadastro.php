<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="prova.css">
    <title>Cadastro de Usuário</title>
</head>
<body>
    <h2>Cadastro de Usuário</h2>
    <?php
    session_start();
    if (isset($_SESSION['success_message'])) {
        echo "<p style='color: green;'>" . $_SESSION['success_message'] . "</p>";
        unset($_SESSION['success_message']);
    }
    if (isset($_SESSION['error_message'])) {
        echo "<p style='color: red;'>" . $_SESSION['error_message'] . "</p>";
        unset($_SESSION['error_message']);
    }
    ?>
    <form action="processa_cadastro.php" method="POST">
        <label for="nome">Nome:</label><br>
        <input type="text" id="nome" name="nome" required><br>
        
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br>
        
        <label for="senha">Senha:</label><br>
        <input type="password" id="senha" name="senha" required><br>

        <label for="perfil">Perfil:</label><br>
        <select id="perfil" name="perfil" required>
            <option value="1">Admin</option>
            <option value="2">Visitante</option>
        </select><br>
        
        <input type="submit" value="Cadastrar">
        <a href="index.php">Já está cadastrado?</a>
    </form>
</body>
</html>
