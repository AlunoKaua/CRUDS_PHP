 <?php
// filepath: /config/database.php
<?php
$pdo = new PDO('mysql:host=localhost;dbname=ifam_plataforma', 'admin', '123456');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>