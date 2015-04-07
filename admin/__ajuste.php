<?php
require("cab.php");

$sql = "
ALTER TABLE docente_orientacao
   DROP COLUMN od_corientador;
";
$rlt = db_query($sql);

$sql = "
ALTER TABLE docente_orientacao
   ADD COLUMN od_coorientador character(8);
";
$rlt = db_query($sql);
?>