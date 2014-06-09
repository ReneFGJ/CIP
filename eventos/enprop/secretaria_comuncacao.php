<?php
require("secretaria_cab.php");
require($include.'sisdoc_email.php');

require($include.'_class_form.php');
$form = new form;

$cp = array();
array_push($cp,array('$H8','','',False,False));
array_push($cp,array('$T80:8','','',True,True));

$tela = $form->editar($cp,'');

if ($form->saved == 0)
	{
		echo $tela;
	} else {
		echo 'Enviando...';
		
		$sql = "select * from evento_enprop where ev_status <> 'X' and ev_status <> '@' ";
		$rlt = db_query($sql);
		$id = 0;
		while ($line = db_read($rlt))
			{
				$id++;
				$nome = ($line['ev_nome']);
				$link = 'http://www2.pucpr.br/reol/eventos/enprop/registration_edit.php?dd0='.$line['id_ev'].'&dd90='.checkpost($line['id_ev']);
				$link = '<A HREF="'.$link.'">'.$link.'</A>';
				$ttt = $dd[1];
				$ttt = troca($ttt,'$nome',$nome);
				$ttt = troca($ttt,'$link',$link);
				$email = trim($line['ev_email']);
				$email = troca($email,' ',';').';';
				$email = splitx(';',$email);
				//array_push($email,'renefgj@gmail.com');
				for ($r=0;$r < count($email);$r++)
					{
					$em = $email[$r];
					//enviaremail($em,'','ENPROP2013 - Confirmação de dados',$ttt);
					//$em = 'renefgj@gmail.com';
					$ttt = '<CENTER><IMG SRC="http://www2.pucpr.br/reol/eventos/enprop/img/logo_enprop.png"></center><BR>'.$ttt;
					enviaremail($em,'','ENPROP2013 - Confirmação de dados',mst($ttt));
					echo '<BR>Enviado para o e-mail '.$em;
					}
			}
			echo 'total>>'.$id;
	}

echo '<BR>';
echo '<BR>$nome = nome do inscrito';
echo '<BR>$link = link de acesso do inscrito';
	
echo $sc->foot();

function msg($x) { return($x); }
?>
