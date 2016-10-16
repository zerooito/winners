
<?php if (!empty($banners)): ?>
    <div class="row carousel-holder">
        <div class="col-md-12">
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">

                    <?php foreach ($banners as $i => $banner): ?>
                        <li data-target="#carousel-example-generic" data-slide-to="<?php echo $i; ?>"></li>
                    <?php endforeach; ?>

                </ol>
                
                <div class="carousel-inner">
                    <?php foreach ($banners as $i => $banner): ?>
                        <div class="item active">
                            <img class="slide-image" src="/uploads/banner/imagens/<?php echo $banner['Banner']['src']; ?>" width="600" height="600" alt="">
                        </div>
                    <?php endforeach; ?>
                </div>

                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                </a>
            </div>
        </div>

    </div>
<?php else: ?>

<?php endif ?>