<div id="trabalho">
	<table width="100%" border=0>
		<tr valign="top">
			<td colspan=2>SILVA, G. F.; COELHO, L. D. S. Controle de um ve�culo a�reo n�o-tripulado aplicado ao processamento de imagens de nadadores competitivos. In: SEMIC, Semin�rio de Inicia��o Cient�fica, 23, 2015, Curitiba-PR. Anais do 23� Semin�rio de Inicia��o Cient�fica. Curitiba: PUCPR, 2015. p. CCOMP11.</td>
			<td width="100" align="right" rowspan=2>
				P�ster				<br>
				<img src="<?php echo base_url('img/semic/icone-poster-grad.png');?>" title="P�ster">
			</td>
		</tr>
		<tr>
			<td colspan=2 class="lt3"><font class="lt6">CCOMP11</font>
				<br><b>Ci�ncia da Computa��o</b></td>
		</tr>
		<tr>
			<td align="center"><font class="lt5"><b>Controle de um ve�culo a�reo n�o-tripulado aplicado ao processamento de imagens de nadadores competitivos</b></font>
			<BR>
			<font class="lt4"><i>Unmanned aerial vehicle applied to image processing in swimming</i></font>
			<BR>
			</td>
		</tr>
	</table>
	<br>
	<div style="text-align:right;">
		SILVA, Guilherme Felipe da<sup>1</sup>; COELHO, Leandro Dos Santos<sup>2</sup>		<BR>
		PIBIC		- Bolsa PUCPR-PIBIC		<BR>
		<I>--</I>
	</div>
	<BR>
	<table width="100%">
		<tr valign="top">
			<td width="44%"> Resumo
			<div style="text-align:justify;">
				<P>
					<B>Introdu��o</B>: A nata��o � um esporte completo e repleto de t�cnicas, desta forma, o atleta com melhor dom�nio das t�cnicas consequentemente ter� melhores resultados no �mbito competitivo. O estudo da biomec�nica dos nadadores surge ent�o como um meio para compreender e aprimorar tais t�cnicas. Em outro �mbito, VANT (ve�culo a�reo n�o-tripulado, ou UAV, Unmanned Aerial Vehicle)  � um ve�culo a�reo que dispensa a presen�a de piloto em cabine, podendo ser controlador atrav�s de controladores remotos ou voar de forma autonoma por meio de algoritmos pr�-programados.					<B>Objetivo</B>: O presente projeto tem o objetivo de utilizar um UAV afim de seguir e filmar um nadador competitivo automaticamente para posterior an�lise biomec�nica.					<B>Metodologia</B>: Utilizando-se as bibliotecas de c�digo aberto FFmpeg e OpenCV, s�o obtidas imagens da c�mera do UAV AR.Drone 2.0 e processadas afim de se detectar um objeto de interesse. A detec��o � realizada utilizando detec��o de contornos ap�s filtragem de cor e binariza��o da imagem. As imagens ainda passam por um filtro de Kalman afim de se eliminar altera��es abruptas e estimar posi��o futura do objeto. Com o objeto detectado, utiliza-se um controlador PID (proporcional, integral e derivativo) fazendo o UAV segui-lo.					<B>Resultados</B>: A abordagem utilizada detecta de forma satisfat�ria objetos de interesse em ambientes com ilumina��o controlada. O controlador PID apresenta bom desempenho na fun��o de seguir um objeto de interesse.					<B>Conclus�es</B>: Apesar de todos os sistemas terem sido implementados de forma satisfat�ria, limita��es no UAV AR.Drone 2.0, no que diz respeito � utiliza��o da c�mera inferior como sensor de realimenta��o para o controlador, inviabilizam a aplica��o do sistema desenvolvido ao processamento de imagens de nadadores competitivos, por�m, ainda assim, mostra-se muito �til para seguir objetos em geral atrav�s da c�mera frontal.				</P>
			</div><B>Palavras-chave</B>: Biomec�nica. controle de processos. controle PID. ve�culo a�reo n�o-tripulado.			<BR>
			<BR>
			</td><td width="2%">&nbsp;</td><td width="44%"> Abstract
			<div style="text-align:justify;">
				<P>
					<B>Introduction</B>: Swimming is a complete sport and full of techniques, in this way, the athlete with better field of techniques consequently have better results in the competitive environment. The study of biomechanics of the swimmers then arises as a mean to understand and improve such techniques. In another context, UAV (Unmanned Aerial Vehicle) is an air vehicle that eliminates the driver presence in the cabin and can be controlled via remote controllers or fly autonomously through algorithms programmed previously.					<B>Objectives</B>: This project aims to use a UAV in order to follow and shoot a competitive swimmer automatically for subsequent biomechanical analysis.					<B>Methods</B>: Using the open source libraries FFmpeg and OpenCV, the images are obtained from the UAV AR.Drone 2.0 camera and then processed in order to detect an object of interest. The detection is performed using edge detection, color filtering and binarization of the image. Finally, the images pass through a Kalman filter in order to eliminate abrupt changes and to estimate future position of the object. With the detected object, a PID controller (proportional, integral and derivative) is used to make the UAV follow it.					<B>Results</B>: The approach satisfactorily detects objects of interest in environments with controlled light. The PID controller performs well in order to follow an object of interest. Although all the systems have been satisfactorily implemented, the UAV AR.Drone 2.0 limitations in regard to the use of the lower camera sensor as feedback for the controller makes it impossible to apply the system developed to shoot competitive swimmers, but still, it shows very useful for tracking objects through the front camera.					<B>Conclusion</B>: Although all the systems have been implemented satisfactorily, the UAV AR.Drone 2.0 limitations, with regard to the use of the lower camera sensor as feedback for the controller, make impossible the implementation of the system developed for image processing of competitive swimmers but still, it proves very useful for tracking objects in general through the front camera.				</P>
			</div><B>Keywords</B>: Biomechanics. control systems. PID control. unmanned aerial vehicle</td>
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