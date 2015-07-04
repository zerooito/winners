<form role="form" action="/produto/s_editar_cadastro/<?php echo $produto['Produto']['id'] ?>" method="post" enctype="multipart/form-data">

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
                                        <input class="form-control" name="dados[nome]"  value="<?php echo $produto['Produto']['nome'] ?>" required>
                                        <!-- <p class="help-block">Example block-level help text here.</p> -->
                                    </div>
                                    <div class="form-group">
                                        <label>Preço</label>
                                        <input class="form-control moeda" name="dados[preco]" value="<?php echo number_format($produto['Produto']['preco'], '2', ',', '.') ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Custo</label>
                                        <input class="form-control moeda" name="dados[custo]" value="<?php echo number_format($produto['Produto']['custo'], '2', ',', '.') ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Peso Bruto</label>
                                        <input class="form-control peso" name="dados[peso_bruto]" value="<?php echo $produto['Produto']['peso_bruto'] ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Peso Liquido</label>
                                        <input class="form-control peso" name="dados[peso_liquido]" value="<?php echo $produto['Produto']['peso_liquido'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Estoque</label>
                                        <input type="number" class="form-control" name="dados[estoque]" value="<?php echo $produto['Produto']['estoque'] ?>" required>
                                    </div>


                                    <div class="form-group">
                                        <label>Categoria</label>
                                        <select class="form-control js-example-basic-single" name="dados[categoria_id]">
                                            <?php foreach ($categorias as $key => $categoria): ?>
                                            <option 
                                                <?php if ($produto['Produto']['categoria_id'] == $categoria['Categoria']['id']): ?>
                                                selected
                                                <?php endif; ?>
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

                            <button type="submit" class="btn btn-success">Salvar Produto</button>
                            <button type="reset" class="btn btn-danger" onclick="history.go(-1);">Cancelar</button>
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
                                        <textarea name="dados[descricao]" style="margin: 0px; height: 168px; width: 425px; max-width: 425px;"><?php echo $produto['Produto']['descricao'] ?></textarea>
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
