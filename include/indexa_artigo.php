<?
	if (strlen($dd[0])==0)
	{
	$sql = "select max(id_article) as art_id from ".$tabela;
	$rlt = db_query($sql);
	if ($line = db_read($rlt))
		{
		$dd[0] = $line['art_id'];
		}
	}
	$tit1 = $dd[1];
	$tit2 = $dd[9];
	$tit3 = $dd[13];
	
	$res1 = $dd[6];
	$res2 = $dd[10];
	$res3 = $dd[14];

	$key = $dd[7];
	$key = $dd[11];
	$key = $dd[15];

	$idi1= $dd[8];
	$idi2= $dd[12];
	$idi3= $dd[16];
	//// ZERA DADOS PARA INDEXAR NOVAMENTE
	$sql = "delete from search where article_id = '".$dd[0]."';";
	$sql = $sql . "delete from index where ix_article = '".$dd[0]."';";
	$rrr = db_query($sql);
	
	//// INICIA PROCESSO DE INDEXACAO
		//titulos
	indexar('TI',$idi1,$tit1,$dd[0]);
	indexar('TI',$idi2,$tit2,$dd[0]);
	indexar('TI',$idi3,$tit3,$dd[0]);
		//resumos
	indexar('AB',$idi1,$res1,$dd[0]);
	indexar('AB',$idi2,$res2,$dd[0]);
	indexar('AB',$idi3,$res3,$dd[0]);
		//autor
	indexar('AU',$idi1,$dd[5],$dd[0]);
	echo "-------->Keyword";
	indexar('KW',$idi1,$dd[7],$dd[0]);
	indexar('KW',$idi2,$dd[11],$dd[0]);
	indexar('KW',$idi3,$dd[15],$dd[0]);
	echo "-------->Fim";
	
function indexar($v1,$v2,$v3,$id)
	{
	global $jid;
	if (strlen(trim($v3)) > 0)
		{
		$v3a = UpperCaseSQL($v3);
		$sql = "insert into search (sc_tipo,journal_id,sc_idioma,sc_texto,sc_texto_asc,article_id) values ";
		$sql = $sql . "('".$v1."','".$jid."','".substr($v2,0,40)."','".substr($v3,0,40)."','".$v3a."','".$id."')";
		$rrr = db_query($sql);
		}
	if ($v1=="KW")
		{
		$ww=array();
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
//			echo $sql.'<HR>';
			$rrr = db_query($sql);
			}
		}
	}
?>