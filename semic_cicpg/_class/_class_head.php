<?php
/**
* Essa classe contém gera elementos comuns das views
* @author Marco Kawajiri <marco.kawajiri@pucpr.br>
* @author Rene F. Gabriel Junior <renefgj@gmail.com>
* @version v.0.13.41
* @package SEMIC_avaliacao
*/
class head
	{
	var $avaliador;
	var $avaliador_nome;
	var $trabalho;
	
	var $title_site = 'Avaliação de Trabalhos - SEMIC';
	var $icone_botao_tipo_trabalho = array(
		#ícone awesome relacionado ao tipo de trabalho
		# para uso em botoes
		"O" => "icon-comment",
		"P" => "icon-file", #alt: "icon-file"

	);
	var $logos = array(
		'SEMIC21' => 'img/title_xxi_semic.png',
	);
	
	/* Campo para identificação do avaliador */
	function cp_id_avaliador()
		{
			#Entrada de dados 
			global $dd;
			$idAvaliadorUnsafe = $dd[1];
			$cp = array();
			array_push($cp,array('$H8','','',False,True));
			array_push($cp,array('$S10','', 'ID Avaliador', True, True)); #av_parecerista_us_codigo
			array_push($cp,array('$M8','', '', False, True)); #av_parecerista_us_codigo
			array_push($cp,array('$B8','','Entrar (eAs8CSk2!j4!xv723891)',False,True));
			return $cp;
		}	
	function logout()
		{
			$_SESSION["avaliador"] = '';
			$_SESSION["avaliador_nome"] = '';
			$_SESSION["check"] = '';
			return(1);
		}
	
	function ativa_avalidor()
		{
			$_SESSION["avaliador"] = strzero($this->avaliador,8);
			$_SESSION["avaliador_nome"] = $this->avaliador_nome;
			$_SESSION["check"] = checkpost(strzero($this->avaliador,8));
			return(1);
		}
	function valida_avaliador($id)
		{
			$sql = "select * from pareceristas where 
					id_us = ".round($id)."
					or us_codigo = '".strzero($id,7)."'
					or us_cracha = '".$id."' ";
			$rlt = db_query($sql);
			if ($line = db_read($rlt))
				{
					$this->avaliador = $line['id_us'];
					return($line['id_us']);
				} else {
					return(0);
				}		
		}
	function set_avaliador($id)
		{
			
			$sql = "select * from pareceristas where id_us = ".round($id)." ";
			echo $sql;
			
			$rlt = db_query($sql);
			if ($line = db_read($rlt))
				{
					$this->avaliador = $line['id_us'];
					$this->avaliador_nome = trim($line['us_nome']);
					$this->ativa_avalidor();
					return(1);
				} else {
					$this->avaliador = '';
					$this->avaliador_nome = '';
					$this->ativa_avalidor();
					return(0);					
				}
		}
	function recupera_avalidor()
		{
			$chk = $_SESSION["check"];
			$ava = $_SESSION['avaliador'];
			$nom = $_SESSION['avaliador_nome'];
			if ((checkpost($ava)==$chk) and (strlen($nom) > 0))
				{
					$this->avaliador_nome = $nom;
					$this->avaliador = $ava;
					return(1);
				} else {
					$this->logout('');
					return(0);
				}
		}
	function cab($cab_top='', $styleModConteudo='')
		{
			$sx = '<!DOCTYPE html>'.
				'<html>'.
				'<head>';
			$sx .= '
				 <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
				<meta name="description" content="">
				<meta name="viewport" content="width=device-width" />
				<link rel="stylesheet" href="css/style_semic.css">
				<link rel="stylesheet" href="css/style_resumo.css">
				<link href="css/fonts.css" rel="stylesheet" type="text/css">
				<script type="text/javascript" src="js/functions.js"></script>
				<link rel="stylesheet" href="css/font-awesome/css/font-awesome.css">
				<script language="JavaScript" type="text/javascript" src="js/jquery-1.7.1.js"></script>
				<script language="JavaScript" type="text/javascript" src="js/jquery.corner.js"></script>
				<title>'.$this->title_site.'</title>';
			$sx.='<div id="conteudo" style="'.$styleModConteudo.'">
				<div id="cab_top">
				'.$cab_top.'
				</div>';
				
			return($sx);			
		}

	function cab_logado($tipoTrabalhoStr, $idTrabalhoStr, $nomeAvaliador, $titulo=NULL, $botaoEsquerda=NULL, $botaoDireita=NULL)
		{
			$nomeAvaliador = $this->avaliador_nome;
			#botao_(direita|esquerda) = array(link, simboloFontAwesome)
			if($titulo == NULL){
				$titulo = "Avaliação de $tipoTrabalhoStr - <b>$idTrabalhoStr</b>";
			}
			$cab_top = $titulo;

			function geraBotaoAwesome($botao, $styleMod){
				list($link, $simboloFontAwesome) = $botao;
				#http://127.0.0.1/SEMIC_avaliacao/seleciona_trabalho.php?dd50=0000131%22
				return '<a style="'.$styleMod.'" href='.$link.'> <i class='.$simboloFontAwesome.'></i> </a>';
			}

			/* //XXX ainda não alinhado, idéia: usar icones com visibility:hidden */
			if($botaoEsquerda !== NULL){
				$cab_top = $cab_top.geraBotaoAwesome($botaoEsquerda, "float:left; margin:10 0 0 23;");
			}
			else{
				$cab_top = $cab_top.geraBotaoAwesome($botaoEsquerda, "float:left; margin:10 0 0 23; visibility:hidden;");
			}
			if($botaoDireita !== NULL){
				$cab_top = geraBotaoAwesome($botaoDireita, "float:right; margin: 10 23 0 0;").$cab_top;
			}
			else{
				$cab_top = geraBotaoAwesome($botaoEsquerda, "float:right; margin: 10 23 0 0; visibility:hidden;").$cab_top;
			}
			$sx = $this->cab($cab_top);
			$sx .= "<div id=nome_avaliador> Avaliador: ".$nomeAvaliador."</div>";
			return $sx;
		}

	function quebra($simboloFontAwesome, $styleMod="")
		{
			//Gera uma quebra bonitinha com um ícone do Font-Awesome
			//ver http://fortawesome.github.io/Font-Awesome/icons/ para referencia
			$sx .= '<div class="quebra_simbolo" sytle="'.$styleMod.'">'.
				   ' <hr class="left"/> '. 
				   '  <i class='.$simboloFontAwesome.'></i>'.
				   ' <hr class="right"/> '. 
				   '</div>';
			return($sx);
		}
	function banner_intro($av)
		{
			#var_dump($av->eventos);
			assert(count($av->eventos) >= 1);
			$sx = '<div id=banner_intro_titulo>';
			list($nomeExterno, $nomeCanonico) = $av->eventos[0];
			if(array_key_exists($nomeExterno, $this->logos)){
				$sx .= '<img src="'.$this->logos[$nomeExterno].'" alt="'.$nomeCanonico.'">';
			}
			else{
				$sx .= $nomeCanonico;
			}
			$sx .= '</div>';
		    $sx .= '<div class=banner_intro_subtitulo>';
		    //$sx .= implode("<br>", array_map(function ($ev){ return $ev[1]; }, array_slice($av->eventos,1)));
		   // #'<span>XIV Mostra de Pesquisa da Pós-Graduação </span>'.
		    $sx .= '</div>';

			return $sx;
		}
	function menu()
		{
			return('');
		}
	function main_content()
		{
			return('');
		}
	function foot($styleModPush='margin-top: 15px;', $conteudoExtra='', $styleModFooter='')
		{
			$sx .= "<div class='push' style='$styleModPush'></div>";
			$sx .= '</div>';
			$sx .= '<div class="footer" style="'.$styleModFooter.'">';
			$sx .= $conteudoExtra;

			$sx .= '<div id="foot">';
			$sx .= '&copy 2006-'.date("Y");
			$sx .= '</div>';
			$sx .= '</div>';
			return($sx);
		}	
	function renderiza_erro_e_sai($tipoErro=NULL)
		{
			echo $this->cab("Erro");
			echo "<center>";
			switch($tipoErro){
				case NULL:
				case "erro":
				default:
					#Erro genérico
					echo "Ocorreu um erro na sua requisição. Verifique a URL";
					break;
			}
			echo "</center>";
			echo $this->foot();
			exit(1);
		}
}

?>