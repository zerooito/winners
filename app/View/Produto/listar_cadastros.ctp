
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Produto - Listar Cadastros</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Listagem dos produtos
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-cliente">
                            <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>Imagem</th>
                                    <th>Nome</th>
                                    <th>Preço</th>
                                    <th>Estoque</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>                   
                            <?php
                            foreach ($produtos as $indice => $produto) {
                            ?>             
                                <tr class="odd gradeX" id="<?php echo $produto['Produto']['id'] ?>">
                                    <td><?php echo $produto['Produto']['id_alias'] ?></td>
                                    <td>
                                        <img src="/uploads/produto/imagens/<?php echo $produto['Produto']['imagem'] ?>" width="80" height="80" />
                                    </td>
                                    <td><?php echo $produto['Produto']['nome'] ?></td>
                                    <td><?php echo $produto['Produto']['preco'] ?></td>
                                    <td class="center"><?php echo $produto['Produto']['estoque'] ?></td>
                                    <td class="center">
                                        <button onclick="remover_produto(<?php echo $produto['Produto']['id'] ?>);" type="button" class="btn btn-danger btn-circle"><i class="fa fa-times"></i></button>
                                        <button onclick="editar_produto(<?php echo $produto['Produto']['id'] ?>);" type="button" class="btn btn-info btn-circle"><i class="fa fa-edit"></i></button>
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

                        <button type="button" class="btn btn-primary" style="margin-bottom: 10px;"><i class="fa fa-plus"><a href="/produto/adicionar_cadastro" style="color: #FFF;"> Adicionar produto</a></i>
                        </button>

                        <button type="button" class="btn btn-info"><i class="fa fa-plus"><a href="/produto/adicionar_cadastro" style="color: #FFF;"> Adicionar Categoria</a></i></button>
                        
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
    </div>
</div>

<script type="text/javascript">
    function remover_produto(id) {
        $.ajax({
            type: "post",
            dataType: "json",
            url: "/produto/excluir_cadastro",
            async: true,
            data: {id: id},
            error: function(x){
                window.reload();
            },
            success: function(x){
                window.location.reload();                
            }
        });
    }
    function editar_produto(id) {
        window.location.href = "/produto/editar_cadastro/"+id;
    }
</script>
