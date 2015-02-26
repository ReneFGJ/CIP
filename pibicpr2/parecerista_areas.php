<?
$debug = true;
require("cab.php");
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_data.php');
require($include.'sisdoc_form2.php');
require($include.'cp2_gravar.php');

require('../_class/_class_parecer_pibic.php');
$parec = new parecer_pibic;

$label = "Cadastro de pareceristas / áreas de atuação";

$sql = "select * from pareceristas where id_us = ".$dd[0];
$rlt = db_query($sql);
$line = db_read($rlt);
$codpar = trim($line['us_codigo']);


if ((strlen($dd[0]) > 0) and (strlen($dd[10]) > 0))
{
	if ($dd[11]=='del')
		{
		$sql = "update pareceristas_area set ";
		$sql .= "pa_parecerista = 'X' || substr(pa_parecerista,2,6) ";
		$sql .= ",pa_area = 'X' || substr(pa_area,2,6) ";
		$sql .= ",pa_update = ".date("Ymd");
		$sql .= " where id_pa = ".$dd[10];
		$rlt = db_query($sql);
		}
}

if (strlen($dd[2]) > 0)
	{
	$sql = "select * from ajax_areadoconhecimento where a_codigo='".$dd[2]."' ";
	$rlt = db_query($sql);
	if ($line = db_read($rlt))
		{
		$cod_area = $line['id_aa'];
		$sql = "select * from pareceristas_area ";
		$sql .= "where pa_parecerista = '".$codpar."' ";
		$sql .= " and pa_area = '".$dd[2]."' ";
		$rlt = db_query($sql);
		if (!$line = db_read($rlt))
			{
			$sql = "insert into pareceristas_area ";
			$sql .= "(pa_parecerista,pa_area,pa_update) ";
			$sql .= " values ";
			$sql .= "('".$codpar."','".$dd[2]."',".date("Ymd").")";
			$rlt = db_query($sql);
//			$dd[1] = '';
			$dd[2] = '';
			} else {
			echo '<font color="red">Já cadastrado</font>';
			}
		}
	}

	$sql = "select * from pareceristas_area ";
	$sql .= " left join ajax_areadoconhecimento on a_codigo = pa_area ";
	$sql .= "where pa_parecerista = '".$codpar."' ";
	$rlt = db_query($sql);
	$s = '';
	while ($line = db_read($rlt))
		{
		$s .= '<TR>';
		$s .= '<TD width="60%"><B>';
		$s .= $line['a_descricao'];
		$s .= '<TD align="center" width="20%">';
		$s .= $line['a_cnpq'];
		$s .= '<TD align="center" width="10%">';
		$s .= stodbr($line['pa_update']);
		$s .= '<TD align="center" width="10%" class="lt1">';
		$s .= '<A HREF="parecerista_areas.php?dd0='.$dd[0].'&dd10='.$line['id_pa'].'&dd11=del">';
		$s .= '[EXCLUIR]</A>';
		}

//////////////////////////////////////////////////////////////////
require("parecerista_areas_avaliacao.php");
/////////////////////////////////////////////////////////////////
		
	$tabela = "";
	$sql = "select * from pareceristas ";
	$sql .= " inner join instituicoes on inst_codigo = us_instituicao ";
	$sql .= " where id_us = ".$dd[0]." ";
	$rlt = db_query($sql);
	if ($line = db_read($rlt))
		{
		?>
		<TABLE width="<?=$tab_max;?>" class="lt1">
			<TR><TD class="lt0" colspan="2">parecerista
			<TR><TD class="lt2" colspan="2"><B><?=$line['us_nome'];?>
			<TR><TD class="lt0" colspan="2">instituição
			<TR><TD class="lt2" colspan="2"><B><?=trim($line['inst_nome']);?> (<?=trim($line['inst_abreviatura']);?>)
		</TABLE>
		<?

		$cp = array();
		array_push($cp,array('$H8','','',False,True,''));
		array_push($cp,array('$S15','','Código CNPQ',True,True,''));
		if (strlen($dd[1]) == 0)
			{
			array_push($cp,array('$Q a_descricao_2:a_codigo:select a_cnpq || \' \' || a_descricao as a_descricao_2, * from ajax_areadoconhecimento where a_semic = 1 order by a_cnpq','','Descricao',True,False,''));
			} else {
			array_push($cp,array('$Q a_descricao:a_codigo:select * from ajax_areadoconhecimento where a_cnpq like \''.$dd[1].'%\'','','Descricao',True,False,''));
			array_push($cp,array('$H1','','Codigo',True,True,''));
			}
		?>
		<table width="<?=$tab_max;?>" align="center" border=1 >
		<TR><TD>
		<?
		editar();
		?>
	</table>
	<TABLE width="<?=$tab_max;?>" class="lt3">
		<TR><TH>Área
			<TH>código
			<TH>atualizado
			<TH>Ação
		<?=$s;?>
	</TABLE>
		<?
		}
	for ($ra=2012;$ra > 2011;$ra--)
		{
			$ano = $ra;
			require("parecerista_projetos_indicado_ano.php");
		}	
	require("parecerista_projetos_indicado.php");
require("foot.php");	
?>