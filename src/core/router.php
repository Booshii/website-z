<?php   

    class Router {

        private $db; 
        private $routes =[]; 
        public $requestUri = '/'; 

        public function __construct($db){
            $this->db = $db;
            $this->routes = [
                'GET' => [
                    '/' => ['callback' => [$this, 'loadHomePage'],'auth' => false],
                    '/home' => ['callback' => [$this, 'loadHomePage'],'auth' => false],
                    '/dashboard' => ['callback' => [$this, 'loadDashboard'],'auth' => true],
                    '/login' => ['callback' => [$this, 'loadLogin'],'auth' => false],
                ],
                'POST' => [
                    '/controller' => ['callback' => [$this, 'handleControllerPost'],'auth' => true],
                ]
            ];
        }
        private function allowedMethodsForPath(string $requestPath): array {
            $allowedMethods = []; 
            foreach ($this->routes as $httpMethod => $pathDefinitions) {
                if (isset($pathDefinitions[$requestPath])) {
                    $allowedMethods[] = $httpMethod;
                }
            return $allowedMethods;
        }

        public function handleRequest() {

            // Routing wird mit URI-basiert umgesetzt
            // Pfad wird aus der ULR extrahiert
            $this->requestUri = parse_url($_SERVER['REQUEST_URI'] ?? "/", PHP_URL_PATH);
            
            $method = $_SERVER['REQUEST_METHOD']; 
            
            // array_key_exists gibt true oder false zurück 
            // call_user_func hilft die Funktionenen dynamisch aufzurufen 
            if (isset($this->routes[$method][$this->requestUri])) {
                $route = $this->routes[$method][$this->requestUri];

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
                $allowedMethods = $this->allowedMethodsForPath($path);
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

        private function loadHomePage(){
            require_once '/var/www/html/website-z/src/views/home.php';      
        }
        private function loadDashboard() {
            require_once '/var/www/html/website-z/src/controller.php';
            $controller = new Controller($this->db);
            // holt den anzuzeigenden Monat und Jahr aus den Pfad
            // wenn keiner angegeben dann wird der aktuelle an renderDashboard übergeben 
            $displayed_month = isset($_GET['month']) ? (int)$_GET['month'] : date("m");
            $displayed_year = isset($_GET['year']) ? (int)$_GET['year'] : date("Y");
            $displayed_flat = isset($_GET['flat']) ? (int)$_GET['flat'] : 1; 
            $controller->renderDashboard($displayed_month, $displayed_year, $displayed_flat); 
        }
        private function loadLogin() {
            require_once VIEW_URL . '/login.php';
        }
        private function pageNotFound() {
            http_response_code(404);
            echo "<h1>404 - Seite nicht gefunden</h1>";
        }

        // POST Funktionen 

        private function handleControllerPost(){
            require_once '/var/www/html/website-z/src/controller.php'; 
            $controller = new Controller($this->db);
            $controller->handleFormRequest(); 
        }



        // hier müsste noch logik für den login gemacht werden vllt in einer login.php

    }