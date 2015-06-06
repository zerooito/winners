
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default" style="margin-top: 12px;">
                <div class="panel-heading">
                    Gerar Danfe a Partir do XML
                </div>
                <div class="panel-body">
                    <form action="/nfe/danfe" method="post" enctype="multipart/form-data" target="_blank">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Arquivo XML</label>
                                    <input type="file" class="form-control" name="nota">
                                    <!-- <p class="help-block">Example block-level help text here.</p> -->
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success">Gerar Danfe</button>
                    </form>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
</div>