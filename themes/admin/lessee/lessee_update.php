<?php $v->layout("_admin"); ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"><i class="fas fa-user"></i> Alterar Cliente(Locatário)</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= $router->route("dash.dash"); ?>" style="color:blue">Home</a></li>
                            <li class="breadcrumb-item"><a href="<?= $router->route("lessee.home"); ?>" style="color:blue">Cliente(Locatário)</a></li>
                            <li class="breadcrumb-item active">Alterar Cliente(Locatário)</li>
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
                    <form action="<?= $router->route("lessee.update",["cod" => $lessee->cod]); ?>" method="post">
                        <div class="card-body">
                            <input type="hidden" name="action" value="update"/>
                            <?= csrf_input(); ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <label>*Nome:</label>
                                    <input type="text" class="form-control" name="name" value="<?=$lessee->name;?>" placeholder="Nome" required>
                                </div>
                                <div class="col-md-12">
                                    <label>*E-mail:</label>
                                    <input class="form-control" type="email" name="email" value="<?=$lessee->email;?>" placeholder="Melhor e-mail" required/>
                                </div>
                                <div class="col-md-12">
                                    <label>*Celular:</label>
                                    <input class="form-control mask-cel" type="text" name="cel" value="<?=$lessee->cel;?>" placeholder="Celular" />
                                </div>
                            </div>
                        </div><!-- /.card-body -->
                        <div class="card-footer">
                            <button class="btn btn-success"><i class="fas fa-edit"> Alterar</i></button>
                            &nbsp&nbsp
                            <a href="#" class="btn btn-danger"
                               data-post="<?= url("/locatario/excluir/{$lessee->cod}"); ?>"
                               data-action="delete"
                               data-confirm="ATENÇÃO: Tem certeza que deseja excluir o locatário? Essa ação não pode ser desfeita!"
                               data-cod="<?= $lessee->cod; ?>"><i class="fas fa-trash"> Excluir </i>
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
            toastr.success("Cliente(Locatário) atualizado com sucesso!");
        });
    </script>
<?php
endif;
$v->end(); ?>