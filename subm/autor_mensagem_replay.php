<?php
require("cab.php");
require($include.'sisdoc_email.php');
require($include.'sisdoc_windows.php');
require($include.'sisdoc_colunas.php');

$clx->protocolo = $dd[0];

$clx->le_submit($dd[0]);

$admin_name = $clx->admin_email_nome;
$admin_email = $clx->admin_email;
$email_adm = $clx->admin_email;
$admin_nome = $clx->admin_email_nome;

echo $clx->mostra();
echo '<HR>';
echo $clx->mostra_arquivos_autor();
$protocolo = $clx->line['doc_protocolo'];
$jid = $clx->line['doc_journal_id'];
require("subm_arquivo_2.php");
require("subm_arquivo.php");

echo '<h2>'.msg('messages').'</h2>';
echo $clx->relacionamento_lista();
echo $clx->relacionamento_form();

require("foot.php");
?>
