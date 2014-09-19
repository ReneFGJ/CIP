<?
    /**
     * Pïagina de Busca do Sistema
	 * @author Rene Faustino Gabriel Junior <renefgj@gmail.com> (Analista-Desenvolvedor)
	 * @copyright Copyright (c) 2011, PUCPR
	 * @access public
     * @version v0.11.28
	 * @link http://www.brapci.ufpr.br
	 * @package Declaracao
	 * @subpackage UC0001
     */

require("cab_semic.php");
require($include.'sisdoc_windows.php');
$estilo_admin = 'style="width: 230; height: 40; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';


/* temp */
//$sql = "select * from pibic_semic_avaliador_notas where av_parecerista_cod = '0000137' ";
//$rlt = db_query($sql);
//$line = db_read($rlt);
//print_r($line);
//
//$sql = "update pibic_semic_avaliador_notas set av_parecerista_cod = '0002302' where id_av = 15";
//$rlt = db_query($sql);
//echo $sql;

$bb1 = 'buscar >>';
$nome = array();

$opc = array();
	
/** Se existe codigo do estudante, recupera quais  */
$cod = $dd[1];

if (strlen($cod) > 0)
	{
	
	$sql = "select us_codigo_id, us_nome from pibic_semic_avaliador_notas
			left join pareceristas on av_parecerista_cod = us_codigo_id
			where av_status <> 0 and us_codigo_id = '".$cod."'
			group by us_codigo_id, us_nome
			";
	$rlt = db_query($sql);
	while ($line = db_read($rlt))
		{
			$dd[2] = trim($line['us_nome']);
			array_push($opc,array('Declaração de avaliador','AV',date("Y"),$dd[1],'pc2','pc3'));
		}
	} else {
		$sql = "select count(*) as total, us_nome, us_codigo_id, us_nome_asc from pibic_semic_avaliador_notas
				left join pareceristas on av_parecerista_cod = us_codigo_id
				where av_status <> 0 
				group by us_nome, us_codigo_id, us_nome_asc
				order by us_nome_asc
				";
		$rlt = db_query($sql);	
		$sx .= '<table>';
		$id = 0;
		while ($line = db_read($rlt))
			{
			$id++;
			$link = '<A HREF="'.page().'?dd1='.$line['us_codigo_id'].'">';
			$sx .= '<TR>';
			$sx .= '<TD>'.$link.$line['us_nome'].'</A>';
			$sx .= '<TD>'.$line['us_codigo_id'];
			$sx .= '<TD>'.$line['total'];
			}
		$sx .= '<TR><TD colspan=10>Total de '.$id;
		$sx .= '</table>';	
		$opc = array();
	}
?>
<TABLE width="98%" align="center" border="0" class="lt1" align="center">
<TR><TD colspan="4">
<FONT class="lt3">
</FONT><FORM method="post" action="declaracao_avaliador.php">

<TABLE width="98%" align="center" border="0" class="lt0" align="center">
<TR valign="top">
<TD><fieldset><legend>Central de Emissão de Declarações</legend>
<TABLE width="100%" align="center" border="0" class="lt0">
<TR valign="top">
<TD align="right">Cód. Avaliador</TD>
<TD><input type="text" name="dd1" value="<?=$dd[1];?>" size="10" maxlength="8"></TD>
<TD><input type="submit" name="acao" value="<?=$bb1;?>"></TD>

<TR valign="top">
<TD align="right">Nome completo (avaliador)</TD>

<TD colspan="2"><input type="text" name="dd2" value="<?=$dd[2];?>" size="60" maxlength="100"></TD>
</TR>
</table>
<? echo $sx; ?>
<? if (count($opc) > 1) { ?>
<fieldset><legend>Resumo dos trabalhos</legend>
<TABLE width="100%" align="center" border="0" class="lt0">
<TR valign="top">
<TD>Trabalhos</TD>
</table>
</fieldset>
<? } ?>
<!-- Opï¿½ï¿½es --->
<TD>
<fieldset><legend>Tipos de declarações</legend>
<UL>
<?
for ($ro=0;$ro < count($opc);$ro++)
	{
	$link = '<A HREF="#" onclick="newxy2('.chr(39).'declaracao_emissao_avaliador.php?dd10='.$opc[$ro][0].'&dd1='.$opc[$ro][1].'&dd2='.$opc[$ro][2].'&dd3='.$opc[$ro][3].'&dd0='.$dd[1].chr(39).',800,600);">'; 
	echo '<LI>';
	echo $link;
	echo $opc[$ro][0];
	echo '</A>';
	echo '</LI>';
	}
?>
</UL>
</TD>
</fieldset></TD>
</TABLE>
</TABLE>
<? echo $hd->foot();	?>