<?php
require_once '../config.php'; // Conexão com o banco de dados
session_start(); // Iniciar a sessão

// Inclua a biblioteca Google API
require_once 'libs/google-api-php-client/vendor/autoload.php';

$client = new Google_Client();
$client->setClientId('SEU_CLIENT_ID');
$client->setClientSecret('SEU_CLIENT_SECRET');
$client->setRedirectUri('http://crud-bootstrap-php/callback.php');
$client->addScope('email');
$client->addScope('profile');

// Verifica se o código de autenticação foi retornado
if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token);

    // Obtém as informações do perfil do usuário
    $oauth2 = new Google_Service_Oauth2($client);
    $userinfo = $oauth2->userinfo->get();

    // Armazene informações do usuário na sessão
    $_SESSION['googleID'] = $userinfo->id;
    $_SESSION['nome'] = $userinfo->name;
    $_SESSION['email'] = $userinfo->email;

    // Verifica se o usuário já existe no banco de dados
    $sql = "SELECT * FROM usuarios WHERE googleID = :googleID";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['googleID' => $userinfo->id]);
    $user = $stmt->fetch();

    if ($user) {
        // Se o usuário já existe, atualiza os dados
        $sql = "UPDATE usuarios SET nome = :nome, email = :email WHERE googleID = :googleID";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'nome' => $userinfo->name,
            'email' => $userinfo->email,
            'googleID' => $userinfo->id
        ]);
    } else {
        // Se o usuário não existe, insere um novo registro
        $sql = "INSERT INTO usuarios (googleID, nome, email, criadoEm) VALUES (:googleID, :nome, :email, NOW())";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'googleID' => $userinfo->id,
            'nome' => $userinfo->name,
            'email' => $userinfo->email
        ]);
    }

    // Redireciona para a página principal ou dashboard
    header('Location: dashboard.php');
    exit();
}