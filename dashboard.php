<?php $titlePage = "Dashboard"; ?>
<?php include("cabecalho.php"); ?>
<?php include("conecta.php"); ?>

<!-- INÍCIO OBTENÇÃO DE DADOS REFERENTES AOS 7 ÚLTIMOS DIAS -->
<!-- INÍCIO DADOS NAS ÚLTIMAS 24 HORAS -->
<!-- INÍCIO OBTER TOTAL CHAMADOS NAS ÚLTIMAS 24 HORAS -->
<?php
$ultimoDiaDivididoPor2 = mysqli_query($conexao, "SELECT COUNT(*) AS atendidasultimodia FROM queue_log WHERE (time >= DATE_SUB(), INTERVAL 1 DAY))");
$ultimoDiaDivididoPor2 = mysqli_fetch_assoc($ultimoDiaDivididoPor2);
$ultimoDiaDivididoPor2 = $ultimoDiaDivididoPor2['atendidasultimodia'];
$ultimoDiaDivididoPor2 = $ultimoDiaDivididoPor2 / 2;
?>
<!-- INÍCIO OBTER TOTAL CHAMADOS NAS ÚLTIMAS 24 HORAS -->


<!-- INÍCIO OBTER LISTA DE AGENTS -->
<?php
$contagemAgentsEmAtendimento = 0;
$agentsDisponivel = 0;
$resultadoListaAgents = mysqli_query($conexao, "SELECT agent,COUNT(*) FROM queue_log WHERE DATE(time) = CURDATE() AND agent != 'NONE' GROUP BY agent");
while($agentid = mysqli_fetch_assoc($resultadoListaAgents)){
    $numeroSIP = $agentid['agent'];
    $agentsEmAtendimento = mysqli_query($conexao, "SELECT event FROM queue_log WHERE DATE(time) = CURDATE() AND agent = '$numeroSIP' AND (event = 'CONNECT' OR event = 'TRANSFER' OR event = 'COMPLETEAGENT' OR event = 'COMPLETECALLER') ORDER BY time DESC LIMIT 1");
    $agentsEmAtendimento = mysqli_fetch_assoc($agentsEmAtendimento);
    $agentsEmAtendimento = $agentsEmAtendimento['event'];
    if($agentsEmAtendimento == 'CONNECT'){
      $contagemAgentsEmAtendimento = $contagemAgentsEmAtendimento + 1;
    }else{
      $agentsDisponivel = $agentsDisponivel + 1;
    }
}
?>
<!-- FIM OBTER LISTA DE AGENTS -->

<!-- INÍCIO OBTER CHAMADOS NESSE MOMENTO -->
<?php
$ligacoesnow = mysqli_query($conexao, "SELECT COUNT(*) AS ligacoes FROM queue_log WHERE DATE(time) = NOW() AND (event = 'ENTERQUEUE' OR event = 'DID' OR event = 'RINGNOANSWER')");
$ligacoesnow = mysqli_fetch_assoc($ligacoesnow);
$ligacoesnow = $ligacoesnow['ligacoes'];
?>
<!-- FIM OBTER CHAMADOS NESSE MOMENTO -->
<!-- FIM DADOS NAS ÚLTIMAS 24 HORAS -->


<!-- INÍCIO DADOS HOJE -->
<!-- INÍCIO OBTER CHAMADOS ATENDIDOS HOJE -->
<?php
$atendidasHoje = mysqli_query($conexao, "SELECT COUNT(*) AS atendidas FROM queue_log WHERE DATE(time) = CURDATE() AND (event = 'CONNECT')");
$atendidasHoje = mysqli_fetch_assoc($atendidasHoje);
$atendidasHoje = $atendidasHoje['atendidas'];
?>
<!-- FIM OBTER CHAMADOS ATENDIDOS HOJE -->

<!-- INÍCIO OBTER CHAMADOS NÃO ATENDIDOS HOJE -->
<?php
$natendidasHoje = mysqli_query($conexao, "SELECT COUNT(*) AS naoatendidas FROM queue_log WHERE DATE(time) = CURDATE() AND ((event = 'ABANDON') OR (event = 'EXITWITHTIMEOUT'))");
$natendidasHoje = mysqli_fetch_assoc($natendidasHoje);
$natendidasHoje = $natendidasHoje['naoatendidas'];
?>
<!-- FIM OBTER CHAMADOS NÃO ATENDIDOS HOJE -->
<!-- FIM DADOS HOJE -->


<!-- INÍCIO DADOS DIA -1 -->
<!-- INÍCIO OBTER CHAMADOS ATENDIDOS DIA -1 -->
<?php
$atendidasDiaMenos1 = mysqli_query($conexao, "SELECT COUNT(*) AS atendidas FROM queue_log WHERE DATE(time) = (CURDATE() - 1) AND (event = 'CONNECT')");
$atendidasDiaMenos1 = mysqli_fetch_assoc($atendidasDiaMenos1);
$atendidasDiaMenos1 = $atendidasDiaMenos1['atendidas'];
?>
<!-- FIM OBTER CHAMADOS ATENDIDOS DIA -1 -->

<!-- INÍCIO OBTER CHAMADOS NÃO ATENDIDOS DIA -1 -->
<?php
$natendidasDiaMenos1 = mysqli_query($conexao, "SELECT COUNT(*) AS naoatendidas FROM queue_log WHERE DATE(time) = (CURDATE() - 1) AND ((event = 'ABANDON') OR (event = 'EXITWITHTIMEOUT'))");
$natendidasDiaMenos1 = mysqli_fetch_assoc($natendidasDiaMenos1);
$natendidasDiaMenos1 = $natendidasDiaMenos1['naoatendidas'];
?>
<!-- FIM OBTER CHAMADOS NÃO ATENDIDOS DIA -1 -->
<!-- FIM DADOS DIA -1 -->


<!-- INÍCIO DADOS DIA -2 -->
<!-- INÍCIO OBTER CHAMADOS ATENDIDOS DIA -2 -->
<?php
$atendidasDiaMenos2 = mysqli_query($conexao, "SELECT COUNT(*) AS atendidas FROM queue_log WHERE DATE(time) = (CURDATE() - 2) AND (event = 'CONNECT')");
$atendidasDiaMenos2 = mysqli_fetch_assoc($atendidasDiaMenos2);
$atendidasDiaMenos2 = $atendidasDiaMenos2['atendidas'];
?>
<!-- FIM OBTER CHAMADOS ATENDIDOS DIA -2 -->

<!-- INÍCIO OBTER CHAMADOS NÃO ATENDIDOS DIA -2 -->
<?php
$natendidasDiaMenos2 = mysqli_query($conexao, "SELECT COUNT(*) AS naoatendidas FROM queue_log WHERE DATE(time) = (CURDATE() - 2) AND ((event = 'ABANDON') OR (event = 'EXITWITHTIMEOUT'))");
$natendidasDiaMenos2 = mysqli_fetch_assoc($natendidasDiaMenos2);
$natendidasDiaMenos2 = $natendidasDiaMenos2['naoatendidas'];
?>
<!-- FIM OBTER CHAMADOS NÃO ATENDIDOS DIA -2 -->
<!-- FIM DADOS DIA -2 -->


<!-- INÍCIO DADOS DIA -3 -->
<!-- INÍCIO OBTER CHAMADOS ATENDIDOS DIA -3 -->
<?php
$atendidasDiaMenos3 = mysqli_query($conexao, "SELECT COUNT(*) AS atendidas FROM queue_log WHERE DATE(time) = (CURDATE() - 3) AND (event = 'CONNECT')");
$atendidasDiaMenos3 = mysqli_fetch_assoc($atendidasDiaMenos3);
$atendidasDiaMenos3 = $atendidasDiaMenos3['atendidas'];
?>
<!-- FIM OBTER CHAMADOS ATENDIDOS DIA -3 -->

<!-- INÍCIO OBTER CHAMADOS NÃO ATENDIDOS DIA -3 -->
<?php
$natendidasDiaMenos3 = mysqli_query($conexao, "SELECT COUNT(*) AS naoatendidas FROM queue_log WHERE DATE(time) = (CURDATE() - 3) AND ((event = 'ABANDON') OR (event = 'EXITWITHTIMEOUT'))");
$natendidasDiaMenos3 = mysqli_fetch_assoc($natendidasDiaMenos3);
$natendidasDiaMenos3 = $natendidasDiaMenos3['naoatendidas'];
?>
<!-- FIM OBTER CHAMADOS NÃO ATENDIDOS DIA -3 -->
<!-- FIM DADOS DIA -3 -->


<!-- INÍCIO DADOS DIA -4 -->
<!-- INÍCIO OBTER CHAMADOS ATENDIDOS DIA -4 -->
<?php
$atendidasDiaMenos4 = mysqli_query($conexao, "SELECT COUNT(*) AS atendidas FROM queue_log WHERE DATE(time) = (CURDATE() - 4) AND (event = 'CONNECT')");
$atendidasDiaMenos4 = mysqli_fetch_assoc($atendidasDiaMenos4);
$atendidasDiaMenos4 = $atendidasDiaMenos4['atendidas'];
?>
<!-- FIM OBTER CHAMADOS ATENDIDOS DIA -4 -->

<!-- INÍCIO OBTER CHAMADOS NÃO ATENDIDOS DIA -4 -->
<?php
$natendidasDiaMenos4 = mysqli_query($conexao, "SELECT COUNT(*) AS naoatendidas FROM queue_log WHERE DATE(time) = (CURDATE() - 4) AND ((event = 'ABANDON') OR (event = 'EXITWITHTIMEOUT'))");
$natendidasDiaMenos4 = mysqli_fetch_assoc($natendidasDiaMenos4);
$natendidasDiaMenos4 = $natendidasDiaMenos4['naoatendidas'];
?>
<!-- FIM OBTER CHAMADOS NÃO ATENDIDOS DIA -4 -->
<!-- FIM DADOS DIA -4 -->


<!-- INÍCIO DADOS DIA -5 -->
<!-- INÍCIO OBTER CHAMADOS ATENDIDOS DIA -5 -->
<?php
$atendidasDiaMenos5 = mysqli_query($conexao, "SELECT COUNT(*) AS atendidas FROM queue_log WHERE DATE(time) = (CURDATE() - 5) AND (event = 'CONNECT')");
$atendidasDiaMenos5 = mysqli_fetch_assoc($atendidasDiaMenos5);
$atendidasDiaMenos5 = $atendidasDiaMenos5['atendidas'];
?>
<!-- FIM OBTER CHAMADOS ATENDIDOS DIA -5 -->

<!-- INÍCIO OBTER CHAMADOS NÃO ATENDIDOS DIA -5 -->
<?php
$natendidasDiaMenos5 = mysqli_query($conexao, "SELECT COUNT(*) AS naoatendidas FROM queue_log WHERE DATE(time) = (CURDATE() - 5) AND ((event = 'ABANDON') OR (event = 'EXITWITHTIMEOUT'))");
$natendidasDiaMenos5 = mysqli_fetch_assoc($natendidasDiaMenos5);
$natendidasDiaMenos5 = $natendidasDiaMenos5['naoatendidas'];
?>
<!-- FIM OBTER CHAMADOS NÃO ATENDIDOS DIA -5 -->
<!-- FIM DADOS DIA -5 -->


<!-- INÍCIO DADOS DIA -6 -->
<!-- INÍCIO OBTER CHAMADOS ATENDIDOS DIA -6 -->
<?php
$atendidasDiaMenos6 = mysqli_query($conexao, "SELECT COUNT(*) AS atendidas FROM queue_log WHERE DATE(time) = (CURDATE() - 6) AND (event = 'CONNECT')");
$atendidasDiaMenos6 = mysqli_fetch_assoc($atendidasDiaMenos6);
$atendidasDiaMenos6 = $atendidasDiaMenos6['atendidas'];
?>
<!-- FIM OBTER CHAMADOS ATENDIDOS DIA -6 -->

<!-- INÍCIO OBTER CHAMADOS NÃO ATENDIDOS DIA -6 -->
<?php
$natendidasDiaMenos6 = mysqli_query($conexao, "SELECT COUNT(*) AS naoatendidas FROM queue_log WHERE DATE(time) = (CURDATE() - 6) AND ((event = 'ABANDON') OR (event = 'EXITWITHTIMEOUT'))");
$natendidasDiaMenos6 = mysqli_fetch_assoc($natendidasDiaMenos6);
$natendidasDiaMenos6 = $natendidasDiaMenos6['naoatendidas'];
?>
<!-- FIM OBTER CHAMADOS NÃO ATENDIDOS DIA -6 -->
<!-- FIM DADOS DIA -6 -->
<!-- FIM OBTENÇÃO DE DADOS REFERENTES AOS 7 ÚLTIMOS DIAS -->


<!-- INÍCIO LISTA DE DIAS GRAVADOS -->
<?php
$lista7days = mysqli_query($conexao, "SELECT * FROM  (select adddate('1970-01-01',t4.i*10000 + t3.i*1000 + t2.i*100 + t1.i*10 + t0.i) listadedatas FROM  (select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t0,  (select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t1,  (select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t2,  (select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t3,  (select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t4) v WHERE listadedatas BETWEEN (NOW() - INTERVAL 7 DAY) AND NOW()");
$resultadoLista7days = mysqli_fetch_assoc($lista7days);
$resultadoLista = $resultadoLista7days['listadedatas'];
$printData = date('Y, m, d', strtotime($resultadoLista));
$rowData = mysqli_fetch_row($lista7days);
?>
<!-- FIM LISTA DE DIAS GRAVADOS -->

<!-- INÍCIO OBTENÇÃO DA MÉDIA DE TEMPO DE ESPERA PARA O ABANDONO -->
<?php
$mediaAbandono = mysqli_query($conexao, "SELECT AVG(data3) FROM queue_log where data3 > '0' AND event = 'ABANDON' ORDER BY data3 ASC LIMIT 50");
$mediaAbandono = mysqli_fetch_assoc($mediaAbandono);
$mediaAbandono = $mediaAbandono['AVG(data3)'];
?>
<!-- FIM OBTENÇÃO DA MÉDIA DE TEMPO DE ESPERA PARA O ABANDONO -->

<!-- INÍCIO OBTENÇÃO DA MÉDIA DE TEMPO DE ESPERA PARA O ATENDIMENTO -->
<?php
$mediaAtendimento = mysqli_query($conexao, "SELECT AVG(data3) FROM queue_log WHERE data3 > '0' AND event = 'CONNECT' ORDER BY data3 ASC LIMIT 50");
$mediaAtendimento = mysqli_fetch_assoc($mediaAtendimento);
$mediaAtendimento = $mediaAtendimento['AVG(data3)'];
?>
<!-- FIM OBTENÇÃO DA MÉDIA DE TEMPO DE ESPERA PARA O ATENDIMENTO -->



<!-- page content -->
<div class="right_col" role="main">

  <!-- top tiles -->
  <center>
    <div class="row tile_count">

      <!-- INÍCIO EXIBIÇÃO DA MÉDIA DE ESPERA PARA O ABANDONO -->
      <div class="col-md-6 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-user-times "></i> Tempo médio para o abandono</span>
        <?php
        if(intval($mediaAbandono) > 1){
          $mediaAbandono = intval($mediaAbandono);
          $mediaAbandono = "$mediaAbandono s";
        }else{
          $mediaAbandono = "DADO NÃO DISPONÍVEL";
        }
        ?>
        <div class="count red"><?=$mediaAbandono?></div>
      </div>
      <!-- FIM EXIBIÇÃO DA MÉDIA DE ESPERA PARA O ABANDONO -->


      <!-- INÍCIO EXIBIÇÃO DA MÉDIA DE ESPERA PARA O ATENDIMENTO -->
      <div class="col-md-6 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-clock-o"></i> Tempo médio para atendimento</span>
        <?php
        if(intval($mediaAtendimento) >= 20){
          $mediaAtendimento = intval($mediaAtendimento);
          $mediaAtendimento = "$mediaAtendimento s";
          ?>
          <div class="count red"><?=$mediaAtendimento?></div>
          <?php
        }
        else if(intval($mediaAtendimento) >= 10 && intval($mediaAtendimento) < 20){
          $mediaAtendimento = intval($mediaAtendimento);
          $mediaAtendimento = "$mediaAtendimento s";
          ?>
          <div class="count orange"><?=$mediaAtendimento?></div>
          <?php
        }
        else if(intval($mediaAtendimento) > 0 && intval($mediaAtendimento) < 10){
          $mediaAtendimento = intval($mediaAtendimento);
          $mediaAtendimento = "$mediaAtendimento s";
          ?>
          <div class="count green"><?=$mediaAtendimento?></div>
          <?php
        }else{
          $mediaAtendimento = "DADO NÃO DISPONÍVEL";
          ?>
          <?php
        }
        ?>
      </div>
      <!-- FIM EXIBIÇÃO DA MÉDIA DE ESPERA PARA O ATENDIMENTO -->

    </center>
    <!-- /top tiles -->

    <!-- INÍCIO GRÁFICO 7 ÚLTIMOS DIAS -->
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="dashboard_graph x_panel">
          <div class="row x_title">
            <div class="col-md-6">
              <h3>Ligações Recebidas <small>Últimos 7 Dias</small></h3>
            </div>
          </div>
          <div class="x_content">
            <div id="placeholder33" style="height: 260px; display: none" class="demo-placeholder"></div>
            <div style="width: 100%;">
              <div id="grafico7dias" class="demo-placeholder" style="width: 100%; height:270px;"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- FIM GRÁFICO 7 ÚLTIMOS DIAS -->


    <!-- INÍCIO GRÁFICO DONNUTS -->
    <div class="col-md-7 col-sm-7 col-xs-7">
      <div class="x_panel tile fixed_height_320 overflow_hidden">
        <div class="x_title">
          <h3>Ligações Recebidas <small>Hoje</small></h3>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
            <li><a class="close-link"><i class="fa fa-close"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <table class="" style="width:100%">
            <tr>
              <th style="width:50%;">
              </th>
              <th>
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                  <p class="">Evento</p>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                  <p class="">Qtde</p>
                </div>
              </th>
            </tr>
            <tr>
              <td>
                <center>
                  <canvas id="canvas1" height="160" width="160" style="margin: 15px 10px 10px 0"></canvas>
                </center>
              </td>
              <td>
                <table class="tile_info">
                  <tr>
                    <td>
                      <p><i class="fa fa-square green"></i>Atendidas </p>
                    </td>
                    <td><p><?= $atendidasHoje ?></p></td>
                  </tr>
                  <tr>
                    <td>
                      <p><i class="fa fa-square red"></i>Não Atendidas </p>
                    </td>
                    <td><?= $natendidasHoje ?></td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </div>
      </div>
    </br>
  </br>
</br>
</br>
</br>
</div>
<!-- FIM GRÁFICO DONNUTS -->


<!-- INÍCIO BOX LIGAÇÕES ESPERANDO ATENDIMENTO -->
<div class="col-md-5 col-sm-5 col-xs-5">
  <div class="row">
    <?php
    if($ligacoesnow >= 2){
      ?>
      <div class="small-box bg-red">
        <center>
          <h1><?=$ligacoesnow?></h1>

          <h3><i class="fa fa-clock-o"></i> Esperando Atendimento</h3>
        </center>
      </div>
      <?php
    }else{
      ?>
      <div class="small-box bg-green">
        <center>
          <h1><?=$ligacoesnow?></h1>

          <h3><i class="fa fa-clock-o"></i> Esperando Atendimento</h3>
        </center>
      </div>
      <?php
    }
    ?>
  </div>

  <div class="row">
    <?php
    if($contagemAgentsEmAtendimento >= 4){
      ?>
      <div class="small-box bg-red">
        <center>
          <h1><?=$contagemAgentsEmAtendimento?></h1>

          <h3><i class="fa fa-phone"></i> Agents Em Atendimento</h3>
        </center>
      </div>
      <?php
    }else{
      ?>
      <div class="small-box bg-green">
        <center>
          <h1><?=$contagemAgentsEmAtendimento?></h1>

          <h3><i class="fa fa-phone"></i> Agents Em Atendimento</h3>
        </center>
      </div>
      <?php
    }
    ?>
  </div>

  <div class="row">
    <?php
    if($agentsDisponivel <= 1){
      ?>
      <div class="small-box bg-red">
        <center>
          <h1><?=$agentsDisponivel?></h1>

          <h3><i class="fa fa-phone"></i> Agents Disponíveis</h3>
        </center>
      </div>
      <?php
    }else{
      ?>
      <div class="small-box bg-green">
        <center>
          <h1><?=$agentsDisponivel?></h1>

          <h3><i class="fa fa-phone"></i> Agents Disponíveis</h3>
        </center>
      </div>
      <?php
    }
    ?>
  </div>
</div>
<!-- FIM BOX LIGAÇÕES ESPERANDO ATENDIMENTO -->


</div>
<!-- /page content -->




<?php include("rodape.php"); ?>
