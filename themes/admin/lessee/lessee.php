<?php $v->layout("_admin"); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><i class="fas fa-user"></i> Cliente(Locatário)</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= $router->route("dash.dash"); ?>" style="color:blue">Home</a></li>
                        <li class="breadcrumb-item active">Cliente(Locatário)</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
        <!-- Default box -->
    </div>
    <!-- /.content-header -->

    <!-- Default box -->
    <div class="card card-solid">
        <div class="card-body pb-0">
            <div class="row">
                <div class="col-md-4">
                    <a href="<?= $router->route("lessee.create"); ?>" class="btn btn-primary">Novo Cliente</a>
                </div>
                <div class="col-md-5">
                </div>
            </div><br>
                <?php
                if($lessees):?>
                <table id="example1" class="display" >
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>E-mail</th>
                            <th>Celular</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($lessees as $lessee): ?>
                        <tr>
                            <td><?= $lessee->name ?></td>
                            <td><?= $lessee->email ?></td>
                            <td><?= $lessee->cel ?></td>
                            <td><a href="<?= url("/locatario/alterar/{$lessee->cod}"); ?>" class="btn btn-primary"><i class="fas fa-edit">Alterar</i></a></td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <td>Total: <?=count($lessees);?></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tfoot>
                </table>
             <?php endif;?>
        </div><!-- /.card-body pb-0 -->
    </div><!-- /.card card-solid -->
</div><!-- /.content-wrapper-->

<?php $v->start("scripts");
if(!empty(flash())):
    ?>
    <script>
        $(function () {
            toastr.success("O cliente(locatário) foi excluído com sucesso...");
        });
    </script>
<?php
endif;
if(!$lessees):
    ?>
    <script>
        $(function () {
            toastr.error("Nenhum cliente encontrado");
        });
    </script>
<?php
endif;
$v->end(); ?>


