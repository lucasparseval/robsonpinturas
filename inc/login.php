<?php 
    include("../config.php");
    include(HEADER_TEMPLATE);
    session_start();
?>

<?php
// Inclua a biblioteca Google API
require_once 'libs/google-api-php-client/vendor/autoload.php';

// Inicialize o cliente
$client = new Google_Client();
$client->setClientId('SEU_CLIENT_ID');
$client->setClientSecret('SEU_CLIENT_SECRET');
$client->setRedirectUri('http://seusite.com/callback.php'); // Ajuste a URL para onde o Google vai redirecionar após o login
$client->addScope('email');
$client->addScope('profile');

// Verifica se o código de autenticação foi retornado (após o login)
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

    // Redireciona para a página de perfil ou dashboard
    header('Location: dashboard.php');
    exit();
}

// Gerar URL de autenticação do Google
$authUrl = $client->createAuthUrl();

// Exiba o link de login
echo "<a href='$authUrl'>Login com Google</a>";
?>

<?php include(FOOTER_TEMPLATE); ?>
