<?php
require("cab.php");
require($include."sisdoc_debug.php");
require("../_class/_class_docentes.php");
$doc = new docentes;

/* Recupera Centros */
$sql = "select * from centro where centro_tipo = 1";
$rlt = db_query($sql);

		echo '<H2>Importacao de Professores Simplificada</H2>';
		echo '<table width="900" align="center"><TR><TD>';

$centro = array();
$centro_cod = array();
while ($line = db_read($rlt))
	{
		array_push($centro,UpperCaseSql(trim($line['centro_nome'])));
		array_push($centro_cod,UpperCaseSql(trim($line['centro_codigo'])));
	} 	
/* Formulários */
if (strlen($dd[1]) == 0)
	{
	?>
	<H2>Importacao de Professores</H2>
	
	<form method="post">
	<textarea cols="70" rows="5" name="dd1"><?=$dd[1];?></textarea>
	<BR>
	<input type="submit" name="dd50" value="submissao">
	</form>
	
	<PRE>
	Matricula;Nome;Escolaridade;e-mail;Curso;Campi;Escola 
	</PRE>
	<?
	}
	
/* Processamento */
if (strlen($dd[1]) > 0)
	{
		/* Separa por Array */

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
				$curso = $l[4];
				$ss = $l[25];
				$ch = $l[24];
				$centro2 = $l[5];
				$escola2 = UpperCaseSql(trim($l[5]));
				$escola = $l[6];
				$email = $dd[3];
				/* Busca Escola */
				if ($escola2 == 'ESCOLA DE CIENC. AGR. E MED. VET.') 
					{ $escola2 = 'ESCOLA DE CIENCIAS AGRARIAS E MEDICINA VETERINARIA'; }
				
				for ($r1=0;$r1 < count($centro);$r1++)
					{
						if (trim($centro[$r1]) == $escola2) { $escola = $centro_cod[$r1]; }
						//echo '<BR>'.$centro[$r].'--'.$c8.'='.($centro[$r] == $c8);
					}
				if (strlen($escola)==0) { echo '<font color="red">Erro na escola "'.$escola2.'"'; exit; }
				
				echo '<BR>==><TT>'.$cracha.' '.$nome.' '.$titulacao.'</TT>';
				$sql = "select * from pibic_professor ";
				$sql .= " where pp_cracha = '".$cracha."' ";
				$rrlt = db_query($sql);
				
				if ($line = db_read($rrlt))
					{
						$doc->atualliza_dados_docente($cracha,$curso,$titulacao,$centro2,$ss,$email,$ch);
						echo '[Atualizado] ';
				} else {
						$doc->inserir_docente($cracha,$nome,$email);
						$doc->atualliza_dados_docente($cracha,$curso,$titulacao,$centro2,$ss,$email,$ch);							
						echo '[Cadastrado] ';
				}
									
			}
	}

echo '</table>';
require("../foot.php");	?>