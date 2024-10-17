<?php 
    include("functions.php"); 
    
    if (!isset($_SESSION)) session_start();
    if (isset($_SESSION['user'])) { // Verifica se tem um usuário logado
        if (!$_SESSION['user']) {
            header("Location: index.php");
            $_SESSION["message"] = "Você precisa estar logado para acessar esse recurso!";
            $_SESSION['type'] = "danger";
        }
    } else {
        header("Location: index.php");
        $_SESSION["message"] = "Você precisa estar logado para acessar esse recurso!";
        $_SESSION['type'] = "danger";
    }

    include(HEADER_TEMPLATE); 
    edit(); 

?>

            <h2 class="mt-2">Atualizar Funcionário</h2>
            <style>
                label {
                    font-weight: bold;
                    color: #707070;
                }
            </style>

            <form action="edit.php?id=<?php echo $funcionarios['id']; ?>" method="post" enctype="multipart/form-data">
                <!-- area de campos do form -->
                <hr />
                <div class="col-md-6 d-flex justify-content-between gap-2">
                    <div class="form-group col">
                        <label for="Prefixo">Prefixo</label>
                        <input type="text" class="form-control" name="funcionarios[nome]" value="<?php echo $funcionarios['nome']?>">
                    </div>
                </div>

                <div class="col-md-6 d-flex justify-content-between gap-2 mt-1">
                    <div class="form-group col">
                        <label for="campo2">Endereço</label>
                        <input type="text" class="form-control" name="funcionarios[endereco]" value="<?php echo $funcionarios['endereco']?>">
                    </div>
                    <div class="form-group col">
                        <label for="campo2">Idade</label>
                        <input type="text" class="form-control" name="funcionarios[idade]" value="<?php echo $funcionarios['idade']?>">
                    </div>
                </div>

                <div class="col-md-6 d-flex justify-content-between gap-2 mt-1">
                    <div class="form-group">
                        <label for="campo3">Data de Nascimento</label>
                        <input type="datetime-local" class="form-control fw-bold" disabled value="<?php echo $funcionarios['dataNas'] ?>">
                    </div>
                    <?php 
                        $foto = "";
                        if (empty( $funcionarios["foto"] )) {
                            $foto = "semimagem.png";
                        } else {
                            $foto = $funcionarios['foto'];
                        }
                    ?>
                    <div class="form-group col">
                        <label for="foto">Foto</label>
                        <input type="file" class="form-control" id="foto" name="foto" value="fotos/<?php echo $foto?>">
                    </div>
                    
                </div>

                <div class="form-group col-md-6 mt-1">
                    <label for="imgPreview">Pré-visualização</label>
                    <img class="form-control shadow p-2 mb-2 bg-body rounded" id="imgPreview" src="fotos/<?php echo $foto?>" alt="Foto do Funcionário">
                </div>


                <div id="actions" class="mt-3">
                    <div class="col-md-6 d-flex justify-content-between gap-2">
                        <button type="submit" class="btn btn-secondary col"><i class="fa-solid fa-floppy-disk"></i> Salvar</button>
                        <a href="index.php" class="btn btn-light text-dark"><i class="fa-solid fa-eraser"></i> Cancelar</a>
                    </div>
                </div>
            </form>

<?php include(FOOTER_TEMPLATE); ?>

<script>
    $(document) .ready(() => {
        $("#foto").change(function () {
            const file = this.file[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function (event) {
                    $("#imgPreview").attr("src", event.target.result);
                };
                reader.readAsDataURL(file);
            }
        });
    });
</script>