<?
require("cab.php");
require($include."sisdoc_debug.php");
require($include."sisdoc_colunas.php");
require($include."sisdoc_windows.php");
require($include."sisdoc_data.php");
require($include."sisdoc_email.php");
require($include.'sisdoc_security_post.php');

$dtipo = "PIBIC";
$ptipo = "PIBIC";
$ano = date("Y");

$sql = "select max(pee_edital) as edital from pibic_edital";
$rlt = db_query($sql);

if ($line = db_read($rlt))
	{ $edital = strzero($line['edital'],4); }
	
require("pibic_edital_3_resumo.php");
	
///////////////////////////////////////////////////////////////////////////////
$sql = "select * from pibic_submit_documento ";
$sql .= " inner join pibic_aluno on pa_cracha = doc_aluno ";
$sql .= " inner join pibic_professor on pp_cracha = doc_autor_principal ";
$sql .= " inner join apoio_titulacao on pp_titulacao = ap_tit_codigo ";
$sql .= " left join pibic_bolsa on (doc_protocolo = pb_protocolo) ";
$sql .= " where doc_ano = '".date("Y")."' ";
$sql .= " and doc_edital = '".$dtipo."' ";
$sql .= " and (doc_protocolo <> doc_protocolo_mae) ";
$sql .= " and (doc_status <> 'X' and doc_status <> '@' ) ";
$sql .= " and doc_nota > 10 ";
$sql .= " order by  doc_area, doc_nota desc, doc_protocolo ";
$rlt = db_query($sql);

$ord = 0;
$icv = '';
$area = '';
while ($line = db_read($rlt))
	{
	$estra = $line['doc_estrategica'];
	
//	echo '['.$estra.']';
	$old_bolsa_img = '';
	$tipo = $line['pb_xtipo'];
	$plink = '<A HREF="ed_pibic_submit_article.php?dd0='.$line['doc_protocolo_mae'].'" target="newsxs">';
	$old_bolsa = trim($line['pba_tipo']);
	$old_bolsa_img = '';
	$estra = $line['doc_estrategica'];
	$bolsa_img = '';
	$bolsa = $old_bolsa;
	require("bolsa_tipo.php");	
	$old_bolsa_img  = $bolsa_img;

	$bolsa = trim($line['pb_tipo']);
	$bolsa_img = '';
	require("bolsa_tipo.php");

	if ($area != $line['doc_area'])
		{
		$ord = 0;
		$area = $line['doc_area'];
		$sx .= '<TR><TD colspan="12"><HR></TD></TR>';
		}
	/////////////////////////////////////////////////////////////// 
	if (($estra == 'S'))
		{
		$img_estrategia_2 = '<IMG SRC="img/star_5.png">';
		} else {
		$img_estrategia_2 = '';
		}
	/////////////////////////////////////////////////////////////// 
	if ((strlen($bolsa_img) > 0) and ($estra == 'S'))
		{
		$img_estrategia = '<IMG SRC="img/star_5.png">';
		} else {
		$img_estrategia = '';
		}
	
	$ord++;
	$sx .= '<TR '.coluna().'>';
	$sx .= '<TD align="center">';
	$sx .= $ord;
	$sx .= '<TD align="center">';
	$sx .= $acor.$line['doc_area'];
	$sx .= $acor.$img_estrategia_2;
	$sx .= '<TD align="center">';
	$sx .= $old_bolsa_img;
	$sx .= '<TD align="center">';
	if (strlen($bolsa_img) > 0)
		{ 	$sx .= '<A onclick="newxy(\''.$ptipo.'_bolsa_retira.php?dd5='.trim($line['pb_tipo']).'&dd1='.trim($line['pp_cracha']).'&dd2='.trim($line['doc_protocolo']).'&dd0='.trim($line['doc_aluno']).'\',400,300);">'; }
	$sx .= $bolsa_img;
//	$sx .= $img_estrategia;
	$sx .= '<TD>';
	$sx .= $plink;
	$sx .= $acor.$line['doc_protocolo_mae'];
	$sx .= '<TD>';
	$sx .= $acor.$line['doc_edital'];
	$sx .= '<TD>';
	$sx .= $acor.$line['doc_protocolo'];
	$sx .= '<TD>';
	$sx .= $acor.$line['ap_tit_titulo'];
	$sx .= '<TD>';
	$sx .= $acor.$line['pp_nome'];
	$sx .= '<TD>';
	$sx .= dsp_sn($line['pp_ss']);
	$sx .= '<TD>';
	$prod = $line['pp_prod'];
	if ($prod == 0)
		{ $sx .= 'Não'; } else { $sx .= '<B>Sim</B>'; }
	$sx .= '<TD>';
	$sx .= $line['pa_nome'];
	$sx .= '<TD>';
	$sx .= $line['pp_centro'];
	$sx .= '<TD>';
	$sx .= number_format($line['doc_nota']/10,1);
	$sx .= '<TD><NOBR>';
	
	if ($line['pee_icv']=='1')
		{
			$sx .= '<A onclick="newxy(\''.$ptipo.'_bolsa_indicar.php?dd5=A&dd1='.trim($line['pp_cracha']).'&dd2='.trim($line['doc_protocolo']).'&dd0='.trim($line['doc_aluno']).'\',400,300);">';
			$sx .= '[ICV]';
			$sx .= '</A>';
			$sx .= '<A onclick="newxy(\''.$ptipo.'_bolsa_indicar.php?dd5=R&dd1='.trim($line['pp_cracha']).'&dd2='.trim($line['doc_protocolo']).'&dd0='.trim($line['doc_aluno']).'\',400,300);">';
			$sx .= '[REPR]';
			$sx .= '</A>';
			$sx .= '<A onclick="newxy(\''.$ptipo.'_bolsa_indicar.php?dd5=D&dd1='.trim($line['pp_cracha']).'&dd2='.trim($line['doc_protocolo']).'&dd0='.trim($line['doc_aluno']).'\',400,300);">';
			$sx .= '[DESQ]';
			$sx .= '</A>';			
			$sx .= '<A onclick="newxy(\''.$ptipo.'_bolsa_indicar.php?dd5=G&dd1='.trim($line['pp_cracha']).'&dd2='.trim($line['doc_protocolo']).'&dd0='.trim($line['doc_aluno']).'\',400,300);">';
			$sx .= '[GR2]';
			$sx .= '</A>';			
		} else {
			$sx .= '<A onclick="newxy(\''.$ptipo.'_bolsa_indicar.php?dd5=C&dd1='.trim($line['pp_cracha']).'&dd2='.trim($line['doc_protocolo']).'&dd0='.trim($line['doc_aluno']).'\',400,300);" class="lta">';
			$sx .= '[CNPq]';
			$sx .= '</A>';
			$sx .= '<A onclick="newxy(\''.$ptipo.'_bolsa_indicar.php?dd5=F&dd1='.trim($line['pp_cracha']).'&dd2='.trim($line['doc_protocolo']).'&dd0='.trim($line['doc_aluno']).'\',400,300);" class="lta">';
			$sx .= '[Fund. Araucária]';
			$sx .= '</A>';
			$sx .= '<A onclick="newxy(\''.$ptipo.'_bolsa_indicar.php?dd5=P&dd1='.trim($line['pp_cracha']).'&dd2='.trim($line['doc_protocolo']).'&dd0='.trim($line['doc_aluno']).'\',400,300);" class="lta">';
			$sx .= '[PUCPR]';
			$sx .= '</A><BR>';
			$sx .= '<A onclick="newxy(\''.$ptipo.'_bolsa_indicar.php?dd5=U&dd1='.trim($line['pp_cracha']).'&dd2='.trim($line['doc_protocolo']).'&dd0='.trim($line['doc_aluno']).'\',400,300);" class="lta">';
			$sx .= '[PUCPR-Estratégica]';
			$sx .= '</A>';
			$sx .= '<A onclick="newxy(\''.$ptipo.'_bolsa_indicar.php?dd5=I&dd1='.trim($line['pp_cracha']).'&dd2='.trim($line['doc_protocolo']).'&dd0='.trim($line['doc_aluno']).'\',400,300);" class="lta">';
			$sx .= '[APROV.]';
			$sx .= '</A>';
			$sx .= '<A onclick="newxy(\''.$ptipo.'_bolsa_indicar.php?dd5=R&dd1='.trim($line['pp_cracha']).'&dd2='.trim($line['doc_protocolo']).'&dd0='.trim($line['doc_aluno']).'\',400,300);">';
			$sx .= '[REPR]';
			$sx .= '</A>';
		}
	}
?>
<font class="lt5">Resultado Edital</font><BR>versão <?=$edital;?><BR>
<table width="100%" align="center" class="lt0">
<TR>
<TH>pos</TH>
<TH>área</TH>
<TH>anterior</TH>
<TH>bolsa</TH>
<TH>Protoc.</TH>
<TH>Protoc.</TH>	
<TH>Tit.</TH>
<TH>Professor</TH>
<TH>SS</TH>
<TH>Prod.</TH>
<TH>Aluno</TH>
<TH width="5%">Centro</TH>
<TH>Nota</TH>
<TH>Tipo</TH>
</TR>
<?=$sx;?>
</TABLE>
