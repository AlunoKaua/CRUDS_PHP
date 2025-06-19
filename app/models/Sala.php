<?php
// filepath: /app/models/Sala.php
require_once __DIR__ . '/../../config/database.php';

class Sala {
    public static function criar($nome, $id_professor) {
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("INSERT INTO salas (nome, id_professor) VALUES (?, ?)");
        $stmt->execute([$nome, $id_professor]);
        return $pdo->lastInsertId();
    }

    public static function listar() {
        $pdo = Database::getInstance();
        return $pdo->query("SELECT salas.*, usuarios.nome as professor FROM salas JOIN usuarios ON salas.id_professor = usuarios.id")->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function associarAluno($id_aluno, $id_sala) {
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("INSERT IGNORE INTO alunos_salas (id_aluno, id_sala) VALUES (?, ?)");
        $stmt->execute([$id_aluno, $id_sala]);
    }
}
?>
