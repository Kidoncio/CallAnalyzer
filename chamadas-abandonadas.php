<?php $titlePage = "Ligações Abandonadas";
require_once("logica-usuario.php");
?>
<?php include("cabecalho.php"); ?>
<?php include("conecta.php"); ?>
<?php include("arrumarData.php"); ?>

<!-- INÍCIO OBTENÇÃO DAS CHAMADAS ABANDONADAS -->
<?php
if($dePrint != $atePrint){
  $resultado = mysqli_query($conexao, "SELECT * FROM queue_log WHERE DATE(time) BETWEEN '$de' AND '$ate' AND event = 'ABANDON' ORDER BY time DESC");
  $rowResultado = mysqli_query($conexao, "SELECT COUNT(*) AS contagem FROM queue_log WHERE DATE(time) BETWEEN '$de' AND '$ate' AND event = 'ABANDON' ORDER BY time DESC");
  $rowResultado = mysqli_fetch_assoc($rowResultado);
  $rowResultado = $rowResultado['contagem'];
}
else{
  $resultado = mysqli_query($conexao, "SELECT * FROM queue_log WHERE DATE(time) = '$de' AND event = 'ABANDON' ORDER BY time DESC");
  $rowResultado = mysqli_query($conexao, "SELECT COUNT(*) AS contagem FROM queue_log WHERE DATE(time) = '$de' AND event = 'ABANDON' ORDER BY time DESC");
  $rowResultado = mysqli_fetch_assoc($rowResultado);
  $rowResultado = $rowResultado['contagem'];
}
?>
<!-- FIM OBTENÇÃO DAS CHAMADAS ABANDONADAS -->


<center>
  <div class="x_content">
    <div class="col-md-2 col-sm-2 col-xs-2">
    </div>
    <div class="cold-md-10 col-sm-10 col-xs-10">
      <!-- INÍCIO DO ERRO CASO $DE < $ATE -->
      <?php
      if($de > $ate){ ?>
        <h1 class="text-danger">ERROR</h1>
        <h4 class="text-danger">A data final não pode ser menor do que a inicial</h4>
        <form action="formulario-abandonadas.php" data-parsley-validate class="form-horizontal form-label-left">
          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
              <button type="submit" class="btn btn-success">Voltar</button>
            </div>
          </div>
        </form>
        <?php
      }else{
        ?>
        <!-- FIM DO ERRO CASO $DE < $ATE / INÍCIO DO ELSE-->
        <h3 class="text-danger">Ligações Abandonadas</h3>
        <h3><small>De <?=$dePrint?> até <?=$atePrint?></small></h3>
        <?php
        if($rowResultado > 1){ ?>
          <h3><small><?=$rowResultado?> resultados encontrados</small></h3>
          <?php
        }else if($rowResultado == 1){ ?>
          <h3><small><?=$rowResultado?> resultado encontrado</small></h3>
          <?php
        }else{ ?>
          <h3><small class="text-danger">Nenhum resultado foi encontrado</small></h3>
          <?php
        }
        ?>
      </div>
    </div>

    <!-- INÍCIO IMPRESSÃO DOS RESULTADOS DA BUSCA NA TABELA -->
    <div class="clearfix"></div>
    <div class="col-md-2 col-sm-2 col-xs-22">
    </div>
    <div class="col-md-10 col-sm-10 col-xs-10">
      <div class="x_panel">
        <div class="table-responsive">
          <table class="table table-striped jambo_table bulk_action">
            <thead>
              <tr class="headings">
                <th class="column-title">Time</th>
                <th class="column-title">Call Id</th>
                <th class="column-title">Evento</th>
                <th class="column-title">Calltime</th>
                <th class="column-title">Número</th>
              </tr>
            </thead>
            <tbody>
              <?php
              while($chamadas = mysqli_fetch_assoc($resultado)){ ?>

                <!-- INÍCIO PARA VERIFICAR O NÚMERO DA CHAMADA -->
                <?php
                $callid = $chamadas['callid'];

                $numeroCliente = mysqli_query($conexao, "SELECT * FROM queue_log WHERE callid = '$callid' AND event = 'ENTERQUEUE' ORDER BY time DESC");
                $numeroCliente = mysqli_fetch_assoc($numeroCliente);
                ?>
                <!-- FIM PARA VERIFICAR O NÚMERO DA CHAMADA -->

                <tr>
                  <!-- INÍCIO DATA -->
                  <td>
                    <?php
                    $time = date('d/m/Y H:i:s', strtotime($chamadas['time']));
                    ?>
                    <p><?=$time?></p>
                  </td>
                  <!-- FIM DATA -->

                  <!-- INÍCIO EXIBIR E LINKAR O CALL ID AO FORMULARIO-CALLID.PHP -->
                  <td>
                    <form action="resultado-callid.php" method="post">
                      <input type="hidden" name="callid" value="<?=$callid?>" />
                      <button class="btn btn-info"><?=$callid?></button>
                    </form>
                  </td>
                  <!-- FIM EXIBIR E LINKAR O CALL ID AO FORMULARIO-CALLID.PHP -->

                  <!-- INÍCIO TRADUÇÃO DO EVENTO -->
                  <td>
                    <?php
                    if($chamadas['event'] == 'ABANDON'){
                      $calltime = $chamadas['data3'];
                      $event = 'ABANDONADA'; ?>
                      <p class="text-danger"><?=$event?></p>
                      <?php
                    }
                    ?>
                  </td>
                  <!-- FIM TRADUÇÃO DO EVENTO -->

                  <!-- INÍCIO CALLTIME -->
                  <td>
                    <?php
                    if($calltime == '' || $calltime == '0'){
                      $calltime = '';
                    }else if($calltime == '1'){
                      $calltime = "$calltime segundo";
                    }else{
                      $calltime = "$calltime segundos";
                    }
                    ?><p><?= $calltime ?></p>
                  </td>
                  <!-- FIM CALLTIME -->

                  <!-- INÍCIO NÚMERO DO CLIENTE -->
                  <td>
                    <?php
                    if($numeroCliente['data2'] == '00000000'){
                      $numeroCliente = 'Número Privado';
                    }else{
                      $numeroCliente = $numeroCliente['data2'];
                    }
                    ?>
                    <form action="resultado-numero.php" method="post">
                      <input type="hidden" name="numeroDoCliente" value="<?=$numeroCliente?>" />
                      <button class="btn btn-info"><?=$numeroCliente?></button>
                    </form>
                  </td>
                  <!-- FIM NÚMERO DO CLIENTE -->

                </tr>
                <?php
              }
              ?>
            </tbody>
          </table>
        </div>
        <!-- FIM DO ELSE CASO $DE < $ATE -->
        <?php
      }
      ?>
      <!-- FIM DO ELSE CASO $DE < $ATE -->
    </div>
  </div>
  <!-- FIM IMPRESSÃO DOS RESULTADOS DA BUSCA NA TABELA -->

</center>
<?php include("rodape.php"); ?>
