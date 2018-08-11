<?php 

/**
 * 
 */
class Router extends App {
	private $router;

	function __construct(){
		$this->router = new \Klein\Klein();
	}

	public function routes(){

		$this->tempDir(); //********  Base Route  ****************


		$this->router->respond('GET', '/?', function ($request) {
			$this -> view('layout/header');
	    	$this->controller('Home');
	    	$this -> view('layout/footer');
		});



		$this->router->respond(array('GET','POST'), '/login', function () {
		    $this -> view('layout/header');
	    	$this->controller('Login');
	    	$this -> view('layout/footer');
		});





		$this->router->respond(array('GET','POST'), '/admin', function () {
		   	$this -> view('layout/header');
	    	$this->controller('Admin');
	    	$this -> view('layout/footer');
		});


		$this->router->respond(array('GET','POST'),'/admin/[:page]', function ($request) {
			$this -> view('layout/header');
	    	$this->controller('Admin',$request->page);
	    	$this -> view('layout/footer');
		});

		$this->router->respond(array('GET','POST'), '/manager', function () {
		   	$this -> view('layout/header');
	    	$this->controller('Manager');
	    	$this -> view('layout/footer');
		});

		$this->router->respond(array('GET','POST'),'/manager/[:page]', function ($request) {
			$this -> view('layout/header');
	    	$this->controller('Manager',$request->page);
	    	$this -> view('layout/footer');
		});


		$this->router->respond(array('GET','POST'),'/ajax/[:page]', function ($request) {
	    	$this->controller('Ajax',$request->page);
	    });

		$this->router->respond(array('GET','POST'),'/excel/[:page]', function ($request) {
	    	$this->controller('Excel',$request->page);
	    });


		$this->router->respond(array('GET','POST'), '/dashboard', function () {
			$this -> view('layout/header');
	    	$this->controller('Dashboard');
	    	$this -> view('layout/footer');
		});

		$this->router->respond(array('GET','POST'), '/dashboard/[:page]', function ($request) {
			$this -> view('layout/header');
	    	$this->controller('Dashboard',$request->page);
	    	$this -> view('layout/footer');
		});

		$this->router->respond('GET', '/hello-world', function () {
		    return 'Hello World!';
		});

		$this->router->respond('GET', '/logout', function () {
		    session_destroy();
			$this->redirect('login');
		});
		

		$this->router->respond('GET', '/abc', function () {
		    return 'Hello World abc!';
		});

		$this->router->onHttpError(function ($code, $router) {
		    switch ($code) {
		        case 404: {
		        	$this -> view('layout/header');
				 	$this -> view('pages/404'); 	
				 	$this -> view('layout/footer');
				 	break;
		        }
		            
		        case 405:
		            $router->response()->body(
		                'You can\'t do that!'
		            );
		            break;
		        default:
		            $router->response()->body(
		                'Oh no, a bad error happened that caused a '. $code
		            );
		    }
		});	

		$this->router->dispatch();
	}

		public function tempDir( )
	{
 
		 $this->router->respond(array('POST','GET'), '/404', function () {
		 	$this -> view('layout/header');
		 	$this -> view('pages/404'); 	
		 	$this -> view('layout/footer');
		});

 

	}

	



}