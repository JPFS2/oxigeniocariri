<?php

include('verifica_login.php');
include('model/conexao.php');

$colindro = "SELECT * FROM cilindro";
$cilindros = $conexao->query($colindro) or die($mysqli->error);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Oxigenio Cariri</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/icon-logo.png" rel="icon">
    <link href="assets/img/icon-logo.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Raleway:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
          rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <style>
        @media print {
            body * {
                visibility: hidden;
            }

            #printable, #printable * {
                visibility: visible;
            }

            #printable {
                position: fixed;
                left: 0;
                top: 0;
            }

            #printable .row .col {

                margin: 0px;
                padding: 0px;
                width: 150px;
            }

        }
    </style>


    <!-- Template Main CSS File -->
    <link href="assets/css/main.css" rel="stylesheet">

</head>

<body>
<!-- ======= Menu superior ======= -->
<section class="topbar d-flex align-items-center">
    <div class="container d-flex justify-content-center justify-content-md-between">
        <div class="contact-info d-flex align-items-center">
            <i class="bi bi-envelope d-flex align-items-center">
                <a href="mailto:contact@example.com">contact@example.com</a></i>
            <i class="bi bi-phone d-flex align-items-center ms-4"><span>+55 88 3532 0017</span></i>
            <i class="bi bi-whatsapp d-flex align-items-center ms-4"><span>+55 88 98149 2016</span></i>
        </div>
        <div class=" d-none d-md-flex align-items-center">
            <?= $_SESSION['usuario'] ?>
        </div>


    </div>
</section>

<!-- ======= Tabela ======= -->
<section class="gradient-form" style="background-color: #eee;">

    <div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <!--- Title ---->
                    <div class="col-sm-11 py-3">
                        <h2>Relação de <b>cilindros</b></h2>
                    </div>

                    <!--- Botão Add ---->
                    <div class="col-sm-1 py-3 float-right">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                data-bs-target="#AddModal">
                            <i class="bi bi-clipboard-plus"></i> <span>Adicionar</span>
                        </button>
                    </div>
                </div>
            </div>

            <!--- Aviso sobre cadastro, exclusão dentre outros ---->
            <?php if (isset($_SESSION['aviso'])) {
                echo "<div class= 'alert alert-success' role='alert'>";
                echo $_SESSION['aviso'];
                echo "</div>";

                $_SESSION['aviso'] = '';
                unset($_SESSION['aviso']);
            }
            ?>

            <table class="table table-striped table-hover ">
                <thead>
                <tr>
                    <th>
							<span class="custom-checkbox">
								<input type="checkbox" id="selectAll">
								<label for="selectAll"></label>
							</span>
                    </th>
                    <th>Numero de cilindro</th>
                    <th>Fabricação</th>
                    <th>Vencimento</th>
                    <th>Endereço</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>

                <?php foreach ($cilindros as $lista): ?>
                    <tr>
                        <td>
							<span class="custom-checkbox">
								<input type="checkbox" id="checkbox1" name="options[]" value="1">
								<label for="checkbox1"></label>
							</span>
                        </td>
                        <td><?= $lista['codigo'] ?></td>
                        <td><?= $lista['fabricacao'] ?></td>
                        <td><?= $lista['validade'] ?></td>
                        <td>
                            <a href="http://oxigeniocarir.epizy.com<?= $lista['endereco'] ?>" target="_blank"
                               rel="noopener noreferrer">http://oxigeniocarir.epizy.com<?= $lista['endereco'] ?>
                            </a>
                        </td>
                        <td>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#QrModal"
                               data-bs-whatever="<?= $lista['codigo'] ?>"
                               data-bs-img="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=http://oxigeniocarir.epizy.com<?= $lista['endereco'] ?>"
                               data-bs-fab="<?= $lista['fabricacao'] ?>"
                               data-bs-venc="<?= $lista['validade'] ?>">
                                <i class="bi bi-qr-code-scan" style="font-size:24px"></i>
                            </a>


                            <a href="model/cilindroE.php?id=<?= $lista['codigo'] ?>" class="delete">
                                <i class="bi bi-dash-circle-fill" style="font-size:24px" data-toggle="tooltip"
                                   title="Delete"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach ?>
                </tbody>
            </table>


        </div>
        <div class="printable"></div>
    </div>

    <!-- Modal Cadastro-->
    <div class="modal fade" id="AddModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Cadastro de Cilindro</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="model/cilindro.php" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="recipient-name" lass="col-form-label">Numero
                                cilindro:</label>
                            <input type="text" placeholder="1234567890" c class="form-control" id="numerocilindro"
                                   name="numerocilindro">
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="recipient-name"
                                       class="col-form-label ">Fab:</label>
                                <input type="text" placeholder="01/01/1900" class="form-control" id="fabricacao"
                                       name="fabricacao">
                            </div>
                            <div class="col">
                                <label for="recipient-name" class="col-form-label">Val:</label>
                                <input type="text" placeholder="01/01/1900" class="form-control" id="vencimento"
                                       name="vencimento">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="message-text"
                                   class="col-form-label">Observação:</label>
                            <textarea class="form-control" placeholder="Cilindro com arranhão na lateral"
                                      id="obs" name="obs"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Certificado de Analise</label>
                            <input class="form-control" type="file" id="arquivo" name="arquivo">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar
                            </button>
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal QR-->
    <div class="modal fade" id="QrModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">New message</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div id="printable" class="modal-body">

                    <div class="row">
                        <div class="col-4">
                            <img id="img" src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=123"">
                        </div>
                        <div class="col-4 py-4">
                            <h5 class="fw-bolder py-0 row">Codigo . . . . . . </h5>
                            <h5 class="fw-bolder py-0 row">Fabricação . . </h5>
                            <h5 class="fw-bolder py-0 row">Vencimento . </h5>
                        </div>
                        <div class="col dados py-4">
                            <h5 id="cod" class="fw-semibold">Codigo :</h5>
                            <h5 id="fab" class="fw-semibold">Fabricação : </h5>
                            <h5 id="venc" class="fw-semibold">Vencimento : </h5>
                        </div>
                    </div>

                    <div id="img-out"></div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="btnSave">Salvar</button>
                    <button type="button" class="btn btn-primary" id="btnPrint">Imprimir</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Transferencia de elementos para modal -->
    <script type="text/javascript">
        const exampleModal = document.getElementById('QrModal')
        exampleModal.addEventListener('show.bs.modal', event => {

            // Button that triggered the modal
            const button = event.relatedTarget


            // Extract info from data-bs-* attributes
            const codigo = button.getAttribute('data-bs-whatever')
            const img = button.getAttribute('data-bs-img')
            const fab = button.getAttribute('data-bs-fab')
            const venc = button.getAttribute('data-bs-venc')


            // If necessary, you could initiate an AJAX request here
            // and then do the updating in a callback.
            //
            // Update the modal's content.
            const modalTitle = exampleModal.querySelector('.modal-title')
            const modalBodyimg = exampleModal.querySelector('.modal-body img')
            const modalBodyfab = exampleModal.querySelector('.modal-body .row #fab')
            const modalBodyvenc = exampleModal.querySelector('.modal-body .row #venc')
            const modalBodycod = exampleModal.querySelector('.modal-body .row #cod')

            modalTitle.textContent = `Cilindro ${codigo}`
            modalBodyimg.src = img
            modalBodyfab.textContent = fab;
            modalBodyvenc.textContent = venc;
            modalBodycod.textContent = codigo;
        })

    </script>

    <!-- Botão imprimir -->
    <script type="text/javascript">
        document.getElementById('btnPrint').onclick = function () {
            window.print();
        };
    </script>

    <!-- Botão Salvar IMG -->
    <script type="text/javascript">
        $(function () {
            $("#btnSave").click(function () {
                html2canvas($("#printable"), {
                    onrendered: function (canvas) {
                        theCanvas = canvas;
                        document.body.appendChild(canvas);

                        // Convert and download as image
                        Canvas2Image.saveAsPNG(canvas);
                        $("#img-out").append(canvas);
                        // Clean up
                        //document.body.removeChild(canvas);
                    }
                });
            });
        });

    </script>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

</section>

<!-- ======= Footer ======= -->
<footer id="footer" class="footer">

    <div class="copyright">
        &copy; Copyright <strong><span>Oxigenio Cariri</span></strong>. All Rights Reserved
    </div>

</footer><!-- End Footer -->
</body>
</html>


