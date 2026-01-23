<?php   

class Router {

	private mysqli $db; 
	private array $routes =[]; 
	private array $config; 

	public function __construct(mysqli $db, array $config) {
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
	
	//**********************************************/
  //************* Helper Functions ***************/
  //**********************************************/
	private function allowedMethodsForPath(string $requestPath): array {
		$allowedMethods = []; 
		foreach ($this->routes as $httpMethod => $pathDefinitions) {
			if (isset($pathDefinitions[$requestPath])) {
				$allowedMethods[] = $httpMethod;
			}
		}
		// if GET is allowed HEAD should be allowed to 
		// add HEAD to the allowedMethods if GET is allowed 
		if (in_array('GET', $allowedMethods, true) && !in_array('HEAD', $allowedMethods, true)) {
			$allowedMethods[] = 'HEAD';
		}

		return $allowedMethods;
	}

	private function ensureSession(): void
	{
		if (session_status() === PHP_SESSION_ACTIVE){
			return;
		}

		$session_config = $this->config['session'];
		session_name($session_config['name']);
		session_set_cookie_params([
			'lifetime' => $session_config['cookie_lifetime'],
			'path' => '/',
			'secure' => $session_config['cookie_secure'],
			'httponly' => $session_config['cookie_httponly'],
			'samesite' => $session_config['cookie_samesite'],
		]);
		
		ini_set('session.use_strict_mode', '1');
		session_start(); 
	}

	//*****************************************/
  //******* handleRequest Functions *********/
  //*****************************************/
	public function handleRequest(): void {
		$requestUri = parse_url($_SERVER['REQUEST_URI'] ?? "/", PHP_URL_PATH);    
		$requestUri = rtrim($requestUri, '/') ?: '/';  
		$method = $_SERVER['REQUEST_METHOD']; 

		if($method === 'HEAD') {
			$method = 'GET';
		}

		if(!isset($this->routes[$method][$requestUri])) {
			$allowedMethods = $this->allowedMethodsForPath($requestUri);
			if (!empty($allowedMethods)) {
				// implode converts array to string
				header("Allow: " . implode(",", $allowedMethods));
				http_response_code(405);
				echo "<h1>405 - Method not allowed </h1>";
				return;
			}
			$this->pageNotFound();
			return;
		}

		$route = $this->routes[$method][$requestUri];
		if(!empty($route['auth'])){
			$this->ensureSession();
			if(!isset($_SESSION["user_id"])){
					header("Location: /login", true, 302); 
					exit(); 
				}
		}

		call_user_func($route['callback']);
	}

  //*****************************************/
  //************ GET Functions **************/
  //*****************************************/
	private function loadHomePage(): void{
		$config = $this->config; 
		require_once VIEW_PATH . '/home.php';      
	}
	private function loadFeWo1(): void{ 
		require_once CORE_PATH . '/controller.php';
		$controller = new Controller($this->db, $this->config);
		$controller->renderFeWo(1);
	}
	private function loadFeWo2(): void{
		require_once CORE_PATH . '/controller.php';
		$controller = new Controller($this->db, $this->config);
		$controller->renderFeWo(2);
	}
	private function sendEventsToFrontend(): void{
		require_once CORE_PATH . '/controller.php';
		$controller = new Controller($this->db, $this->config);
		$displayed_month = isset($_GET['month']) ? (int)$_GET['month'] : date("m");
		$displayed_year = isset($_GET['year']) ? (int)$_GET['year'] : date("Y");
		$displayed_flat = isset($_GET['flat']) ? (int)$_GET['flat'] : 1; 
		$controller->handleApiRequest($displayed_year, $displayed_month, $displayed_flat);
	}
	private function loadDashboard(): void {
		$this->ensureSession();
		require_once CORE_PATH . '/controller.php';
		$controller = new Controller($this->db, $this->config);
		$displayed_month = isset($_GET['month']) ? (int)$_GET['month'] : date("m");
		$displayed_year = isset($_GET['year']) ? (int)$_GET['year'] : date("Y");
		$displayed_flat = isset($_GET['flat']) ? (int)$_GET['flat'] : 1; 
		$controller->renderDashboard($displayed_month, $displayed_year, $displayed_flat); 
	}

	private function loadLogin(): void {
		$this->ensureSession();
		if (isset($_SESSION['user_id'])) {
        header('Location: /dashboard', true, 302);
        exit;
    }
		// gucken ob ich das lieber in den Controller packe 
		if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
		$csrfToken = $_SESSION['csrf_token'];
		require_once VIEW_PATH . '/login.php';
	}
	private function loadImpress(): void{
		require_once VIEW_PATH . '/impress.php';
	}

	private function pageNotFound(): void {
		http_response_code(404);
		echo "<h1>404 - Seite nicht gefunden</h1>";
	}

  //*****************************************/
  //************ POST Functions *************/
  //*****************************************/
	private function handleControllerPost(): void{
		require_once CORE_PATH . '/controller.php'; 
		$controller = new Controller($this->db, $this->config);
		$controller->handleFormRequest(); 
	}
	private function handleLoginPost(): void{
		$this->ensureSession(); 
		require_once CORE_PATH . '/controller.php';
		$controller = new Controller($this->db, $this->config);
		$controller->handleLogin();
	}
}