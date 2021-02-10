<?php $v->layout("_admin"); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><i class="fas fa-exchange-alt"></i> Repasse</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= $router->route("dash.dash"); ?>" style="color:blue">Home</a></li>
                        <li class="breadcrumb-item active">Repasse</li>
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
                <?php
                if($transfers):?>
                <table id="example1" class="display" >
                    <thead>
                        <tr>
                            <th>Locador</th>
                            <th>Data do Repasse</th>
                            <th>Aluguel</th>
                            <th>Iptu</th>
                            <th>Taxa de Administração</th>
                            <th>Valor do Repasse</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($transfers as $transfer): ?>
                        <tr>
                            <td><?=$transfer->lessorTransfer()->name;?></td>
                            <td><?=date_fmt2($transfer->transfer_date);?></td>          
                            <td><?=str_price($transfer->returnPayment()->rent);?></td>
                            <td><?=str_price($transfer->returnPayment()->iptu);?></td>
                            <td><?=str_price($transfer->administration_fee);?>%</td>
                            <td><?=str_price($transfer->value);?></td>
                           <?php if($transfer->status==1):?>
                            <td>
                                <a href="#" class="btn btn-success"
                                   data-post="<?= url("/repasse/confirm/{$transfer->cod}"); ?>"
                                   data-action="0"
                                   data-confirm="Deseja tirar confirmação desse repasse?"
                                   data-cod="<?= $transfer->cod; ?>"><i class="fas fa-thumbs-up"></i>
                                </a>
                            </td>
                            <?php else:?>
                            <td>
                                <a href="#" class="btn btn-danger"
                                   data-post="<?= url("/repasse/confirm/{$transfer->cod}"); ?>"
                                   data-action="1"
                                   data-confirm="Deseja confirmar esse repasse?"
                                   data-cod="<?= $transfer->cod; ?>"><i class="fas fa-thumbs-down"></i>
                                </a>
                            </td>                            
                            <?php endif;?>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <td>Total: <?=count($transfers);?></td>
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
            toastr.success("Operação realizada com sucesso...");
        });
    </script>
<?php
endif;
if(!$transfers):
    ?>
    <script>
        $(function () {
            toastr.error("Nenhum repasse encontrado");
        });
    </script>
<?php
endif;
$v->end(); ?>


