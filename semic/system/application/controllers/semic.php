<?php
class semic extends Controller {
	var $idioma = 'pt';
	function __construct() {
		parent::__construct();
		//$this -> load -> database();
		//$this -> load -> library('form_validation');
		//$this -> load -> database();
		//$this -> load -> helper('url');
		$this -> load -> library('session');
		/* Recupera Idioma */
		if (isset($_SESSION['idioma']))
		{
			$idioma = $_SESSION['idioma'];
		}else{
			
				$idioma = 'pt';
			} 
		$this->idioma = $idioma;
		
		date_default_timezone_set('America/Sao_Paulo');
	}


	function cab() {

		if ($this -> idioma == 'en') {
			/* Carrega classes adicionais */
		$this -> lang -> load("app", "english");
		}else{
			/* Carrega classes adicionais */
			$this -> lang -> load("app", "portuguese");		
		}

		$css = array();
		$js = array();
		array_push($css, 'style_vegas.css');
		array_push($css, 'style_semic2015.css');
		array_push($js, 'vegas/vegas.min.js');
		array_push($js, 'countdown.js');

		/* transfere para variavel do codeigniter */
		$data['css'] = $css;
		$data['js'] = $js;

		//$id = $this -> session -> userdata('idioma');
		if (isset($_SESSION['idioma'])) {
			$id = $_SESSION['idioma'];
		} else {
			$id = 'pt';
		}

		if (strlen($id) == 0) {
			$id = 'pt';
		}
		$this -> idioma = trim($id);
		$this -> load -> view("semic2015/header", $data);
		
		if ($this -> idioma == 'en') {
			$this -> load -> view('semic2015/menu_top_en');
		}else{
			$this -> load -> view('semic2015/menu_top');
		}
	}

	function en() {
		$some_cookie_array = array('idioma' => 'en');
		//$this -> session -> set_userdata($some_cookie_array);
		$_SESSION['idioma'] = 'en';
		$this -> idioma = 'en';
		$this -> index();
	}

	function pt() {
		$some_cookie_array = array('idioma' => 'pt');
		//$this -> session -> set_userdata($some_cookie_array);
		$_SESSION['idioma'] = 'pt';
		$this -> idioma = 'pt';
		$this -> index();
	}

	function index() {
		$this -> cab();
		$this -> load -> view('semic2015/main_image');
		$data = array();
		
		if ($this -> idioma == 'en') {
			
		$box = array('text' => 'whats_semic', 'link');
		
		$data['content'] = $this -> load -> view('semic2015/box_highlight_en', $box, true);
		$data['content'] .= $this -> load -> view('semic2015/edital_premiacao', $data, true);
		
			$path = $_SERVER['CONTEXT_DOCUMENT_ROOT'];
			$file = $path . '/semic/system/application/views/semic2015/anais/';
			$file .=  'premiacao.php';
			
		if (file_exists($file))
		{
			/* Pagina apresentacao */
			$data['content'] .= '<h1>Trabalhos Premiados - SEMIC 2015</h1>';
			$data['content'] .= '<div class="premios">';
			$data['content'] .= $this -> load -> view('semic2015/anais/premiacao', $data, true);
			$data['content'] .= '</div>';
		}

		/* Pagina apresentacao */
		$data['content'] .= $this -> load -> view('semic2015/presentation_en', $data, true);
		
		/* Menu lateral */
		//$data['content_right'] = $this -> load -> view('semic2015/content_right', $data, true);
		$data['content_right'] = $this -> load -> view('semic2015/menu_edital', $data, true);
			
			}else{
				
						$box = array('text' => 'whats_semic', 'link');
						$data['content'] = $this -> load -> view('semic2015/box_highlight', $box, true);
						$data['content'] .= $this -> load -> view('semic2015/edital_premiacao', $data, true);
						
						$path = $_SERVER['CONTEXT_DOCUMENT_ROOT'];
						$file = $path . '/semic/system/application/views/semic2015/anais/';
						$file .=  'premiacao.php';
			
						if (file_exists($file))
						{
							/* Pagina apresentacao */
							$data['content'] .= '<h1>Trabalhos Premiados - SEMIC 2015</h1>';
							$data['content'] .= '<div class="premios">';
							$data['content'] .= $this -> load -> view('semic2015/anais/premiacao', $data, true);
							$data['content'] .= '</div>';
						}
				
							/* Pagina apresentacao */
							$data['content'] .= $this -> load -> view('semic2015/presentation', $data, true);
							
							/* Menu lateral */
							//$data['content_right'] = $this -> load -> view('semic2015/content_right', $data, true);
							$data['content_right'] = $this -> load -> view('semic2015/menu_edital', $data, true);
			}
			
		$data['layout'] = 2;
		$this -> load -> view('semic2015/content', $data);

		$this -> load -> view('semic2015/footer');
	}

	function summary() {
		$this -> cab();
		
		if ($this -> idioma == 'en') {
		$this -> load -> view('semic2015/main_image_en');
		}else{
			$this -> load -> view('semic2015/main_image');
		}
		$data = array();

		$box = array('text' => 'whats_semic', 'link');
		$this -> load -> view('semic2015/anais/sumario_cloud', $data);
		$this -> load -> view('semic2015/anais/sumario_geral', $data);
		
		
		$this -> load -> view('semic2015/footer');
	}
	
	/* VIEW */
	function view($id)
		{
			$this -> cab();
			$this -> load -> view('semic2015/main_image');
						
			$id = trim($id);
			$path = $_SERVER['SCRIPT_FILENAME'];
			$path = substr($path,0,strpos($path,'index.php'));
			$path .= 'system/application/views/semic2015/anais/';
			$file = $path.$id.'.php';
			
			$data = array();
			
			if (file_exists(($file)))
				{
					$data['content'] = $this->load->view('semic2015/anais/'.trim($id),$data,True);
				} else {
					$data['content'] = $this->load->view('semic2015/anais/not_found',$data,True);
				}
		$this -> load -> view('semic2015/content', $data);
		$this -> load -> view('semic2015/footer');
		}
		
	//Pagina programacao
	function programmation() {
		$this -> cab();
		$this -> load -> view('semic2015/main_image');
		$data = array();
		
		if ($this -> idioma == 'en') {
		/* Programacao */
		$data['content'] = $this -> load -> view('semic2015/programation_en', NULL, true);

		$data['content'] .= $this -> load -> view('semic2015/programation_06_10_en', NULL, true);
		$data['content'] .= $this -> load -> view('semic2015/programation_07_10_en', NULL, true);
		$data['content'] .= $this -> load -> view('semic2015/programation_08_10_en', NULL, true);
		$data['content'] .= $this -> load -> view('semic2015/programation_end', NULL, true);
		//$data['content'] .= $this -> load -> view('semic2015/programation_map', NULL, true);
		
		}else {
			/* Programacao */
			$data['content'] = $this -> load -> view('semic2015/programation', NULL, true);
	
			$data['content'] .= $this -> load -> view('semic2015/programation_06_10_pt', NULL, true);
			$data['content'] .= $this -> load -> view('semic2015/programation_07_10_pt', NULL, true);
			$data['content'] .= $this -> load -> view('semic2015/programation_08_10_pt', NULL, true);
			$data['content'] .= $this -> load -> view('semic2015/programation_end', NULL, true);
			//$data['content'] .= $this -> load -> view('semic2015/programation_map', NULL, true);
			/* Em construcao */
			//$data['content'] .= $this -> load -> view('semic2015/under_construction', NULL, true);
			
			}
		
		$data['layout'] = 1;
		$this -> load -> view('semic2015/content', $data);
		$this -> load -> view('semic2015/footer');
	
	}

	//Pagina duvidas
	function faq() {
		$this -> cab();
		$this -> load -> view('semic2015/main_image');
		$data = array();

		/* Programacao puc cultural */
		$data['content'] = $this -> load -> view('semic2015/faq', NULL, true);

		$data['layout'] = 1;
		$this -> load -> view('semic2015/content', $data);

		$this -> load -> view('semic2015/footer');
	}

	//Pagina instrucoes aos autores
	function instructions() {
		$this -> cab();
		$this -> load -> view('semic2015/main_image');
		$data = array();

		/* Programacao puc cultural */
		$data['content'] = $this -> load -> view('semic2015/instructions', NULL, true);

		$data['layout'] = 1;
		$this -> load -> view('semic2015/content', $data);

		$this -> load -> view('semic2015/footer');
	}

	//Pagina contatos
	function contact() {
		$this -> cab();
		$this -> load -> view('semic2015/main_image');
		$data = array();
		
		if ($this -> idioma == 'en') {
		$data['content'] = $this -> load -> view('semic2015/contact_en', NULL, true);

		}else{
			$data['content'] = $this -> load -> view('semic2015/contact', NULL, true);
		}
		$data['layout'] = 1;
		$this -> load -> view('semic2015/content', $data);

		$this -> load -> view('semic2015/footer');
	}
	
	//Pagina instrucoes aos autores
	function whats_semic() {
		$this -> cab();
		$this -> load -> view('semic2015/main_image');
		$data = array();

		if ($this -> idioma == 'en') {	
			$data['content'] = $this -> load -> view('semic2015/whats_semic_en', NULL, true);
		}else{
			$data['content'] = $this -> load -> view('semic2015/whats_semic', NULL, true);
		}
		
		$data['layout'] = 1;
		$this -> load -> view('semic2015/content', $data);

		$this -> load -> view('semic2015/footer');
	}

	//Pagina edicoes anteriores
	function edicoes_anteriores() {
		$this -> cab();
		$this -> load -> view('semic2015/main_image');
		$data = array();

		if ($this -> idioma == 'en') {
			$data['content'] = $this -> load -> view('semic2015/edicoes-anteriores_en', NULL, true);
		} else {
			$data['content'] = $this -> load -> view('semic2015/edicoes-anteriores', NULL, true);
		}

		$data['layout'] = 1;
		$this -> load -> view('semic2015/content', $data);
		$this -> load -> view('semic2015/footer');
	}
	 
	//Pagina Expediente
	function expedient() {
		$this -> cab();
		$this -> load -> view('semic2015/main_image');
		$data = array();

		if ($this -> idioma == 'en') {
			/* Expediente */
			$data['content'] = $this -> load -> view('semic2015/expedient_en', NULL, true);
		} else {
			/* Expediente */
			$data['content'] = $this -> load -> view('semic2015/expedient', NULL, true);
		}

		$data['layout'] = 1;
		$this -> load -> view('semic2015/content', $data);

		$this -> load -> view('semic2015/footer');
	}
	
	//Pagina programacao Cultural
	function programmation_cult() {
		$this -> cab();
		$this -> load -> view('semic2015/main_image');
		$data = array();

		if ($this -> idioma == 'en') {
			
			/* Programacao Cultural */
			$data['content'] = $this -> load -> view('semic2015/programation_puc_cultural_en', NULL, true);
		
		}else{
			
			/* Programacao Cultural */
			$data['content'] = $this -> load -> view('semic2015/programation_puc_cultural', NULL, true);
		
		}

		$data['layout'] = 1;
		$this -> load -> view('semic2015/content', $data);

		$this -> load -> view('semic2015/footer');
	}	

	//Pagina aviso de manutenção
	function aviso() {
		$this -> cab();
		$this -> load -> view('semic2015/main_image');
		$data = array();
		
		if ($this -> idioma == 'en') {
		/* aviso */
		$data['content'] = $this -> load -> view('semic2015/aviso_en', NULL, true);
		}else{
			$data['content'] = $this -> load -> view('semic2015/aviso', NULL, true);
			
		}

		$data['layout'] = 1;
		$this -> load -> view('semic2015/content', $data);
		$this -> load -> view('semic2015/footer');
	}



}
