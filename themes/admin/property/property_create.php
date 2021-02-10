<?php $v->layout("_admin"); ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"><i class="fas fa-home"></i> Cadastrar Imóvel</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= $router->route("dash.dash"); ?>" style="color:blue">Home</a></li>
                            <li class="breadcrumb-item"><a href="<?= $router->route("property.home"); ?>" style="color:blue">Imóvel</a></li>
                            <li class="breadcrumb-item active">Cadastrar Imóvel</li>
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
                    <form action="<?= $router->route("property.create"); ?>" method="post">
                        <div class="card-body">
                            <input type="hidden" name="action" value="create"/>
                            <?= csrf_input(); ?>
                            <div class="row">
                                <div class="col-md-4">
                                  <label>*CEP:</label>
                                  <input class="form-control mask-cep" type="text" name="zipcode" id="zipcode" placeholder="Digite o CEP" />
                                </div>
                                <div class="col-md-8">
                                  <label>*Logradouro:</label>
                                  <input class="form-control" type="text" name="street" id="street" placeholder="Logradouro" />
                                </div>
                                <div class="col-md-4">
                                  <label>*Número:</label>
                                  <input class="form-control" type="text" name="number" placeholder="Número" />
                                </div>
                                <div class="col-md-8">
                                  <label>Complemento:</label>
                                  <input class="form-control" type="text" name="complement" placeholder="Complemento" />
                                </div>
                                <div class="col-md-12">
                                  <label>*Bairro:</label>
                                  <input class="form-control" type="text" name="district" id="district" placeholder="Bairro" />
                                </div>
                                <div class="col-md-6">
                                  <label>*Estado:</label>
                                  <input class="form-control" type="text" name="state" id="state" placeholder="Estado" />
                                </div>
                                <div class="col-md-6">
                                  <label>*Cidade:</label>
                                  <input class="form-control" type="text" name="city" id="city" placeholder="Cidade" />
                                </div>
                                <div class="col-md-12">
                                    <label>*Locador:</label>
                                    <select class="form-control select2bs4" name="lessor">
                                      <option value="">--Selecione--</option>
                                        <?php foreach($lessors as $lessor):?>
                                               <option value="<?=$lessor->id;?>"><?=$lessor->name;?></option>
                                        <?php endforeach;?>
                                    </select>
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
            toastr.success("Imóvel cadastrado com sucesso!");
        });
    </script>
<?php
endif;
$v->end(); ?>