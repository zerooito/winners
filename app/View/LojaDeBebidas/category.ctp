<section class="ftco-section">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="row">
        			<?php foreach ($produtos as $indice => $produto): ?> 
						<?php include('produto_item.ctp') ?>
        			<?php endforeach; ?>
                </div>
            </div>

            <div class="col-md-3">
                <div class="sidebar-box ftco-animate">
                <div class="categories">
                <h3>Categorias</h3>
                <ul class="p-0">
                    <?php foreach ($categorias as $valor): ?>
                    <li><a href="/category/<?php echo $valor['Categoria']['id'] ?>/<?php echo $valor['Categoria']['nome'] ?>"><?php echo $valor['Categoria']['nome'] ?> <span class="fa fa-chevron-right"></span></a></li>
                    <?php endforeach; ?>
                </ul>
                </div>
            </div>
            </div>
        </div>
    </div>
</section>