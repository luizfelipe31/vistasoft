<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?= $head; ?>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= theme("/assets/plugins/fontawesome-free/css/all.min.css", CONF_VIEW_THEME_ADMIN); ?>">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="<?= theme("/assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css", CONF_VIEW_THEME_ADMIN); ?>">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?= theme("/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css", CONF_VIEW_THEME_ADMIN); ?>">
    <!-- JQVMap -->
    <link rel="stylesheet" href="<?= theme("/assets/plugins/jqvmap/jqvmap.min.css", CONF_VIEW_THEME_ADMIN); ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= theme("/assets/css/adminlte.min.css", CONF_VIEW_THEME_ADMIN); ?>">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?= theme("/assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css", CONF_VIEW_THEME_ADMIN); ?>">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?= theme("/assets/plugins/daterangepicker/daterangepicker.css", CONF_VIEW_THEME_ADMIN); ?>">
    <!-- summernote -->
    <link rel="stylesheet" href="<?= theme("/assets/plugins/plugins/summernote/summernote-bs4.min.css", CONF_VIEW_THEME_ADMIN); ?>">

    <link rel="stylesheet" href="<?= theme("/assets/plugins/toastr/toastr.min.css", CONF_VIEW_THEME_ADMIN); ?>">

    <link rel="stylesheet" href="<?= theme("/assets/plugins/select2/css/select2.min.css", CONF_VIEW_THEME_ADMIN); ?>">
    <link rel="stylesheet" href="<?= theme("/assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css", CONF_VIEW_THEME_ADMIN); ?>">

    <link rel="stylesheet" href="<?= theme("/assets/plugins/ekko-lightbox/ekko-lightbox.css", CONF_VIEW_THEME_ADMIN); ?>">

    <link rel="stylesheet" href="<?= theme("/assets/css/dash.css", CONF_VIEW_THEME_ADMIN); ?>">

    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet" href="<?= theme("/assets/plugins//bootstrap4-duallistbox/bootstrap-duallistbox.min.css", CONF_VIEW_THEME_ADMIN); ?>">

    <link media="all" rel="stylesheet" type="text/css" href="<?= theme("/assets/highslide/highslide.css", CONF_VIEW_THEME_ADMIN);?>">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.1.6/css/fixedHeader.dataTables.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css"/>

    <script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>

    <link rel="icon" type="image/png" href="<?=url("shared/images/logo_principal.png")?>"/>
</head>

<div class="ajax_load" style="z-index: 999;">
    <div class="ajax_load_box">
        <div class="ajax_load_box_circle"></div>
        <p class="ajax_load_box_title">Aguarde, carregando...</p>
    </div>
</div>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="<?= $router->route("dash.logoff"); ?>" class="nav-link text-danger"><i class="fas fa-sign-out-alt">Sair</i></a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Notifications Dropdown Menu -->

            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
            <!--li class="nav-item">
                <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                    <i class="fas fa-th-large"></i>
                </a>
            </li-->
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-light-blue elevation-4">
        <!-- Brand Logo -->
        <a href="<?= $router->route("dash.dash"); ?>" class="brand-link">
            <h2 class="text-primary">Desafio VistaSoft</h2>
        </a>

        <?php
        $photo = user()->showPhoto();
        $userPhoto = ($photo ? image($photo, 300, 300) : theme("/assets/images/avatar.jpg", CONF_VIEW_THEME_ADMIN));
        ?>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="<?= $userPhoto; ?>" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="<?= url("/users/user/" . user()->id); ?>" class="d-block"><?= user()->name; ?></a>
                </div>
            </div>

            <!-- SidebarSearch Form -->
            <div class="form-inline">
                <div class="input-group" data-widget="sidebar-search">
                    <input class="form-control form-control-sidebar" type="search" placeholder="Procurar..." aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-sidebar">
                            <i class="fas fa-search fa-fw"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    
                    
                    <li class="nav-item" >
                        <a href="<?= $router->route("dash.dash"); ?>" <?php if($menu=="dash"):?>class="nav-link active"<?php else:?>class="nav-link"<?php endif?>>
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                               
                            </p>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a href="<?= $router->route("lessee.home"); ?>" <?php if($menu=="lessee"):?>class="nav-link active"<?php else:?>class="nav-link"<?php endif?> >
                            <i class="nav-icon fas fa-user-circle"></i>
                            <p>
                                Cliente(Locatário)
                               
                            </p>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a href="<?= $router->route("lessor.home"); ?>" <?php if($menu=="lessor"):?>class="nav-link active"<?php else:?>class="nav-link"<?php endif?>>
                            <i class="nav-icon fas fas fa-user"></i>
                            <p>
                                Proprietáro(Locador)
                               
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="<?= $router->route("property.home"); ?>" <?php if($menu=="property"):?>class="nav-link active"<?php else:?>class="nav-link"<?php endif?>>
                            <i class="nav-icon fas fa-home"></i>
                            <p>
                                Imóvel
                               
                            </p>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a href="<?= $router->route("contract.home"); ?>" <?php if($menu=="contract"):?>class="nav-link active"<?php else:?>class="nav-link"<?php endif?>>
                            <i class="nav-icon fas fa-file"></i>
                            <p>
                                Contrato
                               
                            </p>
                        </a>
                    </li>
                   
                    
                    <li class="nav-item">
                        <a href="<?= $router->route("payment.home"); ?>" <?php if($menu=="payment"):?>class="nav-link active"<?php else:?>class="nav-link"<?php endif?>>
                            <i class="nav-icon fas fa-dollar-sign"></i>
                            <p>
                                Mensalidade
                               
                            </p>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a href="<?= $router->route("transfer.home"); ?>" <?php if($menu=="transfer"):?>class="nav-link active"<?php else:?>class="nav-link"<?php endif?>>
                            <i class="nav-icon fas fa-exchange-alt"></i>
                            <p>
                                Repasse
                               
                            </p>
                        </a>
                    </li>
                    
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!--container-->
    <?= $v->section("content"); ?>
    <!-- /.container -->

    <footer class="main-footer">
        <strong>Copyright &copy; <?= date("Y"); ?> <a href="https://www.vistasoft.com.br/" target="_blank" style="color:blue;">VistaSoft</a>.</strong>
        Todos os direitos reservados.
        <div class="float-right d-none d-sm-inline-block">
            <b>Versão</b> 1.0
        </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->


<!-- jQuery -->
<script src="<?= url("/shared/scripts/jquery.min.js"); ?>"></script>

<script src="<?= url("/shared/scripts/jquery.form.js"); ?>"></script>

<!-- jQuery UI 1.11.4 -->
<script src="<?= url("/shared/scripts/jquery-ui.js"); ?>"></script>

<script src="<?= url("/shared/scripts/jquery.mask.js"); ?>"></script>

<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script src="<?= url("/shared/scripts/scripts.js"); ?>"></script>
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?= theme("/assets/plugins/bootstrap/js/bootstrap.bundle.min.js", CONF_VIEW_THEME_ADMIN); ?>"></script>
<!-- ChartJS -->
<script src="<?= theme("/assets/plugins/chart.js/Chart.min.js", CONF_VIEW_THEME_ADMIN); ?>"></script>
<!-- Sparkline -->
<script src="<?= theme("/assets/plugins/sparklines/sparkline.js", CONF_VIEW_THEME_ADMIN); ?>"></script>
<!-- JQVMap -->
<script src="<?= theme("/assets/plugins/jqvmap/jquery.vmap.min.js", CONF_VIEW_THEME_ADMIN); ?>"></script>
<script src="<?= theme("/assets/plugins/jqvmap/maps/jquery.vmap.usa.js", CONF_VIEW_THEME_ADMIN); ?>"></script>
<!-- jQuery Knob Chart -->
<script src="<?= theme("/assets/plugins/jquery-knob/jquery.knob.min.js", CONF_VIEW_THEME_ADMIN); ?>"></script>
<!-- daterangepicker -->
<script src="<?= theme("/assets/plugins/moment/moment.min.js", CONF_VIEW_THEME_ADMIN); ?>"></script>
<script src="<?= theme("/assets/plugins/daterangepicker/daterangepicker.js", CONF_VIEW_THEME_ADMIN); ?>"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?= theme("/assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js", CONF_VIEW_THEME_ADMIN); ?>"></script>
<!-- Summernote -->
<script src="<?= theme("/assets/plugins/summernote/summernote-bs4.min.js", CONF_VIEW_THEME_ADMIN); ?>"></script>
<!-- overlayScrollbars -->
<script src="<?= theme("/assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js", CONF_VIEW_THEME_ADMIN); ?>"></script>
<!-- AdminLTE App -->
<script src="<?= theme("/assets/js/adminlte.min.js", CONF_VIEW_THEME_ADMIN); ?>"></script>
<!-- Toastr -->
<script src="<?= theme("/assets/plugins/toastr/toastr.min.js", CONF_VIEW_THEME_ADMIN); ?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= theme("/assets/js/demo.js", CONF_VIEW_THEME_ADMIN); ?>"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?= theme("/assets/js/pages/dashboard.js", CONF_VIEW_THEME_ADMIN); ?>"></script>
<!-- Select2 -->
<script src="<?= theme("/assets/plugins/select2/js/select2.full.min.js", CONF_VIEW_THEME_ADMIN); ?>"></script>
<!-- Ekko Lightbox -->
<script src="<?= theme("/assets/plugins/ekko-lightbox/ekko-lightbox.min.js", CONF_VIEW_THEME_ADMIN); ?>"></script>
<!-- Filterizr-->
<script src="<?= theme("/assets/plugins/filterizr/jquery.filterizr.min.js", CONF_VIEW_THEME_ADMIN); ?>"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="<?= theme("/assets/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js", CONF_VIEW_THEME_ADMIN); ?>"></script>

<script type="text/javascript" src="<?= theme("/assets/highslide/highslide-full.packed.js", CONF_VIEW_THEME_ADMIN)?>"></script>

<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src=" https://cdn.datatables.net/fixedheader/3.1.6/js/dataTables.fixedHeader.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>



<script type="text/javascript">
    hs.graphicsDir = '<?= theme("/assets/highslide/graphics/", CONF_VIEW_THEME_ADMIN);?>'
    hs.align = 'center';
    hs.transitions = ['expand', 'crossfade'];
    hs.outlineType = 'rounded-white';
    hs.fadeInOut = true;
    //hs.dimmingOpacity = 0.75;

    // Add the controlbar
    hs.addSlideshow({
        //slideshowGroup: 'group1',
        interval: 5000,
        repeat: false,
        useControls: true,
        fixedControls: 'fit',
        overlayOptions: {
            opacity: .75,
            position: 'bottom center',
            hideOnMouseOut: true
        }
    });

</script>
<script>

var path = '<?php echo url(); ?>'


$(function () {
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
        event.preventDefault();
        $(this).ekkoLightbox({
            alwaysShowClose: true
        });
    });

    $('.filter-container').filterizr({gutterPixels: 3});
    $('.btn[data-filter]').on('click', function() {
        $('.btn[data-filter]').removeClass('active');
        $(this).addClass('active');
    });
})


var table = $('#example1').DataTable({
    "ordering": true,
    "paging": true,
    "info": true,
    "lengthChange": true,
    "language": {
        "search": "Procurar:",
        "paginate": {
            "first": "Primeiro",
            "last": "Último",
            "next": "Próximo",
            "previous": "Anterior"
        },
        "lengthMenu": "_MENU_ Resultados por página",
        "zeroRecords": "Nenhum Registro Encontrado",
        "info": "Mostrar página _PAGE_ de _PAGES_",
        "infoEmpty": "Nenhum Registro Encontrado",
        "infoFiltered": "(filtrar por _MAX_ total de registro)"
    },
    responsive: true
});




$(function () {
//Initialize Select2 Elements
    //$('.select2').select2()

    $('.select2').select2({
        theme: 'bootstrap4'
    })
//Initialize Select2 Elements
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    })

    //Bootstrap Duallistbox
    $('.duallistbox').bootstrapDualListbox()
})


</script>
<?= $v->section("scripts"); ?>
</body>
</html>
