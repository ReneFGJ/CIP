<?
switch ($LANG)
	{
	default:
		$bt_submit = 'Submeter trabalho >>>';
		$texto  = '<P> For the 3° South Brazilian Congress of Scientific Initiation and Graduate are considered two types of submission: Oral and Poster. At the time of submission, the author should make an option for one of the modalities. The papers submitted in the oral modality may hold the presentation in Portuguese or English. </P>
                   <P> <B>Oral form: </B> submit the extended abstract in the chosen language. </P>
                   <P> <B>Poster form: </B> Submit the file of poster. Is available on site specific template of the event, but poster presented at another event may be used. The banner must be printed in size 90 x 120cm colored using only a page.</P>
                   <P> <B>The submission period will be from August 20 to August 30.</B> </P>
                   ';
        break;
	}
$tela = '';
$tela .= '<h1>Paper Submission</h1>';
$tela .= '<div class="colunas">';
$tela .= $texto;
$tela .= '</div>';
$tela .= '<form method="get" action="http://www2.pucpr.br/reol/pb/index.php/cicpg?dd99=submit">';
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
			<TD align="center"><img src="img/logo.png" height="150"></TD>
		</TR>
	</table>
</div>
