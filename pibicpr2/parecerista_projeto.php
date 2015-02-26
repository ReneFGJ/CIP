<? ob_start(); ?>
<?
global $nocab;
require('db.php');
require($include.'sisdoc_cookie.php');
require($include.'sisdoc_email.php');	

$chk = substr(md5($dd[0].$secu),0,8);
$rd_journal = $vars['journal_id'];
if (strlen($rd_journal) > 0)
	{
		setcookie('journal_id',strzero($rd_journal,7));
		setcookie('journal_title',$dd[1]);
		$journal_id = $rd_journal;
		$journal_title = $dd[1];
	} else {
		$journal_id = read_cookie("journal_id");
		$journal_title = read_cookie("journal_title");
	}
$jid = intval($journal_id);
?>
<head>
<title>PUCPR - PIBIC 2009</title>
<link rel="STYLESHEET" type="text/css" href="letras.css">
</head>

<body bgcolor="#FFFFFF">
<TABLE width="<?=$tab_max;?>" align="center">
<TR>
<TD><img src="http://www2.pucpr.br/nep/img/logo_puc.jpg" border="0"></TD>
<TD><img src="http://www2.pucpr.br/reol/public/20/images/homeHeaderLogoImage.jpg"></TD>
</TR>
</TABLE>

<TABLE width="<?=$tab_max;?>" align="center">
<TR>
<TD>
<BR>Titulo:Submissão on-line: Journal PIBIC2009<BR>Controle:0000063<BR>
<BR>
<BR>
<BR>Prezado Parecerista<BR>
<BR>
     Informamos que seu existe um projeto para sua apreciação, caso não possa aceitar essa avaliação recuse o aceite deste o mais breve possível.
<BR>
    Coordenação do PIBIC / PIBIC Jr<CENTER>
<FONT CLASS="lt4">Resumo do projeto</FONT>
</CENTER>
<TABLE width="704" align="center" class="lt2" border=0>
<TR>
<TD colspan="2" align="center">
<font class="lt5">Tributação e Direitos Fundamentais</font>
</TD>
</TR>
<TR>
<TD colspan="2" align="right">
<font class="lt0">Prof. responsável&nbsp;</font>
<font class="lt2">Dr.&nbsp;MARLENE KEMPFER BASSOLI</font>
</TD>
</TR>
<TR>
<TD colspan="2" align="right">
<font class="lt0">
<font class="lt1">&nbsp;mkempferb@gmail.com</font>
</TD>
</TR>
<TR>
<TD colspan="2" align="right">
<font class="lt0">
<A HREF="http://buscatextual.cnpq.br/buscatextual/visualizacv.jsp?id=K4164569P4" target="_new">
<font class="lt1">http://buscatextual.cnpq.br/buscatextual/visualizacv.jsp?id=K4164569P4</A>
</font>
</TD>
</TR>
<TR>
<TD colspan="2" align="right">
<font class="lt1">Direito</font>
</TD>
</TR>
<TR>
<Th colspan="2" align="center" bgcolor="#E0E0E0">
<font class="lt2">Projeto de pesquisa do professor orientador</font>
</TD>
</TR>
<TR onMouseOv
 er=this.style.backgroundColor='#e4f7fa' onMouseOut=this.style.backgroundColor=''>
<TD colspan="1" align="right">
<font class="lt0">Título do projeto                                                               </font>
</TD>
<TD colspan="1" align="left">
<font class="lt1">
<B>Tributação e Direitos Fundamentais</B>
</font>
</TD>
</TR>
<TR  bgcolor="#F0F0F0" onMouseOver=this.style.backgroundColor='#e4f7fa' onMouseOut=this.style.backgroundColor=''>
<TD colspan="1" align="right">
<font class="lt0">Declaraçao:                                                                     </font>
</TD>
<TD colspan="1" align="left">
<font class="lt1">
<B>1</B>
</font>
</TD>
</TR>
<TR onMouseOver=this.style.backgroundColor='#e4f7fa' onMouseOut=this.style.backgroundColor=''>
<TD colspan="1" align="right">
<font class="lt0">Projeto aprovado Externamente:                                                  </font>
</TD>
<TD colspan="1" align="left">
<font class="lt1">
<B>Não</B>
</font>
</TD>
</TR>
<TR  bgcolor="#F0F0F0" onMouse
 Over=this.style.backgroundColor='#e4f7fa' onMouseOut=this.style.backgroundColor=''>
<TD colspan="1" align="right">
<font class="lt0">Projeto aprovado CEP                                                            </font>
</TD>
<TD colspan="1" align="left">
<font class="lt1">
<B>não se aplica</B>
</font>
</TD>
</TR>
<TR onMouseOver=this.style.backgroundColor='#e4f7fa' onMouseOut=this.style.backgroundColor=''>
<TD colspan="1" align="right">
<font class="lt0">Projeto aprovado CEUA                                                           </font>
</TD>
<TD colspan="1" align="left">
<font class="lt1">
<B>não se aplica</B>
</font>
</TD>
</TR>
<TR  bgcolor="#F0F0F0" onMouseOver=this.style.backgroundColor='#e4f7fa' onMouseOut=this.style.backgroundColor=''>
<TD colspan="1" align="right">
<font class="lt0">Área de conhecimento                                                            </font>
</TD>
<TD colspan="1" align="left">
<font class="lt1">
<B>6.01.00.00-1 Direito</B>
</font>
</TD>
</TR>
<TR onMouseOver=this
 .style.backgroundColor='#e4f7fa' onMouseOut=this.style.backgroundColor=''>
<TD colspan="1" align="right">
<font class="lt0">Área de Conhecimento (sub-área)                                                 </font>
</TD>
<TD colspan="1" align="left">
<font class="lt1">
<B>6.01.02.01-2 Direito Tributário</B>
</font>
</TD>
</TR>
<TR>
<TD colspan="4" bgcolor="#00ffff">
<TR class="lt0">
<TD align="right">Projeto em PDF                                    <TD colspan="1">
<A HREF="http://www2.pucpr.br/reol/pibic/download.php?dd0=62&dd1=00004&dd2=e838dd6f7df3aa2dc5da44eb1bf25ab5" target="new_pibic">
<font class="lt2">
<font color="blue">Projeto de Pesquisa - Orientador- 2009-10.pdf&nbsp;(pdf)</A>
</TD>
</TR>
</TABLE>

<TABLE align="center" width="<?=$tab_max;?>" class="lt1" >
<TR class="lt3"><TD colspan="5"><B>Conteúdo do projeto do orientador e relevância para a formação do aluno.</TD></TR>
<TR>
	<TD width="25%"><input type="radio" name="dd10" value="20"> Excelente</TD>
	<TD width="25%"><input type="radio" name="dd10" value="15"> Bom</TD>
	<TD width="25%"><input type="radio" name="dd10" value="5"> Regular</TD>
	<TD width="25%"><input type="radio" name="dd10" value="0"> Ruim</TD>
</TR>
<TR><TD>&nbsp;</TD></TR>
<TR class="lt3"><TD colspan="5"><B>Coerência do projeto do orientador de acordo com os itens: Introdução, Objetivo, Método e Referências Bibliográficas.</TD></TR>
<TR>
	<TD width="25%"><input type="radio" name="dd11" value="20"> Excelente</TD>
	<TD width="25%"><input type="radio" name="dd11" value="15"> Bom</TD>
	<TD width="25%"><input type="radio" name="dd11" value="5"> Regular</TD>
	<TD width="25%"><input type="radio" name="dd11" value="0"> Ruim</TD>
</TR>

<TR><TD>&nbsp;</TD></TR>
<TR class="lt3"><TD colspan="5"><B>Coerência e adequação entre a capacitação e a experiência do professor orientador proponente e a realização do projeto, considerando as informações curriculares apresentadas.</TD></TR>
<TR>
	<TD width="25%"><input type="radio" name="dd12" value="20"> Excelente</TD>
	<TD width="25%"><input type="radio" name="dd12" value="15"> Bom</TD>
	<TD width="25%"><input type="radio" name="dd12" value="5"> Regular</TD>
	<TD width="25%"><input type="radio" name="dd12" value="0"> Ruim</TD>
</TR>

<TR><TD>&nbsp;</TD></TR>
<TR class="lt3"><TD colspan="5"><B>Coerência entre o projeto do orientador e o plano de trabalho do aluno, considerando a contribuição para a formação do discente.</TD></TR>
<TR>
	<TD width="25%"><input type="radio" name="dd13" value="20"> Excelente</TD>
	<TD width="25%"><input type="radio" name="dd13" value="15"> Bom</TD>
	<TD width="25%"><input type="radio" name="dd13" value="5"> Regular</TD>
	<TD width="25%"><input type="radio" name="dd13" value="0"> Ruim</TD>
</TR>

<TR><TD>&nbsp;</TD></TR>
<TR class="lt3"><TD colspan="5"><B>Adequação do cronograma para a execução da proposta..</TD></TR>
<TR>
	<TD width="25%"><input type="radio" name="dd14" value="10"> Adequado</TD>
	<TD width="25%"><input type="radio" name="dd14" value="0"> Inadequado</TD>
</TR>

<TR><TD>&nbsp;</TD></TR>
<TR><TD colspan="4">Justificativa do paracer:</TD></TR>
<TR><TD colspan="4"><textarea cols="80" rows="5" name="dd20"><?=$dd[20];?></textarea></TD></TR>

<TR><TD>&nbsp;</TD></TR>
<TR><TD colspan="4">Sugestões para melhoria do Projeto:</TD></TR>
<TR><TD colspan="4"><textarea cols="80" rows="5" name="dd20"><?=$dd[20];?></textarea></TD></TR>
</TABLE>

