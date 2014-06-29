<?
switch ($LANG)
	{
	default:
		$bt_submit = 'Submeter trabalho >>>';
		$texto  = '<P>Para o III Congresso Sul Brasileiro de Inicia��o Cient�fica e P�s-Gradua��o s�o consideradas duas modalidades de submiss�o, a primeira para apresenta��o oral e outra para p�ster. Somente os melhores trabalhos conforme avalia��o por m�rito ser�o indicados para apresenta��o oral, o restante para p�ster, desde que aprovada. A submiss�o ser� realizada entre os dias 10 de julho � 20 de agosto. Para o resumo seguir as normas na aba "Instru��es para autores" e para o banner utilize o template dispon�vel no site do evento, o banner deve ser impresso em tamanho 90x120cm colorido, utilizando apenas uma p�gina. No banner deve ter os seguintes campos: Introdu��o, Objetivo(s), Metodologia, Discuss�o e Resultado(s), Conclus�o ou Considera��es, e um breve quando com as refer�ncias utilizadas no Banner.</P>';
		$texto .= '<P>For the III South Brazilian Congress of Scientific Initiation and Graduate are considered two types of submission, the first for oral presentation and one for poster. Only the best entries, as judged by merit, will be given for oral presentation, poster for the remainder, if approved. The submission will be held between July 10 to August 20. For a summary is need follow the rules in tab "Instructions for Authors" and use the template for the banner available on the event website, the banner should be printed in size 90x120cm colored using only a page. The banner should have the following fields: Introduction, Objectives, Methods, Results and Discussion, or Completion considerations, and a brief with the references used in Banner.</P>';
		break;
	}
$tela = '';
$tela .= '<h1>Submiss�o de Trabalhos / Submit manuscript</h1>';
$tela .= '<div class="colunas">';
$tela .= $texto;
$tela .= '</div>';
$tela .= '<form method="get" action="page_submit.php">';
$tela .= '<input type="submit" value="'.$bt_submit.'" class="bt_submit">';
$tela .= '</form>';
?>
<style>
	.colunas
	{
  		columns: 2;
  		-webkit-columns: 2;
  		-moz-columns: 2;		
	}
	.cc2 {
		font-family: Tahoma, Arial, Verdana;
		font-size: 20px;
		color: #2D332D;
		text-align: center;
	}
	.bt_submit
		{
			width: 250px;
			height: 50px;
			background-color: #8B1217;
			color: #E0EFE0;
			font-size: 20px;
		}
	.pg03 { background-color: #EFFFEF; }
</style>

<div id="page03" class="page_min pg03">
	
	<table width="98%" cellpadding=0 cellspacing=0 align="center" border=0 style="min-height:800px;">
		<TR valign="top">
			<TD><?php echo $tela; ?></TD>
			<TD align="right"><img src="img/logo.png" height="150"></TD>
		</TR>
	</table>
</div>
