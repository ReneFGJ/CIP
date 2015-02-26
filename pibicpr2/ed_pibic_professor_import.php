<?
require("cab.php");
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_debug.php');
$label = "Cadastro de rotinas do sistema";

//$sql = "ALTER TABLE pibic_professor ADD COLUMN pp_update char(4); ";
//$rlt = db_query($sql);;
//$sql = "update pibic_professor set pp_update = '2011' ";
//$rlt = db_query($sql);
//exit;
$sql = "select * from centro where centro_tipo = 1";
$rlt = db_query($sql);

$centro = array();
$centro_cod = array();
while ($line = db_read($rlt))
	{
		array_push($centro,UpperCaseSql(trim($line['centro_nome'])));
		array_push($centro_cod,UpperCaseSql(trim($line['centro_codigo'])));
	}

if (strlen($dd[1]) == 0)
	{
	?>
	<center>
	<H2>Importacao de Professores</H2>
	
	<form method="post">
	<textarea cols="70" rows="5" name="dd1"><?=$dd[1];?></textarea>
	<BR>
	<input type="submit" name="dd50" value="submissao">
	</form>
	
	<PRE>
	Matricula;Nome; CPF;Escolaridade;CH Semanal;SS;Cod_CR;Centro de Resultado;Atividade 
	</PRE>
	<?
	}
echo '<TT>';
$s = $dd[1];
$lim = 0;
while (strlen($s) > 20)
	{
	$lim++;
	if ($lim > 3000) { echo '200'; exit; }
	$ln = substr($s,0,strpos($s,chr(13))).';';
	$lne = $ln;
	$s = substr($s, strpos($s,chr(13))+2,strlen($s));
	echo '<HR>'.$ln.'<HR>';
	if (strlen($ln) > 10)
	{
	$c1 = trim(substr($ln,0,strpos($ln,';')));
	$ln = substr($ln,strpos($ln,';')+1,strlen($ln));
	
	$c2 = trim(substr($ln,0,strpos($ln,';')));
	$ln = substr($ln,strpos($ln,';')+1,strlen($ln));

	$c3 = trim(substr($ln,0,strpos($ln,';')));
	$ln = substr($ln,strpos($ln,';')+1,strlen($ln));

	$c4 = trim(substr($ln,0,strpos($ln,';')));
	$ln = substr($ln,strpos($ln,';')+1,strlen($ln));

	$c5 = trim(substr($ln,0,strpos($ln,';')));
	$ln = substr($ln,strpos($ln,';')+1,strlen($ln));

	$c6 = trim(substr($ln,0,strpos($ln,';')));
	$ln = substr($ln,strpos($ln,';')+1,strlen($ln));

	$c7 = trim(substr($ln,0,strpos($ln,';')));
	$ln = trim(substr($ln,strpos($ln,';')+1,strlen($ln)));

	$c8 = UpperCaseSql(trim(substr($ln,0,strpos($ln,';'))));
	$ln = substr($ln,strpos($ln,';')+1,strlen($ln));

	$c9 = trim(substr($ln,0,strpos($ln,';')));
	$ln = substr($ln,strpos($ln,';')+1,strlen($ln));

	$c10 = trim(substr($ln,0,strpos($ln,';')));
	$ln = substr($ln,strpos($ln,';')+1,strlen($ln));
	
	$c10 = 'ESCOLA DE '.UpperCaseSql($c10);
	
	$escola = -1;
	echo '=---->'.$c8;;
	
	for ($r=0;$r < count($centro);$r++)
		{
			if ($centro[$r] == $c8) { $escola = $centro_cod[$r]; }
			echo '<BR>'.$centro[$r].'--'.$c8.'='.($centro[$r] == $c8);
		}

	if (strlen($escola) < 5)
		{
			echo $lne;
			 echo 'Erro na escola '.$c8;
			 $escola = '-----';
		}

	$c4a = '004';
	if ($c4 == 'Superior Completo') { $c4a = '004'; }
	if ($c4 == 'Mestrado') { $c4a = '001'; }
	if ($c4 == 'Doutorado') { $c4a = '002'; }
	if ($c4 == 'P�s-Gradua��o') { $c4a = '005'; }
	if ($c4 == 'Especializa��o') { $c4a = '005'; }
	if ($c4 == 'Gradua��o') { $c4a = '004'; }
	
	if (strlen($c4a) == 0)
		{
		echo 'Erro ['.$c4.'] n�o localizado';
		exit; 
		}
	
	$sql = "select * from pibic_professor ";
	$sql .= " where pp_cracha = '".$c1."' ";
	$rlt = db_query($sql);
	echo '<BR>'.$c1.' ';
	if (strpos($c8,'-') > 0)
		{
		$curso = substr($c8,0,strpos($c8,'-'));
		} else {
		$curso = $c8;
		}
		$curso = substr($curso,0,50);
		$c9 = substr($c9,0,50);
	if ($line = db_read($rlt))
		{
			$usql = "update pibic_professor set ";
			$usql .= " pp_carga_semanal = '".$c5."' ";
			$usql .= ", pp_centro = '".$c9."' ";
			$usql .= ", pp_curso = '".$curso."' ";
			$usql .= ", pp_titulacao = '".$c4a."' ";
			$usql .= ", pp_ss = '".substr($c6,0,1)."' ";
			$usql .= ", pp_update = '".date("Y")."' ";
			$usql .= ", pp_escola = '".$escola."' ";
			$usql .= " where id_pp = ".$line['id_pp'];
			echo $sql;
			exit;
			$rlt = db_query($usql);
			echo '[Atualizado] ';
		} else {
			$usql = "insert into pibic_professor ";
			$usql .= "(pp_nome,pp_cracha,pp_escolaridade,";
			$usql .= "pp_carga_semanal,pp_ss,pp_cpf,";
			$usql .= "pp_centro,pp_curso,pp_ativo,pp_titulacao,pp_escola,pp_update";
			$usql .= ") values (";
			$usql .= "'".$c2."','".$c1."','".$c4."',";
			$usql .= "'".$c5."','".substr($c6,0,1)."','".sonumero($c3)."',";
			$usql .= "'".$c9."','".$c8."',1,'".$c4a."','$escola','".date("Y")."')";
			echo $sql;
			exit;
			$rlt = db_query($usql);
			echo '[Cadastrado] ';
		}
	}
	}

require("foot.php");	
?>