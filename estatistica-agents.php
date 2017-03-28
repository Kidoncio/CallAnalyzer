<?php $titlePage = "Estatística dos Agents"; ?>
<?php include("cabecalho.php"); ?>
<?php include("conecta.php"); ?>


<!-- INÍCIO OBTER LISTA DE AGENTS -->
<?php
$resultadoListaAgents = mysqli_query($conexao, "SELECT agent,COUNT(*) FROM queue_log WHERE agent != 'NONE' GROUP BY agent");
$agentid = mysqli_fetch_assoc($resultadoListaAgents);
?>
<!-- FIM OBTER LISTA DE AGENTS -->

<!-- page content -->
<div class="right_col" role="main">

  <br />

    <div class="x_content">
      <div class="col-md-2 col-sm-2 col-xs-2">
      </div>
      <div class="cold-md-10 col-sm-10 col-xs-10">
        <center>
          <h3>Estatísticas dos Agents</h3>
        </center>
      </div>
    </div>

    <!-- INÍCIO IMPRESSÃO DOS RESULTADOS DA BUSCA NA TABELA -->
    <div class="clearfix"></div>
    <div class="col-md-2 col-sm-2 col-xs-2">
    </div>
    <div class="col-md-10 col-sm-10 col-xs-10">
      <div class="x_panel">
        <div class="x_title">
          <div class="table-responsive">
            <table class="table table-striped jambo_table bulk_action">
              <thead>
                <tr class="headings">
                  <th class="column-title">Agent</th>
                  <th class="column-title">Estatísticas</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $bestMediaAtendimento = 1000000;
                $qtdeAtendimentoMes = 0;
                while($agentid = mysqli_fetch_assoc($resultadoListaAgents)){ ?>

                  <!-- INÍCIO OBTER MÉDIA DE TEMPO DE ATENDIMENTO -->
                  <?php
                  $numeroSIP = $agentid['agent'];
                  $resultadoMediaAgentAtendimento = mysqli_query($conexao, "SELECT AVG(data1) FROM queue_log WHERE data1 > '0' AND (event = 'COMPLETEAGENT' OR event = 'COMPLETECALLER') AND agent = '$numeroSIP' ORDER BY time ASC LIMIT 20");
                  $resultadoAgentAtendimento = mysqli_fetch_assoc($resultadoMediaAgentAtendimento);
                  $mediaAgentAtendimento = $resultadoAgentAtendimento['AVG(data1)'];
                  if($mediaAgentAtendimento > 0){
                    if($bestMediaAtendimento > $mediaAgentAtendimento){
                      $bestMediaAtendimento = $mediaAgentAtendimento;
                      $bestMediaAtendimentoSIP = $numeroSIP;
                    }
                  }
                  ?>
                  <!-- FIM OBTER MÉDIA DE TEMPO DE ATENDIMENTO -->

                  <!-- INÍCIO OBTER CHAMADOS NO ÚLTIMO MÊS -->
                  <?php
                  $resultadoAtendimentoUltimoMes = mysqli_query($conexao, "SELECT COUNT(*) AS ultimomes FROM queue_log WHERE (time >= DATE_SUB(NOW(), INTERVAL 1 MONTH)) AND (agent = '$numeroSIP') AND (event = 'CONNECT')");
                  $resultadoUltimoMes = mysqli_fetch_assoc($resultadoAtendimentoUltimoMes);
                  $ultimoMes = $resultadoUltimoMes['ultimomes'];

                  if($ultimoMes > $qtdeAtendimentoMes){
                    $qtdeAtendimentoMes = $ultimoMes;
                    $bestQtdeAtendimentos = $numeroSIP;
                  }
                  ?>
                  <!-- FIM OBTER CHAMADOS NO ÚLTIMO MÊS -->

                  <!-- INÍCIO OBTER CHAMADOS NAS ÚLTIMAS 24 HORAS -->
                  <?php
                  $resultadoAtendimentoUltimoDia = mysqli_query($conexao, "SELECT COUNT(*) AS ultimodia FROM queue_log WHERE (time >= DATE_SUB(NOW(), INTERVAL 1 DAY)) AND (agent = '$numeroSIP') AND (event = 'CONNECT')");
                  $resultadoUltimoDia = mysqli_fetch_assoc($resultadoAtendimentoUltimoDia);
                  $ultimoDia = $resultadoUltimoDia['ultimodia'];
                  ?>
                  <!-- FIM OBTER CHAMADOS NAS ÚLTIMAS 24 HORAS -->

                  <!-- INÍCIO OBTER CHAMADOS NA ÚLTIMA HORA -->
                  <?php
                  $resultadoAtendimentoUltimaHora = mysqli_query($conexao, "SELECT COUNT(*) AS ultimahora FROM queue_log WHERE (time >= DATE_SUB(NOW(), INTERVAL 1 HOUR)) AND (agent = '$numeroSIP') AND (event = 'CONNECT')");
                  $resultadoUltimaHora = mysqli_fetch_assoc($resultadoAtendimentoUltimaHora);
                  $ultimaHora = $resultadoUltimaHora['ultimahora'];
                  ?>
                  <!-- FIM OBTER CHAMADOS NAS ÚLTIMA HORA -->

                  <tr>
                    <td>
                      <form action="resultado-agent.php" method="post">
                        <input type="hidden" name="agentid" value="<?=$numeroSIP?>" />
                        <button class="btn btn-primary"><?=$numeroSIP?></button>
                      </form>
                    </td>
                    <td>
                      <?php
                      if(intval($mediaAgentAtendimento) > 0){ ?>
                        <p><b>Média Tempo de Atendimento:</b> <?=intval($mediaAgentAtendimento)?> segundos</p>
                        <?php
                      }
                      if(intval($ultimoDia) > 2){ ?>
                        <p><b>Atendimentos nas últimas 24 horas:</b> <?=intval($ultimoDia)?> atendimentos</p>
                        <?php
                      }
                      else{ ?>
                        <p><b>Nenhum Atendimento nas últimas 24 horas</b></p>
                        <?php
                      }
                      if(intval($ultimaHora) > 2){ ?>
                        <p><b>Atendimentos na última hora:</b> <?=intval($ultimaHora)?> atendimentos</p>
                        <?php
                      }
                      ?>
                    </td>
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
    <!-- top tiles -->
    <center>
      <div class="row tile_count">

        <!-- INÍCIO EXIBIÇÃO DO AGENT COM MAIOR QUANTIDADE DE ATENDIMENTO NO ÚLTIMO MÊS -->
        <div class="col-md-6 col-sm-4 col-xs-6 tile_stats_count">
          <span class="count_top"><i class="fa fa-user-times "></i> Maior Quantidade de Atendimento no Mês</span>
          <div class="count green"><?=$bestQtdeAtendimentos?></div>
          <div class="count green"><?=$qtdeAtendimentoMes?></div>
        </div>
        <!-- FIM EXIBIÇÃO DO AGENT COM MAIOR QUANTIDADE DE ATENDIMENTO NO ÚLTIMO MÊS -->

        <!-- INÍCIO EXIBIÇÃO DO AGENT COM MAIOR QUANTIDADE DE ATENDIMENTO NO ÚLTIMO MÊS -->
        <div class="col-md-6 col-sm-4 col-xs-6 tile_stats_count">
          <span class="count_top"><i class="fa fa-user-times "></i> Melhor Média de Tempo Atendimento</span>
          <div class="count green"><?=$bestMediaAtendimentoSIP?></div>
          <div class="count green"><?=intval($bestMediaAtendimento)?> s</div>
        </div>
        <!-- FIM EXIBIÇÃO DO AGENT COM MAIOR QUANTIDADE DE ATENDIMENTO NO ÚLTIMO MÊS -->
      </div>
    </center>
    <!-- /top tiles -->
  <!-- /page content -->




  <?php include("rodape.php"); ?>
