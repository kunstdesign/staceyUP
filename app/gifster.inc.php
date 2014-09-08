<?php

Class Gifster {
#gifster specific functions
	
	static function Media($gifster_assets){
	  return Helpers::duplicates( Helpers::fileNames(array_keys($gifster_assets)) );
	}
	
	static function mediaJSON($route, $gifster_assets){
	  $data = self::Media($gifster_assets);
	  return Helpers::write_JSON($route, $data);
	}

}

?>
