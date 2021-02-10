<?php $v->layout("_admin"); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><i class="fas fa-user"></i> Locador</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= $router->route("dash.dash"); ?>" style="color:blue">Home</a></li>
                        <li class="breadcrumb-item active">Locador</li>
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
                    <a href="<?= $router->route("lessor.create"); ?>" class="btn btn-primary">Novo Locador</a>
                </div>
                <div class="col-md-5">
                </div>
            </div><br>
                <?php
                if($lessors):?>
                <table id="example1" class="display" >
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>E-mail</th>
                            <th>Celular</th>
                            <th>Dia para transferência</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($lessors as $lessor): ?>
                        <tr>
                            <td><?= $lessor->name; ?></td>
                            <td><?= $lessor->email; ?></td>
                            <td><?= $lessor->cel; ?></td>
                            <td><?= $lessor->transfer_day; ?></td>
                            <td><a href="<?= url("/locador/alterar/{$lessor->cod}"); ?>" class="btn btn-primary"><i class="fas fa-edit">Alterar</i></a></td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <td>Total: <?=count($lessors);?></td>
                        <td></td>
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
            toastr.success("O locador foi excluído com sucesso...");
        });
    </script>
<?php
endif;
if(!$lessors):
    ?>
    <script>
        $(function () {
            toastr.error("Nenhum locador encontrado");
        });
    </script>
<?php
endif;
$v->end(); ?>


