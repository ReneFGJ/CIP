<?php
/*
 * BlackBox Methodology
 * @author Rene Faustino Gabriel Junior <renefgj@gmail.com>
 * @version 0.14.11
 */
 
 /* Disable message errors */
 ini_set('display_errors', 0);
 ini_set('error_reporting', 0);
 
 $verb = trim($_GET['verb']);
 $directory = trim($_GET['directory']);

 /* Verbo read files in local directory */
 switch ($verb)
 	{
 	case 'scan':
 				$xml = le_diretorio($directory);
				echo $xml;
 			break;
 	}	

exit;
 /* Functions Support */
 
function limpa_diretorio($dir)
	{
		$dirx = '';
		$dir = ' '.$dir;
		while (strpos($dir,'/')==true)
			{
				$dirp = strpos($dir,'/');
				$dirx .= trim(substr($dir,0,$dirp+1));
				$dir = substr($dir,$dirp+1,strlen($dir));
			}
		return($dirx);
	}
function trata_caracter($sx)
	{
		/* ('/',''&#47;') */
		$sx = troca($sx,'/','_');
		return($sx);
	}
function troca($qutf,$qc,$qt)
	{
	return(str_replace(array($qc), array($qt),$qutf));
	}	
function le_diretorio($dir='')
	{
	   $dir2 = $_SERVER['SCRIPT_FILENAME'];
	   $dir2 = limpa_diretorio($dir2);

	   $cr = chr(13).chr(10);
	   $handle = opendir( $dir2 . $dir );

	   header("Content-Type: text/xml");
	   $xml = '<?xml version="1.0"?>'.$cr;
	   
	   $xml .= '<folder>'.$cr;
	   $xml .= '<directory>'.trata_caracter($dir2).'</directory>'.$cr;
	   $xml .= '<date>'.date("YmdHis").'</date>'.$cr;
	   $id = 0;
       while ( false !== ( $filename = readdir ( $handle ) ) )
       {
       	$file = $filename;
       	$filename = $dir.$filename;
		//echo '<BR>'.$filename;
		
		if (!(is_dir($filename)))
			{
				if (file_exists($filename)) 
				{
					$id++;
					$file = $filename;
					//$file = troca($file,$dir,'');
					$data = date ("Ymd H:i:s", filemtime($filename));
					$version = date("0.y.W.d",filemtime($filename));
					$size = filesize($filename);
					$checksum = md5_file($filename);
					$directory = $dir;
					/* Monta XML */
					
					$xml .= '<file>'.$cr;
					$xml .= '<id>'.$id.'</id>'.$cr;
					$xml .= '<filename>'.$file.'</filename>'.$cr;
					$xml .= '<data>'.$data.'</data>'.$cr;
					$xml .= '<version>'.$version.'</version>'.$cr;
					$xml .= '<size>'.$size.'</size>'.$cr;
					$xml .= '<checksum>'.$checksum.'</checksum>'.$cr;
					if (strlen($directory) == 0)
						{
							$xml .= '<directory/>'.$cr;
						} else {
							$xml .= '<directory>'.$directory.'</directory>'.$cr;
						} 
					$xml .= '</file>'.$cr;
				}	
			}
       	}
	    $xml .= '</folder>'.$cr;
		return($xml);	
	}


	
 ?>
