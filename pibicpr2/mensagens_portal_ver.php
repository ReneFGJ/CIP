<?
///////////////// Versao 0.0.1f de 02/08/2008
require("cab.php");

require($include.'sisdoc_colunas.php');
require($include.'sisdoc_data.php');
$label = "Mensagens do sistema para submiss�o<BR>Comunica��o por e-mail (p�s-aceite)";
$cpi = "nw";
$tabela = "ic_noticia";
$tab_max = "98%";

	{
	$sql = "select * from ".$tabela." where nw_journal = ".$journal_id." and nw_ref like 'sub%' ";
	echo $sql;
	$rlt = db_query($sql);
	$hr = '<TR bgcolor="#F0F0F0"><TH>ref�ncia</TH><TH>T�tulo / Conte�do</TH></TR>';
	while ($line = db_read($rlt))
		{
		$link = '<A HREF="http://www2.pucpr.br/reol/editora/ed_edit.php?dd0='.$line['id_nw'].'&dd99=ic_noticia">';
		$linki = '<img src="img/icone_editar.gif" border="0">';
		$sx .= $hr;
		$sx .= '<TR valign="top">';
		$sx .= '<TD bgcolor="#c0c0c0" align="center">';
		$sx .= $link;	
		$sx .= $line['nw_ref'];
		$sx .= $linki;
		$sx .= '<TD class="lt3"><B><I>';
		$sx .= $line['nw_titulo'];
		$sx .= '<TR valign="top">';
		$sx .= '<TD>&nbsp;</TD>';
		$sx .= '<TD><TT>';
		$sx .= $line['nw_descricao'];
		$sx .= '</TR>';

		$sx .= '<TR valign="top">';
		$sx .= '<TD colspan="2"><HR></TD>';
		}
		echo '<BR>';
		echo '<center><font class="lt5">Messagens para Submiss�o</font></center>';
		echo '<BR>';
		echo '<table class="lt1" width="50%%" border="1">';
		$txt = 'Nesta p�gina encontra-se todas as mensagens referente ao processo de submiss�o, avalia��o e aprova��o para publica��o do sistem RE2ol.';
		$txt .= ' Para realizar uma altera��o clique na refer�ncia da mensagem.';
		echo '<TR bgcolor="#ffc2a6"><TD align="left"><TT><B>'.$txt.'</TD></TR>';
		echo '</table>';
		echo '<BR><BR>';
		echo '<table class="lt1" width="98%">';
		echo $sx;
		echo '</table>';
	}

require("foot.php");	
?>