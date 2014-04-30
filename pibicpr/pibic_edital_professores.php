<?
require("cab.php");
require($include."sisdoc_debug.php");
require($include."sisdoc_colunas.php");
require($include."sisdoc_windows.php");
require($include."sisdoc_data.php");
require($include."sisdoc_autor.php");

require("../_class/_class_docentes.php");
$doce = new docentes;
if (strlen($dd[0]) != 0)
	{
	?>
	<H2>Seleciona uma das áreas - PIBIC</H2>
	<form method="get">
	<table width="704">
	<TR align="center">
	<TD><input type="submit" name="dd0" value="Extatas (Ciências)" style="width:300px; height:50px;">
	<TD><input type="submit" name="dd0" value="Vida (Ciências)" style="width:300px; height:50px;">
	<TR align="center">
	<TD><input type="submit" name="dd0" value="Humanas (Ciências)" style="width:300px; height:50px;">
	<TD><input type="submit" name="dd0" value="Sociais Aplicadas" style="width:300px; height:50px;">
	<TR align="center">	
	<TD><input type="submit" name="dd0" value="Todas as áreas" style="width:300px; height:50px;">
	</table>
	</form>
	<?
	exit;
	}
?>
<style>
	.links a
	{
	text-decoration : none;
	font-family : Verdana, Geneva, Arial, Helvetica, sans-serif;
	font-size : 10px;
	font-style : normal;
	font-variant : normal;
	font-weight : normal;
	}

.links A:HOVER {
	text-decoration : underline;
	font-family : Verdana, Geneva, Arial, Helvetica, sans-serif;
	font-size : 10px;
	font-style : normal;
	font-variant : normal;
	font-weight : normal;	
	}
</style>
<?
$produ = $doce->produtividade();

$cps = "*";
$sql = "select $cps from pibic_bolsa ";
$sql .= "inner join pibic_professor on pp_cracha = pb_professor ";
$sql .= "left join apoio_titulacao on ap_tit_codigo = pp_titulacao ";
$sql .= "inner join pibic_bolsa_tipo on pbt_codigo =  pb_tipo ";
$sql .= " where pp_ano = '".date("Y")."' ";
$sql .= " and pb_ativo = 1 ";
$sql .= "order by pp_centro, pp_nome, pbt_edital, pbt_auxilio desc, pb_tipo ";

$rlt = db_query($sql);

$xprof = "X";
$xcentro = "X";
$pibiti = 0;
$pibic = 0;
$pibiti_r = 0;
$pibic_r = 0;
$repo = 0;
$xedital = "X";

$dr1 = 0;
$ms1 = 0;
$ds1 = 0;

/* Cabeçalho */
$hc = '';
while ($line = db_read($rlt))
	{
	$protocolo = trim($line['']);
	$professor = trim($line['pp_nome']);
	$centro = trim($line['pp_centro']);
	$bolsa = trim($line['pb_tipo']);
	$bolsa_img = '<IMG SRC="img/logo_bolsa_'.$bolsa.'.png" border=0 title="'.$line['pb_protocolo'].'-'.$line['pb_protocolo_mae'].'" alt="'.$line['pb_protocolo'].'">';
	$edital = trim($line['pbt_edital']);
	$auxilio = $line['pbt_auxilio'];
	$ss = trim($line['pp_ss']);
	$tit= trim($line['ap_tit_titulo']).' ';
	$tit_cod = trim($line['ap_tit_codigo']);
	$prod = trim($line['pp_prod']);
	if ($prod != '0') { $prod='PROD'; } else { $prod = '&nbsp;'; }
	if ($ss == 'N') { $ss = ''; }
	
	if ($professor != $xprof)
		{
		if ($tit_cod == '002') { $ms1++; }
		if ($tit_cod == '001') { $dr1++; }
		if (trim($ss)=='S') { $ds1++; }
		if (($pibic + $pibiti) > 0)
			{
			$msg = '';
			$bgp = ''; $bgt = '';
			$limit_p = 2;
			$limit_t = 2;
			$limit_tp = 2;
			$limit_tt = 2;
			/* RN Mestre e Doutor Duas bolsas pagar */
			/* RN Mestro dois ICV */
			/* RN Doutor treis ICV */
			
			/* Titulação de Doutor */
			if ($tit_cod == '002') { $limit_tp++; $limit_tt++; }
			if (!empty($pp)) { $limit_p++; }
			/* RN */
			if ($pibic_r > $limit_p) { $bgp=' bgcolor="#ff0000" '; $msg.='<A HREF="#" title="Número de Bolsas PIBIC é superior ao máximo">R</A>"'; }
			if ($pibiti_r > $limit_t) { $bgt=' bgcolor="#ff0000" '; $msg.='<A HREF="#" title="Número de Bolsas PIBITI é superior ao máximo">R</A>"'; }
			
			if ($pibic > ($limit_tp+$limit_p)) { $bgp=' bgcolor="#ff0000" '; $msg.='<A HREF="#" title="Total de Bolsas PIBIC é superior ao máximo">R</A>"'; }
			if ($pibiti > $limit_tt+$limit_t) { $bgt=' bgcolor="#ff0000" '; $msg.='<A HREF="#" title="Total de Bolsas PIBITI é superior ao máximo">R</A>"'; }
			
			if ($pibiti > 0)
				{
					$sx .= '<TD colspan="'.(7-($pibiti+$repo)).'" class="tabela01">&nbsp;</TD>';
				} else {
					$sx .= '<TD colspan="'.(15-($pibic-$pibiti)).'" class="tabela01">&nbsp;</TD>';
				}
			$sx .= '<TD align="center"  '.$bgp.' class="tabela01">'.$pibic.'/'.$pibic_r.'</TD>';
			$sx .= '<TD align="center" '.$bgt.' class="tabela01">'.$pibiti.'/'.$pibiti_r.'</TD>';
			$sx .= '<TD class="tabela01">'.$msg.'</TD>';
			}
		}	
	
	if ($centro != $xcentro)
		{
		$sx .= '<TR class="lt3"><TD colspan="40" class="tabela01"><B><font style="font-size:22px">'.$centro.'</font></B></TD></TR><TR>';
		$xcentro = $centro;
		}
		
	/* Professor diferente */
	if ($professor != $xprof)
		{
		$sx .= '<TR class="lt2"><TD colspan="1" class="tabela01">'.$professor.'</TD>';
		$sx .= '<TD class="tabela01">'.$tit.'</TD>';
		$sx .= '<TD class="tabela01" align="center">&nbsp;'.$ss.'&nbsp;</TD>';
		$sx .= '<TD class="tabela01">'.$prod.'</TD>';
		$xprof = $professor;
		
		$pibic=0;
		$pibiti=0;
		$pibic_r=0;
		$pibiti_r=0;
		$repo = 0;
		$xedital = $edital;
		$sx .= '<TD class="tabela01">'.$edital.'</TD>';
		}
		
	if ($edital != $xedital)
		{
		$sx .= '<TD class="tabela01" colspan="'.(7-$pibic).'">&nbsp;</TD>';
		$sx .= '<TD class="tabela01">'.$edital.'</TD>';
		$xedital = $edital;
		}
	$sx .= '<TD class="tabela01">'.$bolsa_img.'</TD>';
	
	if ($bolsa != 'D')
	{
		if ($edital == 'PIBIC') { $pibic++; }
		if ($edital == 'PIBITI') { $pibiti++; }
	
		if ($auxilio > 0)
			{
			if ($edital == 'PIBIC') { $pibic_r++; }
			if ($edital == 'PIBITI') { $pibiti_r++; }
			}
	} else {
		$repo++;
	}
	/* Memoriza programa do professor */
	$pp = $ss;
	}
echo '==>Dr. ('.$dr1.')';
echo '==>Dr.SS ('.$ds1.')';
echo '==>Msc. ('.$ms1.')';
?>
<table class="tabela00" width="100%">
<?=$sx;?>
</table>