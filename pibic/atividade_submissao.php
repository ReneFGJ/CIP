<?php
require("cab_pibic.php");
require($include.'sisdoc_debug.php');
require($include.'sisdoc_windows.php');
$ic_noticia = 'ic_noticia';
if (strlen($ss->user_cracha)==0)
	{ redirecina(http.'index.php'); }
		
	
//if (date("Ymd") == '20100606')
$submissao_aberta = 1;

if ($submissao_aberta == 1)
	{
		require($include."sisdoc_data.php");
		$dd1 = '20130325';
		$dd2 = '20130425';

		$ss = '';
		$ss = '<TABLE width="500" class="lt1" border="0" cellpadding="0" cellspacing="0">';
//		$ss .= '<TR><TD><fieldset><legend>&nbsp;<B><font color="blue">Submiss�o de Projeto e Plano de Aluno</font></B>&nbsp;</legend>';	
		$ss .= '<TR><TD><fieldset><legend>&nbsp;<B><font color="blue">Submiss�o de Projeto e Plano de Aluno</font></B>&nbsp;</legend>';	
		$ss .= '<TABLE width="100%" class="lt1" border="0">';
		$ss .= '<TR><TD>';
		$ss .= '<font color="red">Per�odo de submiss�o '.stodbr($dd1).' at� <B>'.stodbr($dd2).'</B> as 23h59</font>';
		$ss .= '<BR><BR>';

		$checklist = False;
		/////////////////////////////////////////////////// MANAGERS
		$menu = array();

		array_push($menu,array('Projetos','Submiss�o de novo projeto','submit_phase_0.php')); 

		$texto = 'SUB_MSG_1';
		$sql = "select * from ic_noticia where nw_ref = 'SUB_MSG_1' ";
		$sql .= " and nw_idioma = '".$idioma_id."'";
		$sql .= " and nw_journal = ".$jid;
		$rrr = db_query($sql);
		$sn .= '<font class="lt1">';
		while ($eline = db_read($rrr))
			{
			$sn .=  '<H1>'.$eline['nw_titulo'].'</H1>';
			$texto = $eline['nw_descricao'];
			}
		$sn .= mst($texto);

		////////////////////////////// PIBIC
		global $submitok;
		$submitok = 1;
		
		////////////////////////////////////	
		$sn .= '</p><table width="100%">';
		if ($submitok == 1)
			{
					if ($checklist == true)
				{	
				for ($k=0;$k < count($menu);$k++)
					{
					$sn .=  '<TR><TD><form method="post" action="'.$menu[$k][2].'">';
					$sn .=  '<input type="submit" name="bt" value="'.$menu[$k][1].'" class="botao-normal">';
					$sn .=  '</FORM>';
					}
				} else {
					if ($tituok == True)
						{
							$texto = 'SUB_ERR_2';
							$sql = "select * from ".$ic_noticia." where nw_ref = 'SUB_ERR_2' "; // carga horaria invalida
							$sql .= " and nw_idioma = '".$idioma_id."'";
							$sql .= " and nw_journal = ".$jid;
						} else {
							$sql = "select * from ".$ic_noticia." where nw_ref = 'SUB_ERR_3' "; // titulacao invalida
							$sql .= " and nw_idioma = '".$idioma_id."'";
							$sql .= " and nw_journal = ".$jid;				
						}
				$rrr = db_query($sql);
				while ($eline = db_read($rrr))
				{ $texto = '<font class="lt3">'.$eline['nw_titulo'].'</font><BR><BR>'; $texto .= $eline['nw_descricao']; }
				$sn .=  mst($texto);			
			}
		} else {
			////////////// Justificativa
			$texto = 'SUB_ERR_1';
			$sql = "select * from ".$ic_noticia." where nw_ref = 'SUB_ERR_1' ";
			$sql .= " and nw_idioma = '".$idioma_id."'";
			$sql .= " and nw_journal = ".$jid;
			$rrr = db_query($sql);
			while ($eline = db_read($rrr))
			{ $texto = '<font class="lt3">'.$eline['nw_titulo'].'</font><BR><BR>'; $texto .= $eline['nw_descricao']; }
			$sn .=  mst($texto);		
		}
	$sn .= '</table>';

if ($submitok == 1)
	{
	/*** SUBMISSAO **/
	require("../_class/_class_pibic_projetos.php");
	$prj = new pibic_projetos;	
	$prj->resumo_projetos();
	///////////// Mostra projetos abertos
	if ($submissao_aberta==true) { require("submit_menu_abertos.php"); }
	
	$ss .= '<form method="post" action="submit_phase_0.php">';
	$ss .= '<input type="hidden" name="dd0" value="NEW">';
//	$ss .= '<form method="post" action="submit_phase_1_pibic.php">';
	$ss .= '<input type="submit" name="acao" value="Submeter novo projeto >>>">';
	$ss .= '</form>';
	$ss .= '</TD></TR>';
	}
	$ss .= '</table></fieldset></table>';
	echo $ss;
} else {
		$sn .= '<CENTER><font class="lt3"><font color="#FF8040"><B>SUBMISS�O DE PROJETOS: ENCERRADA</B></font></font></CENTER>';
}

?>