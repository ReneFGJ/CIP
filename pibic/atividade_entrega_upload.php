<?
$uploaddir = $dir.'/reol/pibicpr/docs/';

diretorio_checa($uploaddir);
diretorio_checa($uploaddir.'submit');
diretorio_checa($uploaddir.'submit/'.date("Y"));
diretorio_checa($uploaddir.'submit/'.date("Y")."/".date("m"));
$updir = 'submit/'.date("Y")."/".date("m");
$uploaddir .= 'submit/'.date("Y")."/".date("m");
$filename = trim($_FILES['userfile']['name']);
$ver = 0;

$ext = UPPERCASE(substr($filename,strlen($filename)-3,3));
$ok = 0;
if ($ext == 'PDF') { $ok = 1; }
if ($ext <> 'PDF') { $msge = "O sistema aceita somente a extensão PDF"; }

if ((strlen($filename) > 0 ) and (strlen($dd[0]) > 0) and (1==$ok))
	{
	$ver = count($versoes)+1;
	$filename = UpperCaseSql($filename);
	$filename = troca($filename,' ','_');
	$chave = UpperCaseSQL(substr(md5($chave.$dd[0]),0,8));
	$xfilename = $dd[0].'-'.strzero($ver,2).'-'.$chave.'-'.$filename;
	while (file_exists($uploaddir.'/'.$xfilename)) 
		{
		$ver++;
		$xfilename = $dd[0].'-'.strzero($ver,2).'-'.$chave.'-'.$filename;
		}

	////////////////////////////////////////////////////////////////
	echo '<TABLE class="lt1" width="100%">';
	$arq = $uploaddir.'/';$xfilename;
	$uploadfile = $uploaddir.'/'.$xfilename;

	$type = $_FILES['userfile']['name'];
	$fmt = UpperCase(substr($type,strlen($type)-3,3));
	if ($fmt == 'PDF') { $ok = 1; } else
	{ $msge = 'O formato do arquivo não é válido, aceito somente PDF'; $ok = 0; }
	
	if ($ok == 1) {
	if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) 
		{
			$name = $_FILES['userfile']['name'];
			$size = round($_FILES['userfile']['size']/10);
			$type = $_FILES['userfile']['name'];
			
			$type = substr($type,strlen($type)-3,3);
			$doc_acesso = '1';
			$sql = "insert into ".$ged_files." (pl_type,pl_filename,pl_texto,";
			$sql = $sql . "pl_texto_sql,pl_size,pl_data,";
			$sql = $sql . "pl_versao,pl_acesso,pl_codigo,";
			$sql = $sql . "pl_tp_doc,user_id,pl_hora) values (";
			$sql = $sql . "'".$type."','".$xfilename."','".$name."',";
			$sql = $sql . "'".$rtipo."',".$size.",".date("Ymd").",";
			$sql = $sql . $ver.",'".$doc_acesso."','".$dd[0]."',";
			$sql = $sql . "'".$rtipoc."',0".$user_id.",'".date("H:i")."'); ";
		    $message = "<CENTER><FONT class=lt3 ><font color=green><B>Arquivo válido e foi salvo.</FONT></CENTER>";
			$rlt = db_query($sql);
		} }
	}
	
function diretorio_checa($vdir)
	{
	if(is_dir($vdir))
		{ $rst =  '<FONT COLOR=GREEN>OK';
		} else { 
			$rst =  '<FONT COLOR=RED>NÃO OK';	
			mkdir($vdir, 0777);
			if(is_dir($vdir))
				{
				$rst =  '<FONT COLOR=BLUE>CRIADO';	
				}
		}
		$filename = $vdir."/index.htm";	
		if (!(file_exists($filename)))
		{
			$ourFileHandle = fopen($filename, 'w') or die("can't open file");
			$ss = "<!DOCTYPE HTML PUBLIC -//W3C//DTD HTML 4.01 Transitional//EN><html><head><title>404 : Page not found</title></head>";
			$ss = $ss . '<META HTTP-EQUIV="Refresh" CONTENT="3;URL='.site.'">';
			$rst = $rst . '*';
			fwrite($ourFileHandle, $ss);
			fclose($ourFileHandle);		
		}
		return($rst);
	}		
?>