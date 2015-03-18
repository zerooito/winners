
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Dashboard</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="jumbotron">
              <h1>Olá, seja bem vindo!</h1>
              <p>Ao seu sistema de gestão e cms, aqui você vai poder modificar seu site colocando banners
              e também gerencia todo seu conteudo e otimizar seu fluxo de trabalho.
              </p>
            </div>
            <?php if (!$pagamento) { ?>
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <h3 class="panel-title">Contrate Definitivamente</h3>
                      </div>
                      <div class="panel-body">
                        <!-- INICIO FORMULARIO BOTAO PAGSEGURO -->
                        <form action="https://pagseguro.uol.com.br/v2/pre-approvals/request.html" method="post">
                        <!-- NÃO EDITE OS COMANDOS DAS LINHAS ABAIXO -->
                        <input type="hidden" name="code" value="09EA3A0C0B0BD23774C62FBE6B00F1D0" />
                        <input type="image" src="https://p.simg.uol.com.br/out/pagseguro/i/botoes/assinaturas/209x48-assinar-assina.gif" name="submit" alt="Pague com PagSeguro - é rápido, grátis e seguro!" />
                        </form>
                        <!-- FINAL FORMULARIO BOTAO PAGSEGURO -->
                      </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
        <!-- /#page-wrapper -->
