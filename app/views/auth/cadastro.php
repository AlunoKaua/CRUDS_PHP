<?php
// filepath: /app/views/auth/cadastro.php
?>
<!DOCTYPE html>
<html lang="pt-BR">
<html>
<head>
    <title>Cadastro IFAM</title>
 <link rel="stylesheet" href="/assets/style.css">
</head>
<body>
    <h1>Plataforma Educacional IFAM</h1>
    <h2>Cadastro</h2>
    <?php if (isset($erro)) echo "<p style='color:red;'>$erro</p>"; ?>
    <?php if (isset($sucesso)) echo "<p style='color:green;'>$sucesso</p>"; ?>
    <form action="/cadastro" method="post">
        <input type="text" name="nome" placeholder="Nome" required><br>
        <input type="text" name="sobrenome" placeholder="Sobrenome" required><br>
        <input type="email" name="email" placeholder="E-mail" required><br>
        <input type="text" name="matricula" placeholder="Matrícula" required><br>
        <input type="password" name="senha" placeholder="Senha" required><br>
        <select name="tipo" required>
            <option value="aluno">Aluno</option>
            <option value="professor">Professor</option>
        </select><br>
        <button type="submit">Cadastrar</button>
    </form>
</body>
</html>