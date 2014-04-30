<?php
require("cab.php");
require($include.'sisdoc_form2.php');
require($include.'cp2_gravar.php');
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_windows.php');
require($include.'sisdoc_data.php');
require($include.'sisdoc_email.php');

$file = '../messages/msg_'.page();
if (file_exists($file)) { require($file); }

/** PROJETOS **/
require('../_class/_class_pibic_projetos.php');
$pj = new projetos;
$parecer_pibic->tabela = 'pibic_parecer_2012';
$parecer_pibic->le($dd[0]);

if ($parecer_pibic->status != '@')
{
	echo '<center>';
	echo 'Projeto avaliado com sucesso';
	echo '<META HTTP-EQUIV=Refresh CONTENT="15; URL=main.php">';
	exit;
}

$pj->protocolo = $parecer_pibic->protocolo;

/** GED **/
require_once('../_class/_class_ged.php');
$ged = new ged;

echo '<form method="post" action="avaliacao_pibic_submit.php">'.chr(13);
echo '<input type="hidden" name="dd0" value="'.$dd[0].'">'.chr(13);
echo '<input type="hidden" name="dd1" value="'.$dd[1].'">'.chr(13);
echo '<input type="hidden" name="dd90" value="'.$dd[90].'">'.chr(13);
echo '<table width=98% align=center >';
$file = '../messages/msg_'.page();
if (file_exists($file)) { require($file); }

//$sql = "update pibic_parecer_2012 set pp_data_leitura = ".date("Ymd")." where id_pp = ".round($id);
//$qrlt = db_query($sql);

/* PROJETO DO PROFESSOR */
echo '<table cellpadding=4 class="lt1" width="98%" align="center">';
echo '<TR><TD class="lt2">'.msg('avaliador_info_pibic');
echo '</table>';
echo '<HR width=70% size=1><BR>';

echo $pj->mostra_projeto();

$form_title = '<BR><B>Ficha de Avaliação do Projeto de Professor</B>';
/** Campos do formulario **/
$cp = $parecer_pibic->parecer_cp_modelo_pp();
$cpa = $parecer_pibic->parecer_cp_modelo_pl();
$ddc = 10;

if (strlen($acao) > 0)
	{
		$sql = "update ".$parecer_pibic->tabela." set "; 
			$sql .= " pp_p01='".$dd[10]."', ";
			$sql .= " pp_p02='".$dd[11]."', ";
			$sql .= " pp_p03='".$dd[12]."', ";
			$sql .= " pp_p04='".$dd[13]."', ";
			$sql .= " pp_abe_01='".$dd[80]."', ";
			$sql .= " pp_parecer_data = ".date("Ymd").',';
			$sql .= " pp_parecer_hora = '".date("H:i")."' ";
			$sql .= " where id_pp = ".$dd[0];		
			$rlt = db_query($sql);
	} else {
		$sql = "select * from ".$parecer_pibic->tabela."
				where pp_protocolo = '".$pj->protocolo."'
				and pp_avaliador = '".$par->codigo."' ";
		$rlt = db_query($sql);
		if ($xline = db_read($rlt))
			{
				$dd[10] = trim($xline['pp_p01']);
				$dd[11] = trim($xline['pp_p02']);
				$dd[12] = trim($xline['pp_p03']);
				$dd[13] = trim($xline['pp_p04']);
				$dd[80] = $xline['pp_abe_01'];
			}
	}
echo '<table cellpadding=2 class="lt2" border=0  width=98%>';
echo '<TR><TD align=center class=lt4 >'.$form_title;
for ($r=0;$r < count($cp);$r++)
	{
		if (substr($cp[$r][0],0,2) != '$H')
			{
				$val = trim($_POST['dd'.$ddc]);
				if (strlen($val)==0) 
					{
						$cor = '<font color="FF3030">'; 
					} else {
						$cor = '<font color="303030">';
					}
			echo '<TR><TD class="lt2"><B>'.$cor;
			echo $cp[$r][2].'</font>';
			echo '<TR><TD>';
			echo sget("dd".$ddc,$cp[$r][0],True);
			$ddc++;
			}
	}
	
	
$ddc = 20;
echo '<TR><TD><input type="submit" name="acao" value="gravar >>>">';
/* PLANO DO ALUNO */
$sql = "select * from pibic_submit_documento
		left join pibic_aluno on pa_cracha = doc_aluno 
		where doc_protocolo_mae = '".trim($pj->protocolo)."' 
		and doc_status <> 'X' ";

$rlt = db_query($sql);
$pln = 0; /* Numero de planos */
while ($line = db_read($rlt))
	{
		$pln++;
		/* Recupera informações */
		if (strlen($acao) < 5)
		{
		$sql = "select * from ".$parecer_pibic->tabela."
				where pp_protocolo = '".$line['doc_protocolo']."'
				and pp_protocolo_mae = '".$pj->protocolo."'
				and pp_avaliador = '".$par->codigo."' ";
		$zrlt = db_query($sql);
		
		if ($qline = db_read($zrlt))
			{
				$dd[$ddc] = trim($qline['pp_p05']);
				$dd[$ddc+1] = trim($qline['pp_p06']);
				$dd[$ddc+2] = trim($qline['pp_p07']);
				$dd[$ddc+3] = trim($qline['pp_p08']);				
			} else {
				/* Salva novo parecer */
					$sql = "insert into ".$parecer_pibic->tabela."
						(pp_tipo, pp_protocolo, pp_protocolo_mae, 
						pp_avaliador, pp_revisor, pp_status, 
						pp_pontos, pp_pontos_pp, pp_data, 
						pp_data_leitura, pp_hora, pp_parecer_data, 
						pp_parecer_hora, 
						pp_p01, pp_p02, pp_p03, pp_p04, pp_p05,
						pp_p06, pp_p07, pp_p08, pp_p09, pp_p10,
						pp_p11, pp_p12, pp_p13, pp_p14, pp_p15,
						pp_p16, pp_p17, pp_p18, pp_p19, 
						pp_abe_01, pp_abe_02, pp_abe_03, pp_abe_04, pp_abe_05,
						pp_abe_06, pp_abe_07, pp_abe_08, pp_abe_09, pp_abe_10 
						) values (
						'SUBMP','".$line['doc_protocolo']."','".$pj->protocolo."',
						'$par->codigo','','@',
						0,0,0,
						0,'',0,
						'',
						0,0,0,0,0,
						0,0,0,0,0,
						0,0,0,0,0,
						0,0,0,0,
						'','','','','',
						'','','','',''
						)";	
					$zrlt = db_query($sql);			
			}
		} else {
			$sql = "update ".$parecer_pibic->tabela." set "; 
			$sql .= " pp_p05='".$dd[$ddc+0]."', ";
			$sql .= " pp_p06='".$dd[$ddc+1]."', ";
			$sql .= " pp_p07='".$dd[$ddc+2]."', ";
			$sql .= " pp_p08='".$dd[$ddc+3]."', ";
			$sql .= " pp_parecer_data = ".date("Ymd").',';
			$sql .= " pp_parecer_hora = '".date("H:i")."' ";
			$sql .= " where pp_protocolo = '".$line['doc_protocolo']."' and pp_avaliador = '".$par->codigo."' ";
			$qrlt = db_query($sql);
		}		
		$id = $line['doc_protocolo'];
		echo '<center><font class="lt3"><B>Plano de Aluno</B></font>';
		echo '<table cellpadding=2 class="lt0" border=1 width=98%>';
		echo $pj->resumo_planos_list_line($line);
		echo '</table>';
		
		echo '<table cellpadding=2 class="lt2" border=0 width=98%>';
		for ($r=0;$r < count($cpa);$r++)
			{
				$idn = "dd".$ddc;
				$vlr = trim($_POST[$idn]);
				$vlr = troca($vlr,"'",'´');
				
				if (substr($cpa[$r][0],0,2) != '$H')
					{
						$val = trim($_POST[$idn]);
						if (strlen($val)==0) 
							{
								$xcor = '<font color="FF3030">'; 
							} else {
								$xcor = '<font color="303030">';
							}
					echo '<TR><TD class="lt2"><B>'.$xcor;
						
					echo '<TR><TD class="lt2">'.$xcor;
					echo $cpa[$r][2].'</font>';
					echo '<TR><TD>';
					echo sget($idn,$cpa[$r][0],True);
					echo chr(13);
					$ddc++;
					}
			}
		echo '<TR><TD><input type="submit" name="acao" value="gravar >>>">';		
		echo '</table>';
	}
echo '<TR><TD class="lt1">';
$cap = "<B>Parecer qualitativo</B> (<font color=red >campo obrigatório</font>) será enviado como feedback para o professor proponente, com intuito de aprimoramento da pesquisa na iniciação científica em nossa instituição.";
echo '<TR><TD>';
echo '<table border=0 class="lt1" ><TR><TD colspan=2 >';
echo $cap;
echo '<TR><TD>';
echo sget('dd80','$T60:5',false);
echo '</table>';
$ddc++;
echo '<TR><TD><input type="submit" name="acao" value="gravar >>>">';		

/**************************** VALIDA DADOS DE SUBMISSAO **********/
if ((round($dd[10]) > 0) and (round($dd[11]) > 0) and (round($dd[12]) > 0) and (round($dd[13]) > 0))
{ $pp_valid = 1; } else {$pp_valid ==0; }

if (strlen(trim($dd[80]))==0) { $pp_valid = 0; }
/**************************** VALIDA PLANOS **********************/

for ($r=0;$r < ($pln*4);$r=$r+4)
	{
		if (round($dd[21+$r]) <= 0) { $pp_valid = 0; }
		if (round($dd[22+$r]) <= 0) { $pp_valid = 0; }
		if (round($dd[23+$r]) <= 0) { $pp_valid = 0; }
	}
$bb1 = 'finalizar avaliação';
if (($pp_valid > 0) and (!($acao == 'finalizar avaliação')))
	{
		echo '<TR><TD>';
		echo msg('info_finaliza');
		echo '<TR><TD align="center"><input type="submit" name="acao" value="'.$bb1.'" style="width=400px; height=50px;">';	
	}

if (($pp_valid > 0) and ($acao == 'finalizar avaliação'))
	{
		$email_adm = 'pibicpr@pucpr.br';
		$admin_nome = 'PIBIC (PUCPR)';
		echo 'Avaliação finalizada';
			$sql = "update ".$parecer_pibic->tabela." set ";
			$sql .= " pp_status = 'A',"; 
			$sql .= " pp_parecer_data = ".date("Ymd").",";
			$sql .= " pp_parecer_hora = '".date("H:i")."' ";
			$sql .= " where (pp_protocolo = '".$pj->protocolo."'
							or pp_protocolo_mae = '".$pj->protocolo."') 
							and pp_avaliador = '".$par->codigo."' ";
			$qrlt = db_query($sql);
			$texto = 'Avaliação concluída';
			$texto .= '<BR>Protocolo:'.$pj->protocolo;
			$texto .= '<BR>Avaliador:'.$par->nome.' ('.$par->codigo.')';
			$texto .= '<BR>'.date("d/m/Y H:i:s");			
			enviaremail('monitoramento@sisdoc.com.br','','Finalizado avaliação '.$pj->protocolo,$texto);
			
			redirecina(page().'?dd0='.$dd[0].'&dd90='.$dd[90]);
	}
echo '</table>';
	
?>
