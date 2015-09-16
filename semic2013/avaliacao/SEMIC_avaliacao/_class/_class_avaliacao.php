<?php
/**
* Essa classe mant�m as regras de neg�cio principais
* @author Marco Kawajiri <marco.kawajiri@pucpr.br>
* @version v.0.13.41
* @package SEMIC_avaliacao
*/

// Para compatibilidade com PHP4
if (!function_exists('http_build_query')) {
function http_build_query($data, $prefix='', $sep='', $key='') {
   $ret = array();
   foreach ((array)$data as $k => $v) {
       if (is_int($k) && $prefix != null) $k = urlencode($prefix . $k);
       if (!empty($key)) $k = $key.'['.urlencode($k).']';
       
       if (is_array($v) || is_object($v))
           array_push($ret, http_build_query($v, '', $sep, $k));
       else    array_push($ret, $k.'='.urlencode($v));
   }
 
   if (empty($sep)) $sep = ini_get('arg_separator.output');
   return implode($sep, $ret);
}}

/**
 * cpf() copiado de sisdoc_form2.php
 */
function cpf($cpf)
	{
	$cpf = sonumero($cpf);
	if (strlen($cpf) <> 11) { return(false); } 

	$soma1 = ($cpf[0] * 10) + ($cpf[1] * 9) + ($cpf[2] * 8) + ($cpf[3] * 7) + 
			 ($cpf[4] * 6) + ($cpf[5] * 5) + ($cpf[6] * 4) + ($cpf[7] * 3) + 
			 ($cpf[8] * 2); 
	$resto = $soma1 % 11; 
	$digito1 = $resto < 2 ? 0 : 11 - $resto; 

	$soma2 = ($cpf[0] * 11) + ($cpf[1] * 10) + ($cpf[2] * 9) + 
			 ($cpf[3] * 8) + ($cpf[4] * 7) + ($cpf[5] * 6) + 
			 ($cpf[6] * 5) + ($cpf[7] * 4) + ($cpf[8] * 3) + 
			 ($cpf[9] * 2); 
			 
	$resto = $soma2 % 11; 
	$digito2 = $resto < 2 ? 0 : 11 - $resto; 
	#echo "$digito1, $digito2";
	if (($cpf[9] == $digito1) and ($cpf[10] == $digito2))
		{ return(true); } else
		{ return(false); }
	}

class _DAO_tabela_trabalhos_avaliador{
	var $tabela = "pibic_semic_avaliador";

	var $colAvaliador = "psa_p01";
	var $colArea = "psa_p04";
	var $colNumComSufixo = "psa_p02";
	var $colTipoTrabalhoExt = "psa_p03";
	var $colEvento = "psa_p05";

	var $journal_id = NULL;
	var $tipoTrabalhoCodigo = array(
		'Oral' => 'O',
		'Poster' => 'P',
	);

	function __construct ($journal_id, $eventos, $excecoesPontuais){
		function _nomeEventoExterno($parNomesExtCanon){ return $parNomesExtCanon[0]; }
		$this->eventosValidos = array_map(_nomeEventoExterno, $eventos);
		$this->journal_id = $journal_id;
		$this->excecoesPontuais = $excecoesPontuais;
	}

	//Construtor, para compatibilidade com PHP 4
	function _DAO_tabela_trabalhos_avaliador($journal_id, $eventos, $excecoesPontuais){
		$this->__construct($journal_id, $eventos, $excecoesPontuais);
	}

	function get_trabalhos($idAvaliador=NULL){
		$qry = "SELECT DISTINCT ".implode(", ",array($this->colArea, $this->colNumComSufixo, $this->colTipoTrabalhoExt, $this->colAvaliador)).
			   "  FROM ".$this->tabela.
			   " WHERE (".$this->colEvento." = '".implode("' OR ".$this->colEvento." = '", $this->eventosValidos)."')";
		if($idAvaliador !== NULL){
			$qry .= "   AND ".$this->colAvaliador." = '".$idAvaliador."'";
		}

		$rlt = db_query($qry);

		$trabalhos = array();

		while(($line = db_read($rlt))){
			list($area, $numComSufixo, $tipoExtenso, $idAvaliadorTrab) = $line;
			$tipoExtenso = trim($tipoExtenso);
			$area = trim($area);
			
			$numComSufixo = trim($numComSufixo);
			$idTrabalhoStr = $area.$numComSufixo;
			if(!isset($this->tipoTrabalhoCodigo[$tipoExtenso])){
				echo "ATENCAO: trabalho com tipo de trabalho inv�lido: ".$idTrabalhoStr." (".$tipoExtenso.")<br>";
				continue;
			}
			assert(isset($this->tipoTrabalhoCodigo[$tipoExtenso]));
			$tipoTrabalho = $this->tipoTrabalhoCodigo[$tipoExtenso];
			if($area == 'JI'){
				//XXX xunxo para tratar jovens id�ias com tipo ORAL
				$tipoTrabalho = 'J';
			}
			if(isset($this->excecoesPontuais[$this->journal_id][$idTrabalhoStr][0])){
				echo "Exce��o: ",$idTrabalhoStr;
				$tipoTrabalho = $this->excecoesPontuais[$this->journal_id][$idTrabalhoStr][0];
			}

			array_push($trabalhos, array($idTrabalhoStr, $tipoTrabalho, trim($idAvaliadorTrab)));
		}

		return $trabalhos;
	}
}

class Avaliacao
	{
	/**
	 * Indica o journal_id em ojs.articles a ser usado na edi��o desse $ano
	 * @var integer
	 */
	var $articles_journal_id = 67;
	var $ano = 2013;
	var $tabela_avaliacoes = 'pibic_semic_avaliador_notas';
	var $tabela_locais_horarios = 'pibic_semic_avaliador_hora_local';
	
	/**
	 * Eventos em ordem de visibilidade
	 * Formato: (nomeExterno, nomeCanonico)
	 * @var array
	 */
	var $eventos = array( #
		array('SEMIC21', 'XXI SEMIC'),
		array('MP15', 'XIV Mostra de Pesquisa da P�s-Gradua��o'),
	);

	/**
	 * Tabelas de origem externa
	 */
	var $tabela_pareceristas = 'pareceristas';
	var $col_id_parecerista = 'id_us';
	var $tabela_articles = "articles";

	/**
	 * Ignora a coluna us_ativo em na $tabela_pareceristas.
	 * Isso permite o login de pareceristas mesmo que eles tenham us_ativo = 0
	 * @var boolean
	 */
	var $pareceristas_ignorar_us_ativo = true;

	/**
	 * Defini��o dos campos de nota, podendo ser configurado com um validador adicional 
	 * (um m�todo dessa classe com comportamento espec�fico)
	 * Formato: $nomeColuna => ($tipo, $nomeExtenso, $reqPreenchimento, $gravarNaTabela, $validadorLocalAdicional, $nomeColuna)
	 * Se $nomeColuna for especificado no lado direito, ela toma preced�ncia ao $nomeColuna no lado esquerdo
	 * @var array
	 */
	var $camposAvNotas = array(
		#
		'av_clareza' 	   => array('$[1-10]', "Clareza", True, True, "validador_adicional_nota_um_dez"),
		'av_sintese' 	   => array('$[1-10]', "Poder de S�ntese", True, True, "validador_adicional_nota_um_dez"),
		'av_contribuicao'  => array('$[1-10]', "Contribui��o para forma��o cient�fica", True, True, "validador_adicional_nota_um_dez"),
		'av_conteudo'      => array('$[1-10]', "Conte�do", True, True, "validador_adicional_nota_um_dez"),
		'av_qualidade'     => array('$[1-10]', "Qualidade Visual", True, True, "validador_adicional_nota_um_dez"),
		'av_desempenho'    => array('$[1-10]', "Desempenho do Aluno", True, True, "validador_adicional_nota_um_dez"),

		'av_nota' 		   => array('$[1-10]', "D� uma nota geral para a exposi��o como um todo", True, True, "validador_adicional_nota_um_dez"),
		'av_indicado'      => array('$O : &1:SIM&0:N�O', "Indicar como um dos dez melhores trabalhos?", True, True, 'validador_adicional_s_n'), #"validador_adicional_indicado"?
		'av_prof_presente' => array('$O : &1:SIM&0:N�O&2:FALTOU COM JUSTIFICATIVA', "Professor presente durante a avalia��o?", True, True, 'validador_adicional_presenca_prof'),
	);

	/**
	 * Campos que podem ser usados em $camposAv que n�o s�o relacionados as notas do trabalho
	 */
	var $camposAvOutros = array(
		'sep_av_geral'     => array('$A', 'Avalia��o Geral', False, False, NULL),
	);

	/**
	 * Tipos de avalia��o relacionados aos seus campos.
	 * @var array
	 */
	var $camposAv = array(
		#Campos da avalia��o oral
		'O' => array(
			"av_clareza",
			"av_sintese",
			"av_contribuicao",
			"av_conteudo",
			"av_qualidade",
            "av_desempenho",
            "av_indicado",
            "av_prof_presente",
            "sep_av_geral",
            "av_nota",
        ),

        #Campos da avalia��o de poster
        #A avalia��o de poster n�o cont�m o campo av_clareza
		'P' => array(
			"av_sintese",
			"av_contribuicao",
			"av_conteudo",
			"av_qualidade",
            "av_desempenho",
            "av_indicado",
            "sep_av_geral",
            "av_nota",
        ),

		#Campos de avalia��o dos trabalhos Jovens id�ias
        'J' => array(
			"av_clareza",
			"av_sintese",
			"av_contribuicao",
			"av_conteudo",
			"av_qualidade",
            "av_desempenho",
            "av_indicado",
            "av_prof_presente",
            "sep_av_geral",
            "av_nota",
        ),

        #Campos de avalia��o dos trabalhos Pesquisar e Evoluir
        'Q' => array(
			"av_clareza",
			"av_sintese",
			"av_contribuicao",
			"av_conteudo",
			"av_qualidade",
            "av_desempenho",
            "av_indicado",
            "av_prof_presente",
            "sep_av_geral",
            "av_nota",
        ),
	);

	/**
	 * Tipos de trabalho poss�veis por �rea.
	 * Formato: regexArea => array com tipos de trabalho poss�veis
	 * Colocar na ordem do mais espec�fico pro mais geral
	 *
	 * Apenas para uso interno. Normalmente se deve usar 
	 * 	get_tipos_trabalho_possiveis($idTrabalhostr)
	 *  para conseguir os tipos de trabalho poss�veis
	 *
	 * � uma boa id�ia ter sempre uma entrada de chave '.+'
	 *  no final como caso comum.
	 * @var array
	 */
	var $_tiposTrabalhoPossiveisArea = array(
		'JI' => array('J'),
		'.+' => array('O', 'P'),
	);

	var $_tiposTrabalhoPossiveisPontual = array(
		67 => array(
			'CTA09T'   => array('Q'),
			'iCTA02T'  => array('Q'),
			'iEBIO02'  => array('Q'),
			'MEDVET29' => array('Q'),
			'EDU49T'   => array('Q'),
			'ELE03T'   => array('Q'),
			'CTA13T'   => array('Q'),
			'CTA14T'   => array('Q'),
			'PLAN18T'  => array('Q'),
			'CTA11T'   => array('Q'),
			'CTA12T'   => array('Q'),
			'DES03T'   => array('Q'),
		),
	);
	
	/**
	 * Nome em extenso dos tipos de trabalho
	 * @var array
	 */
	var $tipoTrabalhoExtenso = array(
		"O" => "Ap. Oral",
		"P" => "Poster",
		"J" => "Ap. Jovens Id�ias",
		"Q" => "Pesquisar e Evoluir",
	);

	/**
	 * Nomes de campos de nota alternativos para tipos de trabalhos espec�ficos
	 */
	var $camposAvNomes = array(
		'J' => array(
			"av_clareza" => 'Criatividade',
			"av_sintese" => 'Inova��o',
			"av_contribuicao" => 'Contribui��o Social',
			"av_conteudo" => 'Viabilidade Econ�mica',
			"av_qualidade" => 'Apresenta��o do Pr�tipo',
            "av_desempenho" => 'Apresenta��o Oral',
		),
		'Q' => array(
			"av_clareza" => 'Criatividade',
			"av_sintese" => 'Inova��o',
			"av_contribuicao" => 'Contribui��o Social',
			"av_conteudo" => 'Viabilidade Econ�mica',
			"av_qualidade" => 'Apresenta��o do Pr�tipo',
            "av_desempenho" => 'Apresenta��o Oral',
		),
	);

	/**
	 * Nome da p�gina em que a inst�ncia do objeto se encontra. DEVE ser NULL ou ser uma chave em $this->argsPagina
	 * @var string
	 */
	var $nomePagina = NULL;

	var $argsPaginaIndInicio = 50; #Esse �ndice DEVE ser maior que qualquer ind�ce (em $dd) usado em forms para evitar conflitos

	/**
	 * 	Argumentos de entrada da p�gina e seus sanitizadores
	 *  Um �ndice come�ando em $this->argsPaginaIndInicio ser� atribuido para cada um desses args
	 *  na inicializa��o da inst�ncia desse objeto em $this->argsPagina e $this->argsPaginaInd
	 * @var array
	 */
	var $argsPagina = array(
		'idAvaliador'   => 'san_id_avaliador', 
		'idTrabalhoStr' => 'san_id_trabalho_str', 
		'tipoTrabalho'  => 'san_tipo_trabalho',
		'forcado'       => 'san_zero_um',
		'naoCompareceu' => 'san_numero_positivo',
	);
		
	/**
	 * �ndices atribu�dos a $nomesArgsPagina para uso interno
	 * Os atributos abaixo s�o computados na inicializa��o da inst�ncia do objeto
	 * e N�O DEVEM ser setados pelo desenvolvedor diretamente
	 * @var array
	 */
	var $_argsPagina    = array();
	var $_argsPaginaInd = array();
	var $_sanArgsPag    = array();

	/**
	 * Campos de form poss�veis.
	 * Os atributos abaixo s�o computados na inicializa��o da inst�ncia do objeto
	 * e N�O DEVEM ser setados pelo desenvolvedor diretamente
	 */
	var $_camposAvForm = array();


	/**
	 * Tipo a ser usado em expressoes SQL como CAST(nome_col_str AS bd_tipo_numerico)
	 * Se NULL, � setado automaticamente pelo construtor;
	 */
	var $bd_tipo_numerico = NULL;

	function __construct ($nomePagina = NULL){
		if($nomePagina !== NULL) $this->set_pagina($nomePagina);

		#inicializa $argsPagina com array iniciando em $this->argsPaginaIndInicio
		$ind = $this->argsPaginaIndInicio;
		foreach ($this->argsPagina as $arg => $san) {
			$this->_argsPagina[$ind] = $arg;
			$this->_argsPaginaInd[$arg] = $ind;
			$this->_sanArgsPag[$arg] = $san;
			$ind += 1;
		}

		$this->_camposAvForm = array_merge($this->camposAvNotas, $this->camposAvOutros);

		if($this->bd_tipo_numerico === NULL){
			global $base;
			if($base == 'mysql'){
				$this->bd_tipo_numerico = 'SIGNED';
			}
			elseif($base == 'pgsql'){
				$this->bd_tipo_numerico = 'NUMERIC';
			}
			else{
				die("Impossivel determinar o cast numerico para expressoes SQL a partir do tipo de base de dados: $base");
			}
		}
	}

	//Construtor, para compatibilidade com PHP 4
	function Avaliacao($nomePagina = NULL){
		$this->__construct($nomePagina);
	}
	
	//XXX Os m�todos abaixo seriam mais apropriados numa classe de view

	/**
	 * Seta p�gina em que a inst�ncia do objeto se encontra
	 * @param string $nomePagina
	 */
	function set_pagina($nomePagina){
		$this->nomePagina = $nomePagina;
	}

	/**
	 * Constr�i uma query usando o padr�o $dd$i=$valor
	 * @param  string $pagina
	 * @param  array $inputArgs
	 * @return string
	 */
	function build_query_pagina($pagina, $inputArgs)
		{
			$ddOut = array();
			foreach($inputArgs as $chave => $inArg){
				$ind = $this->_argsPaginaInd[$chave];
				$ddOut['dd'.$ind] = $inArg;
			}
			return http_build_query($ddOut);
		}

	/**
	 * Cria uma URL usando build_query_pagina
	 * @param  [type] $pagina
	 * @param  [type] $inputArgs
	 * @return string
	 */
	function build_url_pagina($pagina, $inputArgs)
		{
			$httpqry=$this->build_query_pagina($pagina, $inputArgs);
			return($pagina.'.php?'.$httpqry);
		}

	/**
	 * Pega os argumentos passados para a p�gina na forma array(key => value)
	 * @return Array
	 */
	function get_args_pagina()
		{
			global $dd;
			if($this->nomePagina == NULL) return array();
			$pagina = $this->nomePagina;
			$args = array();
			foreach($this->_argsPagina as $indiceDd => $argName){
				#Sanitiza entrada
				$entrada = $dd[$indiceDd];
				$sanitizador = $this->_sanArgsPag[$argName];

				$saidaSan = call_user_func_array(array($this, $sanitizador), array($entrada));
				if($saidaSan !== FALSE){
					$args[$argName] = $saidaSan;
				}
			}
			return $args;
		}

	/**
	 * Redireciona para uma p�gina de nome $pagina
	 * @param  [type] $pagina
	 * @param  [type] $inputArgs
	 */
	function redireciona($pagina, $inputArgs){
		redirecina($this->build_url_pagina($pagina, $inputArgs));
		exit();
	}

	/**
	 * Confirma o fim de uma avalia��o, dado par�metros
	 * XXX tight coupling entre modelo e view
	 * @param  [type] $form_av_trab
	 * @param  [type] $cp
	 * @param  [type] $idTrabalhoStrUnsafe
	 * @param  [type] $idAvaliadorUnsafe
	 * @param  [type] $tipoTrabalhoUnsafe
	 */
	function form_confirma_fim($form_av_trab, $cp, $idTrabalhoStrUnsafe, $idAvaliadorUnsafe, $tipoTrabalhoUnsafe)
		{
			list($areaTrab, $numTrab) = $this->san_id_trabalho($idTrabalhoStrUnsafe);
			$idAvaliador = $this->san_id_avaliador($idAvaliadorUnsafe);
			$tipoTrabalho = $this->san_tipo_trabalho($tipoTrabalhoUnsafe);
			$idTrabalhoStr = $this->id_trabalho_str_canon($areaTrab,$numTrab);
			if($form_av_trab->saved
				&& $areaTrab !== FALSE && $idAvaliador !== FALSE && $tipoTrabalho !== FALSE
				&& ($idAvaliacao = $this->get_id_avaliacao($idAvaliador, $idTrabalhoStr, $tipoTrabalho)) !== NULL
			){
				$qry = "UPDATE ".$this->tabela_avaliacoes.
					   " SET av_status = 1,".
					   "     av_tstamp_avaliacao = ".time().
					   " WHERE id_av = ".$idAvaliacao;
				$rlt = db_query($qry);
				return 1;
			}
			return 0;
		}

	/**
	 * Confirma o fim de uma avalia��o, setando todas as notas = -1
	 * @param  [type] $form_av_trab        [description]
	 * @param  [type] $cp                  [description]
	 * @param  [type] $idTrabalhoStrUnsafe [description]
	 * @param  [type] $idAvaliadorUnsafe   [description]
	 * @param  [type] $tipoTrabalhoUnsafe  [description]
	 * @return [type]                      [description]
	 */
	function form_reprovar_trabalho($form_av_trab, $cp, $idTrabalhoStrUnsafe, $idAvaliadorUnsafe, $tipoTrabalhoUnsafe)
		{
			$savedOld = $form_av_trab->saved;
			$form_av_trab->saved = 1;
			$confFim = $this->form_confirma_fim($form_av_trab, $cp, $idTrabalhoStrUnsafe, $idAvaliadorUnsafe, $tipoTrabalhoUnsafe);
			$form_av_trab->saved = $savedOld;
			
			list($areaTrab, $numTrab) = $this->san_id_trabalho($idTrabalhoStrUnsafe);
			$idAvaliador = $this->san_id_avaliador($idAvaliadorUnsafe);
			$tipoTrabalho = $this->san_tipo_trabalho($tipoTrabalhoUnsafe);
			$idTrabalhoStr = $this->id_trabalho_str_canon($areaTrab,$numTrab);
			$idAvaliacao = $this->get_id_avaliacao($idAvaliador, $idTrabalhoStr, $tipoTrabalho);
			if($confFim){
				$qry = "UPDATE ".$this->tabela_avaliacoes.
					   " SET ";
				$qry.= implode(" = -1,", array_keys($this->camposAvNotas))." = -1";
				$qry.= " WHERE id_av = ".$idAvaliacao;
				$rlt = db_query($qry);
				return 1;
			}
			return 0;
		}

	function _horario_inicio_sessao_poster($idTrabalhoStr)
		{
			#Fonte: Programa��o SEMIC - 2013.xlsx Plan2
			$sessao = False;

			$horariosDeSessaoPoster = array(
				#("$dia-$mes-$ano $horarioInicio), 
				#Esses hor�rios vieram da Alessandra
				1 => strtotime("22-10-2013 10:30"), 
				2 => strtotime("23-10-2013 10:00"), 
				3 => strtotime("24-10-2013 10:00"),
			);
			$grupoSessao = array(
				1 => array("Ci�ncias da Sa�de", "Ci�ncias Exatas", "Ci�ncias Agr�rias"),
				2 => array("Ci�ncias Sociais Aplicadas", "Ci�ncias Humanas"),
				3 => array("Mostra de P�s-gradua��o"),
			);
			$localSessao = array(
				1 => "Bloco Verde - T�rreo",
				2 => "Bloco Verde - T�rreo",
				3 => "Bloco Verde - T�rreo",
			);

			$areasSessao = array(
				"Ci�ncias Humanas"						 => array('PSICO', 'ART', 'TEO', 'GEO', 'ANTRO', 'CPOLI', 'HIST', 'LETR', 'SOCIO', 'EDU', 'LING', 'FILO'),
				"Ci�ncias Exatas"						 => array('MAT', 'FIS', 'EBIO', 'MEC', 'EPR', 'ELE', 'ECV', 'ESAN', 'CCOMP', 'EQ', 'QUI'),
				"Ci�ncias Sociais Aplicadas"			 => array('DIRpr', 'ECON', 'DIRt', 'DIRpf', 'SS', 'DES', 'ARQUR', 'DIRpb', 'COMUN', 'PLAN', 'DIResp', 'ADM', 'DIR'),
				"Mostra de P�s-gradua��o"				 => array('PPGT', 'PPGCA', 'PPGB', 'PPGIa', 'PPGTU', 'PPGE', 'PPGTS', 'PPGF', 'PPGEM', 'PPGCS', 'PPGEPS', 'PPGO', 'PPGD'),
				"Ci�ncias da Sa�de"						 => array('ENF', 'FARM', 'EF', 'BOT', 'MICRO', 'IMU', 'MED', 'BIOF', 'BIOG', 'FISIO', 'FAR', 'MORF', 'NUT', 'FISIOL', 'ECO', 'BIOQ', 'ODO', 'SC', 'BIOTEC', 'GEN', 'PARA'),
				"Mobilidade Nacional ou Internacional"	 => array('MOB'),
				"PUC Jovens Id�ias"						 => array('JI'),
			);

			list($areaTrab, $numTrab) = $this->san_id_trabalho($idTrabalhoStr);

			preg_match('/^(?P<area>[A-Z]+?)(?P<ehJunior>(jr)?)$/i', $areaTrab, $matches);
			$areaSessao = $matches['area'];
			if(strpos($areaSessao, 'i') === 0){
				#tira i de internacional no come�o, se aplic�vel
				$areaSessao = substr($areaSessao, 1);
			}

			
			if(preg_match('/^(?P<area>[a-z]*[A-Z]+[a-z]*)(?P<num>\d+)((?P<ehPibit>T?)|(?P<ehJunior>(jr)?))$/', $idTrabalhoStr, $matches)){
				//Primeiro, coloque as exce��es
				if($matches["ehJunior"]){
					$sessao = 1;
				}
				elseif($matches["area"] == "MOB" || $matches["area"] == "iMOB"){
					//Ser de mobilidade nacional ou internacional vem antes de ser PIBITI (Alessandra)
					//"[Trabalhos como MOB12T] nesse caso ele vai apresentar junto com os de mobilidade"
					$sessao = 3;
				}
				elseif($matches["ehPibit"]){
					$sessao = 2;
				}
				//Depois, tente achar a sess�o pelo grupo (ou �rea geral, e.g. Ci�ncias exatas) do trabalho
				else{
					foreach($areasSessao as $areaGeral => $areas){
						if(in_array($areaSessao, $areas)){
							$grupo = $areaGeral;
							break;
						}
					}
					
					foreach($grupoSessao as $sessaoGrupo => $grupos){
						if(in_array($grupo, $grupos)){
							$sessao = $sessaoGrupo;
							break;
						}
					}
				}
			}

			if(!$sessao){
				echo("ATEN��O: ID de trabalho sem sess�o de poster associada: '$idTrabalhoStr'\n");
				return false;
			}

			#echo $idTrabalhoStr." ".$sessao." ".grupoTrab($areaTrab)." ".date("d/m/Y H:i", $horariosDeSessaoPoster[$sessao])."\n";
			return array($horariosDeSessaoPoster[$sessao], $localSessao[$sessao]);
		}

	function get_horarios_locais_trabalho($areaTrab, $numTrab, $tipoTrabalho=false){
		assert($areaTrab);
		assert($numTrab);
		$qry = "SELECT avhl_tipo_trabalho, avhl_tstamp_avaliacao_est, avhl_local".
			   " FROM ".$this->tabela_locais_horarios.
			   " WHERE avhl_area = '".$areaTrab."'".
			   "   AND avhl_numtrab = ".$numTrab;

		if($tipoTrabalho != false){
			$qry .= " AND avhtl_tipo_trabalho ='".$tipoTrabalho."'";
		}
		$rlt = db_query($qry);

		$horariosLocais = array();
		while(($line = db_read($rlt))){
			list($tipoTrabalho, $tstampAvaliacaoEst, $local) = $line;
			$horariosLocais[$tipoTrabalho] = array($tstampAvaliacaoEst, $local);
		}

		//Fallback caso o hor�rio/local do poster n�o esteja na tabela
		if(!isset($horariosLocais['P'])){
			$idTrabalhoStr = $this->san_id_trabalho_tostr($areaTrab, $numTrab, False);
			$horariosLocais['P'] = $this->_horario_inicio_sessao_poster($idTrabalhoStr);
		}

		return $horariosLocais;
	}	

	//XXX implementa��o ineficiente e muito ruim :-(
	function _importar_trabalhos(){

		//Trabalhos para ignorar entrada de avalia��o oral (segundo Alessandra e Mari)
		$trabalhosIgnorar = array(
			'O' => array("CTA06", "ODO31", "MED57T", "FLORE09", "ECO02", "iEPR07T", "DIR01",
					  	 "MED22", "COMUN05", "ADM10", "ADM14", "AGRO08", "AGRO16"),
			'P' => array(),
		);

		$daoTrabsAv = new _DAO_tabela_trabalhos_avaliador($this->articles_journal_id, $this->eventos, $this->_tiposTrabalhoPossiveisPontual);
		$trabalhosAvaliador = $daoTrabsAv->get_trabalhos();
		$trabalhosAvaliador_len = count($trabalhosAvaliador);

		//Retira de $trabalhosAvaliador trabalhos j� cadastrados no sistema
		$qry = "SELECT av_area, av_numtrab, av_tipo_trabalho, av_parecerista_cod".
			   "  FROM ".$this->tabela_avaliacoes.
			   " WHERE av_journal_id = ".$this->articles_journal_id;
		$rlt = db_query($qry);

		while(($line = db_read($rlt))){
			list($areaTrab, $numTrab, $tipoTrabalho, $idAvaliador) = $line;
			$idTrabalhoStr = $this->san_id_trabalho_tostr(trim($areaTrab), trim($numTrab), True);
			
			if($idTrabalhoStr !== false){
				$ind = array_search(array($idTrabalhoStr, trim($tipoTrabalho), trim($idAvaliador)), $trabalhosAvaliador);
				if($ind !== false){
					unset($trabalhosAvaliador[$ind]);
				}
			}
			else{
				// echo "idTrabalhoStr === false";
				// var_dump($idTrabalhoStr);
				// exit;
				$idTrabalhoStr = $this->san_id_trabalho_tostr(trim($areaTrab), trim($numTrab), False);
				#echo ">>> $idTrabalhoStr $tipoTrabalho $idAvaliador\n<br>";

				//XXX :-(
				for($ind=0; $ind<$trabalhosAvaliador_len; $ind++){
					list($idTrabalhoStrE, $tipoTrabalhoE, $idAvaliadorE) = $trabalhosAvaliador[$ind];
					if(strtoupper(trim($idTrabalhoStr)) == strtoupper(trim($idTrabalhoStrE)) && 
						$tipoTrabalho == $tipoTrabalhoE &&
						$idAvaliador == $idAvaliadorE){
						unset($trabalhosAvaliador[$ind]);
						break;
					}
				}
			}
		}

		echo count($trabalhosAvaliador)." novos trabalhos a inserir.\n<br>";

		$qry = '';

		foreach($trabalhosAvaliador as $trabAv){
			list($idTrabalhoStr, $tipoTrabalho, $idAvaliador) = $trabAv;
			list($areaTrab, $numTrab) = $this->san_id_trabalho($idTrabalhoStr);

			if(isset($trabalhosIgnorar[$tipoTrabalho]) && in_array($idTrabalhoStr, $trabalhosIgnorar[$tipoTrabalho])){
				//Ignorar trabalho
				echo "ATEN��O: Ignorando trabalho: $idTrabalhoStr\n<br>";
				continue;
			}

			if(!$areaTrab){
				echo "ATEN��O: Nome de trabalho inv�lido: $idTrabalhoStr\n<br>";
				//exit();
				continue;
			}

			if(array_search($tipoTrabalho, $this->get_tipos_trabalho_possiveis($idTrabalhoStr)) === false){
				echo "ERRO: Tipo de trabalho inv�lido para $idTrabalhoStr: $tipoTrabalho.\n<br>";
				continue;
			} 

			$horariosLocais = $this->get_horarios_locais_trabalho($areaTrab, $numTrab);

			// foreach($horariosLocais as $tipoTrabalhoHor => $horaLocal){
			list($av_tstamp_avaliacao_est, $local) = $horariosLocais[$tipoTrabalho];
			if(!isset($av_tstamp_avaliacao_est)){
				$nomeAvaliador = $this->get_nome_avaliador($idAvaliador);
				echo "ATEN��O: O seguinte trabalho ($tipoTrabalho) n�o possui hor�rio de avalia��o associado: $idTrabalhoStr (Avaliador: $idAvaliador, $nomeAvaliador)\n<br>";
				$av_tstamp_avaliacao_est = 'NULL';
			}
			if(!isset($local) && $tipoTrabalho == 'P'){
				$nomeAvaliador = $this->get_nome_avaliador($idAvaliador);
				echo "ATEN��O: O seguinte trabalho ($tipoTrabalho) n�o possui local de avalia��o associado: $idTrabalhoStr (Avaliador: $idAvaliador, $nomeAvaliador)\n<br>";
				$local = '';	
			}

			$fields = array("av_journal_id", "av_parecerista_cod", "av_area", "av_numtrab", "av_tipo_trabalho", "av_tstamp_avaliacao_est", "av_local");
			$values = array($this->articles_journal_id, "'".$idAvaliador."'", "'".$areaTrab."'", $numTrab, "'".$tipoTrabalho."'", $av_tstamp_avaliacao_est, "'".$local."'");

			$qryExists = "SELECT av_journal_id, av_parecerista_cod, av_area, av_numtrab, av_tipo_trabalho FROM ".$this->tabela_avaliacoes.
						 " WHERE av_journal_id = '".$this->articles_journal_id."'".
						 " AND av_parecerista_cod = '".$idAvaliador."'".
						 " AND av_area = '".$areaTrab."'".
						 " AND av_numtrab = '".$numTrab."'".
						 " AND av_tipo_trabalho = '".$tipoTrabalho."'";
			$rlt = db_query($qryExists);

			if(($line = db_read($rlt))){
				echo "ERRO: trabalho j� encontrado no sistema: $idTrabalhoStr\n<br>";
				continue;
			}

			#echo implode(", ", array($areaTrab, $numTrab, $tipoTrabalhoHor, date("j/n G:i", $av_tstamp_avaliacao_est), $local))."<br>";
			$qry = "INSERT INTO ".$this->tabela_avaliacoes." (".implode(", ", $fields).") ".
				 " VALUES (".implode(", ", $values).");\n";
			#echo $qry."<br>";
			echo "Inserindo $idTrabalhoStr...\n<br>";
			$rlt = db_query($qry);
			// }
		}

	}

	/**
	 * Retorna os tipos de trabalho poss�veis a partir de uma
	 *  id de trabalho.
	 *
	 * e.g. a maioria dos trabalhos aceita avalia��o de apresenta��o oral 
	 * e poster, por�m trabalhos do Jovens Id�ias s� tem tipo 'J'
	 * 
	 * @param  string $idTrabalhoStr
	 * @return array                [description]
	 */
	function get_tipos_trabalho_possiveis($idTrabalhoStrUnsafe){
		list($areaTrab, $numTrab) = $this->san_id_trabalho($idTrabalhoStrUnsafe);
		$idTrabalhoStr = $this->san_id_trabalho_tostr($areaTrab, $numTrab, true);
		
		if(isset($this->_tiposTrabalhoPossiveisPontual[$this->articles_journal_id][$idTrabalhoStr])){
			$tiposTrabalho = $this->_tiposTrabalhoPossiveisPontual[$this->articles_journal_id][$idTrabalhoStr];
			return $tiposTrabalho;
		}

		foreach($this->_tiposTrabalhoPossiveisArea as $regexArea => $tiposTrabalho){
			if(preg_match("/".$regexArea."/", $areaTrab)){
				return $tiposTrabalho;
			}
		}
		echo "ERRO: N�o foi poss�vel determinar tipos de trabalho poss�veis para ($areaTrab, $numTrab)";
		return $this->_tiposTrabalhoPossiveisArea['.+'];
	}

	/**
	 * *Retorna os c�digos dos trabalhos associados com o avaliador de token $tokenAvaliador
	 * se $idTrabalhoStr for especificado, retorna apenas trabalhos associados com o avaliador 
	 *sa�da:
	 *(
	 *	($idTrabalhoStr, $tipoTrabalho),
	 *	($idTrabalhoStr', $tipoTrabalho'),
	 *	...
	 *)
	 * @param  string  $idAvaliadorUnsafe
	 * @param  boolean $idTrabalhoStrUnsafe
	 * @param  boolean $tipoTrabalhoUnsafe
	 * @param  boolean $apenasPendendoAvaliacao
	 * @return array
	 */
	function get_trabalhos_avaliador($idAvaliadorUnsafe, $idTrabalhoStrUnsafe=false, $tipoTrabalhoUnsafe=false, $apenasPendendoAvaliacao=true)
		{
			$idAvaliador = $this->san_id_avaliador($idAvaliadorUnsafe);
			if($idAvaliador === False){ die("ID do avaliador inv�lida"); }
			
			$qry = "SELECT av_area, av_numtrab, av_tipo_trabalho, av_status, av_tstamp_avaliacao_est, av_local, id_av, av_tstamp_avaliacao".
				   "  FROM ".$this->tabela_avaliacoes.
				   " WHERE av_parecerista_cod = '".$idAvaliador."'".
				   "   AND av_journal_id = ".$this->articles_journal_id;

			if($idTrabalhoStrUnsafe){
				list($areaTrab, $numTrab) = $this->san_id_trabalho($idTrabalhoStrUnsafe);
				$qry.="  AND  av_area = '".$areaTrab."'".
				   	  "  AND  av_numtrab = ".$numTrab;
			}

			if($tipoTrabalhoUnsafe){
				$tipoTrabalho = $this->san_tipo_trabalho($tipoTrabalhoUnsafe);
				$qry.="  AND av_tipo_trabalho = '".$tipoTrabalho."'";
			}

			if($apenasPendendoAvaliacao){
				$qry.="  AND av_status = 0";
			}

			$rlt = db_query($qry);

			$saida = array();
			while ($line = db_read($rlt)){
				list(  $av_area, $av_numtrab, $av_tipo_trabalho, $av_status, $av_tstamp_avaliacao_est, $av_local, $id_av, $av_tstamp_avaliacao) = $line;
				$idTrabalhoStr = $this->id_trabalho_str_canon($av_area,$av_numtrab);
				$trab = array($idTrabalhoStr, $av_tipo_trabalho, $av_status, $av_tstamp_avaliacao_est, $av_local, $id_av, $av_tstamp_avaliacao);
				array_push($saida, $trab);
			}

			return $saida;
		}

	function get_id_avaliacao($idAvaliador, $idTrabalhoStr, $tipoTrabalho)
		{
			# Definido aqui porque, por enquanto, s� � usado nesse contexto
			#Pega a id da avalia��o (id_av) do banco de dados dados argsPagina v�lidos
			list($areaTrab, $numTrab) = $this->san_id_trabalho($idTrabalhoStr);

			$qry = "SELECT id_av from ".$this->tabela_avaliacoes.
				   " WHERE av_area    = '".$areaTrab."'".
				   "   AND av_numtrab = ".$numTrab.
				   "   AND av_tipo_trabalho = '".$tipoTrabalho."'".
				   "   AND av_parecerista_cod = '".$idAvaliador."'".
				   "   AND av_journal_id = ".$this->articles_journal_id;

			$rlt = db_query($qry);
			$line = db_read($rlt);
			if(! $line ){
				return false;
			}
			return $line[0];
		}

	function get_notas_avaliacao($idAvaliacao)
		{
			#Pega as notas de uma avalia��o
			# Inclui todos os campos de nota no BD
			$idAvaliacao = $idAvaliacao;
			$camposNotas = array_keys($this->camposAvNotas);
			$qry = "SELECT ".implode(", ", $camposNotas)." FROM ".$this->tabela_avaliacoes.
				   " WHERE id_av = ".$idAvaliacao.
				   "   AND av_journal_id = ".$this->articles_journal_id;
			$rlt = db_query($qry);
			$line = db_read($rlt);
			if(! $line ){
				return false;
			}

			$notas = array();

			return $notas;
		}

	/**
	 * Insere uma nova avalia��o no sistema, nos casos em que o avaliador n�o esteja associado
	 * previamente a avalia��o em quest�o (i.e. uma avalia��o n�o agendada)
	 * Joga exce��o em caso de erro
	 * @param  [type] $idAvaliadorUnsafe
	 * @param  [type] $idTrabalhoStrUnsafe
	 * @param  [type] $tipoTrabalhoUnsafe
	 */
	function insere_avaliacao_forcado($idAvaliadorUnsafe, $idTrabalhoStrUnsafe, $tipoTrabalhoUnsafe)
		{
			
			$idAvaliador = $this->san_id_avaliador($idAvaliadorUnsafe);
			list($areaTrab, $numTrab) = $this->san_id_trabalho($idTrabalhoStrUnsafe);
			$tipoTrabalho = $this->san_tipo_trabalho($tipoTrabalhoUnsafe);
			if(!($areaTrab && $areaTrab && $tipoTrabalho && $this->avaliador_existe($idAvaliador) && array_search($tipoTrabalho, $this->get_tipos_trabalho_possiveis($idTrabalhoStrUnsafe)) !== false)) {
				die("ERRO: Tentativa de inser��o de trabalho inv�lido");
			}

			#Verifica se o trabalho existe
			$qry = "SELECT * from ".$this->tabela_avaliacoes.
				   " WHERE av_area = '".$areaTrab."'".  
				   "   AND av_numtrab = ".$numTrab.
				   "   AND av_tipo_trabalho = '".$tipoTrabalho."'".
				   "   AND av_parecerista_cod = '".$idAvaliador."'".
				   "   AND av_journal_id = ".$this->articles_journal_id;
			$rlt = db_query($qry);
			$line = db_read($rlt);
			
			if(! $line ){
				$horariosLocais = $this->get_horarios_locais_trabalho($areaTrab, $numTrab, $ipoTrabalho);
				if(array_key_exists($tipoTrabalho, $horariosLocais)){
					list($tstampAvaliacaoEst, $local) = $horariosLocais[$tipoTrabalho];
				}
				else{
					$tstampAvaliacaoEst = 0;
					$local = NULL;
				}

				function _emAspas($x){ return "'$x'"; }
				$qry = "INSERT INTO ".$this->tabela_avaliacoes." (av_journal_id, av_area, av_numtrab, av_tipo_trabalho, av_parecerista_cod, av_tstamp_avaliacao_est, av_local)".
					   " VALUES (".implode(",", array_map(_emAspas, array($this->articles_journal_id, $areaTrab, $numTrab, $tipoTrabalho, $idAvaliador, $tstampAvaliacaoEst, $local))).")";

				$rlt = db_query($qry);
			}
		}

	/**
	 *  Retorna os dados de avalia��o no formato 
	 *  ($idAvaliacao, $tstampAvaliacao, $tstampAvaliacaoEst, $localAvaliacao, $statusAvaliacao, $notas)
	 * @param  [type]  $idAvaliadorUnsafe
	 * @param  [type]  $idTrabalhoStrUnsafe
	 * @param  [type]  $tipoTrabalhoUnsafe
	 * @param  boolean $estrito
	 */
	function get_avaliacao($idAvaliadorUnsafe, $idTrabalhoStrUnsafe, $tipoTrabalhoUnsafe, $estrito=True)
		{
			$erroValidaIdTrabalho = $this->valida_id_trabalho($idAvaliadorUnsafe, $idTrabalhoStrUnsafe);
			if($estrito && $erroValidaIdTrabalho != ""){
				die("Trabalho de ID inv�lida ou n�o associada com o avaliador. Erro:".$erroValidaIdTrabalho);
			}
			else{
				$idTrabalhoStr = $this->san_id_trabalho_str($idTrabalhoStrUnsafe);
			}
			$idAvaliador = $this->san_id_avaliador($idAvaliadorUnsafe);
			$tipoTrabalho = $this->san_tipo_trabalho($tipoTrabalhoUnsafe);

			list($areaTrab, $numTrab) = $this->san_id_trabalho($idTrabalhoStr);

			$qry = "SELECT id_av, av_tstamp_avaliacao, av_tstamp_avaliacao_est, av_local, av_status from ".$this->tabela_avaliacoes.
				   " WHERE av_area    = '".$areaTrab."'".
				   "   AND av_numtrab = ".$numTrab.
				   "   AND av_tipo_trabalho = '".$tipoTrabalho."'".
				   "   AND av_parecerista_cod = '".$idAvaliador."'".
				   "   AND av_journal_id = ".$this->articles_journal_id;

			$rlt = db_query($qry);
			$line = db_read($rlt);

			if(! $line ){
				return false;
			}

			list($idAvaliacao, $tstampAvaliacao, $tstampAvaliacaoEst, $localAvaliacao, $statusAvaliacao) = $line;
			$notas = $this->get_notas_avaliacao($idAvaliacao);

			return array($idAvaliacao, $tstampAvaliacao, $tstampAvaliacaoEst, $localAvaliacao, $statusAvaliacao, $notas);
		}

	/** M�todos que lidam com tabelas externas **/

	/**
	 * Retorna ($titulosDoTrabalho, $nomeAutores, $resumos, $ehInternacional)
	 * $titulosDoTrabalho, $resumos s�o arrays
	 * $nomeAutores � uma string separada por ; #vem direto do BD
	 * $titulosDoTrabalho = ($tituloEmPortugues, $tituloInternacional)
	 * $resumos = ($resumoEmPortugues, $resumoInternacional)
	 * Levanta exce��o em caso de IDs inv�lidas. NULL se o trabalho n�o for encontrado no BD
	 * @param  [type]  $idAvaliadorUnsafe
	 * @param  [type]  $idTrabalhoStrUnsafe
	 * @param  boolean $estrito
	 */
	function get_trabalho($idAvaliadorUnsafe, $idTrabalhoStrUnsafe, $estrito=True)
		{
			$erroValidaIdTrabalho = $this->valida_id_trabalho($idAvaliadorUnsafe, $idTrabalhoStrUnsafe);
			if($estrito && $erroValidaIdTrabalho != ""){
				die("Trabalho de ID inv�lida ou n�o associada com o avaliador. Erro:".$erroValidaIdTrabalho);
			}
			else{
				$idTrabalhoStr = $this->san_id_trabalho_str($idTrabalhoStrUnsafe);
			}

			$qry = "SELECT article_ref,".
				   "       article_title, article_2_title,".
				   "       article_autores,". #article_autores
				   "       article_abstract, article_2_abstract,".
				   "       article_internacional".
				   " FROM ".$this->tabela_articles.
				   " WHERE UPPER(article_ref) = UPPER('".$idTrabalhoStr."')".
				   "   AND journal_id = ".$this->articles_journal_id.
				   "   AND article_publicado = 'S'";

			$rlt = db_query($qry);
			$line = db_read($rlt);
			if(! $line ){
				#"O trabalho n�o foi encontrado no BD";
				return NULL;
			}

			foreach($line as $i => $v){
				#Espera-se apenas alguns tipos de tags na entrada do banco de dados
				$line[$i] = strip_tags($v, "<b><i>");
			}

			list($idTrabalhoStrCanon,
				 $tituloEmPortugues, $tituloInternacional, 
				 $nomeAutores, 
				 $resumoEmPortugues, $resumoInternacional, 
				 $ehInternacional) = $line;

			$nomeAutores = str_replace('_', ' ', $nomeAutores);

			return array(
				$idTrabalhoStrCanon,
				array($tituloEmPortugues, $tituloInternacional),
				$nomeAutores,
				array($resumoEmPortugues, $resumoInternacional),
				$ehInternacional);
		}

	/**
	 * Pega o n�mero total de trabalhos na tabela articles
	 */
	function get_total_de_trabalhos_em_articles()
		{
			$qry = "SELECT COUNT(*) FROM articles".
				   " WHERE journal_id = ".$this->articles_journal_id.
				   "   AND article_publicado = 'S'";
			$rlt = db_query($qry);
			$line = db_read($rlt);
			return $line[0];
		}

	/**
	 * Pega o nome do avaliador em pareceristas
	 * @param  [type]  $idAvaliadorUnsafe
	 * @param  boolean $estrito
	 */
	function get_nome_avaliador($idAvaliadorUnsafe, $estrito=True)
		#se $estrito, retorna o nome do avaliador apenas se us_ativo = 1
		{
			$idAvaliador = $this->san_id_avaliador($idAvaliadorUnsafe);
			if($idAvaliador === False){
				#$idAvaliador inv�lida ou n�o encontrada em pareceristas
				return False;
			}
			$qry = "SELECT us_nome FROM ".$this->tabela_pareceristas.
				   " WHERE ".$this->col_id_parecerista." = '".$idAvaliador."'"."";
			#	   "   AND us_journal_id = ".$this->articles_journal_id;
			if($estrito && $this->pareceristas_ignorar_us_ativo == false){
				$qry .= " AND us_ativo = 1";
			}
			$rlt = db_query($qry);
			$line = db_read($rlt);

			if(! $line ){
				return False;
			}
			$nomeAvaliador = strip_tags($line[0]);
			return $nomeAvaliador;
		}

	/**
	 * Somente valida se $idAvaliadorUnsafe est� no formato certo e
	 * verifica se o avaliador existe no banco de dados
	 *
	 * Como avaliador_existe() exerce fun��o de autenticador, n�o � interessante diferenciar se
	 *  o avaliador � n�o-existente ou inv�lido na sa�da
	 * XXX Depreciado: agora san_id_avaliador j� verifica se o avaliador existe
     *
	 * @return 0 em caso de $idAvaliador n�o-existente ou inv�lido.
	 */
	function avaliador_existe($idAvaliador)
		{
			#Verifica se o avaliador existe no banco de dados
			$qry = "SELECT ".$this->col_id_parecerista." FROM ".$this->tabela_pareceristas.
				   " WHERE ".$this->col_id_parecerista." = '".$idAvaliador."'";
			#	   "   AND us_journal_id = ".$this->articles_journal_id.
			if($this->pareceristas_ignorar_us_ativo == false){
				   $qry .= "   AND us_ativo = 1";
			}
			$rlt = db_query($qry);

			return db_read($rlt) != false;

		}

	/** Sanitizadores **/

	function san_id_avaliador($idAvaliadorUnsafe)
		{
			#$id do avaliador s� pode ser n�meros seguidos de dois d�gitos de c�digo verificador
			if(preg_match("/^\d+$/", trim($idAvaliadorUnsafe))) {
				$idAvaliador = intval($idAvaliadorUnsafe);

				#XXX ids de avaliador tem tamanhos distintos (uns tem 8, uns tem 7...)
				#O ideal aqui seria ou usar um CAST ou regex, por�m ambos tem sintaxe diferente
				#no mysql e no postgres
				$qry = "SELECT ".$this->col_id_parecerista." FROM ".$this->tabela_pareceristas.
				   " WHERE CAST(".$this->col_id_parecerista." AS ".$this->bd_tipo_numerico.") = '".$idAvaliador."'";
			#	   "   AND us_journal_id = ".$this->articles_journal_id.
				if($this->pareceristas_ignorar_us_ativo == false){
				   $qry .= "   AND us_ativo = 1";
				}
				$rlt = db_query($qry);
				$line = db_read($rlt);

				if( $line != false ){
					$idAvaliador = str_pad($line[0], 7, '0', STR_PAD_LEFT);
				}
				else{
					$idAvaliador = false;
				}
				return $idAvaliador;
			}
			else{
				#$idAvaliador n�o est� no formato v�lido
				return false; 
			}
		}

	function san_id_avaliador_com_verificador($idAvaliadorComVerificadorUnsafe)
		{
			if(preg_match("/^(\d+)-?(\d\d)$/", trim($idAvaliadorComVerificadorUnsafe), $matches)) {
				$idAvaliadorComVerificador = intval($matches[1].$matches[2]);

				if(cpf(str_pad($idAvaliadorComVerificador, 11, '0', STR_PAD_LEFT))){
					$idAvaliador = intval($idAvaliadorComVerificador/100);
					return $this->san_id_avaliador($idAvaliador);
				}	
			}
			return false;
		}

	/**
	 * Transforma uma $idTrabalhoStr em ($areaTrab, $numTrab)
	 * @param  [type] $idTrabalhoStrUnsafe
	 */
	function san_id_trabalho($idTrabalhoStrUnsafe){
		#Retorna ($areaTrab, $numTrab)
		$areaTrab = False;
		$numTrab = False;
		$idTrabalhoStrUnsafe = trim($idTrabalhoStrUnsafe);

		#XXX Seguindo instru��es do Rene, se o trabalho tiver o sufixo 'jr', concatenar com a �rea do trabalho para uso no BD
		if(preg_match('/^(?P<area>[a-z]*[A-Z]+[a-z]*)(?P<num>\d+)((?P<ehPibit>T?)|(?P<ehJunior>(jr)?))$/i', $idTrabalhoStrUnsafe, $matches)){
			list($areaTrabUnsafe, $numTrabUnsafe, $ehJunior) = array($matches['area'], $matches['num'], $matches['ehJunior']);
			$areaTrabUnsafe = $areaTrabUnsafe;
			$sufixoJr = '';
			if($ehJunior){ $sufixoJr = 'jr'; }
			#$ehJunior =strtolower($ehJunior);

			#Testa se a �rea do trabalho � valida
			$areaTrabValida = !preg_match('/[^\x41-\x5a]/', strtoupper($areaTrabUnsafe)) && (strlen($areaTrabUnsafe) > 0) && (strlen($areaTrabUnsafe) <= 10); #[\x00-\x7F]+ #<- todos os caracteres ascii
			$numTrabValido  = is_numeric($numTrabUnsafe) && (intval($numTrabUnsafe) >= 0);

			#XXX Seguindo instru��es do Rene, se o trabalho tiver o sufixo 'jr', concatenar com a �rea do trabalho para uso no BD
			if($areaTrabValida) { $areaTrab = $areaTrabUnsafe . $sufixoJr; }
			if($numTrabValido)  { $numTrab  = intval($numTrabUnsafe); }
		}

		return array($areaTrab, $numTrab);
	}

	/**
	 * Esse m�todo de santiza��o acessa a tabela externa "articles" para
	 *      conseguir o nome 'canonico' do trabalho
	 * se $estrito == True, retorna False se o artigo n�o estiver no bd articles
	 * do contr�rio, retorna uma id do trabalho sanitizada baseada em
	 *  $idTrabalhoStrUnsafe
	 * @param  [type]  $idTrabalhoStrUnsafe
	 * @param  boolean $estrito
	 */
	function san_id_trabalho_str($idTrabalhoStrUnsafe, $estrito=False)
		{
			list($areaTrab, $numTrab) = $this->san_id_trabalho($idTrabalhoStrUnsafe);
			if($areaTrab === False) { return False; }

			return $this->san_id_trabalho_tostr($areaTrab, $numTrab, $estrito);
		}

	function san_id_trabalho_tostr($areaTrab, $numTrab, $estrito)
		{
			#XXX Chuncho para ver se eu devo colocar o sufixo jr no final
			preg_match('/^(?P<area>[A-Z]+?)(?P<ehJunior>(jr)?)$/i',$areaTrab,$matches);
			$areaTrab = $matches['area'];
			$ehJunior = $matches['ehJunior'];

			#XXX Chuncho para adequar ao formato que est� no banco de dados
			# XXX e se max($numTrab) > 99?
			$idTrabalhoStr = strtoupper($areaTrab).($numTrab >= 10 ? $numTrab : "0".$numTrab).$ehJunior;

			$qry = "SELECT article_ref".
				   " FROM ".$this->tabela_articles.
				   " WHERE (".
				   		"UPPER(article_ref) = UPPER('".$idTrabalhoStr."') ".
						" OR UPPER(article_ref) = UPPER('".$idTrabalhoStr."T')) ". #Para tomar em considera��o trabalhos do PIBIT
				   "   AND journal_id = ".$this->articles_journal_id.
				   "   AND article_publicado = 'S'";

			$rlt = db_query($qry);
			$line = db_read($rlt);

			if(!$line){
				if($estrito) { return False;          }
				else         { return $idTrabalhoStr; }
			}
			$idTrabalho = trim($line[0]);

			return $idTrabalho;
		}

	function san_tipo_trabalho($tipoTrabalhoUnsafe){
		if(array_key_exists($tipoTrabalhoUnsafe, $this->tipoTrabalhoExtenso)){
			$tipoTrabalho = $tipoTrabalhoUnsafe;
			return $tipoTrabalho;
		}
		return False;
	}

	function san_zero_um($algo)
		{
			if(is_numeric($algo) && ($algo === '0' || $algo === '1')){
				return $algo;
			}
			return false;
		}

	function san_numero_positivo($algo)
		{
			if(is_numeric($algo) && ($algo >= 0)){
				return $algo;
			}
			return false;
		}

	function id_trabalho_str_canon($areaTrab, $numTrab)
		{
			#Retorna o nome 'canonico' do trabalho (e.g como est� em articles) dado $areaTrab, $numTrab
			$idTrabalhoStrCanon = $this->san_id_trabalho_tostr($areaTrab,$numTrab,False);
			return $idTrabalhoStrCanon;
		}

	/**
	 * Validadores de form
	 * Validadores retornam '' se a entrada for validada com sucesso
	 * e uma mensagem de erro caso contr�rio
	 */
	
	function valida_avaliador($idAvaliadorUnsafe)
		{
			#Por enquanto, s� verifica se a $id do avaliador est� no formato
			#certo e se existe no banco de dados
			$idAvaliador = $this->san_id_avaliador($idAvaliadorUnsafe);

			if($idAvaliador != False && $this->avaliador_existe($idAvaliador)){
				return('');
			}
			return("C�digo de avaliador inv�lido");
		}

	
	function valida_avaliador_com_verificador($idAvaliadorComVerificadorUnsafe)
		{
			$idAvaliador = $this->san_id_avaliador_com_verificador($idAvaliadorComVerificadorUnsafe);
			return $this->valida_avaliador($idAvaliador);
		}


	function valida_id_trabalho($idAvaliadorUnsafe, $idTrabalhoStrUnsafe, $tipoTrabalho = NULL, $estrito=True)
		{	
			#Verifica se o trabalho est� no banco de dados e, se $estrito, dispon�vel para o 
			# avaliador
			$idAvaliador = $this->san_id_avaliador($idAvaliadorUnsafe);
			$erroValidaAv = $this->valida_avaliador($idAvaliador);
			if($erroValidaAv != "") { return $erroValidaAv; }

			list($areaTrab, $numTrab) = $this->san_id_trabalho($idTrabalhoStrUnsafe);

			if($areaTrab === False || $numTrab === False) { return "C�digo do trabalho inv�lido"; }

			$qry = "SELECT id_av FROM ".$this->tabela_avaliacoes.
				   " WHERE av_area = '".$areaTrab."'".
				   "  AND  av_numtrab = ".$numTrab.
				   "  AND  av_journal_id = ".$this->articles_journal_id;
				   
			if($estrito){
				$qry .= " AND av_parecerista_cod = '".$idAvaliador."'";
			}

			if($tipoTrabalho !== NULL){
				$qry .= "  AND av_tipo_trabalho = '".$tipoTrabalho."'";
			}

			$rlt = db_query($qry);
			$line = db_read($rlt);

			$sucesso = false;

			if($line){
				$sucesso = true;
			}
			elseif($line === false && !$estrito){
				#procura tamb�m em articles, pra ver se pelo menos o artigo existe l�
				$sucesso = $this->san_id_trabalho_tostr($areaTrab, $numTrab, True) !== false;
			}

			if($sucesso){ 
				return ""; 
			}
			else{ 
				return "Trabalho n�o existe no sistema".($estrito ? " ou indispon�vel ao avaliador." : ".");
			}
		}

	/**
	 * Validadores adicionais de form
	 */
	
	function validador_adicional_nota_zero_cem($nota){
		if(is_numeric($nota) && $nota >= 0 && $nota <= 100){
			return "";
		}
		else{
			return "Digite um valor de 0 a 100";
		}
	}

	function validador_adicional_nota_um_dez($nota){
		if(is_numeric($nota) && $nota >= 1 && $nota <= 10){
			return "";
		}
		else{
			return "Escolha um valor de 1 a 10";
		}
	}

	function validador_adicional_s_n($entrada)
		{
			if(is_numeric($entrada) && ($entrada == 1 || $entrada == 0)){
				return "";
			}
			else{
				return "Responda SIM ou N�O";
			}
		}

	function validador_adicional_presenca_prof($entrada)
		{
			if(is_numeric($entrada) && ($entrada == 2 || $entrada == 1 || $entrada == 0)){
				return "";
			}
			else{
				return "Responda SIM, N�O ou FALTOU COM JUSTIFICATIVA";
			}
		}

	/**
	 * Criadores de formul�rio
	 */

	function form_insere_validador(&$cp, $resultado_validador)
		#Insere a sa�da de um validador num array de campos (&$cp) de maneira
		# a deixar form->saved == 0 em caso de valores inv�lidos e 
		# mostrar a sa�da de erro do validador no formul�rio
		{
			global $acao;
			if(strlen($acao) > 0)
				{
					#Mostra mensagem de erro apenas se houver uma 
					# a��o
					$msg_erro = $resultado_validador;
				}
			else
				{
					$msg_erro = "";
				}

			$valido = $resultado_validador != '';

			//Estiliza $msg_erro
			// Isso seria mais apropriado numa classe de view...
			if($msg_erro){
				$msg_erro = '<div style="color: red; text-align:right; font-weight:normal;"><i>'.$msg_erro.'</i><br><br></div>';
			}
			
			array_push($cp,array('$M8','',$msg_erro,False,True));
			array_push($cp,array('$H8','','',$valido,True));
			return $valido;
		}

	/** 
	 * Gera��o de campos do form *
	 */

	/* Campo para identifica��o do avaliador */
	function cp_id_avaliador()
		{
			#Entrada de dados 
			global $dd;
			$idAvaliadorUnsafe = $dd[1];
			$cp = array();
			array_push($cp,array('$H8','','',False,True));
			array_push($cp,array('$S10','', 'ID Avaliador', True, True)); #av_parecerista_cod

			$this->form_insere_validador($cp, $this->valida_avaliador_com_verificador($idAvaliadorUnsafe));

			array_push($cp,array('$B8','','Entrar (eAs8CSk2!j4!xv723891)',False,True));
			return $cp;
		}

	/* Campo para identifica��o do trabalho */
	function cp_id_trabalho()
		{
			global $dd,$acao;

			$argsPagina = $this->get_args_pagina();

			$idTrabalhoStrUnsafe = $dd[1];
			$idAvaliadorUnsafe = $argsPagina["idAvaliador"];

			$cp = array();
			array_push($cp,array('$H8','','',False,True));
			array_push($cp,array('$S10','','C�digo do trabalho',True,True));
			
			$this->form_insere_validador($cp, $this->valida_id_trabalho($idAvaliadorUnsafe, $idTrabalhoStrUnsafe, NULL, False));
						
			array_push($cp,array('$B8','','Continuar',False,True));
			return($cp);
		}

	/**
	 * Cria os campos de avalia��o do trabalho e adiciona em &$cp
 	 *  M�todo helper para cp_oral e cp_poster 
	 * @param  [type] $cp
	 * @param  [type] $tipoTrabalho
	 */
	function cria_campos_ficha_avaliacao(&$cp, $tipoTrabalho)
		{
			foreach($this->camposAv[$tipoTrabalho] as $chv){
				list($tipo, $nomeExtenso, $reqPreenchimento, $gravarNaTabela, $validadorLocalAdicional) = $this->_camposAvForm[$chv];
				if(isset($this->camposAvNomes[$tipoTrabalho][$chv])){
					#Override de $nomeExtenso
					$nomeExtenso = $this->camposAvNomes[$tipoTrabalho][$chv];
				}
				$campos = array($tipo, $chv, $nomeExtenso, $reqPreenchimento, $gravarNaTabela);

				array_push($cp, $campos);

				if($validadorLocalAdicional){
					#Insere validador adicional
					global $dd;
					$i=array_search($campos, $cp);
					$saidaValidador = call_user_func_array(array($this, $validadorLocalAdicional), array($dd[$i]));
					$this->form_insere_validador($cp, $saidaValidador);
				}
			}
		}

	function cp_ficha_avaliacao($tipoAvaliacao)
		{
			if(!array_key_exists($tipoAvaliacao, $this->camposAv)){
				die("Tipo de avalia��o inv�lido");
			}
			
			$args = $this->get_args_pagina();
			list($idAvaliador, $idTrabalhoStr) = array($args["idAvaliador"], $args["idTrabalhoStr"]);
			
			global $dd;
			$idAvaliacao = $this->get_id_avaliacao($idAvaliador, $idTrabalhoStr, $tipoAvaliacao);

			$dd[0] = $idAvaliacao;

			$cp = array();
			array_push($cp,array('$H8','id_av','',False,True)); 
			$this->cria_campos_ficha_avaliacao($cp, $tipoAvaliacao);
			array_push($cp,array('$B8','','Confirmar avalia��o',False,False));

			return($cp);
		}
}
?>
