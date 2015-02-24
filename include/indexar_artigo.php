<?
if (strlen($dd[0]) == 0) { echo "dd0 igual a zero"; exit; }

	$tit1 = $line['article_title'];
	$tit2 = $line['article_2_title'];
	$tit3 = $line['article_3_title'];
	
	$res1 = $line['article_abstract'];
	$res2 = $line['article_2_abstract'];
	$res3 = $line['article_3_abstract'];

	$key1 = $line['article_keywords'];
	$key2 = $line['article_2_keywords'];
	$key3 = $line['article_3_keywords'];

	$idi1= $line['article_idioma'];
	$idi2= $line['article_2_idioma'];
	$idi3= $line['article_3_idioma'];

	$aturo = $line['article_author'];
	//// ZERA DADOS PARA INDEXAR NOVAMENTE
	$sql = "delete from search where article_id = '".$dd[0]."';";
	$sql = $sql . "delete from index where ix_article = '".$dd[0]."';";
	$rrr = db_query($sql);
	
	//// INICIA PROCESSO DE INDEXACAO
		//titulos
	echo "<BR>-------->ID:".$dd[0];
	indexar('TI',$idi1,$tit1,$dd[0]);
	indexar('TI',$idi2,$tit2,$dd[0]);
	indexar('TI',$idi3,$tit3,$dd[0]);
		//resumos
	indexar('AB',$idi1,$res1,$dd[0]);
	indexar('AB',$idi2,$res2,$dd[0]);
	indexar('AB',$idi3,$res3,$dd[0]);
		//autor
	indexar('AU',$idi1,$autor,$dd[0]);
	echo "<BR>-------->Keyword";
	indexar('KW',$idi1,$key1,$dd[0]);
	indexar('KW',$idi2,$key2,$dd[0]);
	indexar('KW',$idi3,$key3,$dd[0]);
	echo "<BR>-------->Fim";
	
function indexar($v1,$v2,$v3,$id)
	{
	global $jid;
	if (strlen(trim($v3)) > 0)
		{
		$v3a = UpperCaseSQL($v3);
		$sql = "insert into search (sc_tipo,journal_id,sc_idioma,sc_texto,sc_texto_asc,article_id) values ";
		$sql = $sql . "('".$v1."','".$jid."','".substr($v2,0,40)."','".substr($v3,0,40)."','".$v3a."','".$id."')";
		echo '<HR>'.$sql.'<HR>';
		exit;
		$rrr = db_query($sql);
		}
	if ($v1=="KW")
		{
		$ww=array();
		$v3 = troca($v3,'.',';');
		$v3=$v3.';';
		$v3=troca($v3,',',';');
		$i = strpos($v3,';');
		echo $i;
		while ($i > 0)
			{
			$vv=trim(substr($v3,0,$i));
			if (strlen($vv) > 0)
				{
				array_push($ww,$vv);
				}
			$v3 = substr($v3,$i+1,strlen($v3));
			$i = strpos($v3,';');
			}
		$sql = "";
		for ($k=0;$k < count($ww);$k++)
			{
				$kx=$ww[$k];
				if (substr($kx,strlen($lx)-1,1) == '.')
					{
					$kx = substr($kx,0,strlen($kx)-1);
					}
//				$ky = UpperCase(substr($kx,0,1)).LowerCase(substr($kx,1,39));
				$sql = $sql . 'insert into index (ix_word,ix_article,ix_idioma,ix_asc,journal_id) values ';
				$sql = $sql . "('".substr($kx,0,40)."','".$id."','".substr($v2,0,40)."','".substr(UpperCaseSQL($kx),0,40)."','".$jid."');".chr(13);
			}
		if (strlen($sql) > 0)
			{
			$rrr = db_query($sql);
			}
		}
	}
?>