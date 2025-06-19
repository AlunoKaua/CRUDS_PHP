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