<?php $v->layout("_admin"); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><i class="fas fa-dollar-sign"></i> Mensalidade</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= $router->route("dash.dash"); ?>" style="color:blue">Home</a></li>
                        <li class="breadcrumb-item active">Mensalidade</li>
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
                if($payments):?>
                <table id="example1" class="display" >
                    <thead>
                        <tr>
                            <th>Locatário</th>
                            <th>Vencimento</th>
                            <th>Referência</th>
                            <th>Aluguel</th>
                            <th>Iptu</th>
                            <th>Condomínio</th>
                            <th>Total</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($payments as $payment): ?>
                        <tr>
                            <td><?=$payment->lesseePayment()->name;?></td>
                            <td><?=date_fmt2($payment->due_date);?></td>
                            <td><?=$payment->reference;?></td>
                            <td><?=str_price($payment->rent);?></td>
                            <td><?=str_price($payment->condominium);?></td>
                            <td><?=str_price($payment->iptu);?></td>
                            <td><?=str_price($payment->rent+$payment->condominium+$payment->iptu);?></td>
                            <?php if($payment->status==1):?>
                            <td>
                                <a href="#" class="btn btn-success"
                                   data-post="<?= url("/mensalidade/confirm/{$payment->cod}"); ?>"
                                   data-action="0"
                                   data-confirm="Deseja tirar confirmação desse pagamento?"
                                   data-cod="<?= $payment->cod; ?>"><i class="fas fa-thumbs-up"></i>
                                </a>
                            </td>
                            <?php else:?>
                            <td>
                                <a href="#" class="btn btn-danger"
                                   data-post="<?= url("/mensalidade/confirm/{$payment->cod}"); ?>"
                                   data-action="1"
                                   data-confirm="Deseja confirmar esse pagamento?"
                                   data-cod="<?= $payment->cod; ?>"><i class="fas fa-thumbs-down"></i>
                                </a>
                            </td>                            
                            <?php endif;?>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <td>Total: <?=count($payments);?></td>
                        <td></td>
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
if(!$payments):
    ?>
    <script>
        $(function () {
            toastr.error("Nenhuma mensalidade encontrado");
        });
    </script>
<?php
endif;
$v->end(); ?>


