<div id="trabalho">
	<table width="100%" border=0>
		<tr valign="top">
			<td colspan=2>HOUBEN, L.; MENDES, N. An�lise de incerteza e de sensibilidade aplicada a um m�todo de c�lculo de �rea ensolarada nas fachadas externas dos edif�cios. In: SEMIC, Semin�rio de Inicia��o Cient�fica, 23, 2015, Curitiba-PR. Anais do 23� Semin�rio de Inicia��o Cient�fica. Curitiba: PUCPR, 2015. p. MEC4.</td>
			<td width="100" align="right" rowspan=2>
				P�ster				<br>
				<img src="<?php echo base_url('img/semic/icone-poster-grad.png');?>" title="P�ster">
			</td>
		</tr>
		<tr>
			<td colspan=2 class="lt3"><font class="lt6">MEC4</font>
				<br><b>Engenharia Mec�nica</b></td>
		</tr>
		<tr>
			<td align="center"><font class="lt5"><b>An�lise de incerteza e de sensibilidade aplicada a um m�todo de c�lculo de �rea ensolarada nas fachadas externas dos edif�cios</b></font>
			<BR>
			<font class="lt4"><i>Uncertainty and sensitivity analysis applied to a sunny area method of calculating the external facades of buildings</i></font>
			<BR>
			</td>
		</tr>
	</table>
	<br>
	<div style="text-align:right;">
		HOUBEN, Lea<sup>1</sup>; MENDES, Nathan<sup>2</sup>		<BR>
		ICI		- Inicia��o Cient�fica Internacional		<BR>
		<I>--</I>
	</div>
	<BR>
	<table width="100%">
		<tr valign="top">
			<td width="44%"> Resumo
			<div style="text-align:justify;">
				<P>
					<B>Introdu��o</B>: Os programas computacionais de simula��o de edif�cios se destacam como ferramentas �teis para atingir projetos energeticamente eficientes. Em particular, essas ferramentas podem ser usadas para estudar a radia��o solar, na qual � um dos principais fatores respons�veis pelo ganho t�rmico no ambiente interno, bem como � uma fonte de energia renov�vel. Uma determina��o precisa da �rea ensolarada se mostra de extrema import�ncia para o desempenho global da edifica��o. V�rios m�todos existem para a computa��o da �rea ensolarada, assim, no objetivo de melhorar as ferramentas de simula��o, � interessante avaliar e comparar esses m�todos implementados em diferentes modelos de simula��o. Isso n�o dever ser feito somente pelos crit�rios de rapidez e precis�o, mas tamb�m pela robustez, ou seja, a capacidade do modelo se adaptar a um ambiente incerto ao qual � sujeita a simula��o t�rmica. Esses modelos s�o determin�sticos, assim, � importante determinar a probabilidade de ocorr�ncia de cada resultado da simula��o diante das incertezas dos par�metros de entrada. Essas quest�es podem ser trabalhadas a partir de ferramentas estat�sticas, como a an�lise de incerteza e sensibilidade.					<B>Objetivo</B>: Desenvolver uma metodologia de avalia��o das t�cnicas de c�lculo da �rea ensolarada implementadas nos programas de simula��o computacional (no programa EnergyPlus inicialmente).					<B>Metodologia</B>: Um m�todo de an�lise de incertezas e de sensibilidade foi usado para avaliar o m�todo anal�tico Polygon Clipping, implementado no programa EnergyPlus. Como par�metros de entrada incertos, optou-se por trabalhar com a localiza��o do edif�cio, orienta��o da fachada e dimens�es dos elementos do brise.					<B>Resultados</B>: Esse trabalho permitiu quantificar as incertezas associadas ao c�lculo da �rea ensolarada, bem como identificar as entradas respons�veis dessas incertezas. Observa-se at� 15% de incertezas nos resultados de �rea ensolarada nas horas mais expostas dos dias de equin�cios e de solst�cio de inverno. A latitude e a largura dos brises solares s�o os principais respons�veis dessas incertezas.Esse trabalho permitiu quantificar as incertezas associadas ao calculo da �rea ensolarada, bem como identificar as entradas respons�veis dessas incertezas.  Observa-se at� 15% de incertezas nos resultados de �rea ensolarada nas horas mais expostas dos dias de equin�cios e de solst�cio de inverno. A latitude e a largura dos brises solares s�o os principais respons�veis dessas incertezas.					<B>Conclus�es</B>: A metodologia pode ser usada para geometrias complexos, bem como auxiliar na fase de concep��o de projetos energeticamente otimizados. Como trabalhos futuros, sugere-se a aplica��o da mesma metodologia para avaliar tamb�m a t�cnica contagem de pixel usada pelo software Domus, desenvolvido no Laborat�rio de Sistemas T�rmicos (PUCPR)				</P>
			</div><B>Palavras-chave</B>: Edif�cios. Sof�tware Domus. EnergyPlus.			<BR>
			<BR>
			</td><td width="2%">&nbsp;</td><td width="44%"> Abstract
			<div style="text-align:justify;">
				<P>
					<B>Introduction</B>: Computer programs for thermal simulation represent useful tools to design energetically efficient projects. In particular, those tools can be used to study solar radiation, which is one of the main factors responsible for the heat gain in an internal environment, as well as a source of renewable energy. An accurate determination of the sunlit area can be extremely important to the overall performance of the building. There are multiple methods to compute the sunlit area. Thus, it is interesting to evaluate and compare these methods in order to improve the simulation tools. This evaluation can�t be done only by looking at the computation cost and accuracy criteria : the robustness must be also assessed. The robustness can be defined as the model�s ability to adapt itself to the uncertain environment to which the thermal simulation is subject to. Indeed the models are deterministic, thus it is important to determine the occurrence probability of each result facing the inputs uncertainties. The uncertainty and sensitivity analysis is a tool that can work on these issues.					<B>Objectives</B>: To develop a methodology for evaluating the sunlit area computation techniques implemented in simulation programs (EnergyPlus initially).					<B>Methods</B>: An uncertainty and sensitivity analysis method was developed to assess the analytical method used in EnergyPlus (Polygon Clipping method). In this work, the uncertain inputs selected were the building localization, the fa�ade orientation, and the overhang elements dimensions.					<B>Results</B>: This work allowed to quantify the uncertainties associated with the sunlit area calculation, and to identify the input elements responsible for those uncertainties. It is observed up to 15% of uncertainty in the results of sunlit area during the period the most exposed to the Sun of the days of equinox and the winter solstice. The latitude and the width of the overhang elements are mainly responsible for these uncertainties.					<B>Conclusion</B>: This methodology can be used for complex geometries as well as help optimizing the building energy efficiency in the design phase. For future work, this methodology could be applied for evaluating the pixel counting technique implemented in the software Domus, developed in the Laborat�rio de Sistemas T�rmicos (PUCPR).				</P>
			</div><B>Keywords</B>: Buildings. Domus Sof�tware. EnergyPlus.</td>
		</tr>
	</table>
	<BR>
	<BR>
	<sup>1</sup> Estudante. PUCPR<br><sup>2</sup> Orientador. PUCPR	<BR>
	<BR>
	<BR>
	<BR>
</div>
<BR>
<BR>
<BR>
</div> 