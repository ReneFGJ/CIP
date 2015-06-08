<?
$include = '../';
require("../db.php");
require($include."sisdoc_debug.php");
require($include."sisdoc_cookie.php");

$dir = $_SERVER['DOCUMENT_ROOT'];
$uploaddir = $dir.'/reol/submissao/public/submit/';
$uploaddir = $dir.'/reol/subm/document/';
$uploaddir = '';

$user_id = read_cookie('nw_user');
$user_nome = read_cookie('nw_user_nome');
$user_nivel = read_cookie('nw_nivel');
$user_log = read_cookie('nw_log');
$nucleo = 'reol_submit';
if (strlen($user_id) ==0)
	{
	//echo '<CENTER><font color="RED" size=2 face="verdana">Erro de Login</font></CENTER>';
	//exit;
	}

if ((strlen($dd[2])==0) or (strlen($dd[1])==0) or (strlen($dd[3])==0))
	{
	echo 'Falha na autenticação. Erro 10';
	exit;
	}
$sql = "select * from submit_files ";
//$sql .= " inner join ".$nucleo." on pl_codigo = doc_protocolo ";
$sql .= " where id_doc=".$dd[0];
$rlt = db_query($sql);

if ($line = db_read($rlt))
	{
	$data = $line['doc_data'];
	$protocolo = 'S'.trim($line['doc_dd0']);
	$file = trim($line['doc_arquivo']);
	$filename = trim($line['doc_filename']);
	///// recupera diretorio onde foi gravado arquivo
	$arq = '../';
	//// ano
	$arq .= substr($data,0,4).'/';
	//// mes
	$arq .= substr($data,4,2).'/';
	$arq = $file;
	
	if (!(file_exists($arq)))
		{
		echo 'Arquivo não localizado '.$arq;
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
		echo 'Arquivo não localizadao';
	}
	$pj_codigp = $dd[1];
	$acao="D";
?>