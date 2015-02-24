<?
require("cab.php");
require($include."sisdoc_data.php");
require($include."sisdoc_colunas.php");
require($include."sisdoc_debug.php");
require("include_journal.php");
$grupo = '0000001';
?>
<font class="lt5">Tarefas</font>
<BR><font class="lt3">ordenado por data</font>
<?
$wh = jdsel('journal_id');
$sql = "select * from reol_submit ";
$sql .= " left join editora_status on doc_status = ess_status ";
$sql .= " where ";
$sql .= " doc_grupo = '".$grupo."' ";
$sql .= " and (".jdsel('journal_id').")";
$sql .= " and ".$wh;
$sql .= " order by doc_data ";
$rlt = db_query($sql);
$rev = "X";

$s = '<TR>';
while ($line = db_read($rlt))
	{
	$setor = $line['ess_descricao_1'];
	$s .= '<TR><TD colspan="5"><font class="lt4">'.$setor.'</font><BR>';
	$s .= '<TR><TD colspan="4">'.$line['doc_1_titulo'];
	$s .= '<TD class="lt5">';
	$s .= date("Ymd")-$line['doc_dt_atualizado'];
	$s .= '</TD>';
	}

echo '<TABLE width="'.$tab_max.'" align="center" class="lt1">';
echo '<TR><TH width="5%">data';
echo '<TH width="5%">hora';
echo '<TH width="55%">descricao';
echo '<TH width="35%">tipo';
echo $s;
echo '</TABLE>';
require("foot.php");
?>
