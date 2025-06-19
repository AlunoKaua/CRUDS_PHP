<?php

namespace App\Controllers;

use App\Models\Usuario;
use App\Models\Sala;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Exception as ReaderException;

class AdminController {

    public function painel() {
        // TODO: Implementar a lógica do painel do administrador
        // Ex: Contagem de usuários, salas, etc.
        echo "<h1>Painel do Administrador</h1>";
        echo "<p><a href=\"/admin/importar_alunos\">Importar Alunos</a></p>";
        echo "<p><a href=\"/admin/salas\">Gerenciar Salas</a></p>";
        // Incluir a view do painel
        // include __DIR__ . '/../views/admin/painel.php';
    }

    public function showImportarAlunosForm() {
        // Exibir a view para importar alunos
        include __DIR__ . '/../views/admin/importar_alunos.php';
    }

    public function importarAlunos() {
        // TODO: Implementar a lógica de upload e leitura do Excel
        // Usar o código fornecido como base e integrar com o fluxo de upload
        // A lógica de importação foi movida para um método separado para organização

        // Este método deve lidar com o recebimento do arquivo e chamar o método de importação
        echo "Processando importação de alunos...";
        // Lógica de upload e chamada para processarExcelImport
        if (isset($_FILES['arquivo_excel']) && isset($_POST['id_sala'])) {
            $arquivo = $_FILES['arquivo_excel'];
            $idSala = $_POST['id_sala'];
            $feedback = $this->processarExcelImport($arquivo, $idSala);
            $_SESSION['feedback_importacao'] = $feedback;
            header('Location: /admin/importar_alunos');
            exit();
        } else {
            $_SESSION['mensagem_erro'] = "Nenhum arquivo enviado ou sala não especificada.";
            header('Location: /admin/importar_alunos');
            exit();
        }
    }

    private function processarExcelImport($arquivoExcel, $idSala) {
        $feedback = [];
        try {
            $spreadsheet = IOFactory::load($arquivoExcel['tmp_name']);
            $sheet = $spreadsheet->getActiveSheet();
            $rows = $sheet->toArray();

            if (empty($rows)) {
                $feedback[] = "O arquivo Excel está vazio.";
                return $feedback;
            }

            $header = array_map('trim', array_map('strtolower', $rows[0]));
            // Espera colunas: nome, email, matrícula, senha, sala
            $expected_header = ['nome', 'email', 'matrícula', 'senha', 'sala']; // 'sala' será usado para validação, mas o aluno será associado a $idSala

            // Validar cabeçalho (opcional, mas boa prática)
            // if (count(array_intersect($expected_header, $header)) !== count($expected_header)) {
            //     $feedback[] = "Cabeçalho do arquivo Excel inválido. Esperado: " . implode(', ', $expected_header);
            //     return $feedback;
            // }

            $usuarioModel = new Usuario();
            $salaModel = new Sala();

            for ($i = 1; $i < count($rows); $i++) {
                // Usar o cabeçalho para mapear os dados corretamente
                $data = [];
                foreach ($header as $index => $col_name) {
                    $data[$col_name] = trim($rows[$i][$index] ?? '');
                }

                // Validação básica dos dados da linha
                if (empty($data['nome']) || empty($data['email']) || empty($data['matrícula']) || empty($data['senha'])) {
                     $feedback[] = "Linha " . ($i + 1) . ": Dados incompletos. Ignorando linha.";
                     continue;
                }

                // Validação: email e matrícula únicos
                if ($usuarioModel->existePorEmailOuMatricula($data['email'], $data['matrícula'])) {
                    $feedback[] = "Linha " . ($i + 1) . ": Aluno com email '{$data['email']}' ou matrícula '{$data['matrícula']}' já cadastrado.";
                    continue;
                }

                // Cadastrar o novo aluno
                $dados_aluno = [
                    'nome' => $data['nome'],
                    'email' => $data['email'],
                    'matricula' => $data['matrícula'],
                    'senha' => password_hash($data['senha'], PASSWORD_DEFAULT), // Criptografar a senha
                    'tipo' => 'aluno'
                ];

                $novoAlunoId = $usuarioModel->create($dados_aluno);

                if ($novoAlunoId) {
                    // Associar aluno à sala especificada no formulário ($idSala)
                    $associado = $salaModel->associarAluno($idSala, $novoAlunoId);
                    if ($associado) {
                        $feedback[] = "Linha " . ($i + 1) . ": Aluno '{$data['nome']}' importado e associado à sala.";
                    } else {
                         $feedback[] = "Linha " . ($i + 1) . ": Aluno '{$data['nome']}' importado, mas falha ao associar à sala.";
                    }
                } else {
                    $feedback[] = "Linha " . ($i + 1) . ": Erro ao cadastrar o aluno '{$data['nome']}'.";
                }
            }

        } catch (ReaderException $e) {
            $feedback[] = "Erro ao ler o arquivo Excel: " . $e->getMessage();
        } catch (\Exception $e) {
             $feedback[] = "Ocorreu um erro inesperado durante a importação: " . $e->getMessage();
        }

        // Opcional: remover o arquivo temporário após processar
        // if (file_exists($arquivoExcel['tmp_name'])) {
        //     unlink($arquivoExcel['tmp_name']);
        // }

        return $feedback;
    }

    // TODO: Adicionar métodos para gerenciar salas (listar, cadastrar, editar)
    public function listarSalas() {
         // TODO: Implementar listagem de salas para o admin
         echo "Lista de Salas (Admin)";
         // Incluir a view de listagem de salas
         // include __DIR__ . '/../views/admin/salas/listar.php';
    }

    public function showCadastrarSalaForm() {
         // TODO: Exibir formulário para cadastrar sala
         echo "Formulário de Cadastro de Sala";
         // Incluir a view de cadastro de sala
         // include __DIR__ . '/../views/admin/salas/cadastrar.php';
    }

    public function cadastrarSala($dados) {
        // TODO: Processar cadastro de sala
        echo "Processando cadastro de sala";
        // Lógica para criar a sala no banco de dados
        // Redirecionar após o cadastro
    }

    // TODO: Adicionar métodos para associar usuários às salas manualmente (se necessário)
    // TODO: Adicionar métodos para gerenciar professores (listar, editar)

}

?>
<?php

namespace App\Controllers;

use App\Models\Usuario;
use App\Models\Sala;
use PhpOffice\PhpSpreadsheet\IOFactory;

class AdminController {

 public function painel() {
 // TODO: Implementar a lógica do painel do administrador
 echo "Painel do Administrador";
 }

 public function showImportarAlunosForm() {
 // TODO: Exibir a view para importar alunos
 include __DIR__ . '/../views/admin/importar_alunos.php';
 }

 public function importarAlunos() {
 // TODO: Implementar a lógica de upload e leitura do Excel
 // Usar o código fornecido como base
 }

 // TODO: Adicionar métodos para gerenciar salas (listar, cadastrar, editar)
 // TODO: Adicionar métodos para associar usuários às salas
 // TODO: Adicionar métodos para gerenciar professores

}

?>
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