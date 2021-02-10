<?php $v->layout("_admin"); ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"><i class="fas fa-user"></i> Cadastrar Locador</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= $router->route("dash.dash"); ?>" style="color:blue">Home</a></li>
                            <li class="breadcrumb-item"><a href="<?= $router->route("lessor.home"); ?>" style="color:blue">Locador</a></li>
                            <li class="breadcrumb-item active">Cadastrar Locador</li>
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
                    <form action="<?= $router->route("lessor.create"); ?>" method="post">
                        <div class="card-body">
                            <input type="hidden" name="action" value="create"/>
                            <?= csrf_input(); ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <label>*Nome:</label>
                                    <input type="text" class="form-control" name="name" placeholder="Nome" required>
                                </div>
                                <div class="col-md-12">
                                    <label>*E-mail:</label>
                                    <input class="form-control" type="email" name="email" placeholder="Melhor e-mail" required/>
                                </div>
                                <div class="col-md-12">
                                    <label>*Celular:</label>
                                    <input class="form-control mask-cel" type="text" name="cel" placeholder="Celular" />
                                </div>
                                <div class="col-md-12">
                                    <label>*Dia para o repasse:</label>
                                    <select class="form-control select2bs4" name="transfer_day">
                                      <option value="">--Selecione--</option>
                                        <?php for($i=1;$i<=28;$i++):?>
                                               <option value="<?=$i;?>"><?=$i;?></option>
                                        <?php endfor;?>
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
            toastr.success("Locador cadastrado com sucesso!");
        });
    </script>
<?php
endif;
$v->end(); ?>