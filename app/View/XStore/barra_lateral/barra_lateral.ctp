<div class="col-md-3">
    <p class="lead">XStore</p>
    <div class="list-group">
    	<?php foreach($categorias as $indice => $valor): ?>
        	<a href="/category/<?php echo $valor['Categoria']['id'] ?>/<?php echo $valor['Categoria']['nome'] ?>" class="list-group-item"><?php echo $valor['Categoria']['nome'] ?></a>
        <?php endforeach; ?>
    </div>
</div>