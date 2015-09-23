<div id="trabalho">
	<table width="100%" border=0>
		<tr valign="top">
			<td colspan=2>QUADROS, M. P.; BATIROLLA, J.; LOURES, E. F. R. Desenvolvimento de plataforma integrada para o controle, diagno[e]#769;stico de falhas e avaliac[e]#807;a[e]#771;o de desempenho baseada em sistema SCADA. In: SEMIC, Seminário de Iniciação Científica, 23, 2015, Curitiba-PR. Anais do 23º Seminário de Iniciação Científica. Curitiba: PUCPR, 2015. p. EPR17T.</td>
			<td width="100" align="right" rowspan=2>
				Pôster				<br>
				<img src="<?php echo base_url('img/semic/icone-poster-grad.png');?>" title="Pôster">
			</td>
		</tr>
		<tr>
			<td colspan=2 class="lt3"><font class="lt6">EPR17T</font>
				<br><b>Engenharia de Produção</b></td>
		</tr>
		<tr>
			<td align="center"><font class="lt5"><b>Desenvolvimento de plataforma integrada para o controle, diagno[e]#769;stico de falhas e avaliac[e]#807;a[e]#771;o de desempenho baseada em sistema SCADA</b></font>
			<BR>
			<font class="lt4"><i>Integrated Platform Development to the control, fault diagnosis and performance assessment based on SCADA System</i></font>
			<BR>
			</td>
		</tr>
	</table>
	<br>
	<div style="text-align:right;">
		QUADROS, Matheus Pallu de<sup>1</sup>; BATIROLLA, Julio<sup>2</sup>; LOURES, Eduardo de Freitas Rocha<sup>3</sup>		<BR>
		PIBITI		- Bolsa Agência PUC		<BR>
		<I>--</I>
	</div>
	<BR>
	<table width="100%">
		<tr valign="top">
			<td width="44%"> Resumo
			<div style="text-align:justify;">
				<P>
					<B>Introdução</B>: A grande lacuna existente no meio industrial e científico é a inexistência de ambientes ou sistemas integrados que permitem uma base informacional compartilhada entre funções de controle, monitoramento, diagnóstico de falhas e avaliação de desempenho no suporte ao sistemas de operação e manutenção industrial. O atendimento de tais funções é realizado de forma desacoplada através de sistemas heterogêneos e específicos que dificultam uma gestão integrada da produção e manutenção. Objetivos: Avaliar as diferentes funções, bases informacionais e componentes tecnológicos das camadas 0, 1 e 2 do modelo ISA 95 e propor uma plataforma integrada de supervisão integrada à função manutenção.					<B>Objetivo</B>: Avaliar as diferentes funções, bases informacionais e componentes tecnológicos das camadas 0, 1 e 2 do modelo ISA 95 e propor uma plataforma integrada de supervisão integrada à função manutenção.					<B>Metodologia</B>: O presente projeto apresenta uma base metodológica denominada CDSS (Ciclo de Desenvolvimento de Sistemas de Supervisão), sob as quais estruturam-se os objetivos e etapas de desenvolvimento. Situações de falha, assinaturas de alarmes, cenários de manutenção e tomada de decisão (paradas e intervenções) serão testados na estrutura do processo descrito, de forma a validar as funções de módulos de controle-monitoramento-manutenção. Tal simulação deverá inspira-se no conceito HIL (Hardware-in-the-loop), sugerindo a escolha de uma ambiente de simulação da planta física em comunicação com os módulos de supervisão.					<B>Resultados</B>: A fim de ter um melhor entendimento da plataforma de controle sequencial, foram explorados dois softwares que permitem o desenvolvimento do diagrama ladder. Para suporte à modelagem de falhas e alarmes, algumas ferramentas industriais FMEA/FTA foram investigadas, em esforço conjunto com o mestrando do PPGEPS, Julio Battirola. Esta etapa forneceu requisitos de implementação das funções de detecção e diagnóstico de alarmes e falhas para camada de controle e supervisão. Para estratégias de integração da função OEE (Overall Equipment Effectiveness), duas possibilidades foram investigadas: a primeira baseada em arquitetura onde os dados são tratados pelo Excel (camada de cálculo) e os resultados foram apresentados na plataforma ELIPSE (camada de interface com usuário); a segunda onde os dados foram tratados e apresentados no Excel (opção adotada).					<B>Conclusões</B>: Primeiro, fazer com que o Ladder funcionasse na base tecnológica interoperável via OPC e incorporando requisitos de controle e detecção de falhas; depois com a implementação das funções monitoramento-comando-diagnóstico no Elipse, o projeto de supervisão tornou-se integrado, facilitando a fase de testes e desenvolvimento. A implementação do OEE juntamente com o Excel integrado ao servidor OPC e Elipse proporcionou o fechamento do projeto, pois a sua integração em nível final do projeto foi alcançada na proposição de plataforma de supervisão integrada.				</P>
			</div><B>Palavras-chave</B>: Supervisão, Falhas, Diagnóstico, Manutenção, OEE, Integração			<BR>
			<BR>
			</td><td width="2%">&nbsp;</td><td width="44%"> Abstract
			<div style="text-align:justify;">
				<P>
					<B>Introduction</B>: One main issue in the industrial and scientific community is the absence of environments or integrated systems that enable a shared informational basis between control functions, monitoring, fault diagnosis and performance evaluation in supporting operative systems and industrial maintenance. The achievement of these functions is performed in uncoupled way through heterogeneous and specific systems, which hinder an integrated production management (operation) and maintenance (current trend in industrial parks).					<B>Objectives</B>: Evaluate the different functions, informational bases and technological components of the layers 0, 1 and 2 of ISA 95 model and propose an integrated platform of integrated supervision to the function maintenance.					<B>Methods</B>: This project presents a methodological approach titled SSDC (Supervisory System Development Cycle) under which the objectives and development steps are structured. Fault conditions, alarm triggering, maintenance and decision making (stops and interventions) scenarios will be simulated in the described structure and process in order to validate the function modules control-monitoring-maintenance. Such simulation is inspired on the methodology HIL (Hardware-in-the-loop), suggesting that the choice of a simulation environment of the physical plant in communication with the supervision modules.					<B>Results</B>: In order to have a better understanding of the ladder platform, they were explored two softwares that allow the making of this diagram. The OpenPCS of infoteam Software AG has been tested with full license, but the IsaGRAF Rockwell Automation Company has been tested with trial license. To support the modeling of faults and alarms, some industrial standards such FMEA/FTA were investigated in joint effort with the master’s degree student Julio Battirola. To integrate OEE (Overall Equipment Effectiveness), two options are possible: the first architecture considers the data processed by Excel and the results are shown in ELIPSE platform; the second one considers the data are processed and displayed in Excel (adopted strategy).					<B>Conclusion</B>: Firstly, make the control layer operative in an interoperable technological basis through OPC, integrating control and fault requirements; then implementing the monitoring-control-diagnosis functions in Elipse – all this elements made easy the tests and improvement steps. The implementation of the OEE indicator in Excel basis, integrated to OPC server and Elipse concluded the overall integrated supervisory platform.				</P>
			</div><B>Keywords</B>: Supervision, Fault, Diagnosis, Maintenance, OEE, Integration</td>
		</tr>
	</table>
	<BR>
	<BR>
	<sup>1</sup> Estudante. PUCPR<br><sup>3</sup> Orientador. PUCPR	<BR>
	<BR>
	<BR>
	<BR>
</div>
<BR>
<BR>
<BR>
</div> 