<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Winners - Gestão Online</title>

    <!-- Bootstrap Core CSS -->
    <?php echo $this->Html->css('bootstrap.min'); ?>
    <!-- <link href="css/bootstrap.min.css" rel="stylesheet"> -->

    <!-- MetisMenu CSS -->
    <?php echo $this->Html->css('plugins/metisMenu/metisMenu.min'); ?>
    <!-- <link href="css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet"> -->

    <!-- Timeline CSS -->
    <?php echo $this->Html->css('plugins/timeline'); ?>
    <!-- <link href="css/plugins/timeline.css" rel="stylesheet"> -->

    <!-- Custom CSS -->
    <?php echo $this->Html->css('sb-admin-2'); ?>
    <!-- <link href="css/sb-admin-2.css" rel="stylesheet"> -->

    <!-- Morris Charts CSS -->
    <?php echo $this->Html->css('plugins/morris'); ?>
    <!-- <link href="css/plugins/morris.css" rel="stylesheet"> -->

    <!-- Custom Fonts -->
    <?php echo $this->Html->css('font-awesome/css/font-awesome.min'); ?>
    <!-- <link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"> -->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Entre com seus dados
                        <?php
                            if ($admin) {
                                echo '<b>FRAMEWORK</b>';
                            }
                        ?>
                        </h3>
                    </div>
                    <div class="panel-body">
                        <form <?php if ($admin) { echo 'action="/admin/processar_login"'; } else { echo 'action="/usuario/processar_login"'; }?> role="form" id="form-login" method="post">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="E-mail" name="dados[email]" type="email" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Senha" name="dados[senha]" type="password" value="">
                                </div>
                                <div class="checkbox">
                                    <a href="#">Esqueceu a sua senha ?</a>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <a href="javascript:;" class="btn btn-lg btn-success btn-block" id="login">Login</a>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- jQuery Version 1.11.0 -->
    <?php echo $this->Html->script('jquery-1.11.0'); ?>
    <script type="text/javascript">
        $('#login').click(function(){
            $('#form-login').submit();
        });
    </script>
</body>

</html>
