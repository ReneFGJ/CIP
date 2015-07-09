<?php
require("cab.php");

require($include.'sisdoc_debug.php');
//ini_set('display_errors', 255	);
//ini_set('error_reporting', 255 );

$sql = "select count(*) as total, pp_protocolo from pibic_parecer_2015 
			where pp_status <> 'D'
			group by pp_protocolo
";
$rlt = db_query($sql);
while ($line = db_read($rlt))
	{
		$tot = $line['total'];
		if ($tot > 1)
			{
				print_r($line);
				echo '<HR>';
			}
	}



exit;


$ad = array(
674,762,736,307,1065,976,901,978,729,223,1080,663,695,947,987,430,221,1152,386);

for ($r=0;$r < count($ad);$r++)
	{
		$sql = "select * from pibic_parecer_2015 
				left join pibic_bolsa_contempladas on pp_protocolo = pb_protocolo
				where pb_relatorio_parcial_nota <> '2'
						and id_pp = ".$ad[$r];
		$rlt = db_query($sql);
		while ($line = db_read($rlt))
		{
			print_r($line);
			exit;
		}
		//echo '<BR>'.$sql;
	}



?>
