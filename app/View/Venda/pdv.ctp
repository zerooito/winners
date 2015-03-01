
<form role="form" action="/produto/s_adicionar_cadastro" method="post">
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-6">
                <div class="panel panel-default" style="margin-top: 12px;">
                    <div class="panel-heading">
                        Dados da Venda
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Codigo do Produto</label>
                                    <input class="form-control" name="dados[codigo_produto]" id="codigo_produto" />
                                    <!-- <p class="help-block">Example block-level help text here.</p> -->
                                </div>
                                <div class="form-group">
                                    <label>Quantidade</label>
                                    <input class="form-control" name="dados[quantidade]" id="quantidade_produto" />
                                </div>
                                <a href="javascript:;" onclick="adicionar_produto();">Adicionar Produto</a>
                            </div>
                            <!-- /.col-lg-6 (nested) -->
                        </div>
                        <!-- /.row (nested) -->
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <div class="col-lg-6">
                <div class="panel panel-default" style="margin-top: 12px;">
                    <div class="panel-heading">
                        Opções
                    </div>
                    <div class="panel-body">
                        <!-- Nav tabs -->
                        <ul class="nav nav-pills">
                            <li class="active"><a href="#totais-pills" data-toggle="tab">Totais</a>
                            </li>
                            <li class=""><a href="#profile-pills" data-toggle="tab">Pesquisar produtos</a>
                            </li>
                            <li class=""><a href="#messages-pills" data-toggle="tab">Atalhos</a>
                            </li>
                            <li class=""><a href="#settings-pills" data-toggle="tab">Configurações</a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane fade active in" id="totais-pills">
                                <h4>Valor:</h4>
                                <p>R$ <em id="total">0,00</em></p>
                                <h4>Forma de pagamento</h4>
                                <ul class="nav nav-pills">
                                    <li style="width: 100%;margin: 5px;font-weight: bolder;"><input type="radio" value="dinheiro" checked />Dinheiro</li>
                                    <li style="width: 100%;margin: 5px;font-weight: bolder;"><input type="radio" value="dinheiro"  />Cartão</li>
                                </ul>
                                <button type="submit" class="btn btn-success">Fechar Venda</button>
                                <button type="reset" class="btn btn-danger" onclick="history.go(-1);">Cancelar</button>
                            </div>
                            <div class="tab-pane fade" id="profile-pills">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-cliente">
                                        <thead>
                                            <tr>
                                                <th>#ID</th>
                                                <th>Nome</th>
                                                <th>Preço</th>
                                                <th>Estoque</th>
                                            </tr>
                                        </thead>
                                        <tbody>                   
                                        <?php
                                        foreach ($produtos as $indice => $produto) {
                                        ?>             
                                            <tr class="odd gradeX" id="<?php echo $produto['Produto']['id'] ?>">
                                                <td><?php echo $produto['Produto']['id_alias'] ?></td>
                                                <td><?php echo $produto['Produto']['nome'] ?></td>
                                                <td><?php echo $produto['Produto']['preco'] ?></td>
                                                <td class="center"><?php echo $produto['Produto']['estoque'] ?></td>
                                            </tr>   
                                        <?php
                                        }// fim foreach
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="messages-pills">
                            </div>
                            <div class="tab-pane fade" id="settings-pills">
                            </div>
                        </div>
                    </div>

                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <div class="col-lg-12">
                <div class="panel panel-default" style="margin-top: 12px;">
                    <div class="panel-heading">
                        Resumo da Venda
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID Produto</th>
                                        <th>Quantidade</th>
                                        <th>Valor Unidade</th>
                                        <th>Total</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody class="itens">
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
    </div>
</form>

<script type="text/javascript">
    function adicionar_produto() {
        var codigo_produto = $('#codigo_produto').val();
        var quantidade_produto = $('#quantidade_produto').val();
        var total = $('#total').html();
        if (codigo_produto < 0) {
           $('#codigo_produto').css('border-color','red');
           return false;
        } else if (quantidade_produto < 0) {
            $('#quantidade_produto').css('border-color','red');
            return false;
        } else {
            $.ajax({
                type: "post",
                dataType: "json",
                url: "/venda/recuperar_dados_venda_ajax",
                async: true,
                data: {dados:{codigo_produto: codigo_produto, quantidade_produto: quantidade_produto}},
                error: function(x){
                    return false;
                },
                success: function(x){
                    var html;
                    total = parseInt(total) + (parseInt(x[0]['Produto']['preco']) * parseInt(quantidade_produto));

                    html = '<tr id="'+x[0]['Produto']['id_alias']+'">';
                    html += '<td>'+ x[0]['Produto']['id_alias'] +'</td>';
                    html += '<td>'+ quantidade_produto +'</td>';
                    html += '<td>'+ x[0]['Produto']['preco'] +'</td>';
                    html += '<td>'+ x[0]['Produto']['preco'] * quantidade_produto +'</td>';
                    html += '<td class="center"><button onclick="remover_produto('+x[0]['Produto']['id_alias']+','+total+');" type="button" class="btn btn-danger btn-circle"><i class="fa fa-times"></i></button></td>';
                    html += '</tr>';
                    $('#total').html(total);
                    $('.itens').append(html);           
                }
            });
        }
    }
    function remover_produto(id,valor) {
        var total = $('#total').html();

        total = parseInt(total) - valor;
        $('#total').html(total);
        $('#'+id).remove();
    }
</script>