<?
$breadcrumbs=array();
require("cab_semic.php");
require($include.'sisdoc_autor.php');

$jid = 85;
$sql = "select * from articles where journal_id = ".$jid;
$sql .= " and (article_autores = '' or article_autores is null or article_autores like '%[*]%') ";
$sql .= " and (article_publicado = 'S' )";
$rlt = db_query($sql);
$id = 0;
while ($line = db_read($rlt))
	{
		$id++;
		$ln = $line ['article_author'];
		$ln = troca($ln,chr(13),'#');
		$ln = troca($ln,chr(10),'');
		$ll = splitx('#',$ln.'#');
		$sa = '';
		
		for ($r=0;$r < (count($ll)-1);$r++)
			{
				
				$sn = $ll[$r];
				
				if (strpos($sn,';') > 0)
					{
						$sn = substr($sn,0,strpos($sn,';'));
					}
				$sn = nbr_autor($sn,8);
				
				if (strlen($sa) > 0) { $sa .= ', '; }
				$sa .= nbr_autor($sn,1);
				//echo '<BR>'.$sa;
			}
		//$sa .= '[*]';
		
		echo '<HR>'.$sa.'<HR>';
		//exit;
		$sql = "update articles set article_autores = '".$sa."' where id_article = ".$line['id_article'];
		$xrlt = db_query($sql);
	}
echo $id;
require("../foot.php");	
?>