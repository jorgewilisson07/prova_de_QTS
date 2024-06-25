<?php
require_once("seguranca.php");
verificarAutenticacao();
verificarAutorizacao(1);

require_once("conexao.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "SELECT * FROM usuarios WHERE id = ?";
    if ($stmt = mysqli_prepare($conn, $query)) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);
        $usuario = mysqli_fetch_assoc($resultado);
        mysqli_stmt_close($stmt);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $perfil = $_POST['perfil'];

        $query = "UPDATE usuarios SET nome = ?, email = ?, perfil = ? WHERE id = ?";
        if ($stmt = mysqli_prepare($conn, $query)) {
            mysqli_stmt_bind_param($stmt, "ssii", $nome, $email, $perfil, $id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            header("location: dash.php");
            exit();
        }
    }
} else {
    header("location: dash.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="prova.css">
    <title>Editar Usuário</title>
</head>
<body>
    <h2>Editar Usuário</h2>
    <form action="" method="POST">
        <label for="nome">Nome:</label><br>
        <input type="text" id="nome" name="nome" value="<?php echo $usuario['nome']; ?>" required><br>
        
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" value="<?php echo $usuario['email']; ?>" required><br>

        <label for="perfil">Perfil:</label><br>
        <select id="perfil" name="perfil" required>
            <option value="1" <?php if ($usuario['perfil'] == 1) echo 'selected'; ?>>Admin</option>
            <option value="2" <?php if ($usuario['perfil'] == 2) echo 'selected'; ?>>Visitante</option>
        </select><br>
        
        <input type="submit" value="Salvar">
    </form>
    <a href="dash.php">Voltar</a>
</body>
</html>
