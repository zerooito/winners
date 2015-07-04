
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <div class="col-md-12">
                <?php include('banners/banners.ctp') ?>

                <div class="row">
                    <? foreach ($produtos as $indice => $produto) { ?> 
                        <?php pr($produto); ?>
                    <? } ?>
                </div>

            </div>

        </div>

    </div>
    <!-- /.container -->