</div>
<!-- footer content -->
<footer>
  <div class="pull-right">
    Call Analyzer
  </div>
  <div class="clearfix"></div>
</footer>
<!-- /footer content -->
</div>
</div>

<!-- INÍCIO REFERENTE AO LOGIN -->
<script src="js/login.js"></script>
<!-- FIM REFERENTE AO LOGIN -->

<!-- DATATABLES -->
<script src="cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>

<!-- jQuery -->
<script src="vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="vendors/fastclick/lib/fastclick.js"></script>
<!-- NProgress -->
<script src="vendors/nprogress/nprogress.js"></script>
<!-- Chart.js -->
<script src="vendors/Chart.js/dist/Chart.min.js"></script>
<!-- gauge.js -->
<script src="vendors/gauge.js/dist/gauge.min.js"></script>
<!-- bootstrap-progressbar -->
<script src="vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
<!-- iCheck -->
<script src="vendors/iCheck/icheck.min.js"></script>
<!-- Skycons -->
<script src="vendors/skycons/skycons.js"></script>
<!-- Flot -->
<script src="vendors/Flot/jquery.flot.js"></script>
<script src="vendors/Flot/jquery.flot.pie.js"></script>
<script src="vendors/Flot/jquery.flot.time.js"></script>
<script src="vendors/Flot/jquery.flot.stack.js"></script>
<script src="vendors/Flot/jquery.flot.resize.js"></script>
<!-- Flot plugins -->
<script src="vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
<script src="vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
<script src="vendors/flot.curvedlines/curvedLines.js"></script>
<!-- DateJS -->
<script src="vendors/DateJS/build/date.js"></script>
<!-- JQVMap -->
<script src="vendors/jqvmap/dist/jquery.vmap.js"></script>
<script src="vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
<script src="vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
<!-- bootstrap-daterangepicker -->
<script src="vendors/moment/min/moment.min.js"></script>
<script src="vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

<!-- Custom Theme Scripts -->
<script src="build/js/custom.min.js"></script>

<!-- INÍCIO DATA INICIAL -->
<script>
$(document).ready(function() {
  $('#data_inicial').daterangepicker({
    singleDatePicker: true,
    minDate: '23/11/2016',
    maxDate: moment(),
    locale: {
      format: 'DD/MM/YYYY',
      applyLabel: 'Concluir',
      cancelLabel: 'Limpar',
      fromLabel: 'De',
      toLabel: 'Até',
      customRangeLabel: 'Custom',
      daysOfWeek: ['Do', 'Se', 'Te', 'Qu', 'Qu', 'Se', 'Sa'],
      monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
      firstDay: 1
    }
  }, function(start, end, label) {
    console.log(start.toISOString(), end.toISOString(), label);
  });
});
</script>
<!-- FIM DATA INICIAL -->


<!-- INÍCIO DATA FINAL -->
<script>
$(document).ready(function() {
  $('#data_final').daterangepicker({
    singleDatePicker: true,
    minDate: '23/11/2016',
    maxDate: moment(),
    locale: {
      format: 'DD/MM/YYYY',
      applyLabel: 'Concluir',
      cancelLabel: 'Limpar',
      fromLabel: 'De',
      toLabel: 'Até',
      customRangeLabel: 'Custom',
      daysOfWeek: ['Do', 'Se', 'Te', 'Qu', 'Qu', 'Se', 'Sa'],
      monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
      firstDay: 1
    }
  }, function(start, end, label) {
    console.log(start.toISOString(), end.toISOString(), label);
  });
});
</script>
<!-- FIM DATA FINAL -->


<!-- bootstrap-daterangepicker -->
<script type="text/javascript">
$(document).ready(function() {

  var cb = function(start, end, label) {
    console.log(start.toISOString(), end.toISOString(), label);
    $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
  };

  var optionSet1 = {
    startDate: moment().subtract(29, 'days'),
    endDate: moment(),
    minDate: '23/11/2016',
    dateLimit: {
      days: 60
    },
    showDropdowns: true,
    showWeekNumbers: true,
    timePicker: false,
    timePickerIncrement: 1,
    timePicker12Hour: true,
    ranges: {
      'Hoje': [moment(), moment()],
      'Ontem': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
      'Últimos 7 Dias': [moment().subtract(6, 'days'), moment()],
      'Últimos 30 Dias': [moment().subtract(29, 'days'), moment()],
      'This Month': [moment().startOf('month'), moment().endOf('month')],
      'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    },
    opens: 'left',
    buttonClasses: ['btn btn-default'],
    applyClass: 'btn-small btn-primary',
    cancelClass: 'btn-small',
    separator: ' to ',
    locale: {
      format: 'DD/MM/YYYY',
      applyLabel: 'Concluir',
      cancelLabel: 'Limpar',
      fromLabel: 'De',
      toLabel: 'Até',
      customRangeLabel: 'Custom',
      daysOfWeek: ['Do', 'Se', 'Te', 'Qu', 'Qu', 'Se', 'Sa'],
      monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
      firstDay: 1
    }
  };
  $('#saveBtn').click(function(){
    console.log(startDate.format('D MMMM YYYY') + ' - ' + endDate.format('D MMMM YYYY'));
  });
  $('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
  $('#reportrange').daterangepicker(optionSet1, cb);
  $('#reportrange').on('show.daterangepicker', function() {
    console.log("show event fired");
  });
  $('#reportrange').on('hide.daterangepicker', function() {
    console.log("hide event fired");
  });
  $('#reportrange').on('apply.daterangepicker', function(ev, picker) {
    console.log("apply event fired, start/end dates are " + picker.startDate.format('MMMM D, YYYY') + " to " + picker.endDate.format('MMMM D, YYYY'));
  });
  $('#reportrange').on('cancel.daterangepicker', function(ev, picker) {
    console.log("cancel event fired");
  });
  $('#options1').click(function() {
    $('#reportrange').data('daterangepicker').setOptions(optionSet1, cb);
  });
  $('#options2').click(function() {
    $('#reportrange').data('daterangepicker').setOptions(optionSet2, cb);
  });
  $('#destroy').click(function() {
    $('#reportrange').data('daterangepicker').remove();
  });
});
</script>
<!-- /bootstrap-daterangepicker -->

<!-- INÍCIO GRÁFICO ÚLTIMOS 7 DIAS -->
<script>
$(document).ready(function() {
  var data1 = [
    [(moment().subtract(6, 'days')), "<?=$atendidasDiaMenos6?>"],
    [(moment().subtract(5, 'days')), "<?=$atendidasDiaMenos5?>"],
    [(moment().subtract(4, 'days')), "<?=$atendidasDiaMenos4?>"],
    [(moment().subtract(3, 'days')), "<?=$atendidasDiaMenos3?>"],
    [(moment().subtract(2, 'days')), "<?=$atendidasDiaMenos2?>"],
    [(moment().subtract(1, 'days')), "<?=$atendidasDiaMenos1?>"],
    [(moment()), "<?=$atendidasHoje?>"]
  ];

  var data2 = [
    [(moment().subtract(6, 'days')), "<?=$natendidasDiaMenos6?>"],
    [(moment().subtract(5, 'days')), "<?=$natendidasDiaMenos5?>"],
    [(moment().subtract(4, 'days')), "<?=$natendidasDiaMenos4?>"],
    [(moment().subtract(3, 'days')), "<?=$natendidasDiaMenos3?>"],
    [(moment().subtract(2, 'days')), "<?=$natendidasDiaMenos2?>"],
    [(moment().subtract(1, 'days')), "<?=$natendidasDiaMenos1?>"],
    [(moment()), "<?=$natendidasHoje?>"]
  ];
  $("#grafico7dias").length && $.plot($("#grafico7dias"), [
    data1, data2
  ], {
    series: {
      lines: {
        show: false,
        fill: true
      },
      splines: {
        show: true,
        tension: 0.4,
        lineWidth: 1,
        fill: 0.4
      },
      points: {
        radius: 0,
        show: true
      },
      shadowSize: 2
    },
    grid: {
      verticalLines: true,
      hoverable: true,
      clickable: true,
      tickColor: "#d5d5d5",
      borderWidth: 1,
      color: '#fff'
    },
    colors: ["rgba(38, 185, 154, 0.38)", "rgba(242, 62, 70, 0.38)"],
    xaxis: {
      tickColor: "rgba(51, 51, 51, 0.06)",
      mode: "time",
      tickSize: [1, "day"],
      //tickLength: 10,
      axisLabel: "Date",
      axisLabelUseCanvas: true,
      axisLabelFontSizePixels: 12,
      axisLabelFontFamily: 'Verdana, Arial',
      axisLabelPadding: 10
    },
    yaxis: {
      ticks: 8,
      tickColor: "rgba(51, 51, 51, 0.06)",
    },
    tooltip: false
  });
});
</script>
<!-- FIM GRÁFICO ÚLTIMOS 7 DIAS -->

<!-- Doughnut Chart -->

<script>
$(document).ready(function(){
  var naoAtendidas = "<?= $natendidasHoje ?>"
  var atendidas = "<?= $atendidasHoje ?>"
  var options = {
    legend: false,
    responsive: false
  };

  new Chart(document.getElementById("canvas1"), {
    type: 'doughnut',
    tooltipFillColor: "rgba(51, 51, 51, 0.55)",
    data: {
      labels: [
        "Não Atendidas",
        "Atendidas"
      ],
      datasets: [{
        data: [naoAtendidas, atendidas],
        backgroundColor: [
          "#E74C3C",
          "#26B99A",
        ],
        hoverBackgroundColor: [
          "#E95E4F",
          "#36CAAB",
        ]
      }]
    },
    options: options
  });
});
</script>
<!-- /Doughnut Chart -->


</body>
</html>
