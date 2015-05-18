<?php
require("cab.php");
?>
		
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<link rel="stylesheet" href="css/thickbox.css" type="text/css" media="screen" />
		<script type="text/javascript" src="js/thickbox.js"></script>

	<body>
		
		<div id="total" class="total">
			
			<?php require("header.php");?>
			
			<div id="corpo">
				 <h1>Envio d<span class="lt6light">e documentos e Informações</span></h1>
				 
				 <p>Olá, <strong>Bolsista!</strong></p>
				 <br />
				 <br />
				 
				 <div id="area-bolsista">
				 	<div id="fases-envio-documento">
				 		
				 		<a href='#' OnClick="mudaAba(1)" class="aba-docs">1. Pré-viagem</a>
						<a href='#' OnClick="mudaAba(2)" class="aba-docs">2. Durante a viagem</a>
						<a href='#' OnClick="mudaAba(3)" class="aba-docs">3. Pós-viagem</a>
				 		
				 		<div id="fases">
				 			<div id="aba1" style="display:inline;">
								<p><span class="numero-fase">1.</span> Antes de você viajar, providencie:</p>
								
								<p>
									<img src="img/doc-enviado-lista.png" />Seus dados pessoais e da sua universidade de destino;<br />
									<img src="img/doc-nao-enviado-lista.png" />Comprovante de matrícula na Universidade; <a href="#TB_inline?height=480&width=500&inlineId=myOnPageContent" title="" class="thickbox">[enviar documento]</a><br />
								</p>
							</div>
					
							<div id="aba2" style="display:none;">
								<p><span class="numero-fase">2.</span> Durante o seu intercâmbio, providencie:</p>
								
								<p>
									<img src="img/doc-nao-enviado-lista.png" />Atualização de dados; <a href="#TB_inline?height=500&width=500&inlineId=myOnPageContent" title="" class="thickbox">[enviar documento]</a><br />
									<img src="img/doc-nao-enviado-lista.png" />Comprovante de embarque; <a href="#TB_inline?height=500&width=500&inlineId=myOnPageContent" title="" class="thickbox">[enviar documento]</a><br />
									<img src="img/doc-nao-enviado-lista.png" />Comprovante da compra de material; <a href="#TB_inline?height=500&width=500&inlineId=myOnPageContent" title="" class="thickbox">[enviar documento]</a><br />
								</p>
								
							</div>
							
							<div id="aba3" style="display:none;">
								<p><span class="numero-fase">3.</span> Agora que você já voltou, precisa nos enviar os seguintes documentos:</p>
								
								<p>
									<img src="img/doc-nao-enviado-lista.png" />Comprovante de volta; <a href="#TB_inline?height=500&width=500&inlineId=myOnPageContent" title="" class="thickbox">[enviar documento]</a><br />
									<img src="img/doc-nao-enviado-lista.png" />Relatório Final; <a href="#TB_inline?height=500&width=500&inlineId=myOnPageContent" title="" class="thickbox">[enviar documento]</a><br />
								</p>
								
							</div>	
				 		</div>
				 		
				 		
				 	</div>
				 	
				 	<!--<div id="campo-data-viagem">
				 		Mês/ano de embarque: <input /><br />
				 		Faltam apenas <span class="numero-dias">20</span> dias!
				 	</div>-->
				 	
				 	<div id="lembrete-dados-pessoais">
				 		<p>
				 			<span class="titulo-bilhete">Lembrar!</span><br /> Mantenha seus dados atualizados!<br />(em caso de emergência, serão esses os dados que vamos contatar.)<br /><br />
				 			<a href="#TB_inline?height=600&width=800&inlineId=myOnPageContent2" title="" class="thickbox"><i class="icon-edit"></i> Atualizar meus dados</a><br />
				 			<a href="#dados-enviados-bolsista"><i class="icon-zoom-in"></i> Visualizar meus dados</a>
				 		</p>
				 	</div>
				 </div> <!-- fecha div area de bolsista -->
				 
				 <!-- Javascript para fazer funcionar as abas do envio dos documentos -->
				 <script type="text/javascript"> 
					function mudaAba (numero_aba)
						{
						if (numero_aba == 1)
						{
						      document.getElementById('aba1').style.display="inline";
						      document.getElementById('aba2').style.display="none";
						      document.getElementById('aba3').style.display="none";
						}
						else if (numero_aba == 2)
						{
						      document.getElementById('aba2').style.display="inline";
						      document.getElementById('aba1').style.display="none";
						      document.getElementById('aba3').style.display="none";
						}
						else if (numero_aba == 3)
						{
						      document.getElementById('aba2').style.display="none";
						      document.getElementById('aba1').style.display="none";
						      document.getElementById('aba3').style.display="inline";
						}
					}
				</script>
</head>
<body>



			 
				 
				 
				 
				 <table>
				 	
				 	<p><h4>Status da sua documentação:</h4></p>
				 	<tr class="lt3">
				 		<td><strong>Seguro Saúde</strong></td>
				 		<td><strong>Comprovante de compra de material didático</strong></td>
				 		<td><strong>Comprovante de Matrícula na Instituição estrangeira</strong></td>
				 		<td><strong>Comprovante de Embarque</strong></td>
				 		
				 		<td><strong>Relatório final</strong></td>
				 	</tr>
				 	
				 	<tr>
				 		<td><img src="img/doc-enviado.png" /></td>
				 		<td><img src="img/doc-enviado.png" /></td>
				 		<td><img src="img/doc-nao-enviado.png" /></td>
				 		<td><img src="img/doc-enviado.png" /></td>
				 		
				 		<td><img src="img/doc-nao-enviado.png" /></td>
				 	</tr>
				 	
				 	<tr class="lt3">
				 		<td><a href="#">Download</a></td>
				 		<td><a href="#">Download</a></td>
				 		<td><a href="#"></a></td>
				 		<td><a href="#">Download</a></td>
				 		
				 		<td><a href="#"></a></td>
				 	</tr>
				 	
				 	
				 </table>
				 
				
				
				
				 
				 
				 
				 <div id="myOnPageContent" style="display: none;"> 
					<br /><br /><br />
					<h4>Enviar arquivos da documentação</h4>
					<br />
						 <div id="enviar-arquivos-bolsista">
							 <p><strong>Escolha qual tipo de arquivo você quer enviar:</strong></p>
							 <span class="lt2"><strong>ATENÇÃO!</strong> Se você enviar um arquivo para o que já esteja postado, ele será substituído pelo que foi enviado por último.</span><br />
							<select>
								<option value="segurasaude">Seguro Saúde</option>
								<option>Comprovante Material Didático</option>
								<option>Comprovante de Matrícula</option>
								<option>Comprovante de Embarque</option>
								<option>Relatório final</option>
							</select>
							<br />
							<br />
							<input type="file" /><span class="lt2">Formato: PDF / máx. 5mb</span>
							
							<p>Comentários:</p>
							<textarea rows="2" cols="50"></textarea>
							<br />
							 <button>Enviar documento</button>
						</div>
				 </div> <!-- fecha div myOnPageContent -->
				 
				 
				 <div id="myOnPageContent2" style="display: none;"> 
				 
							 	<br />
							 	<h4>ATUALIZAR Dados do Aluno e Universidade</h4>
							 	<br />
							 <div id="enviar-dados-bolsista">
								 <p>Bolsista, preencha todas as informações abaixo:</p>
								 
								 <p><strong>País * <br /></strong>
								 	<input class="input-dados"></input><br /><br />
								 	
								 	<strong>Universidade * <br /></strong>
								 	<input class="input-dados"></input><br /><br />
								 	
								 	<strong>Departamento/Escola do seu curso * <br /></strong>
								 	<input class="input-dados"></input><br /><br />
								 	
								 	<strong>Curso no exterior * <br /></strong>
								 	<input class="input-dados"></input><br /><br />
								 	
								 	<strong>Qual a sua data prevista de retorno? (Essa informação pode ser alterada futuramente) * <br /></strong>
								 	<input class="input-dados"></input><br /><br />
								 	
								 	<strong>Agência Financiadora * <br /></strong>
									 	<select>
											<option value="agencia-cnpq">CNPq</option>
											<option value="agencia-capes">CAPES</option>
										</select><br /><br />
										
									<strong>Você possui algum tipo de bolsa na PUCPR? * <br /></strong>
									 	<select>
											<option value="bolsa-prouni">Sim, Prouni</option>
											<option value="bolsa-puc">Sim, Bolsa PUC</option>
											<option value="fies">Sim, FIES</option>
											<option value="nenhuma-bolsa">Não</option>
										</select><br /><br />
								 	
								 	<strong>Contato pessoal no exterior * <br /></strong>
								 	Nome: <input class="input-dados"></input> Email: <input class="input-dados"></input><br />
								 	Telefone: <input class="input-dados"></input> Endereço: <input class="input-dados"></input><br /> <br />
								 	
								 	<strong>Escritório de Relações Internacionais da sua Universidade no exterior: * </strong><br />
								 	Responsável: <input class="input-dados"></input> Email: <input class="input-dados"></input><br />
								 	Telefone: <input class="input-dados"></input> Endereço: <input class="input-dados"></input><br /><br />
								 	
								 	<strong>Contato 1 no Brasil * <br /></strong>
								 	Nome: <input class="input-dados"></input> 
								 	Parentesco: <select>
													<option value="parentesco-pai">pai</option>
													<option value="parestesco-mae">mãe</option>
													<option value="parestesco-mae">tios</option>
													<option value="parestesco-mae">irmãos</option>
													<option value="parestesco-mae">avós</option>
													<option value="parestesco-mae">amigos</option>
												</select><br />
								 	
								 	Email: <input class="input-dados"></input><br /><br />
								 	Telefone: <input class="input-dados"></input> Endereço: <input class="input-dados"></input><br /><br /><br />
								 	
								 	
								 	<strong>Contato 2 no Brasil * <br /></strong>
								 	Nome: <input class="input-dados"></input> 
								 	Parentesco: <select>
													<option value="parentesco-pai">pai</option>
													<option value="parestesco-mae">mãe</option>
													<option value="parestesco-mae">tios</option>
													<option value="parestesco-mae">irmãos</option>
													<option value="parestesco-mae">avós</option>
													<option value="parestesco-mae">amigos</option>
												</select><br />
								 	
								 	Email: <input class="input-dados"></input><br />
								 	Telefone: <input class="input-dados"></input> Endereço: <input class="input-dados"></input>
								 </p> <br />
								  
								 
								 <button>Salvar contatos</button>
							</div>
				 
				 </div>
				 
				 
				 
				 
				 
				 
				 
				 
				 
				 
				
				<h4>Dados do Aluno e Universidade</h4>
				 <div id="dados-enviados-bolsista">
					<p>ATENÇÃO! Você ainda não providenciou seus dados! Preencha os campos abaixo. <a href="#enviar-dados-bolsista">Atualizar meus dados</a></p>					 
					 
					 <table class="lt3">
					 	
					 	<tr>
					 		<td><strong>País:</strong></td>
					 		<td>Reino Unido</td>
					 	</tr>
					 	
					 	<tr>
					 		<td><strong>Universidade:</strong></td>
					 		<td>University of Leeds</td>
					 	</tr>
					 	
					 	<tr>
					 		<td><strong>Departamento/Escola do seu curso:</strong></td>
					 		<td>School of Engineering</td>
					 	</tr>
					 	
					 	<tr>
					 		<td><strong>Curso no Exterior:</strong></td>
					 		<td>Civil Engineering</td>
					 	</tr>
					 	
					 	<tr>
					 		<td><strong>Agência Financiadora:</strong></td>
					 		<td>CNPq</td>
					 	</tr>
					 	
					 	<tr>
					 		<td><strong>Contato pessoal no exterior:</strong></td>
					 		<td>Andressa da Silva<br />
					 			andressa.silva@gmail.com
					 		</td>
					 		<td>Leeds, West Yorkshire LS1, UK 19 ft S<br />
					 		+44 (0) 113 343 2336</td>
					 	</tr>
					 	
					 	<tr>
					 		
					 		<td><strong>Escritório de Relações<br /> Internacionais da sua Universidade<br /> no exterior:</strong></td>
					 		<td>Andrew Beclay<br />
					 			andrey.becley@unileeds.com
					 		</td>
					 		<td>Leeds, West Yorkshire LS1, UK 19 ft S<br />
					 		+44 (0) 113 343 5522</td>
					 		
					 	</tr>
					 	
					 	
					 	<tr>
					 		<td><strong>Contato 1 no Brasil:</strong></td>
					 		<td>Lidia da Silvia (mãe)</td>
							<td>Rua das Flores, 277 - Curitiba, Paraná - 80250-020<br />
					 			41 3252-8976<br /></td>
					 	</tr>
					 	
					 	<tr>
					 		<td><strong>Contato 2 no Brasil:</strong></td>
					 		<td>Rodrigo Gonçalves (tio)</td>
							<td>Rua dos Ipês, 487 - Campo Largo, Paraná - 85678-980<br />
					 			41 3452-4571<br /></td>
					 	</tr>
					 	
					 	
					 	
					 </table>
					 
					
				</div> <!-- fecha div dados-enviados-bolsista-->
				 
				 
				 
				
				
			
			</div> <!-- fecha div corpo -->
			
			<?php require("footer.php");?>
			
		</div>
		
	</body>
</html>