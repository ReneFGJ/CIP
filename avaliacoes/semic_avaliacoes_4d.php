<?
require("cab.php");
require($include.'sisdoc_debug.php');

//$sql = "ALTER TABLE pibic_semic_avaliador  ADD COLUMN psa_checked char(1) ";
//$rlt = db_query($sql);

//$sql = "update pibic_semic_avaliador set psa_final = to_number(psa_p06,'999D9') where psa_p06 <> ''";
//$rlt = db_query($sql);



$sql = "select count(*) as psa_abe_1, avg(psa_final) as psa_final, trim(psa_p04) || trim(psa_p02) as psa_p02 from pibic_semic_avaliador ";
$sql .= " where psa_p06 <> '' 
			and ((psa_p02 like '%jr%') or (psa_p02 like '%JR%') or (psa_p02 like '%Jr%'))
			group by psa_p04, psa_p02 ";
$sql .= " order by psa_final desc limit 100 ";

require("semic_avaliacoes_4.php");
?>