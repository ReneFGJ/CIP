<?
require("cab.php");
require($include."sisdoc_colunas.php");
require($include."sisdoc_windows.php");
require($include."sisdoc_debug.php");

		$sqli = "insert into semic_avaliacao (pp_titulo,pp_ref,pp_aluno_nome,pp_orientador_nome,pp_titulacao,";
		$sqli .= "pp_status,pp_tipo,pp_id,pp_p01,pp_p02,pp_p03) values ";
		$sqlv = '';
		$sqlu = '';
		
		$sql = 'select abbrev || lpad(article_seq,2,0) as idt,* from articles ';

		$sql = 'select abbrev || to_char(article_seq,'.chr(39).'000'.chr(39).') as idt,* from articles ';
		$sql = $sql . 'inner join issue on article_issue = id_issue ';
		$sql = $sql . 'inner join sections on article_section = section_id ';
		$sql = $sql . 'left join semic_avaliacao on id_article = pp_id ';
		$sql = $sql . 'where articles.journal_id = '.$jid.' ';
		
		$sql .= " and article_publicado <> 'X' ";
		$sql = $sql . ' order by seq,issue_title,sections.seq, article_seq';

		$rlt = db_query($sql);
		while ($line = db_read($rlt))
			{
			$idt = trim($line['abbrev']).strzero($line['article_seq'],2);
			$tit = $line['article_title'];
			$aut = $line['article_author'];
			$alu = substr($aut,0,strpos($aut,chr(13)));
			$alu_nome = substr(trim(substr($alu,0,strpos($alu,';'))),0,50);
			$alu_bolsa = substr($alu,strpos($alu,'[')+1,20);
			$alu_bolsa = trim(substr($alu_bolsa,0,strpos($alu_bolsa,']')));
			$proto = strzero($line['id_article'],5);
			$protoa = trim($line['id_pp']);
			$ori = substr($aut,strpos($aut,chr(13))+1,strlen($aut));
			$ori = substr($ori,0,strpos($ori,';'));
			$alu_ori = substr(trim($ori),0,50);

			if (strlen($protoa) == 0)
				{
				if (strlen($sqlv) > 0) { $sqlv .= ', '; }
				$sqlv = $sqli;
				$sqlv .= "('".$tit."','".$idt."','".$alu_nome."','".$alu_ori."','',";
				$sqlv .= "'@','".substr($alu_bolsa,0,5)."','".$proto."',0,0,0)";
				$xrlt = db_query($sqlv);				
				}		
			else
				{
				$sqlu = 'update semic_avaliacao set ';
				$sqlu .= "pp_titulo = '".$tit."'";
				$sqlu .= ",pp_aluno_nome = '".substr($alu_nome0,0,50)."'";
				$sqlu .= ",pp_orientador_nome = '".substr($alu_ori,0,50)."'";
				$sqlu .= ",pp_status = '@'";
				$sqlu .= ",pp_tipo = '".substr($alu_bolsa,0,5)."'";
				$sqlu .= " where id_pp = ".$line['id_pp'];
				$xrlt = db_query($sqlu);	
		
				}
			}

$sql = "select * from semic_avaliacao ";
$sql .= " order by pp_ref ";
$rlt = db_query($sql);
$ss = '';
while ($line = db_read($rlt))
	{
	$link = '<SPAN onclick="newxy2('.chr(39).'central_declaracao.php?dd0='.trim($line['pp_ref']).'&dd1=tp01'.chr(39).',600,500);"><font color="blue"><B>imprimir';
	if (substr($line['pp_ref'],0,1) == 'S') { $link = ''; }
	if (substr($line['pp_ref'],0,1) == 'M') 
		{
		}
	$ss .= '<TR '.coluna().'>';
	$ss .= '<TD>';
	$ss .= $line['pp_ref'];
	$ss .= '<TD>';
	$ss .= $line['pp_titulo'];
	$ss .= '<TD>';
	$ss .= $line['pp_aluno_nome'];
	$ss .= '<TD>';
	$ss .= $line['pp_orientador_nome'];
	$ss .= '<TD>';
	$ss .= $line['pp_tipo'];
	$ss .= '<TD>';
	$ss .= $line['pp_status'];
	$ss .= '<TD>';
	$ss .= $link;
	}
?>
<table width="<?=$tab_max;?>" class="lt1">
<?=$ss;?>
</table>
<?

require("foot.php");
?>