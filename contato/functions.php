<?php
ob_start();

    include("../config.php");
    include(DBAPI);
    $funcionarios = null;
    $funcionario = null;
	
	
    
    // Listagem de funcionarios

    function index() {
        global $funcionarios;
        if (!empty($_POST['funcionarios'])) {
            $funcionarios = filter("funcionarios", "nome like '%" . $_POST['funcionarios'] . "%'");
        } else {
            $funcionarios = find_all("funcionarios");
        }

        return !empty($funcionarios);
    }


    // Upload de imagens

    function upload ($pasta_destino, $arquivo_destino, $tipo_arquivo, $nome_temp, $tamanho_arquivo) {
        try {
            $nomearquivo = basename($arquivo_destino);
            $uploadOk = 1;
            if(isset($_POST["submit"])) {
                $check = getimagesize($nome_temp);
                if($check !== false) {
                    $_SESSION['message'] = "File is an image - " . $check["mime"] . ".";
                    $_SESSION['type'] = "info";
                    $uploadOk = 1;
                } else {
                    $uploadOk = 0;
                    throw new Exception("O arquivo não é uma imagem!");
                }
            }

            if (file_exists($arquivo_destino)) {
                $uploadOk = 0;
                throw new Exception("Desculpe, mas o arquivo já existe!");
            }

            if ($tamanho_arquivo > 5000000) {
                $uploadOk = 0;
                throw new Exception("Desculpe, mas o arquivo é muito grande!");
            }

            if ($tipo_arquivo != "jpg" && $tipo_arquivo != "png" && $tipo_arquivo != "jpeg" && $tipo_arquivo != "gif") {
                $uploadOk = 0;
                throw new Exception("Desculpe, mas só são permitidos arquivos de imagem JPG, PNG, JPEG E GIF!");
            }

            if ($uploadOk == 0) {
                throw new Exception("Desculpe, mas o arquivo não pode ser enviado!");
            } else {
                if (move_uploaded_file($_FILES["foto"] ["tmp_name"], $arquivo_destino)) {
                    $_SESSION['message'] = "O arquivo " . htmlspecialchars($nomearquivo) . " foi armazenado.";
                    $_SESSION["type"] = "success";
                } else {
                    throw new Exception("Desculpe, mas o arquivo não pode ser enviado!");
                }
            }
        } catch (Exception $e) {
            $_SESSION['message'] = "Aconteceu algum erro: " . $e->getMessage();
            $_SESSION["type"] = "danger";
        }
    }
    
    //  Cadastro de Usuários

    /**
     * Add vai receber o post do navegador e salvar o item
     */
    function add() {

        if (!empty($_POST['funcionario'])) {
            try {
                $funcionario = $_POST['funcionario'];

                $today = new DateTime("now", new DateTimeZone("America/Sao_Paulo"));
                $funcionario['dataNas'] = $today->format("Y-m-d H:i:s");

                if(!empty($_FILES["foto"]["name"])) {
                    // Upload de Foto
                    $pasta_destino = "fotos/";
                    $arquivo_destino = $pasta_destino . basename($_FILES["foto"]["name"]);
                    $nomearquivo = basename($_FILES["foto"]["name"]); 
                    $resolucao_arquivo = getimagesize($_FILES["foto"]["tmp_name"]);
                    $tamanho_arquivo = $_FILES["foto"] ["size"];
                    $nome_temp = $_FILES["foto"] ["tmp_name"];
                    $tipo_arquivo = strtolower(pathinfo($arquivo_destino, PATHINFO_EXTENSION));

                    // Chamada da função upload para gravar a imagem
                    upload($pasta_destino, $arquivo_destino, $tipo_arquivo, $nome_temp, $tamanho_arquivo);

                    $funcionario["foto"] = $nomearquivo;
                }
                else {
                    $funcionario["foto"] = "semimagem.png";
                }

                save('funcionarios', $funcionario);
                return header("Location: index.php");
            } catch (Exception $e) {
                $_SESSION['message'] = "Aconteceu um erro: " . $e->getMessage();
                $_SESSION['type'] = "danger";
            }
        }
    }

    // Atualizacao/Edicao de Usuário
    

    function edit() {
        if (isset($_GET['id'])) {

            $id = $_GET['id'];
        
            if (isset($_POST['funcionarios'])) {
        
                $funcionario = $_POST['funcionarios'];

                if(!empty($_FILES['foto'] ['name'])) {
                    $pasta_destino = "fotos/";
                    $arquivo_destino = $pasta_destino . basename($_FILES["foto"]["name"]);
                    $nomearquivo = basename($_FILES["foto"]["name"]);
                    $resolucao_arquivo = getimagesize($_FILES["foto"]["tmp_name"]);
                    $tamanho_arquivo = $_FILES["foto"] ["size"];
                    $nome_temp = $_FILES["foto"] ["tmp_name"];
                    $tipo_arquivo = strtolower(pathinfo($arquivo_destino, PATHINFO_EXTENSION));

                    upload($pasta_destino, $arquivo_destino, $tipo_arquivo, $nome_temp, $tamanho_arquivo);

                    $funcionario['foto'] = $nomearquivo;
                }

        
                update("funcionarios", $id, $funcionario);
                header("location: index.php");
            } else {
        
                global $funcionarios;
                $funcionarios = find("funcionarios", $id);
            } 
            } 
            else {
                header("location: index.php");
        }
    }

    //  Visualização de um Usuário

    function view($id = null) {
        global $funcionarios;
        $funcionarios = find("funcionarios", $id);
    }

    // Exclusão de um Usuário
  
    function delete($id = null) {
    
        global $funcionarios;
        $funcionarios = remove("funcionarios", $id);
    
        header("location: index.php");
    }
	
	// Gerando o PDF
	
	function PDF($p = null) {
		// Instanciation of inherited class
		$pdf = new PDF();
		$pdf->AddPage();
		$pdf->AliasNbPages();
		$pdf->Image('fotos/func_pdf.png', 7, 5, 30);
        $pdf->Cell(160, 20, utf8("LISTAGEM DE FUNCIONÁRIOS"), 0, 1, "C");
        $pdf->SetFont('helvetica', 'B', 12);
        $pdf->Ln(10);
		
	// Verifica se $p não é nulo
		if($p) {
			$funcionarios = filter ("funcionarios", "nome like '%" . $p. "%'");
		} else {
			$funcionarios = find_all("funcionarios");
		}
		if (!is_null($funcionarios) && count($funcionarios) > 0) {
            $header = array ('ID', 'Nome', 'Endereco', 'Idade', 'Foto');
            $nomeCellWidth = 45; 
    
            foreach ($funcionarios as $funcionario) {
                $nomeLength = strlen($funcionario['nome']);
                if ($nomeLength > $nomeCellWidth) {
                    $nomeCellWidth = $nomeLength;
                }
            }

            $grey = false;
            $fillColor = $grey ? [192, 192, 192] : [255, 255, 255];
        
            $pdf->SetFillColor($fillColor[0], $fillColor[1], $fillColor[2]);
            $pdf->SetTextColor(0, 0, 0); 
            $pdf->Cell(15, 12, $header[0], 1, 0, 'C', true);
            $pdf->Cell($nomeCellWidth, 12, $header[1], 1, 0, 'C', true);
            $pdf->Cell(90, 12, $header[2], 1, 0, 'C', true);
            $pdf->Cell(25, 12, $header[3], 1, 0, 'C', true);            
            $pdf->Cell(20, 12, $header[4], 1, 1, 'C', true);            
    
            $posY = 50;
            foreach ($funcionarios as $funcionario) {
                // Alternar a cor de fundo
                $fillColor = $grey ? [192, 192, 192] : [255, 255, 255];
                $grey = !$grey;
    
                $pdf->SetFillColor($fillColor[0], $fillColor[1], $fillColor[2]);
    
                $pdf->Cell(15, 12, $funcionario['id'], 1, 0, 'C', true);
                $pdf->Cell($nomeCellWidth, 12, utf8($funcionario['nome']), 1, 0, 'C', true);
                $pdf->Cell(90, 12, utf8($funcionario['endereco']), 1, 0, 'C', true);
                $pdf->Cell(25, 12, utf8($funcionario['idade']), 1, 0, 'C', true); 
                $pdf->Cell(20, 12, '', 1, 0, 'C', true); 
                $pdf->Image("fotos/{$funcionario['foto']}", 190, $pdf->GetY() + 1, 10, 10);
                $pdf->Ln();
        
                $posY += 40;
            }
    
            // Saída do PDF
            $pdf->Output('I', 'Listagem_Func.pdf');
        } else {
            // Retorna false se não houver registros
            return false;
        }
        
    }

    function pdf_func_view($id = null) {
        $pdf = new PDF();
        $pdf->AddPage();
        $pdf->Image('fotos/func_pdf.png', 10, 5, 30);
        $pdf->AliasNbPages();
        $pdf->Cell(155, 20, utf8("LISTAGEM DE FUNCIONÁRIOS"), 0, 1, "C");
        $pdf->SetFont('helvetica', 'B', 12);
        $pdf->Ln(10);

        global $funcionarios;
        $funcionarios = find("funcionarios", $id);
        
        $name = utf8($funcionarios['nome']);

        $pdf->Cell(9,10, "ID:", 0, 0, 'B');
        $pdf->Cell(100,10, $funcionarios['id'], 0, 1);
        $pdf->Cell(19,10, "Nome:", 0, 0, 'B');
        $pdf->Cell(100,10, $funcionarios, 0, 1);
        $pdf->Cell(16,10, "Endereço:", 0, 0, 'B');
        $pdf->Cell(100,10, utf8($funcionarios['endereco']), 0, 1);
        $pdf->Cell(24,10, "Idade:", 0, 0, 'B');
        $pdf->Cell(100,10, utf8($funcionarios['idade']), 0, 1);
        $pdf->Cell(45,10, utf8("Data de Nascimento:"), 0, 0, 'B');
        $pdf->Cell(100,10, utf8($funcionarios['dataNas']), 0, 1);
        $pdf->Cell(19,10, "Foto:", 0, 0, 'B');
        $pdf->Cell(100, 10, $pdf->Image("fotos/{$funcionarios['foto']}", 10, 100, 30), 0, 1);

        // Saída do PDF
        $pdf->Output('I', $name . ".pdf");
    }