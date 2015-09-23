<div id="trabalho">
	<table width="100%" border=0>
		<tr valign="top">
			<td colspan=2>SILVA, A. O.; GARCIA, D.; CINTHO, L. M. M.; BARRA, C. M. C. M. Registro eletr�nico em sa�de para acompanhamento de pacientes com fibrila��o atrial - versao II. In: SEMIC, Semin�rio de Inicia��o Cient�fica, 23, 2015, Curitiba-PR. Anais do 23� Semin�rio de Inicia��o Cient�fica. Curitiba: PUCPR, 2015. p. EBIO3T.</td>
			<td width="100" align="right" rowspan=2>
				Oral/P�ster				<br>
				<img src="<?php echo base_url('img/semic/icone-oral-post-grad.png');?>" title="Oral/P�ster">
			</td>
		</tr>
		<tr>
			<td colspan=2 class="lt3"><font class="lt6">EBIO3T</font>
				<br><b>Engenharia Biom�dica</b></td>
		</tr>
		<tr>
			<td align="center"><font class="lt5"><b>Registro eletr�nico em sa�de para acompanhamento de pacientes com fibrila��o atrial - versao II</b></font>
			<BR>
			<font class="lt4"><i>Electronic health record for monitoring patient with atrial fibrillation</i></font>
			<BR>
			</td>
		</tr>
	</table>
	<br>
	<div style="text-align:right;">
		SILVA, Alex de Oliveira<sup>1</sup>; GARCIA, Diego<sup>2</sup>; CINTHO, Lilian Mie Mukai<sup>3</sup>; BARRA, Claudia Maria Cabral Moro<sup>4</sup>		<BR>
		PIBIC		- Bolsa CNPq-PIBITI		<BR>
		<I>--</I>
	</div>
	<BR>
	<table width="100%">
		<tr valign="top">
			<td width="44%"> Resumo
			<div style="text-align:justify;">
				<P>
					<B>Introdu��o</B>: A demanda de bancos de dados na �rea de sa�de faz com que seja necess�rio pensar em um padr�o de coleta de dados espec�ficos e relevantes para o acompanhamento de determinadas doen�as. Existem diferentes maneiras de modelar os dados dentro dos padr�es dispon�veis para a �rea de sa�de, sendo necess�rio definir um �nico padr�o para que se possa ter a interoperabilidade entre sistemas. Dentre os padr�es existentes, uma boa forma de representa��o � a de arqu�tipos. 1) Arqu�tipo � uma especifica��o �interoper�vel�, formal e de consenso para representar uma entidade 2) A Fibrila��o Atrial (FA) � uma arritmia supraventricular em que ocorre uma completa desorganiza��o na atividade el�trica atrial, fazendo com que os �trios percam sua capacidade de contra��o, n�o gerando s�stole atrial.					<B>Objetivo</B>: Integrar diretrizes cl�nicas de fibrila��o atrial ao um registro eletr�nico de sa�de (RES) baseado na arquitetura de arqu�tipos.					<B>Metodologia</B>: Para iniciar o desenvolvimento do projeto foi necess�rio entender todo o contexto do assunto proposto que n�o � somente o desenvolvimento do software mas tamb�m os assuntos relacionados � �rea de sa�de. Ap�s a leitura de v�rios textos relacionados � representa��o de dados em forma de Arqu�tipos e a rela��o da FA com AVC foi poss�vel ter contato com os softwares de edi��o de arqu�tipo. Nesse momento foi identificado que os principais s�o �OpenEHR Archetype Editor� e o �LinkEHR�. Ap�s uma s�rie de experimenta��es e ambienta��es foi adotado o �OpenEHR Archetype Editor�, por apresentar-se mais amig�vel.  O pr�ximo passo foi compreender o projeto MobiGuide, que tem como objetivo o desenvolvimento de um sistema de apoio a decis�o para pacientes com doen�as cr�nicas. Sabendo quais informa��es eram necess�rias, seguiu-se para a etapa de defini��o dos arqu�tipos, onde foram modelados 12 no software OpenEHR. Com os arqu�tipos necess�rios para o desenvolvimento do RES foi definido uma linguagem de programa��o e um banco de dados para armazenamento das informa��es, para isso foi escolhida a linguagem Java por ser de uso livre e de alto n�vel, e o banco de dados Mysql que tamb�m � de uso livre e eficiente.					<B>Resultados</B>: O principal resultado deste trabalho � o RES baseado na arquitetura de arqu�tipos, capaz de gerar dinamicamente a interface gr�fica para coleta dos dados dos pacientes. Outro resultado � em rela��o defini��o dos arqu�tipos necess�rios para o desenvolvimento de o RES com a integra��o das diretrizes cl�nicas de FA, possibilitando o acompanhamento de pacientes.					<B>Conclus�es</B>: Foi desenvolvido o RES para Acompanhamento de Pacientes com Fibrila��o Atrial. Como o sistema proposto permite a gera��o de interfaces de para qualquer diretriz cl�nica modelada na forma de arqu�tipos, poder� ser utilizado para o desenvolvimento de sistemas de apoio a decis�o baseados em diretrizes cl�nicas de diversas �reas m�dicas.				</P>
			</div><B>Palavras-chave</B>: Arqu�tipos. Fibrila��o Atrial. Interoperabilidade. Registros eletr�nicos em sa�de.			<BR>
			<BR>
			</td><td width="2%">&nbsp;</td><td width="44%"> Abstract
			<div style="text-align:justify;">
				<P>
					<B>Introduction</B>: There are different forms to represent health data applying standards, so it is necessary to define one to make possible interoperability between systems.  Among the existing, archetypes are a good form of representation. 1) Archetype is a formal specification "interoperable" and consensus to represent an entity. 2) Atrial fibrillation (AF) is a supraventricular arrhythmia in which a complete disruption occurs in atrial electrical activity, leading the atria to lose its ability to contract, generating any atrial systole.					<B>Objectives</B>: Integrate clinical practice guidelines of atrial fibrillation to an electronic health record (HER) base in archetype architecture.					<B>Methods</B>: To start the project development was necessary to understand the whole context of the proposed issue that is not only software development but also issues related to health. After reading various texts relating to the representation of data in the form of archetypes and the relationship of FA stroke it was possible to have contact with the archetype editing software. At that moment it was identified that the main ones are "openEHR Archetype Editor" and "LinkEHR". After a series of trials and settings it adopted the "openEHR Archetype Editor" because be more friendly. The next step was to understand the MobiGuide project, which aims to develop a system of decision support for patients with chronic diseases. Knowing which were information was required, followed for the archetypes definition stage, where 12 were modeled on openEHR software. With the archetypes necessary for the development of RES was defined a programming language and a database for storing information, for this was chosen the Java language to be free, high-level, and the MySQL database that is also free and efficient.					<B>Results</B>: The main result is the RES based on archetypes of architecture, with graphic interface, capable of generating dynamically processing screen archetypes. Another result is the definition of archetypes necessary for the development of an electronic health record with the integration of clinical guidelines of AF, enabling the monitoring of patients and future projects in the application of rules for aid to support the decision.					<B>Conclusion</B>: It was developed the RES for Monitoring Patients with Atrial Fibrillation. The proposed system allows the generation of interfaces clinical guideline for any archetypes modelled may be used to develop decision support systems based on clinical guidelines of various medical fields.				</P>
			</div><B>Keywords</B>: Archetypes. Atrial Fibrillation. Interoperability. Electronic Health Record.</td>
		</tr>
	</table>
	<BR>
	<BR>
	<sup>1</sup> Estudante. PUCPR<br><sup>4</sup> Orientador. PUCPR	<BR>
	<BR>
	<BR>
	<BR>
</div>
<BR>
<BR>
<BR>
</div> 