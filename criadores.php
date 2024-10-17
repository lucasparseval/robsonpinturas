<?php
            include 'config.php';
            include DBAPI;
            if (!isset($_SESSION)) session_start(); 
            include(HEADER_TEMPLATE);
        ?>
        <h1>Criadores | <b class="text-success">Funcionários</b></h1>
        <hr>
        <div class="container-index">
            <div class="container mt-2">
                <div class="d-flex justify-content-evenly criadores-faixa-card">
                    <!-- Card 1 -->
                    <div class="col-md-4">
                        <div class="card">
                            <img src="criadores/kamilly.jpg" class="card-img-top" alt="Card Image">
                            <div class="card-body">
                                <h5 class="card-title fw-bold">Kamilly Barbosa</h5>
                                <p class="card-text text-secondary border-bottom ">Estudante</p>
                                <p class="card-text text-dark">Tenho 17 anos, amo açaí e gosto de sair com os meus amigos</p>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="#" class="btn btn-dark mr-2 col text-link"><i class="fa-regular fa-envelope"></i> <strong style="font-size: 10px; margin-left: 3px;" class="links-criadores link1">kamilly.sousa01@etec.sp.gov.br</strong></a>
                                    <a href="#" class="btn btn-secondary mr-2"><i class="fa-brands fa-instagram"></i></a>
                                    <a href="#" class="btn btn-light"><i class="fa-brands fa-twitter"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <style>
                        .text-link {
                            display: flex;
                            justify-content: center;
                            align-items: center;
                        }

                        @media (max-width: 1200px) {
                            .links-criadores {
                                display: none;
                            }
                        }
                        

                        @media (max-width: 750px) {
                            .links-criadores {
                                display: block;
                            }
                        }

                        @media (max-width: 900px) {
                            .criadores-faixa-card {
                                flex-wrap: wrap;
                                gap: 1rem;
                            }

                        }
                    </style>
                    <!-- Card 2 -->
                    <div class="col-md-4">
                        <div class="card">
                            <img src="criadores/lucas.jpg" class="card-img-top" alt="Card Image">
                            <div class="card-body">
                                <h5 class="card-title fw-bold">Lucas Tiago</h5>
                                <p class="card-text text-secondary border-bottom ">Estudante</p>
                                <p class="card-text text-dark">Tenho 17 anos e gosto de sair com meus amigos e minha família.</p>
                                <div class="d-flex justify-content-center gap-2 w-100">
                                    <a href="#" class="btn btn-dark mr-2 col text-link"><i class="fa-regular fa-envelope"></i> <strong style="font-size: 10px; margin-left: 3px;" class="links-criadores">lucas.souza1127@etec.sp.gov.br</strong></a>
                                    <a href="#" class="btn btn-secondary mr-2"><i class="fa-brands fa-instagram"></i></a>
                                    <a href="#" class="btn btn-light"><i class="fa-brands fa-twitter"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php include(FOOTER_TEMPLATE); ?>