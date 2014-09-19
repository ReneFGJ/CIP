<?
$breadcrumbs=array();
require("cab_semic.php");

require($include.'sisdoc_autor.php');
require($include.'sisdoc_email.php');

require($include.'_class_form.php');
$form = new form;

if (strlen($acao) == 0)
	{
		$dd[2] = $dd[1];
	}

$cp = array();
array_push($cp,array('$H8','','',False,True));
array_push($cp,array('$S100','','',False,False));
array_push($cp,array('$S100','','',True,True));

$tela = $form->editar($cp,'');

if ($form->saved > 0)
	{
		echo 'SAVED';
		if (strlen($dd[2]) > 5)
			{
			/* MOSTRA */
			$tabela = "semic_trabalho_autor";
			$sql = "select * from $tabela where sma_nome = '".trim($dd[1])."' ";
			$rlt = db_query($sql);
			while ($line = db_read($rlt))
				{
					$sqla .= "update $tabela set sma_nome = '".$dd[2]."' where id_sma = ".$line['id_sma'].';'.chr(13);
					$sqlx .= "update $tabela set sma_nome = '".$line['sma_nome']."' where id_sma = ".$line['id_sma'].';'.chr(13);
				}
			/* SEMIC */
			$tabela = "semic_ic_trabalho_autor";
			$sql = "select * from $tabela where sma_nome = '".trim($dd[1])."' ";
			$rlt = db_query($sql);
			while ($line = db_read($rlt))
				{
					$sqla .= "update $tabela set sma_nome = '".$dd[2]."' where id_sma = ".$line['id_sma'].';'.chr(13);
					$sqlx .= "update $tabela set sma_nome = '".$line['sma_nome']."' where id_sma = ".$line['id_sma'].';'.chr(13);
				}
							
			if (strlen($sqla) > 0)
				{
					echo 'enviando e-mail: ';
					require('../pibicpr/_email.php');
					echo '.';
					enviaremail('renefgj@gmail.com','','[SEMIC] Autor: '.$dd[1],mst($sqlx).'<HR>'.mst($sqla));
					echo ' ok';
					$rlt = db_query($sqla);
				}
			echo '<form action="semic_autoridades.php">
						<input type="submit" value="voltar" class="botao-geral">
				</form>
					';
			}
	} else {
		echo $tela;
		echo '<HR>';
		echo '<PRE>
		Utilize "-" para unir subrenomes, mostrando o traço
		Utilize "_" para unir sobrenomes, ocultando o caracter
		</PRE>
		';
	}

echo '<BR><BR>';
$autor = nbr_autor($dd[2],7);
echo '<BR>'.$autor;
echo '<BR>'.nbr_autor($autor,1);
echo '<BR>'.nbr_autor($autor,5);

require("../foot.php");	
?>