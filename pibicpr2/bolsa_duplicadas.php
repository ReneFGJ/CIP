<?
require("cab.php");
require($include."sisdoc_debug.php");

$tabela = "pibic_bolsa_contempladas";

$sql = "select * from ".$tabela." as bolsa inner join ";
$sql .= "( ";
$sql .= "select count(*) as total, pb_aluno from ".$tabela." ";
$sql .= " where pb_status <> 'C' and pb_tipo <> 'A' and pb_ano = '".date("Y")."' ";
$sql .= " group by pb_aluno ";
$sql .= ") as tabela ";
$sql .= " on tabela.pb_aluno = bolsa.pb_aluno ";
$sql .= " left join pibic_aluno on bolsa.pb_aluno = pa_cracha ";
$sql .= " left join pibic_professor on bolsa.pb_professor = pp_cracha ";
$sql .= " where total > 1 ";
$sql .= " and pb_ano = '2012' ";
$sql .= " order by pb_protocolo, bolsa.pb_aluno, pb_status, id_pb ";


$tot = 0;
$rlt = db_query($sql);
$proto = "X";
$sqlu = '';
while ($line = db_read($rlt))
	{
		$protocolo = $line['pb_protocolo'];
		$cor = '';
		
		if ($proto == $protocolo)
			{
				$sqlu .= "update ".$tabela." set pb_status = 'Z' where id_pb = ".$line['id_pb'].';';
				$sqlu .= chr(13).chr(10);
				 $cor = '<font color="red">'; 
			}
		$proto = $protocolo;
	if ($line['pb_status'] == 'Z') { $cor = '<font color="green">'; }
	$tot = $tot + 0.5;
	$s .= '<TR><TD><HR>';
		
	$s .= '<TR><TD>'.$cor.$line['pb_protocolo'];		
		
	$s .= '<TR>';
	$s .= '<TD>Prof(a):';
	$s .= '<B>'.$cor.$line['pp_nome'].'</B>';
	$s .= ' ('.trim($line['pb_professor']).')';
	
	$s .= '<TR>';
	$s .= '<TD>Aluno:';
	$s .= '<B>'.$cor.$line['pa_nome'].'</B>';
	$s .= ' ('.trim($line['pb_aluno']).')';

	$s .= '<TR>';
	$s .= '<TD>';
	$s .= $cor.$line['pb_titulo_projeto'];


	$s .= '<TR>';
	$s .= '<TD>===>';
	$s .= $cor.$line['pb_tipo'];
	$s .= ' ';
	$s .= $cor.$line['pb_ano'];
	$s .= ' ';
	$s .= $cor.$line['pb_status'];	

	$s .= '</TR>';
	}
	
if ($tot == 0)
	{
	$s = '<TR><TD align="center" class="lt3"><BR><BR><font color="green">Nenhuma alunos tem duas bolsas<BR><BR></font></TD></TR>';
	}
	
echo $sqlu;
//$sqlu .= "update ".$tabela." set pb_status = 'A' where pb_status = 'Z' ";
IF (strlen($sqlu) > 0)
	{
		//$rlt = db_query($sqlu);
	}
$sql = "delete from ".$tabela." where pb_status = 'Z' ";
$rlt = db_query($sql);	
?>
<BR><BR>
<CENTER><font class="lt5">Bolsas Duplicadas</font></CENTER>
<table width="<?=$tab_max;?>" class="lt1">
<?=$s;?>
</table>
<?
require("foot.php");	
?>