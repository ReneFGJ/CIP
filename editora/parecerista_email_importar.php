<?
require("cab.php");
echo $hd->menu();
echo '<div id="conteudo">';
echo $hd->main_content('Importar e-mail');
require ("_class/_class_users.php");
$leitor = new users;

$b1 = 'Importar Autores que Submeteram';
$b2 = 'Importar lista manualmente';
$jid = strzero($_SESSION['journal_id'],7);

/*********** TIPO 2 **********************/
if ($acao == $b2)
	{
		
		$em = split(';',$dd[2]);
		for ($r=0;$r < count($em);$r++)
			{
				$email = $em[$r];
				$nome = $em[$r];
				echo '<BR>'.$email.'-->';
				echo $leitor->insert_leitor($nome,$email,$email2);
			}		
	}

/*********** TIPO 1 **********************/
if ($acao == $b1)
	{
		$sql = "select *
					from submit_documento
				inner join submit_autor on sa_codigo = doc_autor_principal 
				where doc_journal_id = '$jid'
				limit 100
				";
				echo $sql;
		$rlt = db_query($sql);
		
		while ($line = db_read($rlt))
			{
				$nome = trim($line['sa_nome']);
				$email = trim($line['sa_email']);
				$email2 = trim($line['sa_email_alt']);

				$leitor->insert_leitor($nome,$email,$email2);
			}
	}

echo '<form action="'.page().'" method="post">';
echo '<textarea name="dd2" cols=80 rows=10 >'.$dd[2].'</textarea>';
echo '<BR>';
echo '<input name="acao" type="submit" value="'.$b2.'">';
echo '<HR>';
echo '<input name="acao" type="submit" value="'.$b1.'">';
echo '<HR>';
echo '</form>';
echo '</div>';
require("foot.php");	
?>