<?
require("cab.php");
require("../_class/_class_importar_docente.php");
$dc = new importa_docente;
?>
<h1>Docentes Importa��o</h1>
<center>
		<form id="upload" action="<?=page();?>" method="post" enctype="multipart/form-data">
		<input type="file" name="arquivo" id="arquivo" />
		<input type="submit" name="dd1" value="enviar >>>">
	</form>
</center>
<?
if (strlen($dd[1]) > 0)
	{
	    $nome = lowercasesql($_FILES['arquivo']['name']);
		$temp = $_FILES['arquivo']['tmp_name'];
		$size = $_FILES['arquivo']['size'];
		echo '<DIV><TT></center>';
		echo '<BR>Arquivo: '.$temp;
		echo '<BR>Tamanho:'.$size;
		if (strlen($temp) > 0)
		{
			$rHandle = fopen($temp, "r");
			$sData = '';
			echo '<BR>'.date("d/m/Y H:i::s").' Abrindo Arquivo ';
			while(!feof($rHandle))
				{
				$sData .= fread($rHandle, filesize($temp));
				}
			fclose($rHandle);
			echo '<BR>'.date("d/m/Y H:i::s").' Tamanho do arquivo lido '.strlen($sData);
							
			if ($dd[30]=='1') { $sData = utf8_decode($sData); }
			
			$ln = splitx(chr(13),$sData);
			echo '<BR>Total de linhas: '.count($ln);
			echo '<BR>Valida��o do Arquivo ';
			/* Identica��o do tipo de obra */
			$tpo = 'doc';
			if (strlen($tpo) > 0)
				{
					echo '<B>'.$tpo.'</B>';
					$dc->arquivos_salva_quebrado($ln,$tpo);
					echo '<BR>SALVO!';
				} else {
					echo '<font color="red">Tipo de obra n�o identificada</font>';
					for ($r=0;$r < 100;$r++)
					{
						print_r($ln[$r]);
						echo '<HR>';
					}
				}
				
		}
	}
?>
