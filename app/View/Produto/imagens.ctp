<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Imagens Produto - <?php echo $produto['Produto']['nome'] ?></h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    
    <!-- /.row -->
	<div class="row">
		<?php foreach ($imagens as $imagem): ?>
	        <div class="col-lg-3" id="<?php echo $imagem['Imagen']['id'] ?>">
				<div class="panel panel-default">
				  	<div class="panel-body">
					    <a href="#" class="thumbnail">
					    	<img src="/uploads/produto/imagens/<?php echo $imagem['Imagen']['arquivo'] ?>" alt="<?php echo $imagem['Imagen']['alt']; ?>">
					    </a>
				  	</div>
				  	<div class="panel-footer" style="text-align: right;">
				  		<a class="btn btn-danger" href="javascript:removeImagem('<?php echo $imagem['Imagen']['id'] ?>');">
				  			<i class="fa fa-times"></i>
				  		</a>
				  	</div>
				</div>
	        </div>
		<?php endforeach; ?>
    </div>

    <div class="row">
    	<div class="col-lg-12" style="text-align: right;">
    		<a href="javascript:;" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
    			<i class="fa fa-plus"></i> Adicionar Imagem
    		</a>
    	</div>
    </div>

	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<form method="post" enctype="multipart/form-data" action="/produto/salvar_imagem/<?php echo $produto['Produto']['id'] ?>">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Adicionar Imagem</h4>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="order">Ordem</label>
							<input type="number" name="photo[order]" value="" class="form-control" id="order">
						</div>
						<div class="form-group">
							<label for="alt">ALT</label>
							<input type="text" name="photo[alt]" value="" class="form-control" id="alt">
						</div>
						<div class="form-group">
							<label for="title">Title</label>
							<input type="text" name="photo[title]" value="" class="form-control" id="title">
						</div>
						<div class="form-group">
							<label for="arquivo">Foto</label>
							<input type="file" name="arquivo" value="" class="form-control" id="arquivo">
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
						<button type="submit" class="btn btn-primary">Enviar Imagem</button>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</form>
	</div><!-- /.modal -->

</div>

<script type="text/javascript">
	
	function removeImagem(id) {
		var idGlobal = id;
    
        swal({
          title: 'Você tem certeza?',
          text: "Somente confirme se você tiver certeza desta ação!",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Sim!',
          cancelButtonText: 'Não.'
        }).then(function(){ 
            $.ajax({
                type: "get",
                dataType: "json",
                url: "/produto/imagem_excluir_cadastro/" + id,
                async: true,
                success: function(data){
                    swal(
                        'Deletado!',
                        'Seu registro foi deletado do sistema.',
                        'success'
                    );      
                    
                    $('#' + idGlobal).remove();
                }
            });
        });
	}

</script>