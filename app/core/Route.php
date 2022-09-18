<?php 

use Illuminate\Database\Capsule\Manager as Capsule;

class Route {
	protected static $routes = [];

	public static function url($path, $views) {
		return self::$routes[str_replace("/", "/", trim($path, "/"))] = $views;
	}

	protected function getView($view) {
		return VIEW_PATH . $view . ".php";
	}

	protected function getPath() {
		$path = str_replace("/", "/", trim($_SERVER["REQUEST_URI"] ?? "/", "/"));
		$position = strpos($path, "?");

		if($position === false) {
			return $path;
		}
		
		return substr($path, 0, $position);
	}

	public function resolve() {
		Capsule::table("online")->where("terakhir_dilihat", "<=", time() - 120)->delete();

		$guest_pages = [""];
	    $auth_pages = ["login", "registrasi"];
	    
	    if(in_array($this->getPath(), $auth_pages)) {
	        if(isset($_SESSION["is_login"])) {
	            if($_SESSION["type"] == "pengguna") {
	                return header("Location: /dashboard");
	            } else {
	                return header("Location: /u/anggota/dashboard");
	            }
	        } 
	    } elseif(explode("/", $this->getPath())[0] == "api") {
			return require_once $this->getView(self::$routes[$this->getPath()]);
	    }
	     elseif (in_array($this->getPath(), $guest_pages)) {
			return require_once $this->getView(self::$routes[$this->getPath()]);
	    } 
	     else {
	         if(!isset($_SESSION["is_login"])) {
	            return header("Location: /login");
	        }
	    }

		if(file_exists($this->getView(self::$routes[$this->getPath()]))) {
			return require_once $this->getView(self::$routes[$this->getPath()]);
		} else {
			return require_once $this->getView("error/404");
		}
	}
}