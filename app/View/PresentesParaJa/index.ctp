
<div id="index-banner" class="parallax-container">
	
	<?php require('menu-transparent.ctp'); ?>

    <div class="section no-pad-bot">
		<div class="container">
			<br>
			<br>
				<h1 class="header center title">
					Presentes Para Já
				</h1>
				<div class="row center">
		  			<h5 class="header col s12 light">
		  				Monte a cesta de presente perfeita
		  			</h5>
				</div>
				<div class="row center">
			  		<a href="http://materializecss.com/getting-started.html" class="btn-large waves-effect waves-light custom-color">
			  			Começar a Montar
			  		</a>
				</div>
			<br>
			<br>
		</div>
    </div>
    <div class="parallax">
    	<img src="https://images.pexels.com/photos/88647/pexels-photo-88647.jpeg?w=940&h=650&auto=compress&cs=tinysrgb" alt="Unsplashed background img 1" style="display: block; transform: translate3d(-50%, 190px, 0px);">
    </div>
</div>

<div class="container">
	
	<div class="row">
        <?php foreach ($produtos as $indice => $produto): ?> 
			<?php include('produto_item/produto_item.ctp') ?>
        <?php endforeach; ?>
    </div>
	
</div>
