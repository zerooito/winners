
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Cupom - Listar Cadastros</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Listagem dos Cupons
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-cliente">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Tipo</th>
                                    <th>Valor</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>                   
                            <?php
                            foreach ($cupons as $indice => $cupom) {
                            ?>             
                                <tr class="odd gradeX" id="<?php echo $cupom['Cupom']['id'] ?>">
                                    <td><?php echo $cupom['Cupom']['nome'] ?></td>
                                    <td><?php echo $cupom['Cupom']['tipo'] ?></td>
                                    <td><?php echo $cupom['Cupom']['valor'] ?></td>
                                    <td class="center">
                                        <button onclick="remover_cupom(<?php echo $cupom['Cupom']['id'] ?>);" type="button" class="btn btn-danger btn-circle"><i class="fa fa-times"></i></button>
                                        <button onclick="editar_cupom(<?php echo $cupom['Cupom']['id'] ?>);" type="button" class="btn btn-info btn-circle"><i class="fa fa-edit"></i></button>
                                    </td>
                                </tr>   
                            <?php
                            }// fim foreach
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->

        <div class="col-lg-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Ações
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <button type="button" class="btn btn-primary"><i class="fa fa-plus"><a href="/cupom/adicionar_cupom" style="color: #FFF;"> Adicionar Cupom</a></i>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
    </div>
</div>

<script type="text/javascript">
    function remover_cupom(id) 
    {
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "/cupom/excluir_cupom/" + id,
            error: function(x){
                window.location.reload();
            },
            success: function(x){
                window.location.reload();                
            }
        });
    }

    function editar_cupom(id) 
    {
        window.location.href = "/cupom/editar_cupom/"+id;
    }
</script>
