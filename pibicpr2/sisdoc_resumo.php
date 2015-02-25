<?
function resumo_normalizacao($_titulo,$_autores,$_resumo,$_keys,$_para,$rarea)
	{
	global $protocolo, $pb_ordem;
	$journal = '0000050';
	$jid = $journal;
	
	$_para = ' '.uppercase($_para);
	//////////////////////////////////////// Identidica o tipo de saida
	$saida_tipo = "XML";
	if (strpos($_para,'ARRAY') > 0) {$titulo_tipo = "ARRAY"; }

	//////////////////////////////////////// Identidica o tipo do título
	$titulo_tipo = "1";
	if (strpos($_para,'T2') > 0) { $titulo_tipo = "2"; }
	if (strpos($_para,'T2') > 0) { $titulo_tipo = "3"; }
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////// Busca extensões
	$_ext = $_SERVER['SCRIPT_FILENAME'];
	$_size = strlen($_ext);

	for ($r = 0;$r < $_size; $r++)
		{
		$_chr = substr($_ext,($_size - $r),1);
		if ($_chr == chr(47)) { $_ext = substr($_ext,0,($_size - $r)+1); $r = $_size; }
		}
	$_lib = $_ext.'sisdoc_resumo_extensao.php';
	$lib_resumo = false;
	if (file_exists($_lib)) { require("sisdoc_resumo_extensao.php"); }

	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////// Processa Bibliotecas
	if ($lib_resumo == true) { $_autores = resumo_ext_autor($_autores); }
	if ($lib_resumo == true) { $_resumo = resumo_ext_resumo($_resumo); }

	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////// Processa dados do título
	$_titulo = uppercase($_titulo);
	if (strpos($_titulo,':') > 0)
		{
		$_pos = strpos($_titulo,':'); // posição do dois pontos
		$_titulo = trim(substr($_titulo,0,$_pos)).': '.trim(lowercase(substr($_titulo,$_pos+1,strlen($_titulo))));
		}
		
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////// Processa Bibliotecas
	$_autor = array();
	$_aut = ' '.$_autores.chr(13);
	while (strpos($_aut,chr(13)) > 0)
		{
		$_pos = strpos($_aut,chr(13));
		$_n = trim(substr($_aut,0,$_pos));
		$_aut = ' '.substr($_aut,$_pos+1,strlen($_aut));
		if (strlen($_n) > 0)
			{ 
			$_n1 = '';
			$_n2 = '';
			if (strpos($_n,';') > 0)  { $_n1 = ' '.substr($_n,strpos($_n,';')+1,strlen($_n)); }
			if (strpos($_n1,';') > 0) { $_n2 = substr($_n1,strpos($_n1,';')+1,strlen($_n1)); }
			if (strpos($_n1,';') > 0) { $_n1 = substr($_n1,0,strpos($_n1,';')); }
			if (strpos($_n,';') > 0)  { $_n = ' '.substr($_n,0,strpos($_n,';')); }
			$_n = nbr_autor($_n,7);
			if ($lib_resumo == true) { $_n = resumo_ext_autor_2($_n); }
			array_push($_autor,array($_n,$_n1,$_n2,'','','','','')); 
			}
		}
		
	$autor = '';
	for ($r = 0; $r < count($_autor);$r++)
		{
		$autor .= trim($_autor[$r][0].';'.trim($_autor[$r][1]).';'.trim($_autor[$r][2])).chr(13);
		}


	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	if ($lib_resumo == true) 
		{ 
		$_curso = $_autor[count($_autor)-1][0]; 
		$_curso = trim(substr($_curso,0,strpos($_curso,' -')));
		if (strlen($_curso) == 0)
			{
			$_curso = $rarea;
			}
		$_curso = troca($_curso,'(Noturno)','');
		$_curso = troca($_curso,'(Manhã)','');
		$_curso = trim($_curso);
		$sql = "select * from sections where title = '".$_curso."' ";
		$rlt = db_query($sql);
		
		if (!($line = db_read($rlt)))
			{
			echo msg_erro('Curso não cadastrado nas áreas de seções ['.$_curso.']');
			exit;
			}
		$session = $line['section_id'];
		}
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	echo '<HR>';
	echo $_titulo;
	echo '<HR>';
	echo mst($autor);
	echo '<HR>';
	echo $_resumo;
	echo '<HR>';
	echo $_keys;
	echo '<HR>';
	$_rst = array($_titulo,$_autores,$_resumo,$_keys);
	
	//////////////////////////////////////////////////////// verifica se já não foi exportado
	$resumo3 = 'PIBICjr'.$protocolo;
	$xsql = "select * from articles where article_3_abstract = '".$resumo3."' ";
	$xrlt = db_query($xsql);
	$ok = 1;	
	if ($line = db_read($xrlt))
		{
		echo msg_erro('Resumo já exportado ID='.$line['id_doc']);
		exit;
		}
	/////////////////////////////////////////// ISSUE
	$sql = "select * from issue where journal_id = ".$journal." order by issue_year , issue_volume , issue_number  limit 1";
	$irlt = db_query($sql);
	$msg = "Para transferir essa submissão para o processo de editoração a necessário a existência de uma edição cujo ano seja 0 (zero). Click <A href=edicoes.php >aqui</A> para criar esta edição. ";
	if ($iline = db_read($irlt))
		{
			$issue = $iline['id_issue'];
			if ($iline['issue_year'] != 0)
				{
				echo msg_erro($msg.' [1] '.$iline['issue_year']);
				exit;
				}
		} else {
				echo msg_erro($msg.' [1]');
				exit;
		}

/** ISSUE */

$sql = "select * from issue where journal_id = ".$jid." order by issue_year , issue_volume , issue_number  limit 1";
$irlt = db_query($sql);
$msg = "Para transferir essa submissão para o processo de editoração a necessário a existência de uma edição cujo ano seja 0 (zero). Click <A href=edicoes.php >aqui</A> para criar esta edição. ";
if ($iline = db_read($irlt))
	{
		$issue = $iline['id_issue'];
		if ($iline['issue_year'] != 0)
			{
			echo msg_erro($msg.' [1] '.$iline['issue_year']);
			exit;
			}
	} else {
			echo msg_erro($msg.' [1]');
			exit;
	}
 

/////////////////////////////////////////// AUTOR
$tabela = "articles";

$fsql = "select * from ".$tabela." ";
//$fsql .= " where article_title = '".$manuscrito_titulo."' ";
$fsql .= " order by id_article desc ";
$fsql .= " limit 1 ";
//$fsql .= " and doc_journal_id = '"
$rlt = db_query($fsql);
$line = db_read($rlt);

/* Busca Seção de publicação */
$ra = troca($rarea,chr(13),'');
$ra = troca($ra,chr(10),'');

if (strpos($ra,'- ') > 0) { $ra = trim(substr($ra,0,strpos($ra,'- '))); }
if (strpos($ra,'(') > 0) { $ra = trim(substr($ra,0,strpos($ra,'('))); }
if (strpos($ra,':') > 0) { $ra = trim(substr($ra,0,strpos($ra,':'))); }
$ra = troca($ra,'Bacharelado em ','');
$ra = troca($ra,'Licenciatura em ','');
$ra = troca($ra,'Planejamento e Gerenciamento Estratégico','Ciências Contábeis');
$ra = troca($ra,'Fundamentos da Ética','Filosofia');




$sql = "select * from sections ";
$sql .= " where journal_id = '".round($jid)."' ";
$sql .= " and title like '%".$ra."%' ";
$sql .= " order by 	section_id desc limit 1 ";
$xrlt = db_query($sql);

$ok = 1;
if (!($xline = db_read($xrlt)))
	{
		echo msg_erro('Sessão não localizada ['.($ra).']');
		$ok = 0;
	} else {
		$sessao = $xline['section_id'];
	}

if ($ok == 1)
{
	$sqli = "insert into  ".$tabela." (";
	$sqli .= 'article_title, article_abstract, article_keywords, article_idioma, ';
	$sqli .= 'article_2_title, article_2_abstract, article_2_keywords, article_2_idioma, ';
	$sqli .= 'article_3_title, article_3_abstract, article_3_keywords, article_3_idioma, ';
	
	$sqli .= 'article_dt_envio, article_dt_aceite, article_pages, ';
	$sqli .= 'article_publicado, article_author, article_issue, ';
	$sqli .= 'article_seq, article_section, journal_id, ';
	$sqli .= 'article_dt_revisao, article_cod ';
	$sqli .= ') values (';

	$sqli .= "'".$_titulo."','".$_resumo."','".troca($_keys,';','.')."','pt_BR',";
	$sqli .= "'','','','',";
	$sqli .= "'','".$resumo3."','','',";
	
	$sqli .= "'".date("Ymd")."','".date("Ymd")."','',";
	$sqli .= "'S','".$autor."','".$issue."',";
	$sqli .= "1,'".$sessao."','".$jid."',";
	
	$sqli .= "'".date("Ymd")."',''";
	$sqli .= ")";
//	echo $sqli;
	$rlti = db_query($sqli);
	$_rst = array($_titulo,$_autores,$_resumo,$_keys);
}	
else {
			echo msg_erro('Erro de OK '.$ok);
			exit;
	}
	return($_rst);
}
?>