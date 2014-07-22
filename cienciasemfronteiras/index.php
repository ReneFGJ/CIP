<?php
header('Content-Type: text/html; charset=utf-8');
$name="Ciência sem Fronteiras PUCPR";
$content = "ciência sem fronteias, ciência, fronteiras, intercâmbio, estudos, pesquisa, pucpr";

$include = '../';
require("../db.php");
require('../_class/_class_csf.php');
$csf = new csf;
?>
<!DOCTYPE html>
<html>
    <head>
    	<title>Ciência sem Fronteiras | PUCPR</title>
        <meta charset="utf-8">
        <meta name="<?php echo $name;?>" content="<?php echo $content;?>">
		<link rel="stylesheet" href="css/estilo.css">
		<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
	</head>
	
	<body>
		
		<div id="total" class="total">
			
			<?php require("header.php");?>
			
			<div id="corpo">
				<a href="volta_brasil.php"><img src="img/banner-volta-brasil_chamada.png" border="0" style="margin-left:130px;"></a>
				<hr>
							<a href="docs/Resultado_Ciencia_Sem_Fronteiras_2014.pdf" target="blank">
								<img src="http://www2.pucpr.br/reol/cienciasemfronteiras/img/banner-resultados-quadro.png" border="0" style="margin-left:150px;">
							</a>
							<a href="docs/CsF__proximos_passos_novembro_2013.pdf" target="blank">
								<img src="http://www2.pucpr.br/reol/cienciasemfronteiras/img/banner-homologados_out_quadro.png" border="0">
							</a>
							<hr>
				<h1>Como <span class="lt6light">funciona?</span></h1>
				<p>Entenda como funciona o processo de inscrição do Ciência sem Fronteiras:</p>
				
				<br>
				

				<div id="processo-passo-1" class="margin-geral-itens">
					<div id="caixa-branco-1"></div>
					<div id="caixa-branco-2"></div>
					
					<div id="caixa-amarela-passo-1" class="caixa-amarela">
						<p>- Ter concluído no mínimo 20% e no máximo 90% do seu curso até a data da viagem;<br />
							- Ter <a href="testedeproficiencia.php">teste de proficiência</a> no idioma do país que você quer ir;<br />
							- Estar cursando sua graduação nas <a href="areascursos.php">Áreas Prioritárias do Ciência sem Fronteiras</a>;<br />
							- Ter no mínimo média 7.0 no seu <a href="historicoescolar.php">Histórico Escolar de Graduação</a>;<br />
							- Ter feito o ENEM a partir de 2009;<br />
							<!--<span class="aviso-rodape">* - Ter <a href="enem.php">ENEM</a> a partir de 2009, porque eventualmente ele pode ser critério classificatório;</span>-->
						</p>
					</div>
				</div>
				
				<div class="margin-geral-itens">
					<span class="lt7">1.</span><span class="lt8"> Ler o edital do país que você quer ir.</span>
					<div id="passo-2">
						<div id="caixa-amarela-passo-2" class="caixa-amarela">
							<p>Sim, nos editais você encontra todas as informações que são necessárias à você, inclusive
								informações específicas sobre os países que você tem interesse. Então, <a href="http://www.cienciasemfronteiras.gov.br" target="_blank">leia os editais</a> porque
								são muito importantes.</p>
						</div>
							
					</div>
				</div>
				
				<div class="margin-geral-itens">
					<span class="lt7">2.</span><span class="lt8"> Fazer o teste de proficiência.</span>
					<div id="passo-3">
						<div id="caixa-amarela-passo-3" class="caixa-amarela">
							<p>Veja <a href="testedeproficiencia.php">mais detalhes quais são os testes de proficiência aceitos</a>.</p>
						</div>
					</div>
				</div>
				
				<!--<div class="margin-geral-itens">
					<span class="lt7">3.</span><span class="lt8"> Inscrição no site da PUCPR.</span>
					<p class="lt9">Agora é hora de se inscrever aqui no site da PUCPR. Esta inscrição é necessária porque você
						precisa ser aprovado (ter a inscrição homologada) pela PUCPR para conseguir a bolsa.</p>
						<p><a href="inscricao.php">Fazer inscrição</a></p>
				</div>-->
				
				<div class="margin-geral-itens">
					<span class="lt7">3.</span><span class="lt8"> Inscrição no site do Governo.</span>
					<div id="passo-5">
						<p class="lt9">Esta inscrição é para que você concorra à bolsa pelo CNPq ou CAPES.
							 Para isso, você vai precisar dos seguintes documentos.</p>
							 <div id="caixa-amarela-passo-5" class="caixa-amarela">
							 	<p>- <a href="historicoescolar.php">Histórico Escolar de Graduação</a> (aquele <strong>retirado no SIGA</strong>);<br />
							 		- Comprovante de Iniciação Científica (se houver);<br />
							 		- Comprovante de Premiações (se houver). Comprovantes de cursos <strong>não valem</strong>;<br />
							 		- Comprovante do <a href="testedeproficiencia.php">Teste de Proficiência</a>;
							 		- Currículo Lattes atualizado na plataforma do <a href="http://lattes.cnpq.br/">CNPq</a>;
							 	</p>
							 </div>
						
							<p class="lt9">Acesse o <a href="http://www.cienciasemfronteiras.gov.br/">site do governo</a> para realizar a sua inscrição.</p>
							
					</div>
				</div>
				<br />
				<div class="margin-geral-itens">
					<span class="lt7">4.</span><span class="lt8"> Retirar seu passaporte.</span>
					<p class="lt9">Você vai precisar do seu passaporte apenas quando for fazer a inscrição no parceiro.</p>
					<div id="caixa-amarela-passo-6" class="caixa-amarela">
						<p>Para retirar seu passaporte, faça o pedido pelo <a href="http://www.dpf.gov.br/simba/passaporte/requerer-passaporte">site da Polícia Federal</a>.
						Custa em torno de R$156,00. Lembre-se de que se você já possui um passaporte deverá verificar se ele não vencerá antes ou durante
						a viagem (passaporte tem validade de 5 anos, após isso é necessário fazer outro na <a href="http://www.dpf.gov.br/simba/passaporte/requerer-passaporte">Polícia Federal</a>.</p>
					<p>É importante lembrar que alguns países pedem que o seu passaporte não vença em até 6 meses depois que você volta de
						viagem. Por exemplo, se você volta em Dezembro, seu passaporte não pode vencer até Junho.</p>
					
					</div>
					
				</div>
				
				<div class="margin-geral-itens">
					<span class="lt7">5.</span><span class="lt8"> Inscrição no parceiro do país, quando houver.</span>
					<p class="lt9">Você receberá um email para se cadastrar no parceiro, porém isso não quer dizer que você
						já ganhou a bolsa.<br />
						O <a href="parceiros.php">Parceiro</a> geralmente é um órgão que gerencia as inscrições em universidades. 
						Ele que vai escolher, juntamente com a CAPES e/ou CNPq, a universidade que você vai estudar.<br />
						Dependendo do país, não existe parceiro e as universidades fazem contato diretamente com o aluno.</p>
				</div>
				
				<div class="margin-geral-itens">
					<span class="lt7">6.</span><span class="lt8"> Conseguir o visto para o País.</span>
					<p class="lt9">Você deve se inscrever para conseguir o <a href="visto.php">visto</a> no consulado do país <strong>APENAS</strong> quando tiver os seguintes
						documentos:</p>
						
						<div id="caixa-amarela-passo-7" class="caixa-amarela">
							<p>- Carta de aceite (emitida pela universidade de destino);<br />
								- Carta de benefício (emitida pela CAPES/CNPq);<br />
								<span class="aviso-rodape">(Ver no site do <a href="visto.php">consulado do país</a> quais outros documentos são necessários.)</span>
							</p>
						</div>
				</div>
				
				<div class="margin-geral-itens">
					<span class="lt7">7.</span><span class="lt8"> Hora de viajar! :D</span>
					<p class="lt9">Agora que você já passou por todas as etapas de avaliação, já conseguiu o seu visto e  
						provou que é um aluno que merece ter a chance de estudar em uma universidade de renome em
						outro país, prepare-se para arrumar as malas!</p>
						
					<div id="caixa-amarela-passo-8" class="caixa-amarela">
						<p>Alunos da PUCPR que já estão lá fora estudando fizeram <a href="depoimentos.php">depoimentos</a> e <a href="dicasviagem.php">dicas de viagem</a> para
							ajudar os próximos estudantes;</p>
					</div>
				</div>
				
				<div class="margin-geral-itens">
					<span class="lt7">8.</span><span class="lt8"> Mantenha contato com a PUCPR</span>
					<p class="lt9">Você <strong>deve</strong> manter contato com a PUCPR durante a sua viagem. Para isso, nós
						 estamos preparand uma página para que você possa postar os documentos solicitados e mandar notícias suas,
						 como depoimentos, vídeos etc. Será disponibilizada em breve.</p>
						
					<div id="caixa-amarela-passo-8" class="caixa-amarela">
						<p>Entre em <a href="contato.php">contato</a> com a Coordenação do Ciência sem Fronteiras. Preencha também
							suas informações na página de <a href="acessobolsistas.php">Acesso ao Bolsista</a></p>
					</div>
				</div>
				
				<div class="margin-geral-itens">
					<span class="lt7">9.</span><span class="lt8"> Relatório Final</span>
					<p class="lt9">Depois de ter aproveitado o seu tempo no exterior, estudando, fazendo estágio e/ou pequisas,
						você deve fazer um relatório para contar sobre a sua experiência no exterior.</p>
						
					<div id="caixa-amarela-passo-8" class="caixa-amarela">
						<p>Contribua, também,
						durante a viagem com vídeos, depoimentos e dicas de viagem para que possamos postar aqui no site
						e mostrar para todos os alunos o quão importante é uma bolsa de graduação Sanduíche pelo 
						Ciência sem Fronteiras!</p>
					</div>
				</div>
				
				
				<div id="links-relacionados">
					<h3>Links relacionados:</h3>
					<li><a href="quemjaviajou.php">Descubra quem já viajou!</a></li>
					<li><a href="dequaiscursos.php">De quais cursos são os alunos que já foram selecionados?</a></li>
				</div>
				
				
				
				</div><!--fecha div total-->
				
				
				
			</div>
			
			<?php require("footer.php");?>
			
		</div>
		
	</body>
</html>