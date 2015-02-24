<?
require("cab_fomento.php");
//require($include.'sisdoc_debug.php');
require("_email.php");
require($include.'sisdoc_email.php');

if (!(function_exists('msg')))
{ function msg($x) { return($x); } }

require("_class_comunicacao.php");
$cm = new comunicacao;

$cm->le($dd[0]);

echo $cm->mostra();

print_r($cm);
$dest = splitx(';',$cm->destinatario.';');

$ass = $cm->assunto;
$txt = $cm->mostra_conteudo();
echo '===>'.$cm->formato;

for ($r=0;$r < count($dest);$r++)
	{
		$msg_id = '    [mid:'.substr(md5($r.date("is")),4,6).']';
		echo '<BR>Enviando para '.$dest[$r];
		enviaremail($dest[$r],'',$ass.'  - '.$msg_id,$txt);
	}
?>
