<?php
<!DOCTYPE html>
<html>
<head>
    <title>Arquivos da Sala</title>
</head>
<body>
    <h2>Arquivos Disponíveis</h2>
    <ul>
        <?php foreach ($arquivos as $arq): ?>
            <li>
                <a href="/public/uploads/<?= htmlspecialchars($arq['caminho']) ?>" download>
                    <?= htmlspecialchars($arq['nome_arquivo']) ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>