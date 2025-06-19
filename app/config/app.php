php
<?php

// app/config/app.php

// Configurações gerais da aplicação

// Define a URL base da aplicação
define('BASE_URL', 'http://localhost/seu_projeto_ifam'); // Altere para a URL do seu projeto

// Modo de debug (true para desenvolvimento, false para produção)
define('DEBUG', true);

// Nome da aplicação
define('APP_NAME', 'Plataforma Educacional IFAM');

// Chave secreta para segurança (pode ser usada para cookies, CSRF, etc.)
// Gere uma string aleatória e complexa
define('APP_SECRET_KEY', 'sua_chave_secreta_aleatoria_aqui');

// Outras configurações globais podem ser adicionadas aqui
// Por exemplo, configurações de timezone:
// date_default_timezone_set('America/Sao_Paulo');

// Configurações de erro (apenas em modo DEBUG)
if (DEBUG) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
} else {
    ini_set('display_errors', 0);
    ini_set('display_startup_errors', 0);
    error_reporting(0); // Desativar exibição de erros em produção
    // Configurar log de erros aqui se necessário
}

?>