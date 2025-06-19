<?php
// filepath: /app/models/Sala.php

class Sala extends Model { // Extender uma classe base Model (a ser criada)
    protected $table = 'salas'; // Nome da tabela

    public function create($data) {
        // Método para criar uma nova sala
        // Implementar lógica de inserção no banco de dados
    }

    public function getAll() {
        // Método para listar todas as salas
        // Implementar lógica de consulta no banco de dados
    }

    public function findByNome($nome) {
        // Método para encontrar uma sala pelo nome
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM {$this->table} WHERE nome = ?");
        $stmt->execute([$nome]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
<?php
// filepath: /app/models/Sala.php

class Sala extends Model { // Extender uma classe base Model (a ser criada)
    protected $table = 'salas'; // Nome da tabela

    public function create($data) {
        // Método para criar uma nova sala
        // Implementar lógica de inserção no banco de dados
    }

    public function getAll() {
        // Método para listar todas as salas
        // Implementar lógica de consulta no banco de dados
    }

    public function findByNome($nome) {
        // Método para encontrar uma sala pelo nome
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM {$this->table} WHERE nome = ?");
        $stmt->execute([$nome]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
