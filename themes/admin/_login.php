<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <?= $head; ?>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= theme("/assets/plugins/fontawesome-free/css/all.min.css", CONF_VIEW_THEME_ADMIN); ?>">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= theme("/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css", CONF_VIEW_THEME_ADMIN); ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= theme("/assets/css/adminlte.min.css", CONF_VIEW_THEME_ADMIN); ?>">
    <link rel="stylesheet" href="<?= theme("/assets/css/style.css", CONF_VIEW_THEME_ADMIN); ?>">
    <link rel="stylesheet" href="<?= theme("/assets/plugins/toastr/toastr.min.css", CONF_VIEW_THEME_ADMIN); ?>">

</head>
<body class="hold-transition login-page">

<div class="ajax_load">
    <div class="ajax_load_box">
        <div class="ajax_load_box_circle"></div>
        <p class="ajax_load_box_title">Aguarde, carregando...</p>
    </div>
</div>

<?= $v->section("content"); ?>

<script src="<?= url("/shared/scripts/jquery.min.js"); ?>"></script>
<script src="<?= url("/shared/scripts/jquery-ui.js"); ?>"></script>
<script src="<?= url("/shared/scripts/login.js"); ?>"></script>
<!-- Bootstrap 4 -->
<script src="<?= theme("/assets/plugins/bootstrap/js/bootstrap.bundle.min.js", CONF_VIEW_THEME_ADMIN); ?>"></script>
<!-- AdminLTE App -->
<script src="<?= theme("/assets/js/adminlte.min.js", CONF_VIEW_THEME_ADMIN); ?>"></script>
<!-- Toastr -->
<script src="<?= theme("/assets/plugins/toastr/toastr.min.js", CONF_VIEW_THEME_ADMIN); ?>"></script>
</body>
</html>
