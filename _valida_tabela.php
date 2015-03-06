<?
require("db.php");

$sql = "
CREATE TABLE pibic_parecer_".date("Y")."
( 
id_pp serial NOT NULL, 
pp_nrparecer char(7), 
pp_tipo char(5), 
pp_protocolo char(7), 
pp_protocolo_mae char(7), 
pp_avaliador char(8), 
pp_revisor char(8), 
pp_status char(1), 
pp_pontos int8 DEFAULT 0, 
pp_pontos_pp int8 DEFAULT 0, 
pp_data int8, 
pp_data_leitura int8, 
pp_hora char(5), 
pp_parecer_data int8, 
pp_parecer_hora char(5), 
pp_p01 char(5), 
pp_p02 char(5), 
pp_p03 char(5), 
pp_p04 char(5), 
pp_p05 char(5), 
pp_p06 char(5), 
pp_p07 char(5), 
pp_p08 char(5), 
pp_p09 char(5), 
pp_p10 char(5), 
pp_p11 char(5), 
pp_p12 char(5), 
pp_p13 char(5), 
pp_p14 char(5), 
pp_p15 char(5), 
pp_p16 char(5), 
pp_p17 char(5), 
pp_p18 char(5), 
pp_p19 char(5), 
pp_abe_01 text, 
pp_abe_02 text, 
pp_abe_03 text, 
pp_abe_04 text, 
pp_abe_05 text, 
pp_abe_06 text, 
pp_abe_07 text, 
pp_abe_08 text, 
pp_abe_09 text, 
pp_abe_10 text, 
pp_abe_11 text, 
pp_abe_12 text, 
pp_abe_13 text, 
pp_abe_14 text, 
pp_abe_15 text, 
pp_abe_16 text, 
pp_abe_17 text, 
pp_abe_18 text, 
pp_abe_19 text 
); 
";

$rlt = db_query($sql);
echo 'FIM';
?>
