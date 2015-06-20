
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default" style="margin-top: 12px;">            
                <div class="panel-heading">
                    Dados do Produto - <?php echo $produto['Produto']['nome'] ?>
                </div>
                <div class="panel-body">
                	<div class="row">
                		<div class="col-lg-12">
                			<div class="col-lg-6">
                				<table class="table table-bordered">
									<thead>
										<th>Nome</th>
										<th>Preço</th>
										<th>Peso Bruto</th>
										<th>Peso Liquido</th>
									</thead>
									<tbody>
										<tr>
											<td>
												<?php echo $produto['Produto']['nome'] ?>
											</td>
											<td>
												<?php echo number_format($produto['Produto']['preco'], '2', ',', '.') ?>
											</td>
											<td>
												<?php echo $produto['Produto']['peso_bruto'] ?>
											</td>
											<td>
												<?php echo $produto['Produto']['peso_liquido'] ?>
											</td>
										</tr>
									</tbody>
								</table>
                			</div>
                			<div class="col-lg-6">
                				<img src="/uploads/produto/imagens/<?php echo $produto['Produto']['imagem'] ?>" alt="..." class="img-rounded" height="225">
                				
                			</div>
                			<button class="btn btn-danger" onclick="history.go(-1);">Cancelar</button>
                		</div>
                	</div>
                </div>
            </div>
        </div>
    </div>
</div>