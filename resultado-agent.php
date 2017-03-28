<?php $titlePage = "Histórico dos Agents"; ?>
<?php include("cabecalho.php"); ?>
<?php include("conecta.php"); ?>

<?php $numeroSIP = $_POST['agentid']; ?>

<!-- INÍCIO ATRELAR AGENT ID NO MYSQL -->
<?php

$resultado = mysqli_query($conexao, "SELECT * FROM queue_log WHERE (time >= DATE_SUB(NOW(), INTERVAL 1 DAY)) AND agent = '$numeroSIP' AND (event != 'RINGNOANSWER' AND event != 'CONNECT') ORDER BY time DESC");

?>
<!-- FIM ATRELAR AGENT ID NO MYSQL -->


<center>
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_content">
      <div class="col-md-2 col-sm-2 col-xs-2">
      </div>
      <div class="cold-md-10 col-sm-10 col-xs-10">
        <center>
          <h3>Histórico do Agent</h3>
          <h3><small>Agent <?=$numeroSIP?></small></h3>
        </center>
      </div>
    </div>

    <!-- INÍCIO IMPRESSÃO DOS RESULTADOS DA BUSCA NA TABELA -->
    <div class="clearfix"></div>
    <div class="col-md-2 col-sm-2 col-xs-22">
    </div>
    <div class="col-md-10 col-sm-10 col-xs-10">
      <div class="x_panel">
      <div class="x_title">
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

                $resultadoNumeroCliente = mysqli_query($conexao, "SELECT * FROM queue_log WHERE callid = '$callid' AND event = 'ENTERQUEUE' ORDER BY time DESC");
                $numeroCliente = mysqli_fetch_assoc($resultadoNumeroCliente);
                ?>
                <!-- FIM PARA VERIFICAR O NÚMERO DA CHAMADA -->

                <tr>
                  <!-- INÍCIO DATA -->
                  <td>
                    <?php
                    $time = date('d/m/Y H:i', strtotime($chamadas['time']));
                    ?>
                    <p><?=$time?></p>
                  </td>
                  <!-- FIM DATA -->

                  <!-- INÍCIO EXIBIR E LINKAR O CALL ID AO FORMULARIO-CALLID.PHP -->
                  <td>
                    <form action="resultado-callid.php" method="post">
                      <input type="hidden" name="callid" value="<?=$chamadas['callid']?>" />
                      <button class="btn btn-info"><?= $chamadas['callid'] ?></button>
                    </form>
                  </td>
                  <!-- FIM EXIBIR E LINKAR O CALL ID AO FORMULARIO-CALLID.PHP -->

                  <!-- INÍCIO TRADUÇÃO DO EVENTO -->
                  <td>
                    <?php
                    if($chamadas['event'] == 'COMPLETEAGENT'){
                      $event = 'ATENDENTE DESLIGOU';
                      $calltime = $chamadas['data2']; ?>
                      <p class="text-primary"><?=$event?></p>
                      <?php
                    }
                    else if($chamadas['event'] == 'COMPLETECALLER'){
                      $event = 'CLIENTE DESLIGOU';
                      $calltime = $chamadas['data2']; ?>
                      <p class="text-primary"><?=$event?></p>
                      <?php
                    }
                    else if($chamadas['event'] == 'TRANSFER'){
                      $event = 'TRANSFERIDA';
                      $calltime = $chamadas['data4']; ?>
                      <p class="text-info"><?=$event?></p>
                      <?php
                    }
                    else{ ?>
                      <p class="text-primary"><?=$chamadas['event']?></p>
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
                      $numero = 'Número Privado';
                    }else{
                      $numero = $numeroCliente['data2'];
                    }
                    ?>
                    <form action="resultado-numero.php" method="post">
                      <input type="hidden" name="numeroDoCliente" value="<?=$numero?>" />
                      <button class="btn btn-info"><?=$numero?></button>
                    </form>
                  </td>
                  <!-- FIM NÚMERO DO CLIENTE -->

                </tr>
                <?php
              }
              ?>
            </tbody>
          </table>
          <!-- FIM IMPRESSÃO DOS RESULTADOS DA BUSCA NA TABELA -->
        </div>
      </div>
    </div>
  </div>


  </center>
  <?php include("rodape.php"); ?>
