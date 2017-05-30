<?

/**
* API request entry
*/
class API extends Base
{

	private $module  = null;
	
	function __construct()
	{
		if(isset($_SERVER['PATH_INFO']) && $_SERVER['PATH_INFO'] != '/'){
			$url = explode('/', $_SERVER['PATH_INFO']);
			
			$action = ucfirst($url[1]);	
			
			if(class_exists($action)){
				$method = 'rest' . ucfirst(strtolower($_SERVER['REQUEST_METHOD']));
				$actionStores = new actionStores(new simpleModuleFactory());
				$actionStores->handlerRequest($action, $method);
			}else{
				self::errorResponse(503, "can't find service")
			}	
		}
	}

}

interface RESTfulInterface {
	public function restGet($url);
	public function restPost($url);
	public function restPut($url);
	public function restDelete($url);
}


class actionStores 
{
	private SimpleModuleFactory $_factory;

	function __construct($pf){
		$this->_factory = $pf;
	}

	function handlerRequest($action, $method, $params){
		$module = $this->_factory->createModule($action);

		$module->handlerRequest($method, $params);
	}
}

/**
* 
*/
class simpleModuleFactory 
{
	function createModule($action){
		switch ($action) {
			case 'user':
				return new User();			
			case 'gcalendar':
				# code...
				break;
		}
	}
}

/**
* user's Information
*/
class User extends APIBase implements RESTfulInterface
{

	function restGet($params)
	{
		if($params){
			if($params == 'Dustin'){
				echo "Hi master";
			}else{
				self::errorResponseForResourceNotFund();
			}
		}else{
			self::errorResponseForEmptyParam();
		}
	}

	function restPost($params){
		if($params){
			echo "new user {$params}";
		}
	}

	function restPut($params){
		if($params){
			echo "update user {$params}";
		}
	}

	function restDelete($params){
		if($params){
			echo "delete user {$params}";
		}
	}
}

class APIBase extends Base{
	function handlerRequest($method, $params){
		if(method_exists(self, $method)){
			$this->$method($params);
		}else{
			self::errorResponse(405, 'Method not Allowed!');
		}
	}

	static function errorResponseForEmptyParam(){
		self::errorResponse(503, 'Service Unavailable');
	}

	static function errorResponseForResourceNotFund(){
		self::errorResponse(404, 'Not found');
	}
}

/**
* 
*/
class Base
{
	
	static function errorResponse($statusCode, $erroMessage){
		header("HTTP/1.0 {$statusCode} {$erroMessage}");
		echo "{$statusCode} {$erroMessage}";
	}
}