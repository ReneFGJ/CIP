<?
switch ($LANG)
	{
	default:
		$bt_submit = 'Submeter trabalho >>>';
		$texto  = '<P>Para o III Congresso Sul Brasileiro de Inicia��o Cient�fica e P�s-Gradua��o s�o consideradas duas modalidades de submiss�o: oral e p�ster. No momento da submiss�o o autor dever� fazer a op��o por uma das modalidades. Os trabalhos submetidos na modalidade oral poder�o realizar a apresenta��o em portugu�s ou em ingl�s. </P>
                   <P> <B>Modalidade oral:</B> submeter o resumo estendido no idioma escolhido </P>
                   <P> <B>Modalidade p�ster:</B> submeter o arquivo do p�ster. No site est� dispon�vel template espec�fico do evento, mas poder� ser utilizado p�ster apresentado em outro evento. O banner deve ser impresso em tamanho 90 x 120cm colorido, utilizando apenas uma p�gina.</P>
                   <P> <B>O per�odo de submiss�o ser� de 15 de julho a 20 de agosto.</B> </P>
                   ';
        break;
	}
$tela = '';
$tela .= '<h1>Submiss�o de Trabalhos</h1>';
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
  		columns: 1;
  		-webkit-columns: 1;
  		-moz-columns: 1;
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
	<A HREF="index.php#page01"><img src="img/icone_top.jpg" align="right" border=0 class="top" title="retorna ao menu"></A>	
	<table width="98%" cellpadding=0 cellspacing=0 align="center" border=0 style="min-height:800px;">
		<TR valign="top">
			<TD><?php echo $tela; ?></TD>
			<TD align="right"><img src="img/logo.png" height="150"></TD>
		</TR>
	</table>
</div>
