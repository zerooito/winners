<?php include('header.ctp'); ?>

<!-- breadcrumb Start-->
<div class="page-notification">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item"><a href="/"><?php echo $nameCategory ?></a></li> 
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- listing Area Start -->
<div class="category-area">
    <div class="container">
        <div class="row">
            <div class="col-xl-7 col-lg-8 col-md-10">
                <div class="section-tittle mb-50">
                    <h2>Compre com a gente</h2>
                    <p>Olhe por <?php echo count($produtos); ?> nesta categoria</p>
                </div>
            </div>
        </div>
        <div class="row">
            <!--? Left content -->
            <div class="col-xl-3 col-lg-3 col-md-4 ">
                <!-- Job Category Listing start -->
                <div class="category-listing mb-50">
                    <!-- single one -->
                    <div class="single-listing">
                        <!-- Select km items start -->
                        <div class="select-job-items2">
                            <select name="select6">
                                <option value="">Pesquise por preço</option>
                                <option value="?de=50&ate=100">R$ 50,00 até R$ 100,00</option>
                                <option value="?de=100&ate=150">R$ 100,00 até R$ 150,00</option>
                                <option value="?de=150&ate=200">R$ 150,00 até R$ 200,00</option>
                            </select>
                        </div>
                        <!--  Select km items End-->
                    </div>
                </div>
                <!-- Job Category Listing End -->
            </div>

            <!--?  Right content -->
            <div class="col-xl-9 col-lg-9 col-md-8 ">
                <!--? New Arrival Start -->
                <div class="new-arrival new-arrival2">
                    <div class="row">
                        <?php foreach ($produtos as $indice => $produto): ?> 
                            <?php include('produto_item.ctp') ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>