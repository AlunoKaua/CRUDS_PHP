<?php

// public/index.php

// Iniciar a sessão
session_start();

// Incluir o autoload do Composer (para gerenciar dependências como o PhpSpreadsheet)
require __DIR__ . '/../vendor/autoload.php';

// Incluir os arquivos de configuração
require __DIR__ . '/../app/config/app.php';
require __DIR__ . '/../app/config/database.php';

// Autoloading simples para as classes do aplicativo (Models e Controllers)
spl_autoload_register(function ($class) {
    $file = __DIR__ . '/../app/' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) {
        require $file;
    }
});

// Obter a URL da requisição
$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

// Roteamento básico (exemplo simplificado)
// Você precisará expandir isso para cobrir todas as suas rotas

$route = strtok($requestUri, '?'); // Remover query string

switch ($route) {
    case '/':
        // Página inicial (redirecionar para login se não estiver logado)
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: /login');
            exit();
        }
        // Exibir painel do usuário logado (dependendo do tipo)
        // TODO: Implementar lógica para exibir o painel correto
        echo "Bem-vindo ao seu painel!";
        break;

    case '/login':
        $authController = new AuthController();
        if ($requestMethod === 'POST') {
            $authController->login($_POST);
        } else {
            $authController->showLoginForm();
        }
        break;

    case '/cadastro':
        $authController = new AuthController();
        if ($requestMethod === 'POST') {
            $authController->cadastro($_POST);
        } else {
            $authController->showCadastroForm();
        }
        break;

    case '/logout':
        $authController = new AuthController();
        $authController->logout();
        break;

    // Rotas do administrador
    case '/admin/painel':
        // TODO: Verificar se o usuário logado é administrador
        $adminController = new AdminController();
        $adminController->painel();
        break;

    case '/admin/importar_alunos':
        // TODO: Verificar se o usuário logado é administrador
        $adminController = new AdminController();
        if ($requestMethod === 'POST') {
            $adminController->importarAlunos();
        } else {
            $adminController->showImportarAlunosForm();
        }
        break;

    // TODO: Adicionar mais rotas para salas, arquivos, provas, etc.

    default:
        // Página não encontrada
        http_response_code(404);
        echo "Página não encontrada";
        break;
}

?>
<?php

// public/index.php

// Iniciar a sessão
session_start();

// Incluir o autoload do Composer (para gerenciar dependências como o PhpSpreadsheet)
require __DIR__ . '/../vendor/autoload.php';

// Incluir os arquivos de configuração
require __DIR__ . '/../app/config/app.php';
require __DIR__ . '/../app/config/database.php';

// Autoloading simples para as classes do aplicativo (Models e Controllers)
spl_autoload_register(function ($class) {
    $file = __DIR__ . '/../app/' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) {
        require $file;
    }
});

// Obter a URL da requisição
$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

// Roteamento básico (exemplo simplificado)
// Você precisará expandir isso para cobrir todas as suas rotas

$route = strtok($requestUri, '?'); // Remover query string

switch ($route) {
    case '/':
        // Página inicial (redirecionar para login se não estiver logado)
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: /login');
            exit();
        }
        // Exibir painel do usuário logado (dependendo do tipo)
        // TODO: Implementar lógica para exibir o painel correto
        echo "Bem-vindo ao seu painel!";
        break;

    case '/login':
        $authController = new AuthController();
        if ($requestMethod === 'POST') {
            $authController->login($_POST);
        } else {
            $authController->showLoginForm();
        }
        break;

    case '/cadastro':
        $authController = new AuthController();
        if ($requestMethod === 'POST') {
            $authController->cadastro($_POST);
        } else {
            $authController->showCadastroForm();
        }
        break;

    case '/logout':
        $authController = new AuthController();
        $authController->logout();
        break;

    // Rotas do administrador
    case '/admin/painel':
        // TODO: Verificar se o usuário logado é administrador
        $adminController = new AdminController();
        $adminController->painel();
        break;

    case '/admin/importar_alunos':
        // TODO: Verificar se o usuário logado é administrador
        $adminController = new AdminController();
        if ($requestMethod === 'POST') {
            $adminController->importarAlunos();
        } else {
            $adminController->showImportarAlunosForm();
        }
        break;

    // TODO: Adicionar mais rotas para salas, arquivos, provas, etc.

    default:
        // Página não encontrada
        http_response_code(404);
        echo "Página não encontrada";
        break;
}

?>
<?php
// index.php
