 <?php
use PhpOffice\PhpSpreadsheet\IOFactory;
require_once __DIR__ . '/../../vendor/autoload.php';

public function importarAlunos($arquivoExcel, $idSala) {
    $spreadsheet = IOFactory::load($arquivoExcel['tmp_name']);
    $sheet = $spreadsheet->getActiveSheet();
    $rows = $sheet->toArray();

    $header = array_map('strtolower', $rows[0]);
    $feedback = [];
    for ($i = 1; $i < count($rows); $i++) {
        $data = array_combine($header, $rows[$i]);
        // Validação: email e matrícula únicos
        if (Usuario::existe($data['email'], $data['matrícula'])) {
            $feedback[] = "Aluno {$data['nome']} já cadastrado.";
            continue;
        }
        $aluno = new Usuario($data['nome'], $data['email'], $data['matrícula'], password_hash($data['senha'], PASSWORD_DEFAULT), 'aluno');
        $aluno->salvar();
        Sala::associarAluno($aluno->id, $idSala);
        $feedback[] = "Aluno {$data['nome']} importado com sucesso.";
    }
    return $feedback;
}