

		<section class="ftco-section">
			<div class="container">
				<div class="row justify-content-center pb-5">
          <div class="col-md-7 heading-section text-center ftco-animate">
          	<span class="subheading">Nossos principais produtos</span>
            <h2>Escolha</h2>
          </div>
        </div>
				<div class="row">
        			<?php foreach ($produtos as $indice => $produto): ?> 
						<?php include('produto_item.ctp') ?>
        			<?php endforeach; ?>
				</div>
			</div>
		</section>