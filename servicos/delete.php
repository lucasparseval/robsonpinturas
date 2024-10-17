<?php 
    include("functions.php"); 

    if (!isset($_SESSION)) session_start();
    if (isset($_SESSION['user'])) { // Verifica se tem um usuário logado
        if (!$_SESSION['user']) {
            $_SESSION["message"] = "Você precisa ser administrador para acessar esse recurso!";
            $_SESSION['type'] = "danger";
            header("Location: index.php");
        }
    } else {
        $_SESSION["message"] = "Você precisa estar logado para acessar esse recurso!";
        $_SESSION["type"] = "danger";
        header("Location: index.php");
    }
    ?>
    <?php if (!empty($_SESSION['message'])) : ?>
        <div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
            <?php echo $_SESSION['message']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php else : ?>
        <?php
            if (isset($_GET['id'])) {
                try {
                    $funcionario = find("funcionarios", $_GET['id']);
                    delete($_GET['id']);
                    
                    // Verifica se o nome do arquivo é semimagem.png | Se for ele não vai excluir a imagem, pq usamos dela em outros lugares!
                    if ($funcionario['foto'] !== "semimagem.png") {
                        unlink("fotos/" . $funcionario['foto']);
                    }

                } catch (Exception $e) {
                    $_SESSION ['message'] = "Não foi possivel realizar a operação: " . $e->getMessage();
                    $_SESSION['type'] = "danger";
                }
            }
        endif;
    ?>