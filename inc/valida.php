<?php
    include("../config.php");
    session_start();
    
    require_once(DBAPI);
    
    // Tenta se conectar a um banco de dados MySQL
    $bd = open_database();
    try {
        // Selecionando o Banco de dados que está ajustado na constante DB_NAME
        // Caso ele não consiga,
        $bd -> select_db(DB_NAME);
        // Pegando o login e senha digitado no form
        $usuario = $_POST['login'];
        $senha = $_POST['senha'];
        // testando para ver se o login e senha digitado no form não estão vazios
        if(!empty($usuario) && !empty($senha)) {
            // Pegando a senha digitada no form e criptografando ela para poder comparar
            // a função de criptografia FOI MOVIDA para  o arquivo database.php (DBAPI)
            $senha = criptografia($_POST['senha']);
            
            // Validação do usuário/senha digitados
            $sql = "SELECT id, nome, user, password FROM usuarios WHERE (user = '" . $usuario . "') AND (password = '" . $senha . "')";
            $query = $bd->query($sql);

            if($query->num_rows > 0) {
                // Coletando os dados
                $dados = $query->fetch_assoc();
                $id = $dados["id"];
                $nome = $dados["nome"];
                $user = $dados["user"];
                $password = $dados["password"];
                // Verifica se $user não está vazio
                if (!empty($user)) {
                    if (!isset($_SESSION)) session_start();
                    $_SESSION['message'] = "Bem vindo " . $nome ."!";
                    $_SESSION['type'] = "info";
                    $_SESSION['id'] = $id;
                    $_SESSION['nome'] = $nome;
                    $_SESSION['user'] = $user;
                } else {
                    // Mensagem de erro quando os dados são inválidos e/ou não foi encontrado
                    throw new Exception("Não foi possível se conectar!<br>Verifique seu usuário e senha.");
                }
                // Direciona para o index do site
                header("Location:". BASEURL . "index.php");
            } else {
                // Mensagem de erro quando os dados são inválidos e/ou não foi encontrado
                throw new Exception("Não foi possível se conectar!<br>Verifique seu usuário e senha.");
            } 
        } else {
            // Mensagem de erro quando os dados são inválidos e/ou não foi encontrado
            throw new Exception("Não foi possível se conectar!<br>Verifique seu usuário e senha.");
        }
    } catch(Exception $e) {
        include(HEADER_TEMPLATE);
        $_SESSION['message'] = "Ocorreu um erro: " . $e->getMessage();
        $_SESSION['type'] = "danger";
    }
?>
    <?php if (!empty($_SESSION['message'])) : ?>
        <div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert" id="actions">
            <?php echo $_SESSION['message']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php clear_messages(); ?>
    <?php endif; ?>
    <header>
        <a href="<?php echo BASEURL ?>index.php" class="btn btn-light"><i class="fa-solid fa-rotate-left"></i> Voltar</a>
    </header>

<?php include(FOOTER_TEMPLATE)?>