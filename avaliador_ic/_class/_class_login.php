<?php
class login {
	var $userp_erro = '';
	var $userp_msg = '';

	var $userp_codigo = '';
	var $userp_name = '';
	var $userp_login = '';
	var $userp_session = '';

	var $auth = 'FILE';

	function security() {
		$this -> userp_name = trim($_SESSION['userp_nome']);
		$this -> userp_login = trim($_SESSION['userp_cod']);
		$this -> userp_codigo = trim($_SESSION['userp_cod']);
		$this -> userp_session = trim($_SESSION['usp_instituicao']);
		
		if (strlen($this -> userp_name) > 0) {
			$this -> setar_usuario();
			return (1);
		} else {
			return (0);
		}
	}

	function setar_usuario() {
		$_SESSION['userp_name'] = $this -> userp_name;
		$_SESSION['userp_login'] = $this -> userp_login;
		$_SESSION['userp_codigo'] = $this -> userp_codigo;
		$_SESSION['userp_session'] = $this -> userp_session;
	}

	function save_userp_to_file() {
		$file = "_user.txt";
		if (file_exists($file)) {
			$ln = file($file);
		} else {
			$ln = array();
		}
	}

	function login($user='', $pass='') {
		global $dd;
		$user = UpperCaseSQL($user);
		$pass = UpperCaseSQL($pass);
		
		if (($user == 'RENE') and ($pass = "ANDRE@19")) {
			$this -> userp_erro = '0';
			$this -> userp_msg = '';
			$this -> userp_name = $user;
			$this -> userp_login = $user;
			$this -> setar_usuario();
			return (1);
		} else {
			$this -> userp_erro = '1';
			$this -> userp_msg = 'Usuário Inválido';
			return (0);
		}
	}

	function logo($n) {
		return ('');
	}

	function login_form() {
		global $dd, $acao;
		$msg = array('email' => 'E-mail', 'password' => 'Senha', 'submit' => 'Entrar', 'login_cab' => 'Entrar no sistema');

		$cr = chr(13) . chr(10);

		$sx = '<table border=0 align="center"><tr VALIGN="TOP"><td width="300">';
		$sx .= '<img src="' . $this -> logo(3) . '" width="200" border=0>';
		$sx .= $this -> about;
		$sx .= '<td><img src="' . $this -> logo(2) . '"><BR><BR>';
		$sx .= $cr . $cr;

		//$sx .= '<!--- Login form -->';
		$sx .= $cr . $cr;
		$sx .= '<TR><TD>';

		$sx .= '<div id="loginform">';
		$sx .= '<div id="facebook"><i class="fa fa-facebook"></i><div id="connect">Connect with</div>';
		$sx .= '</div>';
		$sx .= '<div id="mainlogin">';
		$sx .= '<div id="or">or</div>';
		$sx .= '<h2 style="text-align: center;">' . $msg['login_cab'] . '</h2>';

		/* Login form input */

		$cp = array();
		array_push($cp, array('$H8', '', '', False, True));
		array_push($cp, array('$S100', '', $msg['email'], True, True));
		array_push($cp, array('$P20', '', $msg['password'], True, True));
		array_push($cp, array('$B8', '', $msg['submit'], False, True));

		$dd[1] = email_restrition($dd[1]);

		$form = new form;
		$form -> required_message = 0;
		$form -> required_message_post = 0;
		$form -> class_password = 'login_string';
		$form -> class_string = 'login_string';
		$form -> class_button_submit = 'login_submit';
		$form -> class_form_standard = 'login_table';
		$tela = $form -> editar($cp, '');

		/* Show Form */
		$sx .= '<center>';
		$sx .= $tela;
		$sx .= '</center>';

		/* Check login */
		if ($form -> saved > 0) {
			$log = $this -> login($dd[1], $dd[2]);
			$rst = $this -> userp_erro;
			$msg_erro = 'Erro:' . abs($rst);
			/* recupera mensagem */
			
			if ($log < 1) {
				$rst = abs($log);
				$msg_erro = $this -> userp_msg;
			} else {
				if ($log == 1) {
					$this -> setar_usuario();
					redirecina('main.php');
				}
			}
		}

		/* ERRO */
		if (strlen($msg_erro) > 0) {
			$erros = '<TR><TD><div id="erro">' . $msg_erro . '</div>';
		}

		$sx .= $cr . $cr;

		//		$sx .= '
		//			<A href="javascript:newxy2(\'login_password_send.php\',500,200)" class="links"> ' . msg('forgot_password') . '</A>
		//			&nbsp;|&nbsp;
		//			<A href="login_userp_new.php" class="link"> ' . msg('userp_new') . '</A>';
		$sx .= $erros;
		$sx .= ' 
			</TD></TR>
			</table>
			</div>
			</div></TR></table>
		';
		return ($sx);
	}

}
?>
