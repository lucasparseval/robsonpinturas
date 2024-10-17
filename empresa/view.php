<?php 
	include("functions.php"); 
    if (!isset($_SESSION)) session_start(); 
    if(isset($_GET['pdf'])) {
        if($_GET['pdf'] == "ok") {
            pdf_user_view($_GET['pdf']);
        }
        else {
            pdf_user_view($_GET['pdf']);
        }
    }

    $view_result = view($_GET['id']);;

    include(HEADER_TEMPLATE);
?>

            
                <header>
                    <h2>Funcionários</h2>
                    <hr>
                </header>

                <div class="card" style="width: 18rem;">
                    <?php 
                        if(!empty($funcionarios['foto'])) {
                            echo "<img src=\"fotos/" . $funcionarios['foto'] ."\" class=\" p-1 mb-1 bg-body rounded card-img-top\" width=\"300px\">";
                        } else {
                            echo "<img src=\"fotos/semimagem.png\" class=\"shadow p-1 mb-1 bg-body rounded\" width=\"300px\">";
                        }
                    ?>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $funcionarios['nome']; ?></h5>
                        <ul class="">
                            <li class="">Endereço: <?php echo $funcionarios['endereco']; ?></li>
                            <li class="">Idade: <?php echo $funcionarios['idade']; ?>V</li>
                        </ul>
                        <button class="btn btn-light border rounded-0 mb-2 w-100" disabled><?php echo formatadata($funcionarios['dataNas'], "d/m/Y - H:i:s"); ?></button>
                        <div class="d-flex aling-center flex-column gap-1">
                            <div class="d-flex aling-center flex-row gap-1">
                                <a href="edit.php?id=<?php echo $funcionarios['id']; ?>" class="btn btn-secondary col rounded-1">
                                    <i class="fa-solid fa-pen"></i> Editar
                                </a>
                                <a class="btn btn-dark" href="view.php?pdf=<?php echo $funcionarios['id']; ?>" download><i class="fa-solid fa-file-pdf"></i> PDF</a>
                            </div>

                            <a href="index.php" class="btn btn-light rounded-1">
                                <i class="fa-solid fa-chevron-left"></i> Voltar
                            </a>
                                <style>
                                    
                                    @media (max-width: 900px) {
                                        .card {
                                            margin: 0 auto;
                                        }
                                    }
                                </style>
                            </div>
                        </div>
                    </div>
                </div>                   

<?php clear_messages(); ?> 
<?php include(FOOTER_TEMPLATE); ?>