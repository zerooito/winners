<?php include('header.ctp'); ?>

<!-- breadcrumb Start-->
<div class="page-notification">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item"><a href="/product/<?php echo $produto['Produto']['id'] ?>"><?php echo $produto['Produto']['nome'] ?></a></li> 
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb End-->
<!--?  Details start -->
<div class="directory-details pt-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="small-tittle mb-20">
                    <h2><?php echo $produto['Produto']['nome'] ?></h2>
                </div>
                <div class="directory-cap mb-40">
                    <p>
                        <?php echo $produto['Produto']['descricao'] ?>
                    </p>
                </div>
                <div class="small-tittle mb-20">
                    <h2>Fotos</h2>
                </div>
                <div class="gallery-img">
                    <div class="row">
                        <div class="col-lg-6">
                            <?php if (isset($produto['Produto']['imagem']) && !empty($produto['Produto']['imagem'])): ?>
                                <img src="/uploads/produto/imagens/<?php echo $produto['Produto']['imagem'] ?>" class="mb-30" alt="">
                            <?php else: ?>
                                <img src="/images/imagem404.jpg" class="img-fluid" alt="">
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-wrapper">
                    <form id="contact-form" action="/addCart" method="post">
                        <div class="row">
                            <div class="col-lg-12">
                                <h2>R$ <?php echo number_format($produto['Produto']['preco'], '2', ',', '.') ?></h2>
                                <br>
                                <div class="form-box email-icon mb-15">
                                <input type="hidden" value="<?php echo $produto['Produto']['id'] ?>" name="produto[id]" />
                                    <input type="text" name="produto[quantidade]" placeholder="Quantidade" value="1">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="submit-info">
                                    <?php if ($produto['Produto']['estoque'] > 0): ?>
                                        <button class="submit-btn2" type="submit">Compar</button>
                                    <?php else: ?>
                                        <button class="submit-btn2" disabled>Indisponivel</button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </form> 
                </div>
            </div>
        </div>
    </div>
</div>
<!--  Details End -->
<!-- listing-area Area End -->
<br>
<br>
<br>