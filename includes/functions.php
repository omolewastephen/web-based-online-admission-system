<?php
ob_start();
	function mysql_prep( $value ) {
		$magic_quotes_active = get_magic_quotes_gpc();
		$new_enough_php = function_exists( "mysql_real_escape_string" ); // i.e. PHP >= v4.3.0
		if( $new_enough_php ) { // PHP v4.3.0 or higher
			// undo any magic quote effects so mysql_real_escape_string can do the work
			if( $magic_quotes_active ) { $value = stripslashes( $value ); }
			$value = mysql_real_escape_string( $value );
		} else { // before PHP v4.3.0
			// if magic quotes aren't already on then add slashes manually
			if( !$magic_quotes_active ) { $value = addslashes( $value ); }
			// if magic quotes are active, then the slashes already exist
		}
		return $value;
	}

	function redirect_to($location=NULL) {
		if ($location != NULL) {
			header("Location: {$location}");
			exit;
		}
	}

	function confirm_query($result_set) {
		if (!$result_set) {
			die("Database query failed ".mysql_error());
		}
	}

	function get_all_page() {
		global $connection;
		$query = "SELECT * 
				FROM pages 
				ORDER BY position ASC";
        $page_set = mysql_query($query, $connection);
       	confirm_query($page_set);
       	return $page_set;
	}

		function getstd($id) {
		global $connection;
		$query = "SELECT * 
				FROM students 
				WHERE id = '$id' ";
        $user = mysql_query($query, $connection);
       	confirm_query($user);
       	if($page_array = mysql_fetch_array($user)) {
       		return $page_array;
       	} else {
       		return NULL;
       	}
	}

	function getlocal($id) {
		global $connection;
		$query = "SELECT * 
				FROM locals 
				WHERE local_id = '$id' ";
        $user = mysql_query($query, $connection);
       	confirm_query($user);
       	if($page_array = mysql_fetch_array($user)) {
       		return $page_array;
       	} else {
       		return NULL;
       	}
	}

	function getstate($id) {
		global $connection;
		$query = "SELECT * 
				FROM states 
				WHERE state_id = '$id' ";
        $user = mysql_query($query, $connection);
       	confirm_query($user);
       	if($page_array = mysql_fetch_array($user)) {
       		return $page_array;
       	} else {
       		return NULL;
       	}
	}

	function get_all_page_by_id($page_id) {
		global $connection;
		$query =  "SELECT * ";
		$query .= "FROM pages";
		$query .= " WHERE id = {$page_id} ";
		$query .= "LIMIT 1";
        $page_set = mysql_query($query, $connection);
       	confirm_query($page_set);
       	if($page_array = mysql_fetch_array($page_set)) {
       		return $page_array;
       	} else {
       		return NULL;
       	}
	}

	function sidebar_navigation_id() {
		global $sel_page;
		global $sel_page_array;
		if (isset($_GET['page'])) {
			$sel_page = $_GET['page'];
			$sel_page_array = get_all_page_by_id($sel_page);
		} else {
			$sel_page = NULL;
			$sel_page_array = NULL;
		}
	}

	function getAge($date){ # mounth-day-year
		$bday = explode("-", $date, 3);
		$bday = mktime(0,0,0,$bday[0],$bday[1],$bday[2]);
		$age = (int)((time()-$bday)/31556926 );
		return $age;
		}

		function userAgent($ua){
		    $iphone = strstr(strtolower($ua), 'mobile'); //Search for 'mobile' in user-agent (iPhone have that)
		    $android = strstr(strtolower($ua), 'android'); //Search for 'android' in user-agent
		    $windowsPhone = strstr(strtolower($ua), 'phone'); //Search for 'phone' in user-agent (Windows Phone uses that)
		 
		    function androidTablet($ua){ //Find out if it is a tablet
		        if(strstr(strtolower($ua), 'android') ){//Search for android in user-agent
		            if(!strstr(strtolower($ua), 'mobile')){ //If there is no ''mobile' in user-agent (Android have that on their phones, but not tablets)
		                return true;
		            }
		        }
		    }
		    $androidTablet = androidTablet($ua); //Do androidTablet function
		    $ipad = strstr(strtolower($ua), 'ipad'); //Search for iPad in user-agent
		   $kindle = strstr(strtolower($ua), 'kindle'); //Search for iPad in user-agent
		 
		    if($androidTablet || $ipad || $kindle){ //If it's a tablet (iPad / Android / Kindly)
		        return 'tablet';
		    }
		    elseif($iphone || $android || $windowsPhone){ //If it's a phone and NOT a tablet
		        return 'mobile';
		    }
		    else{ //If it's not a mobile device
		        return 'desktop';
		    }
		}

		function currency_convert($from,$to,$amount) {
		   $string = "1".$from."=?".$to;
		   $google_url = "http://www.google.com/ig/calculator?hl=en&q=".$string;
		   $result = file_get_contents($google_url);
		   $result = explode('"', $result);
		   $converted_amount = explode(' ', $result[3]);
		   $conversion = $converted_amount[0];
		   $conversion = $conversion * $amount;
		   $conversion = round($conversion, 2);
		   $rhs_text = ucwords(str_replace($converted_amount[0],"",$result[3]));
		   $rhs = $conversion.$rhs_text;
		   $price = preg_replace('_^\D+|\D+$_', "", $rhs);
		   return number_format($price, 2, '.', ',');
		}

if ( ! function_exists('mobile_detector') ){
    // Global vars
    $is_mobile = false;
    $is_iphone = $is_ipad = $is_kindle = false;
    $is_ios = $is_android = $is_webos = $is_palmos = $is_windows = $is_symbian = $is_bbos = $is_bada = false;
    $is_opera_mobile = $is_webkit_mobile = $is_firefox_mobile = $is_ie_mobile = $is_netfront = $is_uc_browser = false;
 
    function mobile_detector($debug = false)
    {
        global $is_mobile;
 
        // Check user agent string
        $agent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
 
        if (empty($agent)) {
            return;
        }
 
        $mobile_devices = array(
            'is_iphone' => 'iphone',
            'is_ipad' => 'ipad',
            'is_kindle' => 'kindle'
        );
 
        $mobile_oss = array(
            'is_ios' => 'ip(hone|ad|od)',
            'is_android' => 'android',
            'is_webos' => '(web|hpw)os',
            'is_palmos' => 'palm(\s?os|source)',
            'is_windows' => 'windows (phone|ce)',
            'is_symbian' => 'symbian(\s?os|)|symbos',
            'is_bbos' => 'blackberry(.*?version\/\d+|\d+\/\d+)',
            'is_bada' => 'bada'
        );
 
        $mobile_browsers = array(
            'is_opera_mobile' => 'opera (mobi|mini)', // Opera Mobile or Mini
            'is_webkit_mobile' => '(android|nokia|webos|hpwos|blackberry).*?webkit|webkit.*?(mobile|kindle|bolt|skyfire|dolfin|iris)', // Webkit mobile
            'is_firefox_mobile' => 'fennec', // Firefox mobile
            'is_ie_mobile' => 'iemobile|windows ce', // IE mobile
            'is_netfront' => 'netfront|kindle|psp|blazer|jasmine', // Netfront
            'is_uc_browser' => 'ucweb' // UC browser
        );
 
        $groups = array($mobile_devices, $mobile_oss, $mobile_browsers);
 
        foreach ($groups as $group) {
            foreach ($group as $name => $regex) {
                if (preg_match('/'.$regex.'/i', $agent)) {
                    global $$name;
                    $is_mobile = $$name = true;
                    break;
                }
            }
        }
 
        // Fallbacks
        if ($is_mobile === false) {
            $regex = 'nokia|motorola|sony|ericsson|lge?(-|;|\/|\s)|htc|samsung|asus|mobile|phone|tablet|pocket|wap|wireless|up\.browser|up\.link|j2me|midp|cldc|kddi|mmp|obigo|novarra|teleca|openwave|uzardweb|pre\/|hiptop|avantgo|plucker|xiino|elaine|vodafone|sprint|o2';
            $accept = isset($_SERVER['HTTP_ACCEPT']) ? $_SERVER['HTTP_ACCEPT'] : '';
 
            if (false !== strpos($accept,'text/vnd.wap.wml')
                || false !== strpos($accept,'application/vnd.wap.xhtml+xml')
                || isset($_SERVER['HTTP_X_WAP_PROFILE'])
                || isset($_SERVER['HTTP_PROFILE'])
                || preg_match('/'.$regex.'/i', $agent)
            ) {
                $is_mobile = true;
            }
        }
 
        // DEBUGGER OUTPUT
        if ($debug === true) {
            echo '<strong>User Agent: '.$agent.'</strong><br>';
            foreach ($GLOBALS as $k => $v) {
                if (strpos($k, 'is_') !== false) {
                    echo '<span style="color:'.($v ? 'green':'red').';">$'.$k.'</span><br>';
                }
            }
        }
 
    }
 
    // execute inmmediatly
    //mobile_detector();
 
}
?>