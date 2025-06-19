<!DOCTYPE html>
<html>
<head>
    <title>Upload de Arquivo</title>
</head>
<body>
    <h2>Upload de Arquivo para a Sala</h2>
    <form method="post" enctype="multipart/form-data">
        <input type="file" name="arquivo" required><br>
        <button type="submit">Enviar</button>
    </form>
    <?php if (isset($mensagem)) echo "<p>$mensagem</p>"; ?>
</body>
</html>