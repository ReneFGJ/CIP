<?php
require('cab.php');

echo '<div id="content">';
echo '<h2>Acesso aos Bolsistas</h2>';
echo '<table width="100%" class="lt1"><TR><TD>';
echo 'Prezado bolsista
<BR><BR>
Para nosso acompanhamento durante o seu per�odo de Interc�mbio, voc� dever� postar, num prazo de at� 30 dias ap�s sua viagem, os seguintes documentos: comprovante do seguro contratado e comprovante de matr�cula, bem como, incluir as seguintes informa��es: endere�o no exterior, contato do Escrit�rio de Rela��es Internacionais da Universidade Destino, contato no Brasil.
<BR><BR>
No seu primeiro acesso, crie uma senha pessoal.';
?>
<BR><BR>
<table width="300" align="center" class="lt0" border=0 cellspacing=0 cellpadding=0>
	<TR><TD bgcolor="#C0C0C0" class="lt2"><center>Identifica��o do estudante</TD></TR>
	<TR><TD>Informe seu CPF</TD></TR>
	<TR><TD><input type="text" size=20 maxlength="20"></TD></TR>
	<TR><TD>Senha de acesso</TD></TR>
	<TR><TD><input type="text" size=20 maxlength="20"></TD></TR>
	<TR><TD><input type="button" value="acessar"></TD></TR>	
</table>
<?
echo '</table>';
echo '</div>';
require("foot.php"); ?>
