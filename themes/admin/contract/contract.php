<?php $v->layout("_admin"); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><i class="fas fa-file"></i> Contrato</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= $router->route("dash.dash"); ?>" style="color:blue">Home</a></li>
                        <li class="breadcrumb-item active">Contrato</li>
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
                    <a href="<?= $router->route("contract.create"); ?>" class="btn btn-primary">Novo Contrato</a>
                </div>
                <div class="col-md-5">
                </div>
            </div><br>
                <?php
                if($contracts):?>
                <table id="example1" class="display" >
                    <thead>
                        <tr>
                            <th>Imóvel</th>
                            <th>Locador</th>
                            <th>Locatário</th>
                            <th>Data Início</th>
                            <th>Data Fim</th>
                            <th>Satatus</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($contracts as $contract): ?>
                        <tr>
                            <td><?= $contract->returnProperty()->street." ".$contract->returnProperty()->number." ".$contract->returnProperty()->complement." ".$contract->returnProperty()->district.",".$contract->returnProperty()->state.",".$contract->returnProperty()->city; ?></td>
                            <td><?= $contract->returnLessor()->name;?></td>
                            <td><?= $contract->returnLessee()->name;?></td>
                            <td><?=date_fmt2($contract->start_date);?></td>
                            <td><?=date_fmt2($contract->end_date);?></td>
                            <td><?php if($contract->status=="active"):?> Ativo <?php else: ?> Encerrado <?php endif;?></td>
                            <td><a href="<?= url("/contrato/alterar/{$contract->cod}"); ?>" class="btn btn-primary"><i class="fas fa-edit">Alterar</i></a></td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <td>Total: <?=count($contracts);?></td>
                        <td></td>
                        <td></td>
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
            toastr.success("O imóvel foi excluído com sucesso...");
        });
    </script>
<?php
endif;
if(!$contracts):
    ?>
    <script>
        $(function () {
            toastr.error("Nenhum contrato encontrado");
        });
    </script>
<?php
endif;
$v->end(); ?>


