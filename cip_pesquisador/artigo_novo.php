<?
$xcab = 1;
$breadcrumbs=array();
array_push($breadcrumbs, array('main.php','principal'));
array_push($breadcrumbs, array('captacao.php','Captação'));

require("cab_cip.php");
require($include.'sisdoc_windows.php');
require($include.'sisdoc_debug.php');
require($include.'sisdoc_form2.php');
require($include.'cp2_gravar.php');

require($include.'sisdoc_email.php');

require("../_class/_class_position.php");
$pos = new posicao;
require("../_class/_class_artigo.php");
$cap = new artigo;
//$cap->structure();

require("../_class/_class_bonificacao.php");
$bon = new bonificacao;
$bon->tabela = 'artigo_bonificacao';

/* Página */
$pag = $_GET["pag"];
if (strlen($pag) ==0 ) { $pag = $_SESSION['pag_cap']; }
if (strlen($pag)==0)
        { $pag = 1; }
$_SESSION['pag_cap'] = $pag;
$page = $pag;

echo '<h3>Cadastro de artigos para bonificação</h3>';
?>
<ul>
  <li class="topitem"><A HREF="http://www2.pucpr.br/reol/ged_download.php?dd0=22&dd50=cip_docs&dd90=b6e953145b&dd91=reol">Manual de orientação e submissão de artigos</A></li>
</ul>
<?
if (strlen($dd[0]) > 0) { $cap->le($dd[0]); }
echo $pos->show($pag,4);
$status = $cap->status;

if (($cap->status <> 0) and ($cap->status <> 8))
        {
                echo '<fieldset><legend>Cadastro de artigo publicado</legend>';
                echo '<H3><font color="red">Artigo não está mais em edição</font></h3>';
                echo '</fieldset>';
                exit;           
        }
/* Informacoes sobre a edicao */
$tabela = $cap->tabela;

if ($pag == 1) { $cp = $cap->cp_01(); }
if ($pag == 2) { $cp = $cap->cp_02(); }
if ($pag == 3) { $cp = $cap->cp_03(); $dd[4] = ''; }
if ($pag == 4) { $cp = $cap->cp_04(); $dd[4] = ''; }
if ($pag == 5) 
        {
                require_once("_ged_artigo_ged_documento.php");
                //$ged->structure();
                                
                $ged->protocol = $cap->protocolo;
                $ged->file_status('@','A');
                $arqs = $ged->file_list();
                                
                $cap->le($dd[0]);
                echo '001-Inserir historico - '.$cap->protocolo;
                $bon->historico_inserir($cap->protocolo,'cad','cadastro de novo artigo');
                // Alterar Status
                echo '<BR>002-Alterar status';
                $cap->alterar_status(10);

                echo '<BR>003-Envio de e-mail';
                $cap->enviar_email_coordenador();
                echo '<BR>FIM';
                exit; 
        }
        
/* Página 04 */
if ($pag == 4)
        {
                require_once("_ged_artigo_ged_documento.php");
                //$ged->structure();
                                
                $ged->protocol = $cap->protocolo;
                $arqs = $ged->file_list();
                
                /* */
                $total_arquivos = $ged->total_files;
                
                if ($total_arquivos > 0) { $dd[4] = '1'; }
                else
                                {
                                        array_push($cp,array('$M','','<font color="red">Não foram localizados os arquivos comprobatórios</font>',False,True));
                                }               
                
                echo '<fieldset><legend><h3>'.msg('artigo').'</h3></legend>';
                echo '<P>';
                echo msg('artigo_info');
                echo '</P>';
        }

/* Pagina 03 */
if ($pag == 3) 
        {
                require_once("_ged_artigo_ged_documento.php");
                //$ged->structure();
                $ddf = $_GET['ddf'];
                $ddg = $_GET['ddg'];
                $ddh = $_GET['ddh'];
                $ddi = checkpost($ddf.$secu);
                /* Excluir Arquiv */
                if (($ddg=='DEL') and ($ddi==$ddh))
                        {
                                $ged->id_doc = $ddf;
                                $ged->file_delete();
                        }
                
                echo mst('inst_artigos');
                
                $ged->protocol = $cap->protocolo;
                $arqs = $ged->file_list();
                
                /* */
                $total_arquivos = $ged->total_files;
                $cap->le($dd[0]);
                //echo $cap->mostra();
                /* */
                if ($total_arquivos == 0)
                        {
                                echo '<H2>Nenhum arquivo postado</h2>';
                                $dd[4] = '';
                        } else {
                                echo '<H2>Arquivo(s) postado(s)</h2>';
                                echo $arqs;
                                $dd[4] = '1';
                        }
                //if ($perfil->valid('#SCR#ADM#COO'))
                {
                        echo $ged->upload_botton_with_type($cap->protocolo,'','');
                }               
        }
if (($pag==1) or ($pag==2) or ($pag==3) or ($pag==4))
        {
        echo '<Table width="100%" class="tabela00">';
        echo '<TR><TD>';
        editar();
        echo '</table>';
        }

if ($saved > 0)
        {
                $user = $ss->user_cracha;
                if (strlen($dd[0])==0)
                        {
                                $sql = "select max(id_ar) as id_ar from artigo where ar_professor = '".$user."' ";
                                echo $sql;
                                $rlt = db_query($sql);
                                $line = db_read($rlt);
                                $dd[0] = $line['id_ar'];
                        }
                $cap->updatex();
                $pag++;
                $_SESSION['pag_cap'] = $pag;
                redirecina(page().'?dd0='.$dd[0].'&dd90='.checkpost($dd[0]));
        }
require("../foot.php"); 
?>
