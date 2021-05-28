
<style type="text/css">
	.input {
		border-color: #222;	
	}
</style>

<div class="row">

	<div class="col-md-6 col-xs-12">

		<form action="/home/enviar_email" method="POST">
			<div class="form-group">
				<label class="col-md-12 control-label">Nome</label> 
				<div class="col-md-12">
					<input name="dados[name]" placeholder="Digite seu nome" class="form-control" type="text" style="border-color: #028fcc;" required="">
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-12 control-label">E-mail</label> 
				<div class="col-md-12">
					<input name="dados[name]" placeholder="Digite seu e-mail" class="form-control" type="text" style="border-color: #028fcc;" required="">
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-12 control-label">Mensagem</label> 
				<div class="col-md-12">
					<textarea name="dados[name]" placeholder="Digite sua mensagem" class="form-control" type="text" style="border-color: #028fcc;"></textarea>
				</div>
			</div>
			<div class="form-group text-right" style="margin: 15px;">
				<button class="btn btn-sucess" style="margin-top: 10px;">Enviar</button>
			</div>
		</form>
		
	</div>
	
	<div class="col-md-5 col-xs-12 text-center" style="padding-top:10px;">
		
		<h1>Entre em contato conosco</h1>

		<p>Envie um e-mail atráves do formulario ou contato@ciawn.com.br. </p>

	

	</div>

</div>
