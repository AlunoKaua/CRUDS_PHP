<?php

class ArquivoController {

    public function uploadArquivo($file, $idSala, $idProfessor) {
        $permitidos = ['pdf', 'docx', 'jpg', 'png'];
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, $permitidos)) {
            return "Tipo de arquivo não permitido.";
        }
        if ($file['size'] > 5 * 1024 * 1024) {
            return "Arquivo muito grande.";
        }
        $novoNome = uniqid() . '.' . $ext;
        $destino = __DIR__ . "/../../public/uploads/" . $novoNome;
        if (move_uploaded_file($file['tmp_name'], $destino)) {
            // Lógica para salvar no banco de dados usando o modelo Arquivo
            // Arquivo::salvar($file['name'], $novoNome, $idSala, $idProfessor);
            return "Upload realizado com sucesso!";
        }
        return "Erro ao fazer upload.";
    }

    // Método para exibir o formulário de upload (esqueleto)
    public function showUploadForm() {
        // TODO: Implementar a lógica para exibir o formulário de upload
        // Exemplo: include '../app/views/arquivos/upload.php';
        echo "Página de Upload de Arquivo (Formulário)";
    }

    // TODO: Adicionar outros métodos relacionados a arquivos (download, exclusão, etc.)
}
<?php

class ArquivoController {

    public function uploadArquivo($file, $idSala, $idProfessor) {
        $permitidos = ['pdf', 'docx', 'jpg', 'png'];
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, $permitidos)) {
            return "Tipo de arquivo não permitido.";
        }
        if ($file['size'] > 5 * 1024 * 1024) {
            return "Arquivo muito grande.";
        }
        $novoNome = uniqid() . '.' . $ext;
        $destino = __DIR__ . "/../../public/uploads/" . $novoNome;
        if (move_uploaded_file($file['tmp_name'], $destino)) {
            // Lógica para salvar no banco de dados usando o modelo Arquivo
            // Arquivo::salvar($file['name'], $novoNome, $idSala, $idProfessor);
            return "Upload realizado com sucesso!";
        }
        return "Erro ao fazer upload.";
    }

    // Método para exibir o formulário de upload (esqueleto)
    public function showUploadForm() {
        // TODO: Implementar a lógica para exibir o formulário de upload
        // Exemplo: include '../app/views/arquivos/upload.php';
        echo "Página de Upload de Arquivo (Formulário)";
    }

    // Método para listar arquivos (esqueleto)
    public function listarArquivos($salaId) {
        // TODO: Implementar a lógica para buscar arquivos por sala
        // Exemplo: $arquivos = Arquivo::listarPorSala($salaId);
        // TODO: Incluir a view para exibir a lista
        // Exemplo: include '../app/views/arquivos/listar.php';
        echo "Página de Listagem de Arquivos para a Sala: " . htmlspecialchars($salaId);
    }

    // TODO: Adicionar outros métodos relacionados a arquivos (download, exclusão, etc.)
}
 <?php
public function uploadArquivo($file, $idSala, $idProfessor) {
    $permitidos = ['pdf', 'docx', 'jpg', 'png'];
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, $permitidos)) {
        return "Tipo de arquivo não permitido.";
    }
    if ($file['size'] > 5 * 1024 * 1024) {
        return "Arquivo muito grande.";
    }
    $novoNome = uniqid() . '.' . $ext;
    $destino = __DIR__ . "/../../public/uploads/" . $novoNome;
    if (move_uploaded_file($file['tmp_name'], $destino)) {
        Arquivo::salvar($file['name'], $novoNome, $idSala, $idProfessor);
        return "Upload realizado com sucesso!";
    }
    return "Erro ao fazer upload.";
}