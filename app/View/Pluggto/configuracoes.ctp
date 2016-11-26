<form action="/pluggto/salvar" method="POST">
	<div id="page-wrapper">
	    <div class="row">
	        <div class="col-lg-12">
	            <h1 class="page-header">Plugg.To - Configurações</h1>
	        </div>
	        <!-- /.col-lg-12 -->
	    </div>
	    <!-- /.row -->
	    <div class="row">

	    	<div class="col-lg-12">

				<!-- Nav tabs -->
				<ul class="nav nav-tabs" role="tablist">
					<li role="presentation" class="active">
						<a href="#chaves" aria-controls="chaves" role="tab" data-toggle="tab">Chaves</a>
					</li>
				</ul>

				<!-- Tab panes -->
				<div class="tab-content">
					
					<div role="tabpanel" class="tab-pane active" id="chaves">
						
						<div class="row" style="margin-top:30px;">
			                 <div class="col-md-6">
			                    <div class="form-group">
			                        <label>Client ID</label>
			                        <input class="form-control" name="dados[client_id]" value="<?php echo $dados['client_id']; ?>">
			                    </div>
			                 </div>

			                 <div class="col-md-6">
			                    <div class="form-group">
			                        <label>Client Secret</label>
			                        <input class="form-control" name="dados[client_secret]" value="<?php echo $dados['client_secret']; ?>">
			                    </div>
			                 </div>

			                 <div class="col-md-3">
			                    <div class="form-group">
			                        <label>Plugg ID</label>
			                        <input class="form-control" name="dados[plugg_id]" value="<?php echo $dados['plugg_id']; ?>">
			                    </div>
			                 </div>

			                 <div class="col-md-3">
			                    <div class="form-group">
			                        <label>API User</label>
			                        <input class="form-control" name="dados[api_user]" value="<?php echo $dados['api_user']; ?>">
			                    </div>
			                 </div>

			                 <div class="col-md-6">
			                    <div class="form-group">
			                        <label>API Secret</label>
			                        <input class="form-control" name="dados[api_secret]" value="<?php echo $dados['api_secret']; ?>">
			                    </div>
			                 </div>

			                 <?php if (isset($dados['id'])): ?>
								<input type="hidden" class="form-control" name="dados[id]" value="<?php echo $dados['id']; ?>">
							 <?php endif; ?>
		                </div>

					</div>

				</div>

			</div>


	    </div>

	    <div class="row text-right">
	    	<div class="col-lg-12">
				<button class="text-right btn btn-success">Salvar</button>
			</div>
		</div>

	</div>
</form>