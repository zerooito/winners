
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <div class="col-md-12">

                <div class="row">
                    <? foreach ($produtos as $indice => $produto) { ?> 
                        <?php include('produto_item/produto_item.ctp') ?>
                    <? } ?>
                </div>

            </div>

        </div>

    </div>
    <!-- /.container -->