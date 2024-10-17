<?php
// Inclua o arquivo de configuração
include("../config.php");

// Inclua o arquivo de banco de dados
include(DBAPI); // Isso garante que a função open_database() esteja disponível

// Verifique se a função open_database está definida
if (!function_exists('open_database')) {
  die("Erro: A função open_database não está disponível.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nome = $_POST['nome'];
  $email = $_POST['email'];
  $mensagem = $_POST['mensagem'];

  $db = open_database();

  // Preparar e executar a consulta SQL
  $stmt = $db->prepare("INSERT INTO feedback (nome, email, mensagem, data) VALUES (?, ?, ?, NOW())");
  $stmt->bind_param("sss", $nome, $email, $mensagem);

  if ($stmt->execute()) {
    // Sucesso: redirecionar ou exibir uma mensagem
    echo "<script>alert('Feedback enviado com sucesso!'); window.location.href = '../index.php';</script>";
  } else {
    // Erro: exibir uma mensagem de erro
    echo "Erro ao enviar feedback: " . $stmt->error;
  }

  // Fechar a conexão
  $stmt->close();
  $db->close();
}
?>