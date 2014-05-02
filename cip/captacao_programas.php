<?php
require("cab.php");
require($include.'sisdoc_form2.php');
require($include.'sisdoc_windows.php');
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_data.php');
require($include.'cp2_gravar.php');

require("../_class/_class_programa_pos.php");
$pos = new programa_pos;
require("../_class/_class_captacao.php");
$cap = new captacao;

if (strlen($dd[1])==0)
{
?>
<table class="lt1" align="center">
	<TR><TD colspan=2 class="lt3" align="center"><center>Captação por Programa</center></TD></TR>
	<TR>
		<TD><form method="post" action="<?=page();?>"></TD>
		<TD>Programa:</TD>
		<TD><?=sget("dd1",'$Q pos_nome:pos_codigo:select * from programa_pos where pos_ativo = 1 and pos_corrente = \'1\' order by pos_nome','dd1','dd2',false,false);?></TD>
		<TD><input type="submit" value="busca >>>"></TD>
		<td></form></td>
	</TR>
</table>
<?
} else {
	$pos->le($dd[1]);
	echo $pos->mostra();
	echo $cap->mostra_captacao_programas($dd[1]);	
}
require("../foot.php");
?>
