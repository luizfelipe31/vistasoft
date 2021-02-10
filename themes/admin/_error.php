<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= theme("/assets/plugins/fontawesome-free/css/all.min.css", CONF_VIEW_THEME_ADMIN); ?>">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= theme("/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css", CONF_VIEW_THEME_ADMIN); ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= theme("/assets/css/adminlte.min.css", CONF_VIEW_THEME_ADMIN); ?>">
    <link rel="stylesheet" href="<?= theme("/assets/css/style.css", CONF_VIEW_THEME_ADMIN); ?>">
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <h1 class="text-primary">Desafio VistaSoft</h1>
        </div>
        <div class="card-body">
            <p class="error">&bull;<?= $var_error->code; ?>&bull;</p>
            <h1><?= $var_error->title; ?></h1>
            <p><?= $var_error->message; ?></p>
            <a href="<?= $router->route("login.login"); ?>" style="color:blue;"><?= $var_error->linkTitle; ?></a>
            <footer>
                <hr style="border:1px solid;color:blue;"><p><a href="https://www.vistasoft.com.br/" target="_blank" style="color:blue;">VistaSoft</a>&copy; <?= date("Y"); ?> - todos os direitos reservados</p>
            </footer>
            <!-- /.card-body -->

        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->
</div>
</body>
</html>