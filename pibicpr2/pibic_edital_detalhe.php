<?
require("cab.php");
require($include."sisdoc_debug.php");
require($include."sisdoc_colunas.php");
require($include."sisdoc_data.php");
require($include."sisdoc_email.php");
require($include.'sisdoc_security_post.php');

$sql = "select max(pee_edital) as edital from pibic_edital";
$rlt = db_query($sql);

if ($line = db_read($rlt))
	{
	$edital = strzero($line['edital'],4);
	}

$sql = "select * from pibic_edital ";
$sql .= " inner join pibic_aluno on pa_cracha = pee_aluno ";
$sql .= " inner join pibic_submit_documento on doc_protocolo = pee_protocolo ";
$sql .= " inner join pibic_professor on pp_cracha = doc_autor_principal ";
$sql .= " inner join apoio_titulacao on pp_titulacao = ap_tit_codigo ";
$sql .= " where pee_edital = ".$edital."";
$sql .= " and pee_aluno <> '' ";
$sql .= " order by pee_icv,pee_protocolo_mae, pee_protocolo, pee_total desc ";
$rlt = db_query($sql);

$ord = 0;
$dif = 0;
$xcod = "X";
$yyy=0;
while ($line = db_read($rlt))
	{
	$link = '<A HREF="ed_pibic_submit_article.php?dd0='.$line['pee_protocolo_mae'].'" target="new">';
	$ord++;
	$sx .= '<TR '.coluna().'>';
	$sx .= '<TD align="center">';
	$sx .= $ord;
	$sx .= '<TD align="center">';
	$sx .= $line['pee_protocolo'];
	$sx .= '<TD align="center">';
	$sx .= $link;
	$sx .= $line['pee_protocolo_mae'];
	$sx .= '<TD>';
//	$sx .= $line['ap_tit_titulo'];
//	$sx .= '<TD>';
	$sx .= $line['pp_nome'];
	$sx .= '<TD>';
//	$sx .= dsp_sn($line['pp_ss']);
//	$sx .= '<TD>';
//	$sx .= dsp_sn($line['pp_prod']);
//	$sx .= '<TD>';
	$sx .= $line['pa_nome'];
//	$sx .= '<TD>';
//	$sx .= $line['pa_curso'];
	$sx .= '<TD align="right">';
	$sx .= number_format($line['pee_total']/10,1);
	$sx .= '<TD align="center">';
	$sx .= $line['pee_n01']/10;	
	$sx .= '<TD align="center">';
	$sx .= $line['pee_n02']/10;	
	$sx .= '<TD align="center">';
	$sx .= $line['pee_n03']/10;	
	$sx .= '<TD align="center">';
	$sx .= $line['pee_n04']/10;	
//	$sx .= '<TD align="center">';
//	$sx .= $line['pee_n05']/10;	
	$sx .= '<TD align="center">';
	$sx .= $line['pee_n06']/10;	
	$sx .= '<TD align="center">';
	$sx .= $line['pee_n07']/10;	
	$sx .= '<TD align="center">';
	$sx .= $line['pee_n08']/10;	
	$sx .= '<TD align="center">';
	$sx .= $line['pee_n09']/10;	
	$sx .= '<TD align="center">';
	$sx .= $line['pee_n10']/10;	
	$sx .= '<TD align="center">';
	$sx .= $line['pee_n11']/10;	
	$sx .= '<TD align="center">';
	if ($line['pee_icv']=='1')
		{
		$sx .= 'ICV';
		}
	$xxx = $line['pee_protocolo'];
	$zzz = $line['pee_total'];
	if ($xcod != $xxx) { $yyy = 0; } 
	else
	{
		if ($yyy > 0)
			{
			if ((($zzz-$yyy) > 350) or (($yyy-$zzz) > 350))
				{ $sx .= '<TR><TD align="right" colspan="10">Discrepância '.(($zzz-$yyy)/10).'</TD></TR>'; }
			}
	}
	$yyy = $line['pee_total'];
	$xcod = $xxx;
	}
?>
<font class="lt5">Resultado Edital</font><BR>versão <?=$edital;?><BR>
<table width="100%" align="center" class="lt0">
<TR>
<TH>pos</TH>
<TH>Protoc.</TH>
<TH>Protoc. mae</TH>
<TH>Professor</TH>
<TH>Aluno</TH>
<TH>Nota</TH>
<TH>prod.</TH>
<TH>tit.</TH>
<TH>SS</TH>
<TH>Ext</TH>

<TH>PP-1</TH>
<TH>PP-2</TH>
<TH>PP-3</TH>

<TH>PA-1</TH>
<TH>PA-2</TH>
<TH>PA-3</TH>

<TH>Tipo</TH>
</TR>
<?=$sx;?>
</TABLE>
<?
require("foot.php");	?>
<a href="pibic_edital_gerar.php">gerar</a>