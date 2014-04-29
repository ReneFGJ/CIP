<?
require("cab.php");
require("../_class/_class_lattes.php");
$lt = new lattes;

?>
<center>
		<form id="upload" action="<?=page();?>" method="post" enctype="multipart/form-data">
		<input type="file" name="arquivo" id="arquivo" />
		<BR><input type="checkbox" name="dd13" value="1"> Excluir dados de 2013
		<BR><input type="checkbox" name="dd12" value="1"> Excluir dados de 2012
		<BR><input type="checkbox" name="dd11" value="1"> Excluir dados de 2011
		<BR><input type="checkbox" name="dd10" value="1"> Excluir dados de 2010
		<BR><input type="checkbox" name="dd14" value="1"> Excluir dados de 2009
			
			
		<BR><input type="checkbox" name="dd30" value="1"> UTF8
		<BR>
		<input type="submit" name="dd1" value="enviar >>>">
	</form>
</center>
<?

//$sql = "delete from lattes_artigos"; $rlt = db_query($sql);
if ($dd[13]=='1') { echo '<HR>Excluíndo 2013<HR>'; $sql = "delete from lattes_artigos where la_tipo = 'A' and la_ano = '2013' "; $rlt = db_query($sql); }
if ($dd[12]=='1') { echo '<HR>Excluíndo 2012<HR>'; $sql = "delete from lattes_artigos where la_tipo = 'A' and la_ano = '2012' "; $rlt = db_query($sql); }
if ($dd[11]=='1') { echo '<HR>Excluíndo 2011<HR>'; $sql = "delete from lattes_artigos where la_tipo = 'A' and la_ano = '2011' "; $rlt = db_query($sql); }
if ($dd[10]=='1') { echo '<HR>Excluíndo 2010<HR>'; $sql = "delete from lattes_artigos where la_tipo = 'A' and la_ano = '2010' "; $rlt = db_query($sql); }
if ($dd[14]=='1') { echo '<HR>Excluíndo 2009<HR>'; $sql = "delete from lattes_artigos where la_tipo = 'A' and la_ano = '2009' "; $rlt = db_query($sql); }
if (strlen($dd[1]) > 0)
	{
						$tipo = $dd[2];
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
            					$sData .= fread($rHandle, filesize($temp));
        					fclose($rHandle);
							echo '<BR>'.date("d/m/Y H:i::s").' Tamanho do arquivo lido '.strlen($sData);
							
							if ($dd[30]=='1') { $sData = utf8_decode($sData); }
							
							$tipo = '';
							if (strpos($sData,'"Título do Livro"') > 0) { $tipo = 'livro'; }
							if (strpos($sData,'"Título da Obra Publicada"') > 0) { $tipo = 'livro_organizado'; }
							if (strpos($sData,'"Título do Trabalho";"Evento"') > 0) { $tipo = 'evento'; }
							if (strpos($sData,'"Artigo publicado em periódicos - Completo"') > 0) { $tipo = 'artigo'; }
							if (strpos($sData,'"Título";"ISBN";"Ano Publicação"') > 0) { $tipo = 'capitulo'; }
							
							echo '<BR>'.date("d/m/Y H:i::s").' Tipo do arquivo "'.$tipo.'"';
							
							$sData = troca($sData,"'","´");
							
							if ($tipo == 'livro_organizado') { $lt->inport_livros_organizados($sData); }
							if ($tipo == 'evento') { $lt->inport_eventos($sData); }
							if ($tipo == 'artigo') { $lt->inport_artigos($sData); }
							if ($tipo == 'livro') { $lt->inport_livros($sData); }
							if ($tipo == 'capitulo') { $lt->inport_livros_capitulos($sData); }
							}
						echo '</div>';
								
		//$lt->inport_livros($dd[1]);	
	}
?>
