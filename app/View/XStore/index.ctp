
    <!-- Page Content -->
    <div class="container">

        <div class="row">
            <?php include('barra_lateral/barra_lateral.ctp') ?>  

            <div class="col-md-9">

                <?php include('banners/banners.ctp') ?>

                <div class="row">
                    <? foreach ($produtos as $indice => $produto) { ?> 
                        <?php include('produto_item/produto_item.ctp') ?>
                    <? } ?>
                </div>

            </div>

        </div>

    </div>
    <!-- /.container -->