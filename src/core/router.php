<?php   

class Router {

	private $db; 
	private $routes =[]; 
	private $config; 

	public function __construct($db, $config){
		$this->db = $db;
		$this->config = $config; 
		$this->routes = [
			'GET' => [
				'/' => ['callback' => [$this, 'loadHomePage'],'auth' => false],
				'/home' => ['callback' => [$this, 'loadHomePage'],'auth' => false],
				'/dashboard' => ['callback' => [$this, 'loadDashboard'],'auth' => true],
				'/login' => ['callback' => [$this, 'loadLogin'],'auth' => false],
				'/fewo1' => ['callback' => [$this, 'loadFeWo1'],'auth' => false],
				'/fewo2' => ['callback' => [$this, 'loadFeWo2'],'auth' => false],
				'/impressum' => ['callback' => [$this, 'loadImpress'],'auth' => false],
				'/api/events' => ['callback' => [$this, 'sendEventsToFrontend'], 'auth' => false],
			],
			'POST' => [
				'/controller' => ['callback' => [$this, 'handleControllerPost'],'auth' => true],
				'/login' => ['callback' => [$this, 'handleLoginPost'], 'auth' => false]
			]
		];
	}

	
	// prüft, welche HTTP-Methoden für einen bestimmten Pfad in deinem Router erlaubt sind.
	private function allowedMethodsForPath(string $requestPath): array {
		$allowedMethods = []; 
		foreach ($this->routes as $httpMethod => $pathDefinitions) {
			if (isset($pathDefinitions[$requestPath])) {
				$allowedMethods[] = $httpMethod;
			}
		}
		return $allowedMethods;
	}

	public function handleRequest() {
		// Routing wird mit URI-basiert umgesetzt
		// Pfad wird aus der ULR extrahiert
		$requestUri = parse_url($_SERVER['REQUEST_URI'] ?? "/", PHP_URL_PATH);      
		$method = $_SERVER['REQUEST_METHOD']; 
		// array_key_exists gibt true oder false zurück 
		// call_user_func hilft die Funktionenen dynamisch aufzurufen 
		if (isset($this->routes[$method][$requestUri])) {
			$route = $this->routes[$method][$requestUri];
			if($route['auth']){
				if(session_status() === PHP_SESSION_NONE){
					session_start(); 
				}
				if(!isset($_SESSION["user_id"])){
					header("Location: /login", true); 
					exit(); 
				}
			}     
			call_user_func($route['callback']);
		} else {
			$allowedMethods = $this->allowedMethodsForPath($requestUri);
			if (!empty($allowedMethods)) {
				// implode verbindet ein array zu einem String
				header("Allow: " . implode(",", $allowedMethods));
				http_response_code(405);
				echo "<h1>105 - Method not allowed </h1>";
			} else {
				$this->pageNotFound();
			}
		}
	}

	// GET Funktionen 
	private function loadHomePage(){
		$config = $this->config; 
		require_once VIEW_PATH . '/home.php';      
	}
	private function loadFeWo1(){
		require_once CORE_PATH . '/controller.php';
		$controller = new Controller($this->db, $this->config);
		$controller->renderFeWo(1);
	}
	private function loadFeWo2(){
		require_once CORE_PATH . '/controller.php';
		$controller = new Controller($this->db, $this->config);
		$controller->renderFeWo(2);
	}
	private function sendEventsToFrontend(){
		require_once CORE_PATH . '/controller.php';
		$controller = new Controller($this->db, $this->config);
		$displayed_month = isset($_GET['month']) ? (int)$_GET['month'] : date("m");
		$displayed_year = isset($_GET['year']) ? (int)$_GET['year'] : date("Y");
		$displayed_flat = isset($_GET['flat']) ? (int)$_GET['flat'] : 1; 

		$controller->handleApiRequest($displayed_year, $displayed_month, $displayed_flat);
	}
	private function loadDashboard() {
		require_once CORE_PATH . '/controller.php';
		$controller = new Controller($this->db, $this->config);
		// holt den anzuzeigenden Monat und Jahr aus den Pfad
		// wenn keiner angegeben dann wird der aktuelle an renderDashboard übergeben 
		$displayed_month = isset($_GET['month']) ? (int)$_GET['month'] : date("m");
		$displayed_year = isset($_GET['year']) ? (int)$_GET['year'] : date("Y");
		$displayed_flat = isset($_GET['flat']) ? (int)$_GET['flat'] : 1; 
		$controller->renderDashboard($displayed_month, $displayed_year, $displayed_flat); 
	}

	private function loadLogin() {
		require_once VIEW_PATH . '/login.php';
	}
	private function loadImpress(){
		require_once VIEW_PATH . '/impress.php';
	}

	private function pageNotFound() {
		http_response_code(404);
		echo "<h1>404 - Seite nicht gefunden</h1>";
	}

	// POST Funktionen 
	private function handleControllerPost(){
		require_once CORE_PATH . '/controller.php'; 
		$controller = new Controller($this->db, $this->config);
		$controller->handleFormRequest(); 
	}
	// hier müsste noch logik für den login gemacht werden vllt in einer login.php
	private function handleLoginPost(){
		require_once CORE_PATH . '/controller.php';
		$controller = new Controller($this->db, $this->config);
		$controller->handleLogin();
	}
}