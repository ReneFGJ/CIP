<?php
/**
* Essa classe mantém as regras de negócio principais
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

	function __construct ($journal_id, $eventos){
		function _nomeEventoExterno($parNomesExtCanon){ return $parNomesExtCanon[0]; }
		$this->eventosValidos = array_map(_nomeEventoExterno, $eventos);
		$this->journal_id = $journal_id;
	}

	//Construtor, para compatibilidade com PHP 4
	function _DAO_tabela_trabalhos_avaliador($journal_id, $eventos){
		$this->__construct($journal_id, $eventos);
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
				echo "ATENCAO: trabalho com tipo de trabalho inválido: ".$idTrabalhoStr." (".$tipoExtenso.")<br>";
				continue;
			}
			assert(isset($this->tipoTrabalhoCodigo[$tipoExtenso]));
			$tipoTrabalho = $this->tipoTrabalhoCodigo[$tipoExtenso];

			array_push($trabalhos, array($idTrabalhoStr, $tipoTrabalho, $idAvaliadorTrab));
		}

		return $trabalhos;
	}
}

class Avaliacao
	{
	/**
	 * Indica o journal_id em ojs.articles a ser usado na edição desse $ano
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
		array('MP15', 'XIV Mostra de Pesquisa da Pós-Graduação'),
	);

	/**
	 * Tabelas de origem externa
	 */
	var $tabela_pareceristas = 'pareceristas';
	var $col_id_parecerista = 'id_us';
	var $tabela_articles = "articles";

	/**
	 * Definição dos campos de nota, podendo ser configurado com um validador adicional 
	 * (um método dessa classe com comportamento específico)
	 * Formato: Nome da coluna na BD => ($tipo, $nomeExtenso, $reqPreenchimento, $gravarNaTabela, $validadorLocalAdicional)
	 * @var array
	 */
	var $camposAvForm = array(
		#
		'av_clareza' 	  => array('$[1-10]', "Clareza", True, True, "validador_adicional_nota_um_dez"),
		'av_sintese' 	  => array('$[1-10]', "Poder de Síntese", True, True, "validador_adicional_nota_um_dez"),
		'av_contribuicao' => array('$[1-10]', "Contribuição para formação científica", True, True, "validador_adicional_nota_um_dez"),
		'av_conteudo'     => array('$[1-10]', "Conteúdo", True, True, "validador_adicional_nota_um_dez"),
		'av_qualidade'    => array('$[1-10]', "Qualidade Visual", True, True, "validador_adicional_nota_um_dez"),
		'av_desempenho'   => array('$[1-10]', "Desempenho do Aluno", True, True, "validador_adicional_nota_um_dez"),

		'av_nota' 		  => array('$[1-10]', "Dê uma nota geral para a exposição como um todo", True, True, "validador_adicional_nota_um_dez"),
		'av_indicado'     => array('$O : &1:SIM&0:NÃO', "Indicar como um dos dez melhores trabalhos?", True, True, validador_adicional_s_n), #"validador_adicional_indicado"?
	);
	
	/**
	 * Tipos de avaliação relacionados aos seus campos.
	 * @var array
	 */
	var $camposAv = array(
		#Campos da avaliação oral
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

        #Campos da avaliação de poster
        #A avaliação de poster não contém o campo av_clareza
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

	/**
	 * Nome em extenso dos tipos de trabalho
	 * @var array
	 */
	var $tipoTrabalhoExtenso = array(
		"O" => "Ap. Oral",
		"P" => "Poster",
	);

	/**
	 * Nome da página em que a instância do objeto se encontra. DEVE ser NULL ou ser uma chave em $this->argsPagina
	 * @var string
	 */
	var $nomePagina = NULL;

	var $argsPaginaIndInicio = 50; #Esse índice DEVE ser maior que qualquer indíce (em $dd) usado em forms para evitar conflitos

	/**
	 * 	Argumentos de entrada da página e seus sanitizadores
	 *  Um índice começando em $this->argsPaginaIndInicio será atribuido para cada um desses args
	 *  na inicialização da instância desse objeto em $this->argsPagina e $this->argsPaginaInd
	 * @var array
	 */
	var $argsPagina = array(
		'idAvaliador'   => 'san_id_avaliador', 
		'idTrabalhoStr' => 'san_id_trabalho_str', 
		'tipoTrabalho'  => 'san_tipo_trabalho',
		'forcado'       => 'san_zero_um',
		'naoCompareceu' => 'san_zero_um',
	);
		
	/**
	 * Índices atribuídos a $nomesArgsPagina para uso interno
	 * Os atributos abaixo são computados na inicialização da instância do objeto
	 * e NÃO DEVEM ser setados pelo desenvolvedor diretamente
	 * @var array
	 */
	var $_argsPagina    = array();
	var $_argsPaginaInd = array();
	var $_sanArgsPag    = array();


	/**
	 * Tipo a ser usado em expressoes SQL como CAST(nome_col_str AS bd_tipo_numerico)
	 * Se NULL, é setado automaticamente pelo construtor;
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
	
	//XXX Os métodos abaixo seriam mais apropriados numa classe de view

	/**
	 * Seta página em que a instância do objeto se encontra
	 * @param string $nomePagina
	 */
	function set_pagina($nomePagina){
		$this->nomePagina = $nomePagina;
	}

	/**
	 * Constrói uma query usando o padrão $dd$i=$valor
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
	 * Pega os argumentos passados para a página na forma array(key => value)
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
	 * Redireciona para uma página de nome $pagina
	 * @param  [type] $pagina
	 * @param  [type] $inputArgs
	 */
	function redireciona($pagina, $inputArgs){
		redirecina($this->build_url_pagina($pagina, $inputArgs));
		exit();
	}

	/**
	 * Confirma o fim de uma avaliação, dado parâmetros
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
	 * Confirma o fim de uma avaliação, setando todas as notas = -1
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
				$qry.= implode(" = -1,", array_keys($this->camposAvForm))." = -1";
				$qry.= " WHERE id_av = ".$idAvaliacao;
				$rlt = db_query($qry);
				return 1;
			}
			return 0;
		}

	//XXX implementação ruim
	function _importar_trabalhos(){

		function get_horarios_locais_trabalho($av, $areaTrab, $numTrab){
			assert($areaTrab);
			assert($numTrab);
			$qry = "SELECT avhl_tipo_trabalho, avhl_tstamp_avaliacao_est, avhl_local".
				   " FROM ".$av->tabela_locais_horarios.
				   " WHERE avhl_area = '".$areaTrab."'".
				   "   AND avhl_numtrab = ".$numTrab;
			$rlt = db_query($qry);

			$horariosLocais = array();
			while(($line = db_read($rlt))){
				list($tipoTrabalho, $tstampAvaliacaoEst, $local) = $line;
				$horariosLocais[$tipoTrabalho] = array($tstampAvaliacaoEst, $local);
			}

			return $horariosLocais;
		}

		$daoTrabsAv = new _DAO_tabela_trabalhos_avaliador($this->articles_journal_id, $this->eventos);
		$trabalhosAvaliador = $daoTrabsAv->get_trabalhos();

		$qry = '';

		foreach($trabalhosAvaliador as $trabAv){
			list($idTrabalhoStr, $tipoTrabalho, $idAvaliador) = $trabAv;
			list($areaTrab, $numTrab) = $this->san_id_trabalho($idTrabalhoStr);

			if(!$areaTrab){
				echo "ATENÇÃO: Nome de trabalho inválido: $idTrabalhoStr\n<br>";
				//exit();
				continue;
			}

			$horariosLocais = get_horarios_locais_trabalho($this, $areaTrab, $numTrab);

			// foreach($horariosLocais as $tipoTrabalhoHor => $horaLocal){
			list($av_tstamp_avaliacao_est, $local) = $horariosLocais[$tipoTrabalho];
			if(!isset($av_tstamp_avaliacao_est)){
				echo "ATENÇÃO: O seguinte trabalho ($tipoTrabalho) não possui horário de avaliação associado: $idTrabalhoStr\n<br>";
				$av_tstamp_avaliacao_est = 'NULL';
			}
			if(!isset($local) && $tipoTrabalho == 'P'){
				echo "ATENÇÃO: O seguinte trabalho ($tipoTrabalho) não possui local de avaliação associado: $idTrabalhoStr\n<br>";
				$local = '';	
			}

			$fields = array("av_parecerista_cod", "av_area", "av_numtrab", "av_tipo_trabalho", "av_tstamp_avaliacao_est", "av_local");
			$values = array("'".$idAvaliador."'", "'".$areaTrab."'", $numTrab, "'".$tipoTrabalho."'", $av_tstamp_avaliacao_est, "'".$local."'");

			#echo implode(", ", array($areaTrab, $numTrab, $tipoTrabalhoHor, date("j/n G:i", $av_tstamp_avaliacao_est), $local))."<br>";
			$qry = "INSERT INTO ".$this->tabela_avaliacoes." (".implode(", ", $fields).") ".
				 " VALUES (".implode(", ", $values).");\n";
			#echo $qry."<br>";
			$rlt = db_query($qry);
			// }
		}

	}

	/**
	 * *Retorna os códigos dos trabalhos associados com o avaliador de token $tokenAvaliador
	 * se $idTrabalhoStr for especificado, retorna apenas trabalhos associados com o avaliador 
	 *saída:
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
			if($idAvaliador === False){ die("ID do avaliador inválida"); }
			
			$qry = "SELECT av_area, av_numtrab, av_tipo_trabalho, av_status, av_tstamp_avaliacao_est, av_local, id_av, av_tstamp_avaliacao".
				   "  FROM ".$this->tabela_avaliacoes.
				   " WHERE av_parecerista_cod = '".$idAvaliador."'";

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
			# Definido aqui porque, por enquanto, só é usado nesse contexto
			#Pega a id da avaliação (id_av) do banco de dados dados argsPagina válidos
			list($areaTrab, $numTrab) = $this->san_id_trabalho($idTrabalhoStr);

			$qry = "SELECT id_av from ".$this->tabela_avaliacoes.
				   " WHERE av_area    = '".$areaTrab."'".
				   "   AND av_numtrab = ".$numTrab.
				   "   AND av_tipo_trabalho = '".$tipoTrabalho."'".
				   "   AND av_parecerista_cod = '".$idAvaliador."'";

			$rlt = db_query($qry);
			$line = db_read($rlt);
			if(! $line ){
				return false;
			}
			return $line[0];
		}

	function get_notas_avaliacao($idAvaliacao)
		{
			#Pega as notas de uma avaliação
			# Inclui todos os campos de nota no BD
			$idAvaliacao = $idAvaliacao;
			$camposNotas = array_keys($this->camposAvForm);
			$qry = "SELECT ".implode(", ", $camposNotas)." FROM ".$this->tabela_avaliacoes.
				   " WHERE id_av = ".$idAvaliacao;
			$rlt = db_query($qry);
			$line = db_read($rlt);
			if(! $line ){
				return false;
			}

			$notas = array();

			return $notas;
		}

	/**
	 * Insere uma nova avaliação no sistema, nos casos em que o avaliador não esteja associado
	 * previamente a avaliação em questão (i.e. uma avaliação não agendada)
	 * Joga exceção em caso de erro
	 * @param  [type] $idAvaliadorUnsafe
	 * @param  [type] $idTrabalhoStrUnsafe
	 * @param  [type] $tipoTrabalhoUnsafe
	 */
	function insere_avaliacao_forcado($idAvaliadorUnsafe, $idTrabalhoStrUnsafe, $tipoTrabalhoUnsafe)
		{
			
			$idAvaliador = $this->san_id_avaliador($idAvaliadorUnsafe);
			list($areaTrab, $numTrab) = $this->san_id_trabalho($idTrabalhoStrUnsafe);
			$tipoTrabalho = $this->san_tipo_trabalho($tipoTrabalhoUnsafe);
			if(!($areaTrab && $areaTrab && $tipoTrabalho && $this->avaliador_existe($idAvaliador))){
				die("ERRO: Tentativa de inserção de trabalho inválido");
			}

			#Verifica se o trabalho existe
			$qry = "SELECT * from ".$this->tabela_avaliacoes.
				   " WHERE av_area = '".$areaTrab."'".  
				   "   AND av_numtrab = ".$numTrab.
				   "   AND av_tipo_trabalho = '".$tipoTrabalho."'".
				   "   AND av_parecerista_cod = '".$idAvaliador."'";
			$rlt = db_query($qry);
			$line = db_read($rlt);

			if(! $line ){
				function _emAspas($x){ return "'$x'"; }
				$qry = "INSERT INTO ".$this->tabela_avaliacoes." (av_area, av_numtrab, av_tipo_trabalho, av_parecerista_cod)".
					   " VALUES (".implode(",", array_map(_emAspas, array($areaTrab, $numTrab, $tipoTrabalho, $idAvaliador))).")";

				$rlt = db_query($qry);
			}
		}

	/**
	 *  Retorna os dados de avaliação no formato 
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
				die("Trabalho de ID inválida ou não associada com o avaliador. Erro:".$erroValidaIdTrabalho);
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
				   "   AND av_parecerista_cod = '".$idAvaliador."'";

			$rlt = db_query($qry);
			$line = db_read($rlt);

			if(! $line ){
				return false;
			}

			list($idAvaliacao, $tstampAvaliacao, $tstampAvaliacaoEst, $localAvaliacao, $statusAvaliacao) = $line;
			$notas = $this->get_notas_avaliacao($idAvaliacao);

			return array($idAvaliacao, $tstampAvaliacao, $tstampAvaliacaoEst, $localAvaliacao, $statusAvaliacao, $notas);
		}

	/** Métodos que lidam com tabelas externas **/

	/**
	 * Retorna ($titulosDoTrabalho, $nomeAutores, $resumos, $ehInternacional)
	 * $titulosDoTrabalho, $resumos são arrays
	 * $nomeAutores é uma string separada por ; #vem direto do BD
	 * $titulosDoTrabalho = ($tituloEmPortugues, $tituloInternacional)
	 * $resumos = ($resumoEmPortugues, $resumoInternacional)
	 * Levanta exceção em caso de IDs inválidas. NULL se o trabalho não for encontrado no BD
	 * @param  [type]  $idAvaliadorUnsafe
	 * @param  [type]  $idTrabalhoStrUnsafe
	 * @param  boolean $estrito
	 */
	function get_trabalho($idAvaliadorUnsafe, $idTrabalhoStrUnsafe, $estrito=True)
		{
			$erroValidaIdTrabalho = $this->valida_id_trabalho($idAvaliadorUnsafe, $idTrabalhoStrUnsafe);
			if($estrito && $erroValidaIdTrabalho != ""){
				die("Trabalho de ID inválida ou não associada com o avaliador. Erro:".$erroValidaIdTrabalho);
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
				#"O trabalho não foi encontrado no BD";
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
	 * Pega o número total de trabalhos na tabela articles
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
				#$idAvaliador inválida ou não encontrada em pareceristas
				return False;
			}
			$qry = "SELECT us_nome FROM ".$this->tabela_pareceristas.
				   " WHERE ".$this->col_id_parecerista." = '".$idAvaliador."'"."";
			#	   "   AND us_journal_id = ".$this->articles_journal_id;
			if($estrito){
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
	 * Somente valida se $idAvaliadorUnsafe está no formato certo e
	 * verifica se o avaliador existe no banco de dados
	 *
	 * Como avaliador_existe() exerce função de autenticador, não é interessante diferenciar se
	 *  o avaliador é não-existente ou inválido na saída
	 * XXX Depreciado: agora san_id_avaliador já verifica se o avaliador existe
     *
	 * @return 0 em caso de $idAvaliador não-existente ou inválido.
	 */
	function avaliador_existe($idAvaliador)
		{
			#Verifica se o avaliador existe no banco de dados
			$qry = "SELECT ".$this->col_id_parecerista." FROM ".$this->tabela_pareceristas.
				   " WHERE ".$this->col_id_parecerista." = '".$idAvaliador."'".
			#	   "   AND us_journal_id = ".$this->articles_journal_id.
				   "   AND us_ativo = 1";
			$rlt = db_query($qry);
			$line = db_read($rlt);
			return db_read($rlt) != false;

		}

	/** Sanitizadores **/

	function san_id_avaliador($idAvaliadorUnsafe){
			#$id do avaliador só pode ser alfanumérico estrito (e.g. sem espaços, sem caracteres de acento)
			if(preg_match("/^[a-zA-Z0-9_]+$/", trim($idAvaliadorUnsafe))) {
				$idAvaliador = intval($idAvaliadorUnsafe);
				#XXX ids de avaliador tem tamanhos distintos (uns tem 8, uns tem 7...)
				#O ideal aqui seria ou usar um CAST ou regex, porém ambos tem sintaxe diferente
				#no mysql e no postgres
				$qry = "SELECT ".$this->col_id_parecerista." FROM ".$this->tabela_pareceristas.
				   " WHERE CAST(".$this->col_id_parecerista." AS ".$this->bd_tipo_numerico.") = '".$idAvaliador."'".
			#	   "   AND us_journal_id = ".$this->articles_journal_id.
				   "   AND us_ativo = 1";
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
				#$idAvaliador não está no formato válido
				return false; 
			}
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

		#XXX Seguindo instruções do Rene, se o trabalho tiver o sufixo 'jr', concatenar com a área do trabalho para uso no BD
		if(preg_match('/^(?P<area>[a-z]*[A-Z]+[a-z]*)(?P<num>\d+)((?P<ehPibit>T?)|(?P<ehJunior>(jr)?))$/i', $idTrabalhoStrUnsafe, $matches)){
			list($areaTrabUnsafe, $numTrabUnsafe, $ehJunior) = array($matches['area'], $matches['num'], $matches['ehJunior']);
			$areaTrabUnsafe = $areaTrabUnsafe;
			$sufixoJr = '';
			if($ehJunior){ $sufixoJr = 'jr'; }
			#$ehJunior =strtolower($ehJunior);

			#Testa se a área do trabalho é valida
			$areaTrabValida = !preg_match('/[^\x41-\x5a]/', strtoupper($areaTrabUnsafe)) && (strlen($areaTrabUnsafe) > 0) && (strlen($areaTrabUnsafe) <= 10); #[\x00-\x7F]+ #<- todos os caracteres ascii
			$numTrabValido  = is_numeric($numTrabUnsafe) && (intval($numTrabUnsafe) >= 0);

			#XXX Seguindo instruções do Rene, se o trabalho tiver o sufixo 'jr', concatenar com a área do trabalho para uso no BD
			if($areaTrabValida) { $areaTrab = $areaTrabUnsafe . $sufixoJr; }
			if($numTrabValido)  { $numTrab  = intval($numTrabUnsafe); }
		}

		return array($areaTrab, $numTrab);
	}

	/**
	 * Esse método de santização acessa a tabela externa "articles" para
	 *      conseguir o nome 'canonico' do trabalho
	 * se $estrito == True, retorna False se o artigo não estiver no bd articles
	 * do contrário, retorna uma id do trabalho sanitizada baseada em
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

			#XXX Chuncho para adequar ao formato que está no banco de dados
			# XXX e se max($numTrab) > 99?
			$idTrabalhoStr = strtoupper($areaTrab).($numTrab >= 10 ? $numTrab : "0".$numTrab).$ehJunior;

			$qry = "SELECT article_ref".
				   " FROM ".$this->tabela_articles.
				   " WHERE (".
				   		"UPPER(article_ref) = UPPER('".$idTrabalhoStr."') ".
						" OR UPPER(article_ref) = UPPER('".$idTrabalhoStr."T')) ". #Para tomar em consideração trabalhos do PIBIT
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
			return is_numeric($algo) && ($algo === '0' || $algo === '1');
		}

	function id_trabalho_str_canon($areaTrab, $numTrab)
		{
			#Retorna o nome 'canonico' do trabalho (e.g como está em articles) dado $areaTrab, $numTrab
			$idTrabalhoStrCanon = $this->san_id_trabalho_tostr($areaTrab,$numTrab,False);
			return $idTrabalhoStrCanon;
		}

	/**
	 * Validadores de form
	 * Validadores retornam '' se a entrada for validada com sucesso
	 * e uma mensagem de erro caso contrário
	 */
	
	function valida_avaliador($idAvaliadorUnsafe)
		{
			#Por enquanto, só verifica se a $id do avaliador está no formato
			#certo e se existe no banco de dados
			$idAvaliador = $this->san_id_avaliador($idAvaliadorUnsafe);
			if($idAvaliador != False && $this->avaliador_existe($idAvaliador)){
				return('');
			}
			return("Código de avaliador inválido");
		}


	function valida_id_trabalho($idAvaliadorUnsafe, $idTrabalhoStrUnsafe, $tipoTrabalho = NULL, $estrito=True)
		{	
			#Verifica se o trabalho está no banco de dados e, se $estrito, disponível para o 
			# avaliador
			$idAvaliador = $this->san_id_avaliador($idAvaliadorUnsafe);
			$erroValidaAv = $this->valida_avaliador($idAvaliador);
			if($erroValidaAv != "") { return $erroValidaAv; }

			list($areaTrab, $numTrab) = $this->san_id_trabalho($idTrabalhoStrUnsafe);

			if($areaTrab === False || $numTrab === False) { return "Código do trabalho inválido"; }

			$qry = "SELECT id_av FROM ".$this->tabela_avaliacoes.
				   " WHERE av_area = '".$areaTrab."'".
				   "  AND  av_numtrab = ".$numTrab;
				   
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
				#procura também em articles, pra ver se pelo menos o artigo existe lá
				$sucesso = $this->san_id_trabalho_tostr($areaTrab, $numTrab, True) !== false;
			}

			if($sucesso){ 
				return ""; 
			}
			else{ 
				return "Trabalho não existe no sistema".($estrito ? " ou indisponível ao avaliador." : ".");
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
				return "Responda SIM ou NÃO";
			}
		}

	/**
	 * Criadores de formulário
	 */

	function form_insere_validador(&$cp, $resultado_validador)
		#Insere a saída de um validador num array de campos (&$cp) de maneira
		# a deixar form->saved == 0 em caso de valores inválidos e 
		# mostrar a saída de erro do validador no formulário
		{
			global $acao;
			echo '---->'.$acao;
			if(strlen($acao) > 0)
				{
					#Mostra mensagem de erro apenas se houver uma 
					# ação
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
	 * Geração de campos do form *
	 */

	/* Campo para identificação do avaliador */
	function cp_id_avaliador()
		{
			#Entrada de dados 
			global $dd;
			$idAvaliadorUnsafe = $dd[1];
			$cp = array();
			array_push($cp,array('$H8','','',False,True));
			array_push($cp,array('$S10','', 'ID Avaliador', True, True)); #av_parecerista_cod

			$this->form_insere_validador($cp, $this->valida_avaliador($idAvaliadorUnsafe));
			array_push($cp,array('$B8','','Entrar (eAs8CSk2!j4!xv723891)',False,True));
			return $cp;
		}

	/* Campo para identificação do trabalho */
	function cp_id_trabalho()
		{
			global $dd,$acao;

			$argsPagina = $this->get_args_pagina();

			$idTrabalhoStrUnsafe = $dd[1];
			$idAvaliadorUnsafe = $argsPagina["idAvaliador"];

			$cp = array();
			array_push($cp,array('$H8','','',False,True));
			array_push($cp,array('$S10','','Código do trabalho',True,True));
			
			$this->form_insere_validador($cp, $this->valida_id_trabalho($idAvaliadorUnsafe, $idTrabalhoStrUnsafe, NULL, False));
						
			array_push($cp,array('$B8','','Continuar',False,True));
			return($cp);
		}

	/**
	 * Cria os campos de avaliação do trabalho e adiciona em &$cp
 	 *  Método helper para cp_oral e cp_poster 
	 * @param  [type] $cp
	 * @param  [type] $tipoTrabalho
	 */
	function cria_campos_ficha_avaliacao(&$cp, $tipoTrabalho)
		{
			foreach($this->camposAv[$tipoTrabalho] as $chv){
				list($tipo, $nomeExtenso, $reqPreenchimento, $gravarNaTabela, $validadorLocalAdicional) = $this->camposAvForm[$chv];
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
				die("Tipo de avaliação inválido");
			}
			
			$args = $this->get_args_pagina();
			list($idAvaliador, $idTrabalhoStr) = array($args["idAvaliador"], $args["idTrabalhoStr"]);
			
			global $dd;
			$idAvaliacao = $this->get_id_avaliacao($idAvaliador, $idTrabalhoStr, $tipoAvaliacao);

			$dd[0] = $idAvaliacao;

			$cp = array();
			array_push($cp,array('$H8','id_av','',False,True)); 
			$this->cria_campos_ficha_avaliacao($cp, $tipoAvaliacao);
			array_push($cp,array('$B8','','Confirmar avaliação',False,False));

			return($cp);
		}
}
?>
