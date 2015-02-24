<?
//echo '<BR>acao='.!isset($acao);
//echo '<BR>dd1='.isset($dd[1]);

if (!isset($acao) and isset($dd[0]) and (strlen(trim($dd[0]))>0)) 
	{
	$sql = "select * from ".$tabela." where ".$cp[0][6]."=".$dd[0];
	$result = db_query($sql);
	
    if ($line = db_read($result))
		{
		for ($k=1;$k<100;$k++)
			{
			if (isset($cp[$k][6]))
				{ 
				$dd[$k]=$line[$cp[$k][6]]; 
				if (substr($cp[$k][2],0,2) == '$D')
					{
					$dd[$k] = stodbr($dd[$k]);
					}
				if (substr($cp[$k][2],0,2) == '$N')
					{
					if ($dd[$k] > 1)
						{
						$SS = $dd[$k] * 100;
//						echo '['.$SS.']';
						$SS = substr($SS,0,strlen($SS)-2).'.'.substr($SS,strlen($SS)-2,2);
						$dd[$k] = $SS;
//						echo $dd[$k].'==='.$SS;
						}
					else
						{
						$dd[$k] = ($dd[$k]+1) * 100;
						$dd[$k] = '0.'.substr($dd[$k],strlen($dd[$k])-2,2);
						}
					
					}
				$cp[$k][1]=trim($dd[$k]);
				};
			}
		}
	}
/********************************************************** GRAVAR */
//if (strlen(trim($dd[1])) > 0) 
{
if (isset($acao))
	{
	$ok=1;
	for ($p=1;$p <100;$p++)
		{
		if ($cp[$p][5]==True)
			{
				if (isset($dd[$p]))
					{ 
					if (strlen(trim($dd[$p])) < 1) { $ok=-1; }
					} else { $ok=0; }
			}
//		echo "<BR>".$cp[$p][5].'='.$cp[$p][6].'='.$p."=[".$dd[$p]."]==>".$ok."==";
		}
	if ($ok==1)
	{
	if (isset($dd[0]) and (strlen($dd[0]) > 0)) 
		{
//		echo "==gravado";
		$sql = "update ".$tabela." set ";
		$cz=0;
		for ($k=1;$k<100;$k++)
			{
				if (isset($cp[$k][6]) && ($cp[$k][7]==False))
				{
					if ($cz++>0) {$sql = $sql . ', ';}
					if (substr($cp[$k][2],0,2) == '$D') { $cp[$k][1] = brtos($cp[$k][1]); }
					$sql = $sql . $cp[$k][6].'='.chr(39).$cp[$k][1].chr(39).' ';
				}
			}
		$sql = $sql .' where '.$cp[0][6].'='.$cp[0][1];
		$result = db_query($sql) or die("<P><FONT COLOR=RED>ERR 002:Query failed : " . db_error());
//		$dd[1] = NULL;
		$acao=null;
		$saved=1;
		}
	else
		{
		$sql = "insert into ".$tabela." (";
		$sql2= "";
		$tt=0;
		for ($k=1;$k<100;$k++)
			{
				if (isset($cp[$k][6]))
				{
				if ($tt++ > 0) { $sql = $sql . ', '; $sql1 = $sql1 .', ';}
				$sql = $sql . $cp[$k][6];
				if (substr($cp[$k][2],0,2) == '$D') { $cp[$k][1] = brtos($cp[$k][1]); }
				$sql1= $sql1. chr(39).$cp[$k][1].chr(39);
				}
			}
		$sql = $sql . ') values ('.$sql1.')';
//		echo $sql;
		$result = db_query($sql);
		$dd[1] = null;
		$acao=null;
		$saved=2;
		}
	}
	}
	else
	{
	$saved=-1;
	}
	//echo $sql;
}
?>