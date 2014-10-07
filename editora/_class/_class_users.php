<?php
class users {
	var $tabela_fila_envio = 'user_fila_envio';	

	function email_resumo_enviar() {
		$sql = "select count(*) as total 
				from " . $this -> tabela_fila_envio;
		$rlt = db_query($sql);
		$line = db_read($rlt);
		return ($line['total']);
	}
	
	function email_gera_fila_envio($titulo, $conteudo, $email, $titulo_email = '') {
		$last = $this -> email_resumo_enviar();
		if ($last > 0) {
			echo '<h1>ERRO</h1>';
			echo '<h2>Não é possível gerar nova lista, existe ' . $last . ' e-mail para enviar da campanha anterior</h2>';
			echo 'click <A HREF="chamadas_enviar_email.php">AQUI</A> para finalizar o envio';
			exit ;
		}
		$xmail = '';
		$sql = '';

		for ($r = 0; $r < count($email); $r++) {
			$mail = trim($email[$r]);
			echo '<BR>Inserindo -> ' . $email[$r];
			if ($mail != $xmail) {
				$nome = substr($email[$r], strpos($email[$r], ';') + 1, 255);
				$cracha = substr($nome, strpos($nome, ';') + 1, 255);
				//$nome = substr($nome, 0, strpos($nome, ';'));
				$cracha = substr($cracha, 0, strpos($cracha, ';'));
				/****/
				$titulo = troca($titulo, '<br>', '');
				$titulo = troca($titulo, '<BR>', '');
				$titulo = troca($titulo, '&nbsp', '');
				$tit = '[NEWS] - ' . $titulo;
				if (strlen($titulo_email) > 0) {
					$tit = '[NEWS] - ' . $titulo_email;
				}
				$nnome = substr($nome, 0, strpos($nome, ';'));
				$tit .= ' ' . $nnome;

				$txt = $conteudo;

				$sql .= "insert into " . $this -> tabela_fila_envio . " 
									( fle_email, fle_titulo, fle_content )
									values
									( '$mail','$tit','$txt');
							" . chr(13) . chr(10);
				echo ' <font color="blue">Adicionado</font>';
			} else {
				echo ' <font color="red">descartado</font>';
			}
			$xmail = $mail;
		}

		if (strlen($sql) > 0) { $rlt = db_query($sql);
		}
	}

	function enviar_email($total) {

		$sql = "select * from " . $this -> tabela_fila_envio . "
						order by id_fle
						limit " . round($total);

		$rlt = db_query($sql);
		$sql = "";
		while ($line = db_read($rlt)) {
			$id = $line['id_fle'];
			$email = $line['fle_email'];
			$titulo = $line['fle_titulo'];
			$conteudo = $line['fle_content'];
			enviaremail($email, '', $titulo, $conteudo);
			echo '<BR>Enviado para ' . $email;
			$sql .= "delete from " . $this -> tabela_fila_envio . " where id_fle = " . round($id) . ';' . chr(13) . chr(10);
		}
		if (strlen($sql) > 0) { $rlt = db_query($sql);
		}

		$total = $this -> email_resumo_enviar();
		return ($total);
	}

	function fila_email_create() {
		$sql = "	CREATE TABLE user_fila_envio
					( 
					id_fle serial NOT NULL, 
					fle_content text, 
					fle_titulo char(255), 
					fle_email char(120) 
					);
				";
		$rlt = db_query($sql);
	}

	function recupera_email() {
		global $jid;
		$sql = "select * from users 
						where journal_id = '" . $jid . "' and disabled = 0
						order by email
						";
		$rlt = db_query($sql);
		while ($line = db_read($rlt)) {
			$ee .= trim($line['email']) . '; ';
		}
		return ($ee);
	}

	function insert_leitor($nome, $email, $email_alt) {
		global $jid;
		$nome = substr($nome, 0, 40);
		$sql = "select * from users 
				where email = '$email' and journal_id  = '$jid'
				order by email
			";
		$rlt = db_query($sql);
		if (!($line = db_read($rlt))) {
			$name = substr($email, 0, strpos($nome, ';'));
			$data = date("Y-m-d");
			$pass = md5($data);
			$sql = "insert into users 
						(username, senha, first_name,
						middle_name, last_name, initials,
						affiliation, email, phone, 
						mailing_address, biography, interests,
						locales, date_registered, date_last_login,
						must_change_password, disabled, disabled_reason,
						journal_id 
						) values (
						'$name','$pass','$nome',
						'','','',
						'','$email','',
						1,0,0,
						'','$data','1900-01-01',
						0,0,0,
						'$jid'
						)
				";
			//echo $sql; exit;
			echo '<BR>Inserido -->' . $email;
			$xrlt = db_query($sql);
		}
	}

	function desabilitar_email_invalido() {
		global $jid;
		//$sql .= "update users set disabled = 0 where journal_id = '".$jid."'";
		//$rlt = db_query($sql);

		$sql = "select * from users 
						where journal_id = '" . $jid . "' and disabled = 0
						order by email
						";
		$rlt = db_query($sql);
		$sql = "";
		while ($line = db_read($rlt)) {
			$ok = checaemail($line['email']);
			if ($ok == 1) {

			} else {
				$sql .= "update users set disabled = 1 where user_id = " . $line['user_id'] . ';' . chr(13) . chr(10);
				//echo '<BR>'.$line['email'];
				//echo ' <font color="red">Erro</font>';
				$sql = "";
			}
		}
		if (strlen($sql) > 0) { $rlt = db_query($sql);
		}
		return (0);

	}

	function resumo() {
		global $jid, $dd, $acao;
		$jid = strzero($jid, 7);

		$this -> desabilitar_email_invalido();

		if ($dd[1] == 'disable') {
			$sql = "update users set disabled = 1 where email = '" . trim($dd[0]) . "' and journal_id = '" . $jid . "' ";
			$rlt = db_query($sql);
		}
		$sql = "select * from users 
						where journal_id = '" . $jid . "' and disabled = 0
						order by email
						";
		$rlt = db_query($sql);

		$sx .= '<table width="100%" class="tabela01">';
		$r = 0;
		while ($line = db_read($rlt)) {
			$r++;
			$nome = $line['first_name'];
			$sx .= '<TR ><TD style="border-top: 1px solid #000000;">';
			$sx .= '<A name="P' . ($r) . '"></A>';
			$sx .= trim($line['email']) . '<BR>';
			$sx .= '<TD style="border-top: 1px solid #000000;" align="center">';
			$sx .= checaemail($line['email']);
			$sx .= '<TD style="border-top: 1px solid #000000;">';
			$link = '<A HREF="' . page() . '?dd0=' . trim($line['email']) . '&dd1=disable&dd90=' . checkpost($line['email']) . '#P' . ($r - 1) . '">';
			$sx .= $link;
			$sx .= '[desabilidar]';
			$sx .= '</A>';
		}
		$sx .= '</table>';
		return ($sx);
	}

}
?>
