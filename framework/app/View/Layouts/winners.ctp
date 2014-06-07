<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="product" content="BlackBook EAD">
    <meta name="description" content="">
    <meta name="author" content="Reginaldo Luis">

    <?php
    	echo $this->Html->css('metro-bootstrap');
    	echo $this->Html->css('metro-bootstrap-responsive');
    	echo $this->Html->css('style');


    	echo $this->Html->script('jquery');
    	echo $this->Html->script('funcoes');
    ?>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script src="http://malsup.github.com/jquery.tcycle.js"></script>
    <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

    {$script}

    <title>Winnes Desenvolvimento de Sites e Sistemas</title>
</head>

    <body class="metro">
    <nav class="navigation-bar dark fixed-top shadow">
        <nav class="navigation-bar-content container">

            <button class="element image-button image-left place-left">
                <img src="assets/images/logo.png" width="64" height="64"/>
            </button>
            <a class="element brand" href="#"><span class="icon-spin">O que é ?</span></a>     
            <span class="element-divider"></span>
            <a class="element brand" href="#"><span class="icon-printer">Por que usar ?</span></a>     
            <span class="element-divider"></span>
            <a class="element brand" href="#"><span class="icon-printer">Planos</span></a>     
            <span class="element-divider"></span>
            <a class="element brand" href="#"><span class="icon-printer">Downloads</span></a>     
            <span class="element-divider"></span>
            <a class="element brand" href="#" onclick="javascript:$zopim.livechat.window.toggle();"><span class="icon-printer">Suporte</span></a>     
            <span class="element-divider"></span>
            <a class="element brand" href="#"><span class="icon-printer">Compra Agora</span></a>     
            <span class="element-divider"></span>
     
            <div class="element input-element">
                <form>
                    <div class="input-control text">
                        <input type="text" placeholder="O que procura ?">
                        <button class="btn-search"></button>
                    </div>
                </form>
            </div>
                 
            <span class="element-divider place-right"></span>
            <a class="element place-right" href="#"><span class="icon-locked-2">Duvidas ?</span></a>
            <span class="element-divider place-right"></span>
            <button class="element image-button image-left place-right">
                Reginaldo Luis
                <img src="assets/images/1.png"/>
            </button>
        </nav>
    </nav>

        <?php echo $this->fetch('content'); ?>
    </body>
</html>