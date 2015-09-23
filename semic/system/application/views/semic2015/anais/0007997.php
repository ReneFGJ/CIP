<div id="trabalho">
	<table width="100%" border=0>
		<tr valign="top">
			<td colspan=2>BABONI, F. B.; FRANçA, A.; VIEGAS, E. K.; SANTIN, A. O. Sintetização de hardware para algoritmos de aprendizado de máquina usando ROCCC. In: SEMIC, Seminário de Iniciação Científica, 23, 2015, Curitiba-PR. Anais do 23º Seminário de Iniciação Científica. Curitiba: PUCPR, 2015. p. iCCOMP19T.</td>
			<td width="100" align="right" rowspan=2>
				Oral				<br>
				<img src="<?php echo base_url('img/semic/icone-oral-grad.png');?>" title="Oral">
			</td>
		</tr>
		<tr>
			<td colspan=2 class="lt3"><font class="lt6">iCCOMP19T</font>
				<br><b>Ciência da Computação</b></td>
		</tr>
		<tr>
			<td align="center"><font class="lt5"><b>Sintetização de hardware para algoritmos de aprendizado de máquina usando ROCCC</b></font>
			<BR>
			<font class="lt4"><i>Hardware synthesizing for machine learning algorithms using ROCCC</i></font>
			<BR>
			</td>
		</tr>
	</table>
	<br>
	<div style="text-align:right;">
		BABONI, Fernando Brasil<sup>1</sup>; FRANçA, Andre<sup>2</sup>; VIEGAS, Eduardo Kugler<sup>3</sup>; SANTIN, Altair Olivo<sup>4</sup>		<BR>
		PIBITI		- Bolsa PUCPR-PIBITI		<BR>
		<I>--</I>
	</div>
	<BR>
	<table width="100%">
		<tr valign="top">
			<td width="44%"> Resumo
			<div style="text-align:justify;">
				<P>
					<B>Introdução</B>: Visando a melhor otimização, segurança, facilidade e custo, o ROCCC 2.0 (Riverside Optimizing Compiler for Configurable Computing) se tornou a melhor ferramenta de sintetização de Hardware para algoritmo em VHDL (VHSIC Hardware Description Language) para o projeto. ROCCC é uma ferramenta de compilação para gerar códigos para FPGA (Field-Programmable Gate Array) que utiliza um extenso conjunto de transformações do compilador.					<B>Objetivo</B>: O projeto proposto visa a tradução de um algoritmo KNN (K-Nearest Neighbor) para, futuramente, ser implementado em uma FPGA.					<B>Metodologia</B>: Este foi utilizado para compilar todo o código, inicialmente, em C++ para VHDL, correspondendo todas as funções do código original. Diversas dificuldades foram enfrentadas em sua implementação, como as limitações deste framework e até mesmo questionamentos sobre o que ele realmente era capaz de traduzir. Esses obstáculos foram desde limitações do reconhecimento do ROCCC nas bibliotecas C, e até mesmo, a remodelação de todo o código previamente escrito em C. Isso fez com que várias versões do projeto serem refeitas para produzir uma capaz de traduzir o código de uma forma desejável que contivesse todas as funções do código, previamente, em C.					<B>Resultados</B>: Os primeiros resultados começaram a surgir após unificar as funções do código inicial, bem como também, eliminar todas as Structs e Ponteiros. Estes problemas foram resolvidos graças a reescrita do código em C, que não limitaria o ROCCC, até que por fim, foi possível gerar os primeiros códigos em VHDL para serem implementados em uma FPGA.					<B>Conclusões</B>: Estes códigos em VHDL possuíam todas as características do código original e com as otimizações proporcionadas pelo ROCCC.				</P>
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