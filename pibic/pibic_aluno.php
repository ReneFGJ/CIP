<?
require("cab.php");

$sql= "select * from pibic_aluno ";
$sql .= "limit 1 ";

$rlt = db_query($sql);
$line = db_read($rlt);

//print_r($line);

$cracha = trim($line['pa_cracha']);
$filename = $cracha;
$ver = 1;
$uploaddir = '/pucpr/httpd/htdocs/www2.pucpr.br/reol/';
	$chave = "pibic".date("Y");
	$chave = UpperCaseSQL(substr(md5($chave.$dd[0]),0,8));
	$xfilename = $cracha.'-'.strzero($ver,2).'-'.$chave.'-'.$filename.'.jpg';
	$xfilename = $uploaddir. 'pibic/ass/cpf/'.$xfilename;
echo '<BR>'.$xfilename.' =][= ';

if (file_exists($xfilename))
	{
	echo 'ok';
	} else {
	echo 'não ok';
	}
echo '<TABLE width="'.$tab_max.'" align="center"><TR><TD>';
require($include.'sisdoc_row.php');	
echo '</table>';
?>