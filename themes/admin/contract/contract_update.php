<?php $v->layout("_admin"); ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"><i class="fas fa-file"></i> Alterar Contrato</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= $router->route("dash.dash"); ?>" style="color:blue">Home</a></li>
                            <li class="breadcrumb-item"><a href="<?= $router->route("contract.home"); ?>" style="color:blue">Contrato</a></li>
                            <li class="breadcrumb-item active">Alterar Contrato</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <form action="<?= $router->route("contract.update",["cod" => $contract->cod]); ?>" method="post">
                        <div class="card-body">
                            <input type="hidden" name="action" value="update"/>
                            <?= csrf_input(); ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Imóvel:</label>
                                       <?=$contract->returnProperty()->street." ".$contract->returnProperty()->number." ".$contract->returnProperty()->complement." ".$contract->returnProperty()->district.",".$contract->returnProperty()->state.",".$contract->returnProperty()->city;?>
                                </div> 
                                <div class="col-md-12">
                                    <label>Locador:</label>
                                    <?=$contract->returnLessor()->name;?>
                                </div>
                                <div class="col-md-12">
                                    <label>Locatário:</label>
                                      <?=$contract->returnLessee()->name;?>
                                </div>
                                <div class="col-md-2">
                                     <label>Data Início:</label>
                                     <?=date_fmt2($contract->start_date);?>
                                </div>
                                <div class="col-md-10">
                                    <label>Data Fim:</label>
                                    <?=date_fmt2($contract->end_date);?>
                                </div>
                              <?php if($contract->status=="active"):?>
                                <div class="col-md-6">
                                    <label>*Taxa de administração:</label>
                                    <input class="form-control mask-percent" type="text" value="<?=str_price($contract->administration_fee);?>" name="administration_fee" required placeholder="Taxa de administração %" />
                                </div>
                                <div class="col-md-6">
                                   <label>*Aluguel:</label>
                                   <input class="form-control mask-money" type="text" value="<?=str_price($contract->rent);?>" name="rent" required placeholder="0,00" />
                                </div>
                                <div class="col-md-6">
                                   <label>Condomínio:</label>
                                   <input class="form-control mask-money" type="text" value="<?=str_price($contract->condominium);?>" name="condominium" placeholder="0,00" />
                                </div>
                                <div class="col-md-6">
                                   <label>*IPTU:</label>
                                   <input class="form-control mask-money" type="text" name="iptu" value="<?=str_price($contract->iptu);?>" required placeholder="0,00" />
                                </div>
                                <div class="col-md-12">
                                    <label>Status:</label>
                                    
                                    <select class="form-control select2bs4" name="status">
                                      <option value="active" selected >Ativo</option>
                                      <option value="closed" >Encerrado</option>
                                    </select>
                                   
                                </div>
                               <?php else:?>
                                <div class="col-md-6">
                                    <label>*Taxa de administração:</label>
                                    <?=str_price($contract->administration_fee);?>
                                </div>
                                <div class="col-md-6">
                                   <label>*Aluguel:</label>
                                   <?=str_price($contract->rent);?>
                                </div>
                                <div class="col-md-6">
                                   <label>Condomínio:</label>
                                   <?=str_price($contract->condominium);?>
                                </div>
                                <div class="col-md-6">
                                   <label>*IPTU:</label>
                                   <?=str_price($contract->iptu);?>
                                </div>
                                <div class="col-md-12">
                                    <label>Status:</label>Encerrado
                                </div>
                               <?php endif;?>
                            </div>
                        </div><!-- /.card-body -->
                        <?php if($contract->status=="active"):?>
                        <div class="card-footer">
                            <button class="btn btn-success"><i class="fas fa-edit"> Alterar</i></button>
                        </div><!-- /.card-footer -->
                        <?php endif;?>
                    </form><!-- /.form -->
                </div><!-- /.card -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
<?php $v->start("scripts");
if(!empty(flash())):
    ?>
    <script>
        $(function () {
            toastr.success("Contrato atualizado com sucesso!");
        });
    </script>
<?php
endif;
?>
   
<?php $v->end(); ?>