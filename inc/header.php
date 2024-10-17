<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Robson Pinturas</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="<?php echo BASEURL; ?>css/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo BASEURL; ?>css/style.css">
  <link rel="icon" href="<?php echo BASEURL; ?>icon/icon.png" type="image/png">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      padding-top: 70px;
      /* Ajuste do padding superior para refletir a altura da navbar */
      padding-bottom: 20px;
    }

    .navbar-nav .nav-link {
      font-family: 'Poppins', sans-serif;
      font-size: 16px;
      color: #333;
      margin-right: 35px;
      transition: color 0.3s ease, transform 0.3s ease;
    }

    .navbar-nav .nav-link:hover {
      color: #003366;
      transform: scale(1.1);
    }

    .navbar-nav {
      margin: 0 auto;
    }

    /* Estilo base para o logotipo */
    .navbar-brand img {
      height: 60px;
    }

    .social-icons {
      font-size: 20px;
      color: #333;
      margin-left: 20px;
      transition: color 0.3s ease, transform 0.3s ease;
    }

    .social-icons:hover {
      color: #00517b;
      transform: scale(1.2);
    }

    .login-icon {
      margin-left: 30px;
    }

    /* Ajustes de altura para telas grandes */
    @media (min-width: 992px) {
      .navbar {
        padding-top: 10px;
        /* Aumentado para refletir a nova grossura */
        padding-bottom: 10px;
        /* Aumentado para refletir a nova grossura */
        height: 70px;
        /* Aumenta a altura da navbar */
      }

      .navbar-brand img {
        height: 45px;
        /* Ajusta o tamanho do logo */
      }
    }

    /* Para dispositivos móveis */
    @media (max-width: 991.98px) {
      .navbar {
        padding-top: 15px;
        /* Aumentado para um pouco mais de espaço */
        padding-bottom: 15px;
        /* Aumentado para um pouco mais de espaço */
      }

      .navbar-brand img {
        height: 50px;
        /* Mantém o logo maior em dispositivos móveis */
      }
    }
  </style>
  <link rel="stylesheet" href="<?php echo BASEURL; ?>css/awesome/all.min.css">
</head>

<body>
  <nav class="navbar navbar-expand-lg bg-light fixed-top" data-bs-theme="light">
    <div class="container">
      <a class="navbar-brand" href="<?php echo BASEURL; ?>">
        <img src="<?php echo BASEURL; ?>img/icon.png" alt="Robson Pinturas">
      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Navbar centralizada -->
      <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <!-- Catálogo (dropdown) -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Catálogo
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="<?php echo BASEURL; ?>catalogo/tons_tintas.php">Tons de Tinta</a></li>
              <li><a class="dropdown-item" href="<?php echo BASEURL; ?>catalogo/tons_aplicados.php">Tons Aplicados</a>
              </li>
            </ul>
          </li>

          <!-- Serviços -->
          <li class="nav-item">
            <a class="nav-link" href="<?php echo BASEURL; ?>servicos/index.php">Serviços</a>
          </li>

          <!-- Empresa -->
          <li class="nav-item">
            <a class="nav-link" href="<?php echo BASEURL; ?>empresa/index.php">Empresa</a>
          </li>

          <!-- Contato (dropdown) -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Contato
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="<?php echo BASEURL; ?>contato/contato.php">Contate-nos</a></li>
              <li><a class="dropdown-item" href="<?php echo BASEURL; ?>contato/agendamento.php">Solicite um
                  Agendamento</a></li>
            </ul>
          </li>

          <!-- Blog -->
          <li class="nav-item">
            <a class="nav-link" href="<?php echo BASEURL; ?>blog/index.php">Blog</a>
          </li>
        </ul>

        <!-- Ícones de redes sociais e login -->
        <div class="d-flex navbar-icons">
          <a href="https://instagram.com" target="_blank" class="social-icons">
            <i class="fab fa-instagram"></i>
          </a>
          <a href="https://wa.me/123456789" target="_blank" class="social-icons">
            <i class="fab fa-whatsapp"></i>
          </a>
          <a href="https://facebook.com" target="_blank" class="social-icons">
            <i class="fab fa-facebook"></i>
          </a>
          <a href="inc/login.php" class="social-icons login-icon navbar-icons">
            <i class="fas fa-user"></i>
				<?php if (!isset($_SESSION['googleID'])): ?>
				<?php else: ?>
					<a href="dashboard.php"><?php echo $_SESSION['nome']; ?> (Logout)</a>
				<?php endif; ?>
          </a>
        </div>

      </div>
    </div>
  </nav>

  <main class="container">
    <br>
  </main>
</body>

</html>