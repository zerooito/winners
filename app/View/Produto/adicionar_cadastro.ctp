<form role="form" action="/produto/s_adicionar_cadastro" method="post" enctype="multipart/form-data">

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default" style="margin-top: 12px;">
                    <div class="panel-heading">
                        Dados do Produto
                    </div>
                    <div class="panel-body">

                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Nome</label>
                                        <input class="form-control" name="dados[nome]" required>
                                        <!-- <p class="help-block">Example block-level help text here.</p> -->
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Custo</label>
                                                <input class="form-control moeda" name="dados[custo]" id="custo" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Porcentagem</label>
                                                <div class="input-group">
                                                    <input class="form-control" id="porcetagem-custo">
                                                    <div class="input-group-addon">%</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Preço</label>
                                        <input class="form-control moeda" name="dados[preco]" id="preco" required>
                                    </div>
                                    <div class="form-group">
                                        <label>SKU</label>
                                        <input class="form-control" name="dados[sku]" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Peso Bruto</label>
                                        <input class="form-control peso" name="dados[peso_bruto]" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Peso Liquido</label>
                                        <input class="form-control peso" name="dados[peso_liquido]">
                                    </div>
                                    <div class="form-group">
                                        <label>Estoque</label>
                                        <input type="number" class="form-control" name="dados[estoque]" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Estoque Minimo</label>
                                        <input type="number" class="form-control" name="dados[quantidade_minima]" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Categoria</label>
                                        <select class="form-control js-example-basic-single" name="dados[categoria_id]">
                                            <?php foreach ($categorias as $key => $categoria): ?>
                                            <option 
                                                value="<?php echo $categoria['Categoria']['id'] ?>"
                                            >
                                            <?php echo $categoria['Categoria']['nome'] ?>
                                            </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Informações extras
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label>
                                            Descrição:
                                        </label>
                                        <textarea name="dados[descricao]" style="margin: 0px; height: 168px; width: 425px; max-width: 425px;"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>
                                            Imagem
                                        </label>
                                        <input type="file" name="imagem" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6"></div>
                        <div class="col-lg-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Variações
                                </div>
                                <div class="panel-body">
                                    <div class="col-lg-6">
                                        <label>Variação</label>
                                        <input type="text" class="form-control" name="variacao[0][variacao]" required>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Estoque</label>
                                        <input type="number" class="form-control" name="variacao[0][estoque]" required>
                                    </div>
                                    <div id="variacoes" data-n-variacao="0">
                                        
                                    </div>
                                    <div class="col-lg-9" style="margin-top: 10px;"></div>
                                    <div class="col-lg-4">
                                        <button type="button" class="btn btn-success" id="variacao">+ Variação</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9"></div>
                        <div class="col-lg-3">
                            <button type="submit" class="btn btn-success">Salvar Produto</button>
                            <button type="reset" class="btn btn-danger" onclick="history.go(-1);">Cancelar</button>
                        </div>
                        <!-- /.row (nested) -->
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
    $(document).ready(function() {
      $(".js-example-basic-single").select2();

      $('#variacao').click(function() {
        var n_variacao = $('#variacoes').data('n-variacao')
          , html       = ''
          ;

        html  =  '<div class="col-lg-6">';
        html +=     '<label>Variação</label>';
        html +=     '<input type="text" class="form-control" name="variacao[' + (parseInt(n_variacao) + 1) + '][variacao]" required>';
        html +=  '</div>';
        html +=  '<div class="col-lg-6">';
        html +=     '<label>Estoque</label>';
        html +=     '<input type="number" class="form-control" name="variacao[' + (parseInt(n_variacao) + 1) + '][estoque]" required>';
        html +=  '</div>';

        $('#variacoes').data('n-variacao', (parseInt(n_variacao) + 1));
        $('#variacoes').append(html);
      });

        $('#porcetagem-custo').keyup(function(){
            value = $(this).val();
            custo = $('#custo').val();

            if (custo == undefined || custo == "") {
                $(this).val('');
                return $('#custo').css('border-color', 'red').focus();
            }

            $('#custo').css('border-color', '1px solid #ccc');

            porcetagem = (custo * value) / 100;

            value = parseFloat(custo) + parseFloat(porcetagem);

            if (value < 1)
                formatNumber = value;
            else 
                formatNumber = number_format(value, 2);

            $('#preco').val('');
            $('#preco').val(formatNumber);
        });
    });
</script>
