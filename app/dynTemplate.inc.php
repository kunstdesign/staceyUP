<?php
class dynTemplate{
	protected $template;
	protected $variables = array();

	public function __construct($template, $variables = Array()){
		$this->template  = Config::$templates_folder.'/'.$template.'.dyn.php';
		$this->variables = $variables;
	}

	public function __get($key){
		return $this->variables[$key];
	}

	public function __set($key, $value){
		$this->variables[$key] = $value;
	}
	
	public function __toString(){
		extract($this->variables);
		chdir(dirname($this->template));
		ob_start();
	
		include basename($this->template);
	
		return ob_get_clean();
	}
}

?>