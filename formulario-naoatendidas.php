<?php $titlePage = "Ligações Não Atendidas"; ?>
<?php include("cabecalho.php"); ?>
<?php include("conecta.php"); ?>

<center>

  <div class="right_col" role="main">
    <div class="">
      <div class="page-title">
        <div class="title_left">
          <h3>Ligações Não Atendidas</h3>
        </div>
        <div class="title_right">
          <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
          </div>
        </div>
      </div>
      <div class="clearfix"></div>
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2></h2>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <br />
              <form id="formulario-naoatendidas" action="chamadas-naoatendidas.php" data-parsley-validate class="form-horizontal form-label-left" method="post">

                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">De <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="data_inicial" name="data_inicial" class="date-picker form-control col-md-7 col-xs-12" required="required" type="text">
                  </div>
                </div>
                <div class="ln_solid"></div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Até <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="data_final" name="data_final" class="date-picker form-control col-md-7 col-xs-12" required="required" type="text">
                  </div>
                </div>
                <div class="ln_solid"></div>
                <div class="form-group">
                  <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <button type="submit" class="btn btn-success">Procurar</button>
                  </div>
                </div>

              </form>
            </div>
          </div>
        </div>
      </div>


    </center>
    <?php include("rodape.php"); ?>
