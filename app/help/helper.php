<?php 
use App\MobilatDetails;
/***********************************************************************************/
// get current company
if (!function_exists('get_company')) {
    function get_company() {
        if (session()->has('current_company')) {
            return session()->get('current_company');
        }
        return null;
    }
}

if (!function_exists('ChackSiralExit')) {
    function ChackSiralExit($siral) {
        
        $MobilatDetails5 = MobilatDetails::where('sirarnamber', 'like', '%' . $siral . '%' )->orderBy('id', 'DESC')->get()->pluck('action')->first();
        
        if($MobilatDetails5 == 2 ){
          return false;
        }else{
            return true;
        }
    }
}





/***********************************************************************************/
// Get count all data from data base for any model 

// Service counts
if (!function_exists('count_model')) {
    function count_model($model, $namespace = "\App\Http\Models") {
        $back_slash = substr($namespace, strlen($namespace) - 1, 1) === '\\' ? '' : '\\';
        $class_name = $namespace . $back_slash . $model;
        $newClass = new $class_name();
        if (in_array('lang_parent', $newClass->fillable)) {
            return $class_name::where('lang_parent', null)->count();
        } else {
            return $class_name::count();
        }
    }
}
/***********************************************************************************/
// get contacts 
if (!function_exists('get_contact')) {
    function get_contact($name = null) {
        if ($name === null) {
            $contact = \App\Http\Models\Contact::first();
        } else {
            $contact = \App\Http\Models\Contact::first()->{$name};
        }
        return $contact;
    }
}



/***********************************************************************************/
// add Prefix in url admin [control panel]
if (!function_exists('aurl')) {
    function aurl($url = null) {
        $name = env('ADMIN_PRIFEX', 'admin');
        if ($url == 'prefix') {
            return $name;
        }
        return url($name . '/' . $url);
    }
}
/***********************************************************************************/
// add Prefix in url company [control panel]
if (!function_exists('curl')) {
    function curl($url = null) {
        $name = 'company';
        if ($url == 'prefix') {
            return $name;
        }
        return url($name . '/' . $url);
    }
}
/***********************************************************************************/
// add class active in links active
if (!function_exists('active_link')) {
    function active_link($uri, $recursive = true, $class_name = 'active') {
        if ($recursive === true) {
            if ($uri === Request::segment(1)) {
                return $class_name;
            }
        } else if ($recursive === false) {
            if (url($uri) === Request::url()) {
                return $class_name;
            }
        }
        return ''; 
    }
}
// add class active in links active in [ control panel ]
if (!function_exists('active_link_admin')) {
    function active_link_admin($uri, $recursive = true, $class_name = 'active') {
        if ($recursive === true) {
            if ($uri === Request::segment(2)) {
                return $class_name;
            }
        } else if ($recursive === false) {
            if (aurl($uri) === Request::url()) {
                return $class_name;
            }
        }
        return ''; 
    }
}
/***********************************************************************************/

// add class active in links active in [ Company control panel ]
if (!function_exists('active_link_company')) {
    function active_link_company($uri, $recursive = true, $class_name = 'active') {
        if ($recursive === true) {
            if ($uri === Request::segment(2)) {
                return $class_name;
            }
        } else if ($recursive === false) {
            if (curl($uri) === Request::url()) {
                return $class_name;
            }
        }
        return ''; 
    }
}
/***********************************************************************************/
// if (!function_exists('admin')) {
//     function admin() {
//         return auth()->guard('admin');
//     }
// }
/***********************************************************************************/
if (!function_exists('handel_get_lang')) {
    function handel_get_lang() {
        $name_cookies = env('LARAVEL_COOKIES_LANG_NAME', 'laravel_cookies_lang');
        $defaultLang = Cookie::get($name_cookies) !== null ? Cookie::get($name_cookies) : 'en';
        if (env('USER_LANG_ALLOW') == true) {
            if (auth()->check()) {
                session()->put($name_cookies, auth()->user()->lang);
            }
        }
        if (session()->has($name_cookies)) {
            $currentLang = session($name_cookies);
        } else {
            session()->put($name_cookies, $defaultLang);
            $currentLang = $defaultLang;
        }
        setcookie($name_cookies, $currentLang, time() + (60 * 24 * 30 * 12), '/'); // expired after 1 year.
        return $currentLang;
    }
}
if (!function_exists('lang')) {
    function lang() {
        return handel_get_lang();
    }
}
if (!function_exists('get_lang')) {
    function get_lang() {
        return handel_get_lang();
    }
}
if (!function_exists('default_lang')) {
    function default_lang() {
        return handel_get_lang();
    }
}
/***********************************************************************************/
// Ge Direction
if (!function_exists('handel_get_direction')) {
    function handel_get_direction() {
        $name_cookies = env('LARAVEL_COOKIES_LANG_NAME', 'laravel_cookies_lang');
        if (session()->has($name_cookies)) {
            if (session($name_cookies) == 'ar') {
                return 'rtl';
            } else {
                return 'ltr';
            }
        } else {
            return 'ltr';
        }
    }
}
if (!function_exists('direction')) {
    function direction() {
        return handel_get_direction();
    }
}
if (!function_exists('dir')) {
    function dir() {
        return handel_get_direction();
    }
}
if (!function_exists('get_dir')) {
    function get_dir() {
        return handel_get_direction();
    }
}
if (!function_exists('get_dir_css')) {
    function get_dir_css($dir = false) {
        if ($dir == false) {
            return handel_get_direction() == 'ltr' ? 'left' : 'right';
        } else {
            return handel_get_direction() == 'ltr' ? 'right' : 'left';
        }
    }
}
/***********************************************************************************/
// handel number to amount money
if (!function_exists('money')) {
    function money($money, $fixed = 1) {
        $result = $money;
        preg_match("/^(([0-9]+)(\.?[0-9]+)?)/", $money, $matches);
        if (isset($matches[0])) {
            $all_money_str = $matches[0];
            if ($all_money_str == $money) {
                $money = round($money, $fixed);
                preg_match("/^(([0-9]+)(\.?[0-9]+)?)/", $money, $matches_rounded);
                $all_money = $matches_rounded[2];
                $result_money = $all_money;
                $rest_money = isset($matches_rounded[3]) ? $matches_rounded[3] : '';
                $result_money = strlen($all_money) === 4 ? substr($all_money, 0, 1) . ',' . substr($all_money, 1) : $all_money;
                $result_money = strlen($all_money) === 5 ? substr($all_money, 0, 2) . ',' . substr($all_money, 2) : $result_money;
                $result_money = strlen($all_money) == 6 ? substr($all_money, 0, 3) . ',' . substr($all_money, 3) : $result_money;

                $result_money = strlen($all_money) == 7 ? substr($all_money, 0, 1) . ',' . substr($all_money, 1, 3) . ',' . substr($all_money, 4, 3) : $result_money;
                $result_money = strlen($all_money) == 8 ? substr($all_money, 0, 2) . ',' . substr($all_money, 2, 3) . ',' . substr($all_money, 5, 3) : $result_money;
                $result_money = strlen($all_money) == 9 ? substr($all_money, 0, 3) . ',' . substr($all_money, 3, 3) . ',' . substr($all_money, 6, 3) : $result_money;

                $result_money = strlen($all_money) == 10 ? substr($all_money, 0, 1) . ',' . substr($all_money, 1, 3) . ',' . substr($all_money, 4, 3) . ',' . substr($all_money, 7, 3) : $result_money;
                $result_money = strlen($all_money) == 11 ? substr($all_money, 0, 2) . ',' . substr($all_money, 2, 3) . ',' . substr($all_money, 5, 3) . ',' . substr($all_money, 8, 3) : $result_money;
                $result_money = strlen($all_money) == 12 ? substr($all_money, 0, 3) . ',' . substr($all_money, 3, 3) . ',' . substr($all_money, 6, 3) . ',' . substr($all_money, 9, 3) : $result_money;

                $result_money = strlen($all_money) == 13 ? substr($all_money, 0, 1) . ',' . substr($all_money, 1, 3) . ',' . substr($all_money, 4, 3) . ',' . substr($all_money, 7, 3) . ',' . substr($all_money, 10, 3) : $result_money;
                $result_money = strlen($all_money) == 14 ? substr($all_money, 0, 2) . ',' . substr($all_money, 2, 3) . ',' . substr($all_money, 5, 3) . ',' . substr($all_money, 8, 3) . ',' . substr($all_money, 11, 3) : $result_money;
                $result_money = strlen($all_money) == 15 ? substr($all_money, 0, 3) . ',' . substr($all_money, 3, 3) . ',' . substr($all_money, 6, 3) . ',' . substr($all_money, 9, 3) . ',' . substr($all_money, 12, 3) : $result_money;

                $result = $result_money . $rest_money;
            }
        }
        return $result;
    }
}

/***********************************************************************************/
/* return order List in breadcrumb */
if (!function_exists('pushBreadCrumb')) {
    function pushBreadCrumb($title = 'link breadcrumb', $type = 'active', $url = '#') {
        if ($type == 'active') {
            return "<li class='active'>$title</li>";
        } else if ($type == 'link') {
            return "<li><a href='$url'>$title</a></li>";
        }
    }
}