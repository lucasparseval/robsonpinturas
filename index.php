<?php
include 'config.php';
include DBAPI;
if (!isset($_SESSION))
  session_start();
include(HEADER_TEMPLATE);
$db = open_database();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <title>Robson Pinturas</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="<?php echo BASEURL; ?>css/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo BASEURL; ?>css/style.css">
  <link rel="icon" href="<?php echo BASEURL; ?>icon/icon.png" type="image/png">

  <!-- Importando a fonte "Poppins" -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

  <style>
  body {
    padding-top: 20px;
    padding-bottom: 20px;
    font-family: 'Poppins', sans-serif;
  }

  .card-body h5 {
    font-family: 'Poppins', sans-serif;
    font-weight: bold;
  }

  .card-text, .about-section p, .testimonial-section blockquote p {
    text-align: justify;
  }

  .carousel-item img {
    height: 400px;
    object-fit: cover;
  }

  .icon-card {
    font-size: 2rem;
    margin-bottom: 10px;
    color: #255269;
  }

  .testimonial-section {
    background-color: #255269;
    color: white;
    padding: 50px 0;
  }

  .testimonial-section h2,
  .testimonial-section blockquote,
  .testimonial-section footer {
    color: white;
  }

  .btn-petroleo {
    background-color: #255269;
    border-color: #255269;
  }

  .btn-petroleo:hover {
    background-color: #1a3b4c;
    border-color: #1a3b4c;
  }

  blockquote p {
    margin-bottom: 10px;
  }

  blockquote footer {
    margin-top: 0.5rem;
  }

  .form-control {
    border: 1px solid #1a3b4c;
    border-radius: 5px;
    padding: 10px;
    font-size: 16px;
  }

  .form-control:focus {
    border-color: #255269;
    box-shadow: 0 0 5px rgba(37, 82, 105, 0.5);
  }

  textarea.form-control {
    resize: none;
  }

  .btn-feedback {
    background-color: #003366;
    border-color: #003366;
    color: white;
  }

  .btn-feedback:hover {
    background-color: #32373c;
    border-color: #32373c;
  }

  .about-section {
    padding: 50px 0;
  }

  .about-section img {
    max-width: 100%;
    height: auto;
  }

  .about-section h2 {
    font-weight: bold;
    margin-bottom: 20px;
  }

  .about-section p {
    font-size: 1rem;
    margin-bottom: 15px;
    text-align: justify;
  }

  .about-section img {
    max-width: 40%;
    height: auto;
    border-radius: 10px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
  }

  </style>

</head>

<body>

  <!-- Carrossel -->
  <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true"
        aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="img/carrossel1.jpg" class="d-block w-100" alt="Ambiente Pintado">
        <div class="carousel-caption d-none d-md-block">
          <h5>Transforme seu espaço com Robson Pinturas</h5>
          <p>Pintura de alta qualidade com acabamentos perfeitos.</p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="img/carrossel2.png" class="d-block w-100" alt="Ambiente Moderno">
        <div class="carousel-caption d-none d-md-block">
          <h5>Personalize com Cores</h5>
          <p>Escolha tons que refletem sua personalidade.</p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="img/carrossel3.jpg" class="d-block w-100" alt="Ambiente Moderno">
        <div class="carousel-caption d-none d-md-block">
          <h5>Serviço Rápido e Eficiente</h5>
          <p>Confie nos especialistas para realizar seu projeto.</p>
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>

  <!-- Cards Responsivos -->
  <section class="container mt-5">
    <div class="row">
      <div class="col-md-4 mb-4">
        <div class="card text-center">
          <div class="card-body">
            <i class="fas fa-paint-brush icon-card"></i>
            <h5 class="card-title">Encontre sua Cor</h5>
            <p class="card-text">Encontre as cores ideais para sua casa.</p>
            <a href="catalogo/tons_tintas.php" class="btn btn-primary btn-petroleo">Saiba Mais</a>
          </div>
        </div>
      </div>
      <div class="col-md-4 mb-4">
        <div class="card text-center">
          <div class="card-body">
            <i class="fas fa-tint icon-card"></i>
            <h5 class="card-title">Descubra sua Tinta</h5>
            <p class="card-text">Veja as opções de tinta para o seu projeto.</p>
            <a href="#" class="btn btn-primary btn-petroleo">Saiba Mais</a>
          </div>
        </div>
      </div>
      <div class="col-md-4 mb-4">
        <div class="card text-center">
          <div class="card-body">
            <i class="fas fa-shopping-cart icon-card"></i>
            <h5 class="card-title">Compre Online</h5>
            <p class="card-text">Encontre todas as opções de compra online.</p>
            <a href="catalogo/tons_aplicados.php" class="btn btn-primary btn-petroleo">Saiba Mais</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Seção de Serviços -->
  <section class="services-section" style="background-color: #255269; padding: 50px 0;">
    <div class="container">
      <h2 class="text-white text-center mb-4">Conheça Nossos Principais Serviços</h2>
      <br>
      <div class="row">

        <!-- Card 1: Textura Projetada -->
        <div class="col-md-4 mb-4">
          <div class="card shadow h-100">
            <div class="card-body text-center">
              <i class="fas fa-paint-roller fa-3x" style="color: #255269; margin-bottom: 10px;"></i>
              <h5 class="card-title">Textura Projetada</h5>
              <p class="card-text">Acabamento moderno e resistente para paredes internas e externas, 
			  com aplicação rápida e relevos únicos. Oferece proteção contra impactos e intempéries, 
			  unindo durabilidade e estilo.</p>
            </div>
          </div>
        </div>

        <!-- Card 2: Grafiato -->
        <div class="col-md-4 mb-4">
          <div class="card shadow h-100">
            <div class="card-body text-center">
              <i class="fas fa-fill-drip fa-3x" style="color: #255269; margin-bottom: 10px;"></i>
              <h5 class="card-title">Grafiato</h5>
              <p class="card-text">Técnica de revestimento com textura granulada que cria um 
			  acabamento rústico e sofisticado. Resistente e ideal para áreas internas e externas, 
			  protege contra umidade e fissuras, garantindo durabilidade..</p>
            </div>
          </div>
        </div>

        <!-- Card 3: Cimentos -->
        <div class="col-md-4 mb-4">
          <div class="card shadow h-100">
            <div class="card-body text-center">
              <i class="fas fa-trowel fa-3x" style="color: #255269; margin-bottom: 10px;"></i>
              <h5 class="card-title">Cimentos</h5>
              <p class="card-text">O revestimento de cimento oferece um visual moderno e minimalista, ideal para quem
                busca um estilo industrial. Além de ser resistente e durável, é versátil, podendo ser aplicado em pisos
                e paredes internas e externas. Sua alta durabilidade o torna uma opção prática e estética para diversos
                ambientes.</p>
            </div>
          </div>
        </div>

        <!-- Card 4: Efeitos Decorativos -->
        <div class="col-md-4 mb-4">
          <div class="card shadow h-100">
            <div class="card-body text-center">
              <i class="fas fa-swatchbook fa-3x" style="color: #255269; margin-bottom: 10px;"></i>
              <h5 class="card-title">Efeitos Decorativos</h5>
              <p class="card-text">Técnicas de pintura que criam acabamentos personalizados, como marmorizado, metalizado 
			  e degradê. Proporcionam textura e profundidade, elevando o design dos ambientes.</p>
            </div>
          </div>
        </div>

        <!-- Card 5: Verniz -->
        <div class="col-md-4 mb-4">
          <div class="card shadow h-100">
            <div class="card-body text-center">
              <i class="fas fa-paintbrush fa-3x" style="color: #255269; margin-bottom: 10px;"></i>
              <h5 class="card-title">Verniz</h5>
              <p class="card-text">Acabamento transparente que protege madeira, concreto ou metal, conferindo brilho 
			  e resistência contra umidade e desgaste, prolongando a durabilidade das superfícies.</p>
            </div>
          </div>
        </div>

        <!-- Card 6: Laqueamento -->
        <div class="col-md-4 mb-4">
          <div class="card shadow h-100">
            <div class="card-body text-center">
              <i class="fas fa-box fa-3x" style="color: #255269; margin-bottom: 10px;"></i>
              <h5 class="card-title">Laqueamento</h5>
              <p class="card-text">Técnica de acabamento liso e brilhante em móveis e superfícies de madeira, 
			  oferecendo visual sofisticado e proteção contra arranhões e desgastes.</p>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- Seção Sobre Robson -->
  <section class="about-section container mt-5">
    <div class="row align-items-center">
      <div class="col-md-6 text-center mb-4 mb-md-0">
        <img src="img/robson1.png" class="img-fluid rounded shadow" alt="Robson"
          style="max-width: 100%; height: auto;" />
      </div>
      <div class="col-md-6">
        <h2>Sobre Robson Pinturas</h2>
        <p>Robson é um profissional apaixonado por pintura, com mais de 10 anos de experiência no mercado. Ele acredita
          que cada ambiente deve refletir a personalidade de seus moradores e se dedica a transformar espaços por meio
          de cores e acabamentos de alta qualidade.</p>
        <p>Com um compromisso firme com a satisfação do cliente, Robson oferece um serviço rápido, eficiente e com um
          toque especial que faz a diferença. Se você está buscando renovar seu espaço, Robson Pinturas é a escolha
          certa!</p>
      </div>
    </div>
    <br>
    <br>
  </section>

  <!-- Seção de Depoimentos -->
  <section class="testimonial-section text-center">
    <div class="container">
      <h2>O Que Nossos Clientes Dizem</h2>
      <blockquote class="blockquote">
        <p class="mb-0">"O serviço da Robson Pinturas foi excelente! Minha casa nunca esteve tão bonita."</p>
        <footer class="blockquote-footer mt-2">João, <cite title="Source Title">Cliente Satisfeito</cite></footer>
      </blockquote>

      <h3 style="margin-top: 40px;">Deixe seu Feedback</h3>
      <form action="inc/enviar_feedback.php" method="POST" class="mt-4">
        <div class="mb-3">
          <input type="text" name="nome" class="form-control" placeholder="Seu Nome" required>
        </div>
        <div class="mb-3">
          <input type="email" name="email" class="form-control" placeholder="Seu E-mail" required>
        </div>
        <div class="mb-3">
          <textarea name="mensagem" class="form-control" rows="4" placeholder="Sua Mensagem" required></textarea>
        </div>
        <button type="submit" class="btn btn-feedback">Enviar Feedback</button>
      </form>

      </form>
    </div>
  </section>



  <script src="<?php echo BASEURL; ?>js/bootstrap.bundle.min.js"></script>
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
</body>

</html>

<?php include(FOOTER_TEMPLATE); ?>