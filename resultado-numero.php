<html>
<?php $titlePage = "Histórico de Ligações"; ?>
<?php include("cabecalho.php"); ?>
<?php include("conecta.php"); ?>

<!-- INÍCIO PESQUISAR NÚMERO NO MYSQL -->
<?php
$numeroDoCliente = $_POST['numeroDoCliente'];

$resultadoBuscaNumeroCliente = mysqli_query($conexao, "SELECT * FROM queue_log WHERE data2 = '$numeroDoCliente' order by time DESC");
$rowResultado = mysqli_query($conexao, "SELECT COUNT(*) AS contagem FROM queue_log WHERE data2 = '$numeroDoCliente' order by time DESC");
$rowResultado = mysqli_fetch_assoc($rowResultado);
$rowResultado = $rowResultado['contagem'];

?>
<!-- FIM PESQUISAR NÚMERO NO MYSQL -->


<center>
  <div class="x_content">
    <div class="col-md-2 col-sm-2 col-xs-2">
    </div>
    <div class="cold-md-10 col-sm-10 col-xs-10">
      <center>
        <h3>Histórico de Ligações</h3>
        <h3><small>Número Pesquisado: <?=$numeroDoCliente?></small></h3>
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
                <th class="column-title">Agent</th>
                <th class="column-title">Calltime</th>
                <th class="column-title">Número</th>
              </tr>
            </thead>
            <tbody>
              <?php
              while($chamadas = mysqli_fetch_assoc($resultadoBuscaNumeroCliente)){ ?>

                <!-- INÍCIO VERIFICAÇÃO DO EVENTO FINAL DA CHAMADA -->
                <?php
                $callid = $chamadas['callid'];

                $verificarResultadoDaChamada = mysqli_query($conexao, "SELECT * FROM queue_log WHERE callid = '$callid' AND event != 'ENTERQUEUE' AND event != 'RINGNOANSWER' AND event != 'DID' AND event != 'CONNECT' ORDER BY time DESC");
                $resultadoDaChamada = mysqli_fetch_assoc($verificarResultadoDaChamada);
                ?>
                <!-- INÍCIO VERIFICAÇÃO DO EVENTO FINAL DA CHAMADA -->

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
                    if($resultadoDaChamada['event'] == 'ABANDON'){
                      $calltime = $resultadoDaChamada['data3'];
                      $event = 'ABANDONADA'; ?>
                      <p class="text-danger"><?=$event?></p>
                      <?php
                    }
                    else if($resultadoDaChamada['event'] == 'EXITWITHTIMEOUT'){
                      $calltime = $resultadoDaChamada['data3'];
                      $event = 'CLIENTE NÃO ATENDIDO'; ?>
                      <p class="text-danger"><?=$event?></p>
                      <?php
                    }
                    else if($resultadoDaChamada['event'] == 'COMPLETEAGENT'){
                      $calltime = $resultadoDaChamada['data2'];
                      $event = 'ATENDENTE DESLIGOU'; ?>
                      <p class="text-primary"><?=$event?></p>
                      <?php
                    }
                    else if($resultadoDaChamada['event'] == 'COMPLETECALLER'){
                      $calltime = $resultadoDaChamada['data2'];
                      $event = 'CLIENTE DESLIGOU'; ?>
                      <p class="text-primary"><?=$event?></p>
                      <?php
                    }
                    else if($resultadoDaChamada['event'] == 'TRANSFER'){
                      $calltime = $resultadoDaChamada['data4'];
                      $event = 'TRANSFERIDA'; ?>
                      <p class="text-info"><?=$event?></p>
                      <?php
                    }
                    else if($resultadoDaChamada['event'] == 'EXITEMPTY'){
                      $calltime = $resultadoDaChamada['data4'];
                      $event = 'NÃO FOI POSSÍVEL EFETUAR A LIGAÇÃO'; ?>
                      <p class="text-warning"><?=$event?></p>
                      <?php
                    }
                    else{ ?>
                      <p class="text-primary"><?=$resultadoDaChamada['event']?></p>
                      <?php
                    }
                    ?>
                  </td>
                  <!-- FIM TRADUÇÃO DO EVENTO -->

                  <!-- INÍCIO AGENT -->
                  <td>
                    <?php if($resultadoDaChamada['event'] == 'COMPLETEAGENT' || $resultadoDaChamada['event'] == 'COMPLETECALLER' || $resultadoDaChamada['event'] == 'TRANSFER'){ ?>
                      <form action="resultado-agent.php" method="post">
                        <input type="hidden" name="agentid" value="<?=$resultadoDaChamada['agent']?>" />
                        <button class="btn btn-info"><?=$resultadoDaChamada['agent']?></button>
                      </form>
                      <?php
                    }
                    ?>
                  </td>
                  <!-- FIM AGENT -->

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
                    ?><p><?=$calltime?></p>
                  </td>
                  <!-- FIM CALLTIME -->

                  <!-- NÚMERO DO CLIENTE -->
                  <td>
                    <p><?=$numeroDoCliente?></p>
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

  </center>
  <?php include("rodape.php"); ?>
  </html>
