<?
require("db.php");
require($include."sisdoc_debug.php");
$user_id = read_cookie('nw_user');
$user_nome = read_cookie('nw_user_nome');
$user_nivel = read_cookie('nw_nivel');
$user_log = read_cookie('nw_log');
$nucleo = 'pibic_submit_documento';

if ((strlen($dd[2])==0) or (strlen($dd[1])==0) or (strlen($dd[0])==0))
	{
	echo 'Falha na autenticaчуo';
	exit;
	}
//$sql = "select * from pibic_ged_files where pl_codigo='".$dd[1]."' and id_pl=".$dd[0];
$sql = "select * from pibic_ged_files ";
$sql .= " inner join pibic_submit_documento on pl_codigo = doc_protocolo ";
$sql .= " where id_pl=".$dd[0];
$rlt = db_query($sql);

if ($line = db_read($rlt))
	{
	$protocolo = trim($line['doc_protocolo']);
	$file = trim($line['pl_filename']);
	$filename = trim($line['pl_texto']);
	$tipo = trim($line['pl_tp_doc']);
	if ($tipo == 'RPARC')
		{
		$dir = $_SERVER['DOCUMENT_ROOT'].'/reol/pibicpr/docs/submit/';
		$data = substr($line['pl_data'],0,4).'/'.substr($line['pl_data'],4,2);
		} else {
		$dir = $_SERVER['DOCUMENT_ROOT'].'/reol/pibic/public/submit/';
		$data = substr($line['pl_data'],0,4).'/'.substr($line['pl_data'],4,2);
		}
	$arq = $dir.$data.'/'.$uploaddir;
	$arq = $dir.$data.'/'.$file;
//echo $arq;
//exit;
	if (!(file_exists($arq)))
		{
		$dir = $_SERVER['DOCUMENT_ROOT'].'/reol/pibicpr/docs/submit/';
		$data = substr($line['pl_data'],0,4).'/'.substr($line['pl_data'],4,2);	
		$arq = $dir.$data.'/'.$uploaddir;
		$arq = $dir.$data.'/'.$file;
		}

	if (!(file_exists($arq)))
		{
		echo 'Arquivo nуo localizado '.$arq;
		echo '<BR>';
		echo '>>>'.$line['pl_tp_doc'];
		exit;
		}
	header("Expires: 0");
	//header('Content-Length: $len');
	header('Content-Transfer-Encoding: none');
	$file_extension = strtolower(substr($file,strlen($file)-3,3));
	switch( $file_extension ) {
	      case "pdf": $ctype="application/pdf"; break;
    	  case "exe": $ctype="application/octet-stream"; break;
	      case "zip": $ctype="application/zip"; break;
	      case "doc": $ctype="application/msword"; break;
	      case "xls": $ctype="application/vnd.ms-excel"; break;
	      case "ppt": $ctype="application/vnd.ms-powerpoint"; break;
	      case "gif": $ctype="image/gif"; break;
	      case "png": $ctype="image/png"; break;
	      case "jpeg":
	      case "jpg": $ctype="image/jpg"; break;
	      case "mp3": $ctype="audio/mpeg"; break;
	      case "wav": $ctype="audio/x-wav"; break;
	      case "mpeg":
	      case "mpg":
	      case "mpe": $ctype="video/mpeg"; break;
	      case "mov": $ctype="video/quicktime"; break;
	      case "avi": $ctype="video/x-msvideo"; break;
		}
	header("Content-Type: $ctype");
	header('Content-Disposition: attachment; filename="'.$protocolo.'-'.$filename.'"');
	readfile($arq);
	} else {
		echo 'Arquivo nуo localizadao';
	}
	$pj_codigp = $dd[1];
	$acao="D";
	require("index_count_v2.php");	
?>