<? 
/*
 * @author PUCPR  
 */
require('db.php');

$oai =  strpos(lowercasesql($_SERVER['PATH_INFO']),'/oai');
$google = 'UA-12712904-2';

	$mostra_issue = False;
	$charset = charset_start("ASCII");
	
	while (substr($path,strlen($path)-1,1)=='/') 
		{ 
		$path = substr($path,0,strlen($path)-1); 
		}
	$opath=$path;
	$findme  = '/';
	$pos = strpos($path, $findme);
	if ($pos > 0)
		{
		$path = substr($path,0,$pos);
		}

	if (strlen($dd[99])==0)
		{
		$ii = strpos($opath,'/');
		
		while ($ii > 0)
			{
			$ipath=substr($opath,$ii+1,100);
			if (strlen($ipath) > 0)
				{
				$opath = $ipath;
				} else {
				$opath=substr($opath,0,$ii-1);
				}
			$ii = strpos($opath,'/');
			}
		$dd[99] = strtolower($opath);
		}
if ( ($dd[98]=="tracerip") or ($dd[99]=="oai") or ($dd[99]=="pdf") or ($dd[99]=="password") or ($dd[98]=="print") or ($dd[98]=="email"))
	{
	$nocab="SIM";
	}
if (strlen($nocab) < 1)
	{
	ob_start();
	require('cab_instituicao.php');
	}
	$path = troca(strtoupper($path),"'",'');
    $query = "SELECT * FROM journals where (path='".$path."' or path = '".strtolower($path)."')";
    $result = db_query($query);
require_once($include.'sisdoc_data.php');
if ($line = db_read($result))
	{
	$cab_text = trim($line['jnl_html_cab']);
	$layout = $line['layout'];
	$titulo = $line['title'];
	$jid    = $line['journal_id'];
	$abrev  = $line['path'];
	$issne  = trim($line['jn_eissn']);
	$isbn   = trim($line['jn_isbn']);
	$issn   = trim($line['journal_issn']);
	if (strlen(trim($line['jnl_google'])) > 0)
		{ $google = trim($line['jnl_google']); }
	$bgcor  = trim($line['jn_bgcor']);
	$site   = trim($line['jn_http']);
	$jnid   = trim($line['jn_id']);
	$emailadmin = trim($line['jn_email']);
	$submissao  = trim($line['jn_send']);
	$submissao_suspensa  = trim($line['jn_send_suspense']);
	$noticia  = trim($line['jn_noticia']);
	
	//////////////////////////////////
	if (strlen($cab_text) > 0)
		{
		$cab_text = troca($cab_text,"�","'");
		$cab_text = troca($cab_text,'�','<');
		$cab_text = troca($cab_text,'�','>');
		$cab_text = troca($cab_text,'',chr(92));
		$cab_text = troca($cab_text,'�','"');
		}
	
	////////////// REGISTRA ACESSOS
	//if ($dd[99] != "admin") { require('index_count.php'); }
	if ($dd[99]=="oai")
		{
		require('oai/index.php');
		exit();
		}
		
	if ($dd[99]=="xadmin")
		{
		require('admin/admin_password.php');
		exit();
		}
		

///////////// PDF
	if ($dd[99]=="pdf")
		{ require('editora/pdf.php'); exit(); }
		

	require("index_new_layout.php");
		
///////////// ENVIAR SENHA POR E-MAIL
	if ($dd[99]=="password")
		{ require('peerreview/enviar_senha.php'); exit(); }		

///////////// PEERREVIEWED
	if ($dd[99]=="peer")
		{ require('peerreview/index.php'); exit(); }
		
///////////// GESTOR PEERREVIEWED
	if ($dd[99]=="gp")
		{ require('peerreview/gp_index.php'); exit(); }		

///////////// ADMIN
	if ($dd[99]=="admin")
		{ require('admin/index.php'); exit(); }
		
	if ($dd[99]=="adminlogin")
		{ require('admin/login.php'); exit(); }
		
if (($dd[99]!="oai") and ($oai <= 0) and (strlen($google) > 0))
{
	?>
	<body>
	<script type="text/javascript">
	var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
	document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
	</script>
	<script type="text/javascript">
	try {
	var pageTracker = _gat._getTracker("<?=$google;?>");
	pageTracker._trackPageview();
	} catch(err) {}</script>
	<?
}
///////////// PAGINAS
	if ($dd[99]=="noticia")
		{ require('layout/'.$layout.'/noticias.php'); exit(); }	

	if ($dd[99]=="comunicate")
		{ require('layout/'.$layout.'/comunicacao.php'); exit(); }	
		
	if ($dd[99]=="main")
		{ require('layout/'.$layout.'/main.php'); exit(); }	

	if ($dd[99]=="useradm")
		{ require('layout/'.$layout.'/user_adm.php'); exit(); }	

	if ($dd[99]=="user")
		{ require('layout/'.$layout.'/user.php'); exit(); }	

	if ($dd[99]=="faq")
		{ require('layout/'.$layout.'/faq.php'); exit(); }			
		
	if ($dd[99]=="search")
		{ require('layout/'.$layout.'/search.php'); exit(); }
		
	if ($dd[99]=="resumo")
		{ require('layout/'.$layout.'/resumo.php'); exit(); }

	if ($dd[99]=="view")
		{
			$file = 'layout/'.$layout.'/view.php';
			 require($file); exit(); }
		
	if ($dd[99]=="email")
		{ require('layout/'.$layout.'/view_email.php'); exit(); }
		
	if ($dd[99]=="print")
		{ require('layout/'.$layout.'/view_print.php'); exit(); }				

	if ($dd[99]=="olds")
		{ require('layout/'.$layout.'/achive.php'); exit(); }
		
	if ($dd[99]=="about")
		{ require('layout/'.$layout.'/sobre.php'); exit(); }
		
	if ($dd[99]=="editores")
		{ require('layout/'.$layout.'/editores.php'); exit(); }
		
	if ($dd[99]=="assinatura")
		{ require('layout/'.$layout.'/assinatura.php'); exit(); }
		
	if ($dd[99]=="index")
		{ require('layout/'.$layout.'/indice.php'); exit(); }
		
	if ($dd[99]=="contact")
		{ require('layout/'.$layout.'/contato.php'); exit(); }	

	if ($dd[99]=="submit")
		{ require('layout/'.$layout.'/submit.php'); exit(); }	
	if ($dd[99]=="submissao")
		{ require('layout/'.$layout.'/submit.php'); exit(); }	
	if ($dd[99]=="login")
		{ require('layout/'.$layout.'/submit.php'); exit(); }	
	if ($dd[99]=="login_old")
		{ require('layout/'.$layout.'/login.php'); exit(); }


	$xarq = 'layout/'.$layout.'/index.php';
	require($xarq);
	}
	else
	{
	echo '<CENTER><font face="Verdana,Geneva,Arial,Helvetica,sans-serif" size="3">';
	echo "<P>";
	echo '<FONT COLOR="#ff0000">';
	echo "Este caminho n�o esta mais ativo<BR>";
		{
		echo "Veja no <a href=\"/reol/catalogo.php\">Catalogo de Periodicos</a>";
		}
	header("Location: ".http."catalogo.php");		
	echo "<BR>".$path;
	echo "<BR>".substr($path,strlen($path)-3,3);
	require("foot.php");
	}
ob_end_flush();
	
?>
</body>

