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

		date_default_timezone_set('America/Sao_Paulo');
	}

	function cab() {

		/* Carrega classes adicionais */
		$this -> lang -> load("app", "portuguese");

		$css = array();
		$js = array();
		array_push($css, 'style_vegas.css');
		array_push($css, 'style_semic2015.css');
		array_push($js, 'vegas/vegas.min.js');
		//array_push($js, 'zepto.min.js');

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
		$this -> load -> view('semic2015/menu_top');

	}

	//Pagina programacao
	function programmation() {
		$this -> cab();
		$this -> load -> view('semic2015/main_image');

		$data = array();

		/* Programacao */
		//$data['content'] = $this -> load -> view('semic2015/programation', NULL, true);

		/* Em construcao */
		//$data['content'] .= $this -> load -> view('semic2015/under_construction', NULL, true);

		/* Programacao puc cultural */
		$data['content'] = $this -> load -> view('semic2015/programation_puc_cultural', NULL, true);

		/* Programacao Cientifica */
		//$data['content'] = $this -> load -> view('semic2015/programation_puc_cientifica', NULL, true);

		$data['layout'] = 1;
		$this -> load -> view('semic2015/content', $data);

		$this -> load -> view('semic2015/footer');
	}

	function index() {
		$this -> cab();
		$this -> load -> view('semic2015/main_image');

		$data = array();

		$box = array('text' => 'whats_semic', 'link');
		$data['content'] = $this -> load -> view('semic2015/box_highlight', $box, true);

		/* Em construcao */
		$data['content'] .= $this -> load -> view('semic2015/under_construction', NULL, true);

		/* Menu lateral */
		$data['content_right'] = $this -> load -> view('semic2015/content_right', NULL, true);
		$data['content_right'] .= $this -> load -> view('semic2015/menu_edital', NULL, true);

		$data['layout'] = 2;
		$this -> load -> view('semic2015/content', $data);

		$this -> load -> view('semic2015/footer');
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

}
