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
                                <div class="col-md-4">
                                  <label>*CEP:</label>
                                  <input class="form-control mask-cep" type="text" name="zipcode" id="zipcode" value="<?= $property->zipcode; ?>" placeholder="Digite o CEP" />
                                </div>
                                <div class="col-md-8">
                                  <label>*Logradouro:</label>
                                  <input class="form-control" type="text" name="street" id="street" value="<?= $property->street; ?>" placeholder="Logradouro" />
                                </div>
                                <div class="col-md-4">
                                  <label>*Número:</label>
                                  <input class="form-control" type="text" name="number" value="<?= $property->number ?>" placeholder="Número" />
                                </div>
                                <div class="col-md-8">
                                  <label>Complemento:</label>
                                  <input class="form-control" type="text" name="complement" value="<?= $property->complement ?>" placeholder="Complemento" />
                                </div>
                                <div class="col-md-12">
                                  <label>*Bairro:</label>
                                  <input class="form-control" type="text" name="district" id="district" value="<?= $property->district ?>" placeholder="Bairro" />
                                </div>
                                <div class="col-md-6">
                                  <label>*Estado:</label>
                                  <input class="form-control" type="text" name="state" id="state" value="<?= $property->state ?>" placeholder="Estado" />
                                </div>
                                <div class="col-md-6">
                                  <label>*Cidade:</label>
                                  <input class="form-control" type="text" name="city" id="city" value="<?= $property->city ?>" placeholder="Cidade" />
                                </div>
                                <div class="col-md-12">
                                    <label>*Locador:</label>
                                    <select class="form-control select2bs4" name="lessor">
                                      <option value="">--Selecione--</option>
                                        <?php foreach($lessors as $lessor):?>
                                               <option <?php if($lessor->id==$property->lessor): ?>selected<?php endif;?> value="<?=$lessor->id;?>"><?=$lessor->name;?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                            </div>
                        </div><!-- /.card-body -->
                        <div class="card-footer">
                            <button class="btn btn-success"><i class="fas fa-edit"> Alterar</i></button>
                            &nbsp&nbsp
                            <a href="#" class="btn btn-danger"
                               data-post="<?= url("/imovel/excluir/{$property->cod}"); ?>"
                               data-action="delete"
                               data-confirm="ATENÇÃO: Tem certeza que deseja excluir o imóvel? Essa ação não pode ser desfeita!"
                               data-cod="<?= $property->cod; ?>"><i class="fas fa-trash"> Excluir </i>
                            </a>
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