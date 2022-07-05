<?php include('header.ctp'); ?>

<!--? New Arrival Start -->
<div class="new-arrival">
    <div class="container">
        <!-- Section tittle -->
        <div class="row justify-content-center">
            <div class="col-xl-7 col-lg-8 col-md-10">
                <div class="section-tittle mb-60 text-center wow fadeInUp" data-wow-duration="2s" data-wow-delay=".2s">
                    <h2>Em<br>Destaque</h2>
                </div>
            </div>
        </div>
    </div>
	<div class="row">
		<?php foreach ($produtos as $indice => $produto): ?> 
			<?php include('produto_item.ctp') ?>
		<?php endforeach; ?>
	</div>
</div>
<!--? New Arrival End -->