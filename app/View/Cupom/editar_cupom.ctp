
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default" style="margin-top: 12px;">
                <div class="panel-heading">
                    Dados do Cupom
                </div>
                <div class="panel-body">
                    <form role="form" action="/cupom/s_editar_cupom/<?php echo $cupom[0]['Cupom']['id'] ?>" method="post">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Nome</label>
                                    <input class="form-control" name="dados[nome]" value="<?php echo $cupom[0]['Cupom']['nome'] ?>" required>
                                    <!-- <p class="help-block">Example block-level help text here.</p> -->
                                </div>
                                <div class="form-group">
                                    <label>Tipo</label>
                                    <select class="form-control" name="dados[tipo]" required>
                                        <option
                                        <?php if ($cupom[0]['Cupom']['tipo'] == 'fixo'): ?>
                                            selected                                        
                                        <?php endif; ?>
                                            value="fixo"
                                        >Fixo</option>
                                        <option 
                                        <?php if ($cupom[0]['Cupom']['tipo'] == 'porcento'): ?>
                                            selected                                        
                                        <?php endif; ?>
                                            value="porcento"
                                        >Porcento</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Valor</label>
                                    <input class="form-control moeda" name="dados[valor]" value="<?php echo $cupom[0]['Cupom']['valor'] ?>" required>
                                </div>
                            </div>
                            <!-- /.col-lg-6 (nested) -->
                        </div>

                        <button type="submit" class="btn btn-success">Salvar Cupom</button>
                        <button type="reset" class="btn btn-danger" onclick="history.go(-1);">Cancelar</button>
                    </form>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
</div>