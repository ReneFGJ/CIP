<?php
if (!function_exists(('msg')))
	{
		function msg($t)
			{
				$CI = &get_instance();
				if (strlen($CI->lang->line($t)) > 0)
					{
						return($CI->lang->line($t));
					} else {
						return($t);
					}
			}
	}

$lang['versao'] = 'v0.15.25';

/****************************** AVALIADORES */
$lang['desactive'] = 'desativar';
$lang['active'] = 'ativar';
$lang['avaliador'] = 'avaliador';
$lang['desativar_como_avaliador'] = 'desativar avaliador';
$lang['ativar_como_avaliador'] = 'ativar como avaliador';
$lang['active_area'] = 'Ativar área';
$lang['add_area'] = 'Incorporado área';

$lang['add_area'] = 'Incorporado área';
$lang['aceitar_avaliacao'] = 'ACEITAR';
$lang['recusar_avaliacao'] = 'RECUSAR';
$lang['recusar_avaliacao_confirma'] = 'GRAVAR RECUSA >>';


/*****************************************************************/
$lang['page_docentes'] = 'Docentes';
$lang['page_avaliadores'] = 'Avaliadores';
$lang['page_discente'] = 'Discentes';
$lang['Vigencia'] = 'Vigência';
$lang['Orientador'] = 'Orientador';

$lang['back'] = 'voltar';

$lang['pt_BR'] = 'Português';
$lang['en'] = 'Inglês';
$lang['Orientador'] = 'Orientador';
$lang['Areas'] = 'Áreas';
$lang['area_nao_definida'] = 'Área não definida';

$lang['email_modificar'] = 'Atualizar e-mail';
$lang['email_excluir'] = 'Excluir e-mail';
$lang['email_adicionar'] = 'Adicionar e-mail';
$lang['email_sem'] = 'Sem e-mail';
$lang['email_ok'] = 'E-mail ok';

/**%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%**/
/* Ciencia sem fronteiras */
$lang['csf_bt_cancelar'] 			= 'Cancelar processo';
$lang['csf_bt_homologar_no'] 		= 'Não homologado';
$lang['csf_bt_homologar'] 			= 'Homologado pela Instituição';
$lang['csf_bt_homologar_capes_no'] 	= 'Não homologado pela CAPES/CNPq';
$lang['csf_bt_homologar_capes'] 	= 'Homologação da CAPES/CNPq';
$lang['csf_bt_homologar_parceiro'] 	= 'Aceite do Parceiro';
$lang['csf_bt_desistente'] 			= 'Desistente';
$lang['csf_bt_viagem'] 				= 'Saída do Brasil';
$lang['csf_bt_fim_viagem'] 			= 'Retorno ao Brasil';
$lang['csf_bt_troca_universidade'] 	= 'Troca de Univerisdade';
$lang['csf_bt_troca_pais'] 			= 'Troca de país';
$lang['scf_historico'] 				= 'Histórico';
$lang['csf_bt_retorno'] 			= 'Retorno antecipado';
$lang['last_harvesting'] 			= 'Última coleta';

/**%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%**/
/* Grupos de Pesquisa */
$lang['gp_situacao'] 				= 'Situação';
$lang['espelho_cnpq'] 				= 'Espelho (DGP)';
$lang['gp_ano_formacao'] 			= 'Ano de formação';
$lang['gp_instituicao_grupo'] 		= 'Instituíção';
$lang['gp_cidade'] 					= 'Cidade';
$lang['gp_data'] 					= 'Dados do grupo';
$lang['csf_title_novo'] 			= 'Novo registro de aluno - CSF';
$lang['nome_linha'] 				= 'Nome da linha de pesquisa';
$lang['dgp_pesquisadores'] 			= 'Pesquisadores';
$lang['dgp_estudantes'] 			= 'Estudantes';
$lang['dgp_espelho'] 				= 'Link do CNPq';
$lang['last_update'] 				= 'Atualizado CNPq';
$lang['gpus_cnpq_nome'] 			= 'nome';
$lang['dgp_linhas'] 				= 'Linhas de pesquisa';
$lang['gpus_titulacao_max'] 		= 'Titulação';
$lang['gpus_dt_inclusao'] 			= 'Dt. Inclusão';
$lang['dgp_membros'] 				= 'Membros do Grupo';


/* Ciencia sem fronteiras Parceiros */
$lang['Label_csf_descricao_parceiro'] = 'Parceiro';
$lang['Label_csf_nome_pais_parceiro'] = 'Pais';
$lang['Label_csf_ativo_parceiro'] 	  = 'Status';
$lang['Label_csf_contato_parceiro']   = 'Contato';
$lang['Label_csf_email1_parceiro']    = 'E-mail 1';
$lang['Label_csf_email2_parceiro']    = 'E-mail 2';
$lang['Label_csf_phone1_parceiro']    = 'Fone 1';
$lang['Label_csf_phone2_parceiro']    = 'Fone 2';
$lang['Label_csf_site_parceiro']      = 'Site';
$lang['Label_index_parceiros'] 	  	  = 'Lista de parceiros';
$lang['Label_editar_parceiros'] 	  = 'Editar parceiro';
$lang['Label_csf_edital'] 	  		  = 'Edital';


/*Fomento*/
$lang['fm_titulo'] 			= 'Nome da chamada';
$lang['fm_titulo_email'] 	= 'Titulo do e-mail(opcional)';
$lang['fm_agencia'] 		= 'Agência';
$lang['fm_idioma'] 			= 'Idioma';
$lang['fm_chamada'] 		= 'Chamada';
$lang['fm_status'] 			= 'Status';
$lang['fm_autor'] 			= 'Responsável (LOGIN)';
$lang['fm_corpo'] 			= 'Corpo';
$lang['fm_url_externa'] 	= 'Link da chamada';
$lang['fm_total_visualizacoes'] = 'Total de visualizações';
$lang['fm_local'] 			= 'Local';
$lang['fm_disseminador'] 	= 'Disseminador';
$lang['fm_tipo_edital'] 	= 'Tipo de edital';
$lang['fm_fluxo_continuo'] 	= 'Fluxo continuo';
$lang['fm_assinatura'] 		= 'Requer assinatura de documento';
$lang['fm_login'] 			= 'Responsável (LOGIN)';
$lang['fm_texto_1'] 		= 'Objetivo(s)';
$lang['fm_texto_2'] 		= 'Recursos';
$lang['fm_texto_3'] 		= 'Elegibilidade';
$lang['fm_texto_4'] 		= 'Contato';
$lang['fm_texto_5'] 		= '';
$lang['fm_texto_6'] 		= 'Áreas e categorias';
$lang['fm_texto_7'] 		= '';
$lang['fm_texto_8'] 		= '';
$lang['fm_texto_9'] 		= '';
$lang['fm_texto_10'] 		= '';
$lang['fm_texto_11'] 		= 'Submissão da proposta';
$lang['fm_texto_12'] 		= 'Contato na instituição';
$lang['fm_data_01'] 		= 'Deadline para submissão da proposta';
$lang['fm_data_02'] 		= 'Deadline (envio da documentação)';
$lang['fm_data_03'] 		= 'Previsão de divulgação dos resultados';
$lang['fm_data_04'] 		= '';
$lang['fomento_editais'] 	= 'Editais de fomento';
$lang['title_fomento_editais'] = 'Editais de fomento';


/* Idiomas */
$lang['Label_idioma_nome'] 			= 'Nome do idioma';
$lang['Label_idioma_ativo'] 		= 'Status';
$lang['Label_idioma_codificacao']	= 'Codificação';
$lang['Label_index_idioma'] 	  	= 'Lista de idiomas';
$lang['Label_editar_idioma'] 	  	= 'Editar idioma';


/* Perfis */
$lang['Label_perfil_codigo'] 	= 'Código';
$lang['Label_perfil_descricao'] = 'Descrição';
$lang['Label_perfil_status']	= 'Status';
$lang['Label_index_perfil'] 	= 'Lista de perfis';
$lang['Label_editar_perfil'] 	= 'Editar perfil';


/* Unidades */
$lang['Label_unidade_descricao'] 	= 'Unidade';
$lang['Label_unidade_sigla'] 		= 'Sigla';
$lang['Label_unidade_decano'] 		= 'Decano';
$lang['Label_unidade_status']		= 'Status';
$lang['Label_index_unidade'] 		= 'Lista de unidades';
$lang['Label_editar_unidade'] 		= 'Editar unidade';


/* Instituições */
$lang['Label_instituicao_nome'] 		= 'Nome';
$lang['Label_instituicao_sigla'] 		= 'Sigla';
$lang['Label_instituicao_uf'] 			= 'UF';
$lang['Label_instituicao_rzsocial']		= 'Razão Social';
$lang['Label_instituicao_cnpj'] 		= 'CNPJ';
$lang['Label_instituicao_natjuridica']	= 'Natureza Juridica';
$lang['Label_instituicao_faixapo'] 		= 'Faixa po';
$lang['Label_instituicao_cidade'] 		= 'Cidade';
$lang['Label_instituicao_ativeconomic'] = 'Atividade Econômica';
$lang['Label_instituicao_latitude'] 	= 'Latitude';
$lang['Label_instituicao_longitude'] 	= 'Longitude';
$lang['Label_instituicao_use'] 			= 'Use';
$lang['Label_instituicao_ordem'] 		= 'Ordem';
$lang['Label_index_instituicao'] 		= 'Lista de instituições';
$lang['Label_editar_instituicao'] 		= 'Editar instituicao';


/* Paises */
$lang['Label_csf_pais'] 	= 'Nome do país';
$lang['Label_csf_iso'] 		= 'Codigo Iso3';
$lang['Label_csf_cod_iso'] 	= 'Código Numerico';

/**%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%**/
/**              ADMINISTRATIVOS                                      **/
/**%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%**/
/* Nome do mes */
$lang['mes_01'] = 'Janeiro';
$lang['mes_02'] = 'Fevereiro';
$lang['mes_03'] = 'Março';
$lang['mes_04'] = 'Abril';
$lang['mes_05'] = 'Maio';
$lang['mes_06'] = 'Junho';
$lang['mes_07'] = 'Julho';
$lang['mes_08'] = 'Agosto';
$lang['mes_09'] = 'Setembro';
$lang['mes_10'] = 'Outubro';
$lang['mes_11'] = 'Novembro';
$lang['mes_12'] = 'Dezembro';
/* Nome do mes abreviados*/
$lang['mes_01a'] = 'JAN.';
$lang['mes_02a'] = 'FEV.';
$lang['mes_03a'] = 'MAR.';
$lang['mes_04a'] = 'ABR.';
$lang['mes_05a'] = 'MAIO';
$lang['mes_06a'] = 'JUN.';
$lang['mes_07a'] = 'JUL.';
$lang['mes_08a'] = 'AGO.';
$lang['mes_09a'] = 'SET.';
$lang['mes_10a'] = 'OUT.';
$lang['mes_11a'] = 'NOV.';
$lang['mes_12a'] = 'DEZ.';

/* Cabecalho */
$lang['cab_update'] = 'Atualizar dados';
$lang['cab_expediente_01'] = 'Pró-Reitoria de Pesquisa';
$lang['cab_expediente_02'] = 'Diretoria de Pós-Graduação Stricto Sensu';
$lang['cab_expediente_03'] = 'Diretoria de Pesquisa';
$lang['cab_expediente_04'] = 'Centro Integrado de Pesquisa';
$lang['cab_expediente_05'] = 'Observatório';
$lang['cab_expediente_06'] = 'Iniciação Científica';
$lang['cab_expediente_07'] = 'Fundo de Pesquisa';
$lang['cab_expediente_08'] = 'Comitê de Ética com Seres Humanos (CEP)';
$lang['cab_expediente_09'] = 'Comitê de Ética no Uso de Animais (CEUA)';
$lang['cab_expediente_10'] = 'Biotério';

/* Botoes de Formulário*/
$lang['bt_update'] = 'ATUALIZAR';
$lang['bt_salvar_continuar'] = 'Salvar e continuar >>>';
$lang['busca'] = 'BUSCA';


/* Atores do sistema */
$lang['titulacao'] = 'titulação';
$lang['link_lattes'] = 'link para o Lattes';

$lang['cab_admin'] = 'Administração';
$lang['cab_logout'] = 'Sair';

$lang['fast_search'] = 'Deseja fazer uma busca rápida?';
$lang['fast_search_place'] = 'Procure por assuntos, pesquisadores, pesquisas... ';

$lang['title_admin'] = 'Usuários do sistema';

$lang['about_expediente'] = 'Expediente';

/* LOGIN */
$lang['login_entrar'] = 'ENTRAR';
$lang['login_name'] = 'Login de rede';
$lang['login_password'] = 'Senha';
$lang['login_versao'] = 'versão';

$lang['login_erro_01'] = 'Login ou senha incorreta';

/* Rodape */
$lang['about_sistem'] = 'Sobre o CIP';
$lang['contact_sistem'] = 'Contato';
/**%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%**/
/**%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%**/
?>
