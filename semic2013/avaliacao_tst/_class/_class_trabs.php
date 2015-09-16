<?php



error_reporting(-1);



class trabs

	{

	var $tabela = 'pibic_semic_avaliador';



	var $camposAv = array(

		#Nome da coluna na DB      ($tipo, $nomeExtenso, $reqPreenchimento, $outro, $validadorAdicional) #XXX documentar $outro

		'id_av'			  => array('$H8',     "",       False,True, NULL),

		'av_clareza' 	  => array('$[1-10]', "Clareza", True, True, NULL),

		'av_sintese' 	  => array('$[1-10]', "S�ntese", True, True, NULL),

		'av_contribuicao' => array('$[1-10]', "Contribui��o", True, True, NULL),

		'av_conteudo'     => array('$[1-10]', "Conte�do", True, True, NULL),

		'av_qualidade'    => array('$[1-10]', "Qualidade", True, True, NULL),

		'av_desempenho'   => array('$[1-10]', "Desempenho", True, True, NULL),

		'av_nota' 		  => array('$I8'	, "Nota", True, True, NULL),

		'av_indicado'     => array('$O : &1:SIM&0:N�O', "Indicado como um dos dez melhores trabalhos?", True, True),

	);



	var $chavesCamposAv = array(

		#Campos da avalia��o oral

		'O' => array(

			"av_clareza",

			"av_sintese",

			"av_contribuicao",

			"av_conteudo",

			"av_qualidade",

            "av_desempenho",

            "av_nota",

            "av_indicado"

        ),



        #Campos da avalia��o de poster

        #A avalia��o de poster n�o cont�m o campo av_clareza

		'P' => array(

			"av_sintese",

			"av_contribuicao",

			"av_conteudo",

			"av_qualidade",

            "av_desempenho",

            "av_nota",

            "av_indicado"

        )

	);



	function alterar_status($status)

		{

			global $dd;

			$sql = "update ".$this->tabela." set av_status = ".round($status)."

					where id_av = ".round($dd[0]);

			$rlt = db_query($sql);

			return(1);

		}

	

	#exemplo

	function codigo_separador($med)

		{

			$trab = sonumero($med);

			$area = troca($med,$trab,'');

			return(array($area,$trab));	

		}

		

	#exemplo

	function consulta_sql()

		{

			$sql = "select * from ....";

			$rlt = db_query($sql);

			

			if ($line = db_read($rlt))

			{

				print_r($line);

			}

			

			/* */

			while ($line = db_read($rlt))

				{

				print_r($line);		

				}

		}



	#exemplo

	function validador()

		{

			$erro = 1;

			/* verifica se existe o trabalho */

			$id_trab = $this->codigo_separador($dd[1]);

			$area = $id_trab[0];

			$nume = $id_trab[1];

			/* verifica se o trabalho � para este avalidor */

			//$erro = $this->existe_na_base($area,$trab);

			

			if ($erro == 1)

				{

				$this->erro = 'C�digo n�o localizado para avalia��o';

				return('');

				} else {

					$this->erro = '';

					return('1');

				}

		}



	/* Campo para identifica��o do avaliador */

	function cp_id_avaliador()

		{

			$cp = array();

			array_push($cp,array('$H8','','',False,True));

			array_push($cp,array('$S10','av_parecerista_us_codigo', 'C�digo do avaliador', True, True));



			array_push($cp,array('$B8','','Entrar',False,True));

			return $cp;



		}



	/* Campo para identifica��o do trabalho */

	function cp_id_trabalho()

		{

			global $dd,$acao;

			$cp = array();

			array_push($cp,array('$H8','','',False,True));

			array_push($cp,array('$S10','','C�digo do trabalho',True,True));

			#array_push($cp,array('$H8','',$this->validador(),True,True));

			#array_push($cp,array('$M8','',$this->erro,True,True));

			

			array_push($cp,array('$H8','','',True,True));

			

			array_push($cp,array('$B8','','Continuar >>>',False,True));

			return($cp);

		}



	private function criaFichaAvaliacao(&$cp, $tipoTrabalho)

		#Cria os campos de avalia��o do trabalho e adiciona em &$cp

		{

			foreach($this->chavesCamposAv[$tipoTrabalho] as $chv){

				list($tipo, $nomeExtenso, $reqPreenchimento, $outro, $validadorAdicional) = $this->camposAv[$chv];

				array_push($cp, array($tipo, $chv, $nomeExtenso, $reqPreenchimento, $outro));

			}

		}



	/* Ficha de avalia��o Oral */

	function cp_oral()

		#Cria uma ficha com os campos de avalia��o oral

		{

			$cp = array();



			array_push($cp,array('$H8','','',False,True)); #XXX Qual � o prop�sito desse campo?

			$this->criaFichaAvaliacao($cp, 'O');

			array_push($cp,array('$B8','','Avaliar',True,True));



			return($cp);

		}



	/* Ficha de avalia��o de Poster */

	function cp_poster()

		{

		#Cria uma ficha com os campos de avalia��o de poster

			$cp = array();



			array_push($cp,array('$H8','','',False,True)); #XXX Qual � o prop�sito desse campo?

			$this->criaFichaAvaliacao($cp, 'P');

			array_push($cp,array('$B8','','Avaliar',True,True));



			return($cp);

		}



	}

?>

