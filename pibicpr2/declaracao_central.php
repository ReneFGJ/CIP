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

require("cab.php");
require($include.'sisdoc_windows.php');
$estilo_admin = 'style="width: 230; height: 40; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';

/** Chama biblioteca do SOAP */
require_once('../include/nusoap/nusoap.php');
require_once("_pucpr_login.php");

$bb1 = 'buscar >>';
$nome = array();
if ((strlen($dd[1]) > 7) and ($acao = $bb1))
	{
	require('_class_alunopucpr.php');
	$nome = $client = new Estudante();
	$nome->le_cracha($dd[1]); 
	if (strlen($nome->al_nomeAluno) > 0) { $dd[2] = $nome->al_nomeAluno; }
	}

$opc = array();
if (round(date("Ym")) > round(date("Y").'10'))
{array_push($opc,array('Declaração de Ouvinte SEMIC ('.(date("Y")-0).')','P',(date("Y")-0),'',$dd[1])); }
 array_push($opc,array('Declaração de Ouvinte SEMIC ('.(date("Y")-1).')','P',(date("Y")-1),'',$dd[1]));
	
/** Se existe codigo do estudante, recupera quais  */
$cod = $nome->al_cracha;
if (strlen($cod) > 0)
	{
	
	$sql = "select * from pibic_bolsa_contempladas ";
	$sql .= " where pb_aluno = '".$cod."' ";
	$sql .= " and pb_status <> 'C' ";
	$sql .= " order by pb_ano desc ";
	$rlt = db_query($sql);
	while ($line = db_read($rlt))
		{
		// pb_professor
		// pb_protocolo
		// pb_protocolo_mae
		// pb_titulo_projeto
		// pb_ano
		// pb_tipo
		array_push($opc,array('Participação no programa PIBIC/PIBIT - '.$line['pb_ano'].'/'.($line['pb_ano']+1),'O',($line['pb_ano']+1),$line['id_pb'],$dd[1]));
		}
	} else {
		$opc = array();
	}
?>
<TABLE width="98%" align="center" border="0" class="lt1" align="center">
<TR><TD colspan="4">
<FONT class="lt3">
</FONT><FORM method="post" action="declaracao_central.php">

<TABLE width="98%" align="center" border="0" class="lt0" align="center">
<TR valign="top">
<TD><fieldset><legend>Central de Emissãoo de Declarações</legend>
<TABLE width="100%" align="center" border="0" class="lt0">
<TR valign="top">
<TD align="right">Cód. Cracha</TD>
<TD><input type="text" name="dd1" value="<?=$dd[1];?>" size="10" maxlength="8"></TD>
<TD><input type="submit" name="acao" value="<?=$bb1;?>"></TD>

<TR valign="top">
<TD align="right">Nome completo</TD>

<TD colspan="2"><input type="text" name="dd2" value="<?=$dd[2];?>" size="60" maxlength="100"></TD>
</TR>
</table>
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
	$link = '<A HREF="#" onclick="newxy2('.chr(39).'declaracao_emissao.php?dd10='.$opc[$ro][0].'&dd1='.$opc[$ro][1].'&dd2='.$opc[$ro][2].'&dd3='.$opc[$ro][3].'&dd0='.$dd[1].chr(39).',800,600);">'; 
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
<? require("foot.php");	?>