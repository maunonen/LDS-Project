<?php

class  ValInput {
	
	static function int($val, $min = null, $max = null) {
		$val = filter_var($val, FILTER_VALIDATE_INT);
		if ($val === false) {
			return 'The field should be number';
		}  elseif ( 
							!empty( $min) && !empty( $max) && 
							$max > $min && !empty( $val) 
						) { 
			if ( $val < $min && $val > $max){
				return 'The field should be in range ( '. $min. ', ' . $max . ' ).'; 
			}
		return $val;
	}
	}

	static function str($val, $min = '', $max = '') {

		if (!is_string($val)) {
			return 'The field should be string';
		} elseif ( 
							!empty( $min) && !empty( $max) && 
							$max > $min && !empty( $val) 
						) { 
			if ( strlen($val < $min && $val > $max)){
				return 'The field should be in range ( '. $min. ', ' . $max . ' ).'; 
			}
		}

		$val = trim(htmlspecialchars($val));
		return $val;	
		
	}
	
	static function bool($val) {
		$val = filter_var($val, FILTER_VALIDATE_BOOLEAN);
		return $val;
	}

	static function email($val) {
		$val = filter_var($val, FILTER_VALIDATE_EMAIL);
		if ($val === false) {
			return 'The field should be email address';
		}
		return $val;
	}

	static function url($val) {
		$val = filter_var($val, FILTER_VALIDATE_URL);
		if ($val === false) {
			return 'The field should be url address';
		}
		return $val;
	}
}