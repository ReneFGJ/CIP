<?php
$include = '../';
require("../db.php");

require($include.'sisdoc_debug.php');
echo '<TD colspan=10>';
require("../_class/_class_pibic_bolsa_contempladas.php");
$pb = new pibic_bolsa_contempladas;

require("../_class/_class_pareceristas.php");
$par = new parecerista;

require("../_class/_class_parecer_pibic.php");
$pari = new parecer_pibic;
$pari->tabela = "pibic_parecer_".date("Y");
$proto = trim($dd[0]);
echo '<h1>Reavalia��o do relat�rio final</h1>';
while (strlen($proto) < 7)
	{ $proto = '0'.$proto; }
	
if ($dd[2]=='DECLINAR')
	{
		$sql = "update pibic_bolsa_contempladas set pb_relatorio_parcial_nota = -99
				where pb_protocolo = '".$dd[5]."' 
		";
		$rlt = db_query($sql);
		
		$sql = "update pibic_parecer_".date("Y")." set pp_status = 'D' where id_pp = ".$dd[3];
		$rlt = db_query($sql);
		//pb_relatorio_parcial_nota
		echo '<font color="blue">Declinou</font>';
		exit;
	}
	
$pb->le('',$proto);
//print_r($pb);
$area = $pb->pb_semic_area;
$prof = $pb->pb_professor;
$tipo = 'RFNR';
if ($dd[2]==1)
	{
		if (strlen($dd[3]) > 0) { $tipo = $dd[3]; }
		
		if ($prof == $dd[1])
			{
				echo '
				<script>
					alert("O Avaliador � o mesmo que o orientador neste projeto");
				</script>
				';
					
			} else {
				$pari->inserir_idicacao_avaliacao($proto,$dd[1],$tipo);
				$sql = "update pibic_bolsa_contempladas 
						set pb_relatorio_final_correcao_nota = -90
						where pb_protocolo = '".$proto."' ";
				$rlt = db_query($sql);
		
				$pr = round($proto);
				$sx = '
				<script>
					$("#TR'.$pr.'").hide();
					$("#TRI'.$pr.'").hide();
					/* alert("Indicado"); */
				</script>
				';
				echo $sx;
				exit;
			}
	}
if ($dd[3]=='RFNR')
{
	echo '<table class="tabela01" width="100%">';
	echo '<TR><TD>';
	echo '<B>'.$pb->pb_titulo_projeto.'</B>';
		echo '<BR>'.$prof;
	
	echo $pari->avaliador_idicar_correcao_form($proto,$area,'RFNR');
		
	echo '</table>';	
}

if (strlen($dd[3]) == 0)
{
	echo '<table class="tabela01" width="100%">';
	echo '<TR><TD>';
	echo '<B>'.$pb->pb_titulo_projeto.'</B>';
		echo '<BR>'.$prof;
	
	echo $pari->avaliador_idicar_form($proto,$area,'RFNR');
		
	echo '</table>';
	
	echo $proto;
}
?>