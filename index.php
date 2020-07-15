<html>
    <head>
        <title>DAW - AJAX</title>
        <!-- Bootstrap -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="css/fontawesome-free-5.13.0-web/css/all.css">

        <!-- jQuery -->
        <script src="js/jquery-3.5.1.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="js/bootstrap/bootstrap.min.js"></script>
        <script src="js/bootstrap/bootstrap.bundle.min.js"></script>
        <!-- My Script -->
        <script src="js/index.js"></script>
        <script src="js/classes.js"></script>
    </head>
    <body>
        <h1>Desenvolvimento de Aplicacao para Web</h1>
        <h3>Exemplo AJAX, BootStrap & Font Awesome</h3>
        <br />
        <p>Neste exemplo pratico cujo objectivo sera ilustra para os alunos a utilizacao de AJAX, Bootstrap e font awesome, tecnologias muito usadas hoje em dia no Desenvolvimento Web.</p>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Fotos</h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <a class="btn btn-success" href="#" data-toggle="modal" data-target="#addModal">
                                    <i class="fa fa-save fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Nova
                                </a>
                                <hr />
                                <?php
                                    
                                ?>
                                <div class="container">
                                    <div id="itemContent" class="card-deck mb-3 text-center">
                                        <!-- Content here -->
                                    </div>
                                    <div id="itemPagination">
                                        <!-- Pagination here -->
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <?php
            require_once("cmp/modal.php");
        ?>
    </body>
</html>