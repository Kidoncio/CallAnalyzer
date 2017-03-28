<?php
$dePrint = $_POST['data_inicial'];
$de = str_ireplace("/","-",$dePrint);
$de = date('Y/m/d', strtotime($de));
$atePrint = $_POST['data_final'];
$ate = str_ireplace("/","-",$atePrint);
$ate = date('Y/m/d', strtotime($ate));
