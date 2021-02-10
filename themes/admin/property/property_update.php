<?php $v->layout("_admin"); ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"><i class="fas fa-user"></i> Alterar Imóvel</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= $router->route("dash.dash"); ?>" style="color:blue">Home</a></li>
                            <li class="breadcrumb-item"><a href="<?= $router->route("property.home"); ?>" style="color:blue">Imóvel</a></li>
                            <li class="breadcrumb-item active">Alterar Imóvel</li>
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
                    <form action="<?= $router->route("property.update",["cod" => $property->cod]); ?>" method="post">
                        <div class="card-body">
                            <input type="hidden" name="action" value="update"/>
                            <?= csrf_input(); ?>
                            <div class="row">
                                <div class="col-md-12">
                                  <label>*Logradouro:</label>
                                  <?= $property->street; ?>
                                </div>
                                <div class="col-md-12">
                                  <label>*Número:</label>
                                  <?= $property->number ?>
                                </div>
                                <div class="col-md-12">
                                  <label>Complemento:</label>
                                  <?= $property->complement ?>
                                </div>
                                <div class="col-md-12">
                                  <label>*Bairro:</label>
                                  <?= $property->district ?>
                                </div>
                                <div class="col-md-12">
                                  <label>*Estado:</label>
                                  <?= $property->state ?>
                                </div>
                                <div class="col-md-12">
                                  <label>*Cidade:</label>
                                  <?= $property->city ?>
                                </div>
                                <div class="col-md-12">
                                    <label>*Locador:</label>
                                    <select class="form-control select2bs4" name="lessor">
                                      <?php if($property->lessor==""):?>
                                        <option value="">--Selecione--</option>
                                      <?php endif;?>
                                        <?php foreach($lessors as $lessor):?>
                                               <option <?php if($lessor->id==$property->lessor): ?>selected<?php endif;?> value="<?=$lessor->id;?>"><?=$lessor->name;?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                            </div>
                        </div><!-- /.card-body -->
                        <div class="card-footer">
                            <button class="btn btn-success"><i class="fas fa-edit"> Alterar</i></button>
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
            toastr.success("Imóvel atualizado com sucesso!");
        });
    </script>
<?php
endif;
$v->end(); ?>