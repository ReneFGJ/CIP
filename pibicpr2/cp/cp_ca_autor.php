<?
$tabela = "ca_autor";
$cp = array();
array_push($cp,array('$H4','id_aa','id_aa',False,True,''));
array_push($cp,array('$A','','Dados sobre o autor',False,True,''));
array_push($cp,array('$S100','aa_nome','Nome completo do autor',True,True,''));
array_push($cp,array('$H8','aa_nome_asc','Nome ASC',True,True,''));
array_push($cp,array('$Q ap_tit_titulo:ap_tit_titulo:select * from apoio_titulacao order by ap_tit_titulo','aa_titulacao','Titulacao',False,True,''));

array_push($cp,array('$S100','aa_nome_dsp','Nome autorizado',True,True,''));
array_push($cp,array('$S40','aa_nome_cit','Nome em citações bibliográficas',True,True,''));

array_push($cp,array('$S100','aa_email','e-mail',False,True,''));
array_push($cp,array('$S100','aa_email_1','e-mail (alt)',False,True,''));

array_push($cp,array('$S100','aa_lattes','Link para Lattes',False,True,''));
array_push($cp,array('$T60:5','aa_biografia','Biografia',True,True,''));

array_push($cp,array('$T60:5','aa_endereco','Endereço<BR>para<BR>contato',True,True,''));

array_push($cp,array('$H8','aa_codigo','aa_codigo',False,True,''));
array_push($cp,array('$O 1:SIM&2:NÃO','aa_ativo','sis_ativo',True,True,''));

array_push($cp,array('$Q ci_nome:ci_codigo:select * from ca_instituicao where ci_ativo=1 order by ci_nome','aa_afiliacao','Afiliação Institucional',True,True,''));

$dd[3] = UpperCaseSQL($dd[2]);

if (strlen($dd[0]) ==0)
	{
	$qsql = "select * from ".$tabela." where aa_nome_asc = '".UpperCaseSQL($dd[2])."' ";
	$qrlt = db_query($qsql);

	if ($qline = db_read($qrlt))
		{
		echo '<BR><BR><font class="lt3"><font color="RED"><B>';
		echo $dd[2].'</B><BR><BR>';
		echo "Nome já cadastrado no sistema";
		exit;
		}
	}
/// Gerado pelo sistem "base.php" versao 1.0.2
?>