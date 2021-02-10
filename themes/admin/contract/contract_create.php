<?php $v->layout("_admin"); ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"><i class="fas fa-file"></i> Cadastrar Contrato</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= $router->route("dash.dash"); ?>" style="color:blue">Home</a></li>
                            <li class="breadcrumb-item"><a href="<?= $router->route("contract.home"); ?>" style="color:blue">Contrato</a></li>
                            <li class="breadcrumb-item active">Cadastrar Contrato</li>
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
                    <form action="<?= $router->route("contract.create"); ?>" method="post">
                        <div class="card-body">
                            <input type="hidden" name="action" value="create"/>
                            <?= csrf_input(); ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>*Imóvel:</label>
                                    <select class="form-control select2bs4" name="property" id="property" required>
                                      <option value="">--Selecione--</option>
                                        <?php foreach($properties as $property):?>
                                               <option value="<?=$property->id;?>"><?=$property->street." ".$property->number." ".$property->complement." ".$property->district.",".$property->state.",".$property->city;?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div> 
                                <div class="col-md-6">
                                    <label>*Locador:</label>
                                        <select class="form-control select2bs4" name="lessor" id="lessor" required>
                                          <?php if($property->lessor==""):?>
                                            <option value="">--Selecione--</option>
                                          <?php endif;?>
                                            <?php foreach($lessors as $lessor):?>
                                                   <option value="<?=$lessor->id;?>"><?=$lessor->name;?></option>
                                            <?php endforeach;?>
                                        </select>
                                </div>
                                <div class="col-md-12">
                                    <label>*Locatário:</label>
                                    <select class="form-control select2bs4" name="lessee" required>
                                      <option value="">--Selecione--</option>
                                        <?php foreach($lessees as $lessee):?>
                                               <option value="<?=$lessee->id;?>"><?=$lessee->name;?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>  
                                <div class="col-md-6">
                                     <label>*Data Início:</label>
                                     <input type="text" class="form-control mask-date" name="start_date"  required placeholder="dd/mm/yyyy"/>
                                </div>
                                <div class="col-md-6">
                                    <label>*Data Fim:</label>
                                    <input type="text" class="form-control mask-date " name="end_date" required placeholder="dd/mm/yyyy"/>
                                </div>
                                <div class="col-md-6">
                                    <label>*Taxa de administração:</label>
                                    <input class="form-control mask-percent" type="text" name="administration_fee" required placeholder="Taxa de administração %" />
                                </div>
                                <div class="col-md-6">
                                   <label>*Aluguel:</label>
                                   <input class="form-control mask-money" type="text" name="rent" required placeholder="0,00" />
                                </div>
                                <div class="col-md-6">
                                   <label>Condomínio:</label>
                                   <input class="form-control mask-money" type="text" name="condominium" placeholder="0,00" />
                                </div>
                                <div class="col-md-6">
                                   <label>*IPTU:</label>
                                   <input class="form-control mask-money" type="text" name="iptu" required placeholder="0,00" />
                                </div>
                            </div>
                        </div><!-- /.card-body -->
                        <div class="card-footer">
                            <button class="btn btn-success"><i class="fas fa-edit"> Cadastrar</i></button>
                        </div><!-- /.card-footer -->
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
            toastr.success("Contrato cadastrado com sucesso!");
        });
    </script>
<?php
endif;
?>
    <script src="<?= url("/shared/scripts/contract.js"); ?>"></script>
<?php $v->end(); ?>