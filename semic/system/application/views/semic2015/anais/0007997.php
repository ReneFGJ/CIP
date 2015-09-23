<div id="trabalho">
	<table width="100%" border=0>
		<tr valign="top">
			<td colspan=2>BABONI, F. B.; FRAN�A, A.; VIEGAS, E. K.; SANTIN, A. O. Sintetiza��o de hardware para algoritmos de aprendizado de m�quina usando ROCCC. In: SEMIC, Semin�rio de Inicia��o Cient�fica, 23, 2015, Curitiba-PR. Anais do 23� Semin�rio de Inicia��o Cient�fica. Curitiba: PUCPR, 2015. p. iCCOMP19T.</td>
			<td width="100" align="right" rowspan=2>
				Oral				<br>
				<img src="<?php echo base_url('img/semic/icone-oral-grad.png');?>" title="Oral">
			</td>
		</tr>
		<tr>
			<td colspan=2 class="lt3"><font class="lt6">iCCOMP19T</font>
				<br><b>Ci�ncia da Computa��o</b></td>
		</tr>
		<tr>
			<td align="center"><font class="lt5"><b>Sintetiza��o de hardware para algoritmos de aprendizado de m�quina usando ROCCC</b></font>
			<BR>
			<font class="lt4"><i>Hardware synthesizing for machine learning algorithms using ROCCC</i></font>
			<BR>
			</td>
		</tr>
	</table>
	<br>
	<div style="text-align:right;">
		BABONI, Fernando Brasil<sup>1</sup>; FRAN�A, Andre<sup>2</sup>; VIEGAS, Eduardo Kugler<sup>3</sup>; SANTIN, Altair Olivo<sup>4</sup>		<BR>
		PIBITI		- Bolsa PUCPR-PIBITI		<BR>
		<I>--</I>
	</div>
	<BR>
	<table width="100%">
		<tr valign="top">
			<td width="44%"> Resumo
			<div style="text-align:justify;">
				<P>
					<B>Introdu��o</B>: Visando a melhor otimiza��o, seguran�a, facilidade e custo, o ROCCC 2.0 (Riverside Optimizing Compiler for Configurable Computing) se tornou a melhor ferramenta de sintetiza��o de Hardware para algoritmo em VHDL (VHSIC Hardware Description Language) para o projeto. ROCCC � uma ferramenta de compila��o para gerar c�digos para FPGA (Field-Programmable Gate Array) que utiliza um extenso conjunto de transforma��es do compilador.					<B>Objetivo</B>: O projeto proposto visa a tradu��o de um algoritmo KNN (K-Nearest Neighbor) para, futuramente, ser implementado em uma FPGA.					<B>Metodologia</B>: Este foi utilizado para compilar todo o c�digo, inicialmente, em C++ para VHDL, correspondendo todas as fun��es do c�digo original. Diversas dificuldades foram enfrentadas em sua implementa��o, como as limita��es deste framework e at� mesmo questionamentos sobre o que ele realmente era capaz de traduzir. Esses obst�culos foram desde limita��es do reconhecimento do ROCCC nas bibliotecas C, e at� mesmo, a remodela��o de todo o c�digo previamente escrito em C. Isso fez com que v�rias vers�es do projeto serem refeitas para produzir uma capaz de traduzir o c�digo de uma forma desej�vel que contivesse todas as fun��es do c�digo, previamente, em C.					<B>Resultados</B>: Os primeiros resultados come�aram a surgir ap�s unificar as fun��es do c�digo inicial, bem como tamb�m, eliminar todas as Structs e Ponteiros. Estes problemas foram resolvidos gra�as a reescrita do c�digo em C, que n�o limitaria o ROCCC, at� que por fim, foi poss�vel gerar os primeiros c�digos em VHDL para serem implementados em uma FPGA.					<B>Conclus�es</B>: Estes c�digos em VHDL possu�am todas as caracter�sticas do c�digo original e com as otimiza��es proporcionadas pelo ROCCC.				</P>
			</div><B>Palavras-chave</B>: ROCCC. FPGA. KNN. VHDL.			<BR>
			<BR>
			</td><td width="2%">&nbsp;</td><td width="44%"> Abstract
			<div style="text-align:justify;">
				<P>
					<B>Introduction</B>: Aiming to better optimization, security, ease and cost, ROCCC 2.0 (Riverside Optimizing Compiler for Configurable Computing) became the best hardware synthesis tool for algorithm in VHDL (VHSIC Hardware Description Language) for the project. ROCCC is a build tool to generate code for FPGA (Field-Programmable Gate Array) that uses an extensive set of compiler transformations.					<B>Objectives</B>: The proposed project is the translation of a KNN (K-Nearest Neighbor) algorithm for the future, be implemented in an FPGA.					<B>Methods</B>: This was used to compile all the code initially in C ++ to VHDL, representing all functions of the original code. Several difficulties were encountered in its implementation, as the limitations of this framework and even questions about what it really was able to translate. These obstacles were limitations, from the recognition of ROCCC in C libraries, and even remodeling of all the code previously written in C. This made several versions of the project being redone to produce a capable version to translate the code of a desirable form that contains all the code functions previously in C.					<B>Results</B>: The first results began to emerge after unifying the functions of the original code, and also, eliminating all Structs and Pointers. These problems have been solved thanks to rewrite code in C, which does not limit the ROCCC, until at last, it was possible to generate the first code in VHDL for implementation in an FPGA.					<B>Conclusion</B>: These codes in VHDL had all the features of the original code and the optimizations provided by ROCCC.				</P>
			</div><B>Keywords</B>: ROCCC. FPGA. KNN. VHDL.</td>
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