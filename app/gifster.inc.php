<?php

Class Gifster {
#gifster specific functions
	static function list_media($dir){
		$aa = Helpers::list_files($dir, '/(?<!thumb|_lge|_sml)\.(gif|jpg|jpeg)$/i', false);
		$a = [];
		foreach ($aa as $key => $value){
			$parts = explode('.', $key);
			if(!is_array($parts)){continue;}
			
			$name = $parts[0];
			$ext  = $parts[1];
			$extL = strtolower($ext);
			
			if($extL == 'jpeg' || $extL == 'jpg' || $extL == 'gif'){
				$type = false;
				
					 if($extL == 'gif' ){$type = "GIF";}
				else if($extL == 'jpg' ){$type = "JPG";}
				else if($extL == 'jpeg'){$type = "JPG";}
				else                    {continue;     }
				
				//set Array
				if(!isset($a[$name])){$a[$name] = [];}
				
				$a[$name]['name'] = $name;
				$a[$name][$type]  = $ext;
				
				$a[$name][$type.'_src'] = Asset::link_path($dir.'/'.$name.'.'.$ext);
				
				$a[$name]['slug'] = $name;
				$a[$name]['link'] = '/'.Helpers::file_path_to_url($dir).'/'.$name.'/';
				
				//array_push($a[$parts[0]], $parts[1]);
			}
		}
		
		$b = array_filter($a, function($val){
			if(!is_array($val)){return false;}
			$JPG = isset($val['JPG']);
			$GIF = isset($val['GIF']);
			return $JPG && $GIF;
		});
		natcasesort($b);
		return $b;
	}
	
	static function Media($gifster_assets){
	  return Helpers::duplicates( Helpers::fileNames(array_keys($gifster_assets)) );
	}
	
	static function mediaJSON($route, $gifster_assets){
	  $data = self::Media($gifster_assets);
	  return Helpers::write_JSON($route, $data);
	}

}

?>
