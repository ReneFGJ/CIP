<?
require("submissao_cab.php");
require($include.'sisdoc_windows.php');
require($include.'sisdoc_email.php');
/* Checa Link */
$chk = checkpost($dd[0]);
if (($dd[99] != $chk) or (strlen($dd[99]) < 8))
	{
	echo '<H2>Erro de link</H2>';
	exit;
	}
	
$protocolo = $dd[1];


/* Projeto do Professor */
$sql = " select * ";
$sql .= " from pibic_submit_documento ";
$sql .= " inner join pibic_professor on doc_autor_principal = pp_cracha ";
$sql .= " left join apoio_titulacao on pp_titulacao = ap_tit_codigo ";
$sql .= " where doc_protocolo = '".$protocolo."' ";
$sql .= " and (doc_status <> 'X' and doc_status <> '@') ";
$rlt = db_query($sql);

$sx = '';
while ($line = db_read($rlt))
	{ require("submissao_mst_projeto.php"); }
echo $sx;

$sx = '';

/* Plano do Aluno */
$protocolo = $dd[0];
$sql = " select * ";
$sql .= " from pibic_submit_documento ";
$sql .= " inner join pibic_professor on doc_autor_principal = pp_cracha ";
$sql .= " left join apoio_titulacao on pp_titulacao = ap_tit_codigo ";
$sql .= " where doc_protocolo = '".$protocolo."' ";
$sql .= " and (doc_status <> 'X' and doc_status <> '@') ";
$rlt = db_query($sql);

$sx = '';
while ($line = db_read($rlt))
	{ require("submissao_mst_plano.php"); }
echo $sx;

/* Ação */
require("submissao_indicar_aluno_acao.php");

/* Rodapé */
require("foot.php");
?>