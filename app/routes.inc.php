<?php
Class Routes {
	var $url_path;
	var $file_path;
	var $parent_url;
	var $parent_path;
	public $redirected = false;

	
	function __construct($url) {
	  # store url and converted file path
	  $this->url_path   = $url;
	  $this->file_path  = Helpers::url_to_file_path($url);
	  $this->redirected = false;
	  
	  #routes
	  $methods = get_class_methods($this);
	  forEach($methods as $method){
	  	if(strpos($method, 'route_') !== false){
			$this->{$method}();
	  	}
	  }
	  echo $this->redirected;
	}
	
	
	//Controllers:
	# rewrite any calls to /index or /app back to /
	function route_sandbox(){
		
		if(preg_match('/^\/?(index|app)\/?$/', $this->url_path)) {
		  header('HTTP/1.1 301 Moved Permanently');
		  header('Location: ../');
		  $this->redirected = true;
		}
	}
	# add trailing slash if required
	function route_slashes(){
		if(!preg_match('/\/$/', $this->url_path) && !preg_match('/[\.\?\&][^\/]+$/', $this->url_path)){
		  header('HTTP/1.1 301 Moved Permanently');
		  header('Location:'.$this->url_path.'/');
		  
		  $this->redirected = true;
		}
	}
	
	#access to _media.json;
	function route_mediaJSON(){
		if(preg_match('/\/_?media\.json$/', $this->url_path)){
		$url = Array();
		preg_match('/^\/(.*?)\/_?media\.json$/', $this->url_path, $url);
		$this->parent_path = Helpers::url_to_file_path($url[1]);
		$this->file_path   = $this->parent_path.'/_media.json';
			if(file_exists($this->file_path)){
				$content = file_get_contents($this->file_path);
				header('Content-type: application/json; charset=utf-8');
				echo($content);
				$this->redirected = true;
		  		die;
			}
		}
	}
	
	function route_single(){
		$media_match = Array();
		preg_match('/\/(\d+)\/?$/', $this->url_path, $media_match);
		$media_number = $media_match[1];

		$json_file = $this->parent_path.'/_media.json';
		if(file_exists($json_file) && $media_number){
			$filename = false;
			$media_json = Helpers::loadJSON($json_file);
			$is_media = in_array($media_number, $media_json);
			$mediapad = in_array(str_pad($media_number, 8, '0', STR_PAD_LEFT), $media_json);
			
			if($is_media){
				$filename = $media_number;
			}else if($mediapad){
				$filename = str_pad($media_number, 8, '0', STR_PAD_LEFT);
			}
			if($filename){
				$view = new dynTemplate("single");
				$view->imgSrc = $filename;
				echo $view;
				die;	
			}
		}
	}
}

?>