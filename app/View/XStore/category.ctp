
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <div class="col-md-12">

                <div class="row">
                    <?php foreach ($produtos as $indice => $produto) { ?> 
                        <?php include('produto_item/produto_item.ctp') ?>
                    <?php } ?>
                </div>

            </div>

        </div>

    </div>
    <!-- /.container -->