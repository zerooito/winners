<?php require('menu.ctp'); ?>

<div class="container" style="margin-top: 10px;">

	<div class="row">
        <?php foreach ($produtos as $indice => $produto): ?> 
			<?php include('produto_item/produto_item.ctp') ?>
        <?php endforeach; ?>
    </div>

</div>