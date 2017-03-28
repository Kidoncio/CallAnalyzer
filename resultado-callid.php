<?php $titlePage = "Histórico do Call ID"; ?>
<?php include("cabecalho.php"); ?>
<?php include("conecta.php"); ?>

<center>
  <!-- INÍCIO ATRELAR CALL ID NO MYSQL -->
  <?php
  $callid = $_POST['callid'];

  $resultado = mysqli_query($conexao, "SELECT * FROM queue_log where callid = '$callid' order by time");

  ?>
  <!-- FIM ATRELAR CALL ID NO MYSQL -->

  <!-- INÍCIO IMPRESSÃO DOS RESULTADOS DA BUSCA NA TABELA -->
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_content">
      <div class="col-md-2 col-sm-2 col-xs-2">
      </div>
      <div class="cold-md-10 col-sm-10 col-xs-10">
        <center>
          <h3>Histórico do Call ID</h3>
          <h3><small>Call ID Pesquisado: <?=$callid?></small></h3>
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

                    <!-- INÍCIO CALL ID -->
                    <td><?= $chamadas['callid'] ?></td>
                    <!-- FIM CALL ID -->

                    <!-- INÍCIO TRADUÇÃO DO EVENTO -->
                    <td>
                      <?php
                      if($chamadas['event'] == 'ABANDON'){
                        $calltime = $chamadas['data3'];
                        $event = 'ABANDONADA'; ?>
                        <p class="text-danger"><?=$event?></p>
                        <?php
                      }
                      else if($chamadas['event'] == 'DID'){
                        $event = 'LIGAÇÃO'; ?>
                        <p class="text-info"><?=$event?></p>
                        <?php
                      }
                      else if($chamadas['event'] == 'ENTERQUEUE'){
                        $event = 'ENTROU NA FILA';  ?>
                        <p class="text-info"><?=$event?></p>
                        <?php
                      }
                      else if($chamadas['event'] == 'RINGNOANSWER'){
                        $event = 'CHAMADA SEM RESPOSTA'; ?>
                        <p class="text-info"><?=$event?></p>
                        <?php
                      }
                      else if($chamadas['event'] == 'EXITWITHTIMEOUT'){
                        $calltime = $chamadas['data3'];
                        $event = 'CLIENTE NÃO ATENDIDO'; ?>
                        <p class="text-danger"><?=$event?></p>
                        <?php
                      }
                      else if($chamadas['event'] == 'CONNECT'){
                        $calltime = $chamadas['data1'];
                        $event = 'LIGAÇÃO ATENDIDA'; ?>
                        <p class="text-success"><?=$event?></p>
                        <?php
                      }
                      else if($chamadas['event'] == 'COMPLETEAGENT'){
                        $calltime = $chamadas['data2'];
                        $event = 'ATENDENTE DESLIGOU'; ?>
                        <p class="text-primary"><?=$event?></p>
                        <?php
                      }
                      else if($chamadas['event'] == 'COMPLETECALLER'){
                        $calltime = $chamadas['data2'];
                        $event = 'CLIENTE DESLIGOU'; ?>
                        <p class="text-primary"><?=$event?></p>
                        <?php
                      }
                      else if($chamadas['event'] == 'TRANSFER'){
                        $calltime = $chamadas['data4'];
                        $event = 'TRANSFERIDA'; ?>
                        <p class="text-info"><?=$event?></p>
                        <?php
                      }
                      else if($chamadas['event'] == 'EXITEMPTY'){
                        $calltime = $chamadas['data4'];
                        $event = 'NÃO FOI POSSÍVEL EFETUAR A LIGAÇÃO'; ?>
                        <p class="text-warning"><?=$event?></p>
                        <?php
                      }
                      else{ ?>
                        <p class="text-primary"><?=$chamadas['event']?></p>
                        <?php
                      }
                      ?>
                    </td>
                    <!-- FIM TRADUÇÃO DO EVENTO -->

                    <!-- INÍCIO AGENT -->
                    <td>
                      <?php if($chamadas['event'] == 'CONNECT'){
                        $agent = $chamadas['agent'];
                      } elseif($chamadas['agent'] == 'NONE'){
                        $agent = '';
                      }
                      if($agent != ''){ ?>
                        <form action="resultado-agent.php" method="post">
                          <input type="hidden" name="agentid" value="<?=$agent?>" />
                          <button class="btn btn-info"><?=$agent?></button>
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
