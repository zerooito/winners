
<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
<!--             <li class="sidebar-search">
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Procurar...">
                    <span class="input-group-btn">
                    <button class="btn btn-default" type="button">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
                </div>
                <!-- /input-group -->
            <!-- </li> -->
            <li>
                <a href="/dashboard/home"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
            </li>
            <?php
                foreach ($modulos as $i => $valor) {
                    echo '<li>';
                        echo '<a href="/'.$valor['modulo'].'/'.$valor['funcao'].'"><i class="fa '.$valor['icone'].' fa-fw"></i> '.$valor['nome'].'</a>';
                    echo '</li>';
                }
            ?>
            <!--             <li>
                <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Vendas<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="flot.html">Ecommerce</a>
                    </li>
                    <li>
                        <a href="/venda/pdv/">PDV</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            <!-- </li> -->
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>