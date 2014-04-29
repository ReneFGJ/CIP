<?php
require("cab.php");
require($include."sisdoc_debug.php");
require("../_class/_class_docentes.php");
$doc = new docentes;

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
	
if (strlen($dd[1]) > 0)
	{
		echo '<HR>';
		$ln = splitx(chr(13),$dd[1]);
				
		for ($r=0;$r < count($ln);$r++)
			{
				//echo $ln[$r];
				$l = splitx(';',$ln[$r].';');
				
				$cracha = $l[0];
				$nome = $l[1];
				$cpf= sonumero($l[20]);
				$titulacao = $doc->inport_titulacao($l[2]);
				$escolaridade = $l[2];
				$ss = $l[25];
				$ch = $l[24];
				$centro2 = $l[6];
				$escola2 = UpperCaseSql(trim($l[7]));
				$escola = '';
				$email = $dd[3];
				/* Busca Escola */
				for ($r1=0;$r1 < count($centro);$r1++)
					{
						if (trim($centro[$r1]) == $escola2) { $escola = $centro_cod[$r1]; }
						//echo '<BR>'.$centro[$r].'--'.$c8.'='.($centro[$r] == $c8);
					}
				if (strlen($escola)==0) { echo '<font color="red">Erro na escola "'.$escola2.'"'; exit; }
				
				$curso = $l[8];
				echo '<BR>==>'.$cracha.' '.$nome.' '.$titulacao.' ';
				$sql = "select * from pibic_professor ";
				$sql .= " where pp_cracha = '".$cracha."' ";
				$rrlt = db_query($sql);
				if ($line = db_read($rrlt))
					{
						$usql = "update pibic_professor set ";
						$usql .= " pp_carga_semanal = '".$ch."' ";
						$usql .= ", pp_centro = '".$centro2."' ";
						$usql .= ", pp_curso = '".$curso."' ";
						$usql .= ", pp_titulacao = '".$titulacao."' ";
						$usql .= ", pp_ss = '".substr($ss,0,1)."' ";
						$usql .= ", pp_update = '".date("Y")."' ";
						$usql .= ", pp_escola = '".$escola."' ";
						$usql .= " where id_pp = ".$line['id_pp'];
						echo $usql; exit;
					$wrlt = db_query($usql);
					echo '[Atualizado] ';
				} else {
					$usql = "insert into pibic_professor ";
					$usql .= "(pp_nome,pp_cracha,pp_escolaridade,";
					$usql .= "pp_carga_semanal,pp_ss,pp_cpf,";
					$usql .= "pp_centro,pp_curso,pp_ativo,pp_titulacao,pp_escola,pp_update";
					$usql .= ") values (";
					$usql .= "'".$nome."','".$cracha."','".substr($escolaridade,0,20)."',";
					$usql .= "'".$ch."','".substr($ss,0,1)."','".sonumero($cpf)."',";
					$usql .= "'".$centro2."','".$curso."',1,'".$titulacao."','$escola','".date("Y")."')";
					echo $usql; exit;
					$wrlt = db_query($usql);
							
					echo '[Cadastrado] ';
		}				
			}
	}
require("../foot.php");	?>