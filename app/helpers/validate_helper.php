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

	static function phonenumber ( $phonenumber) {
		$phoneNumbeRegExp = '/^\d{6,14}$/';
		return  preg_match( $phoneNumbeRegExp, $phonenumber ); 
	}

	static function hetu ( $hetu) {
		$hetuRegExp = '/^(0[1-9]|[12]\d|3[01])(0[1-9]|1[0-2])([5-9]\d\+|\d\d-|[01]\dA)\d{3}[\dABCDEFHJKLMNPRSTUVWXY]$/'; 
		return  preg_match( $hetuRegExp, $hetu ); 
	}

	static function date($date, $format = 'Y-m-d'){
		
		$d = DateTime::createFromFormat($format, $date);
    // return date if Datetime class return date other return false 
    return $d && $d->format($format) === $date;
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