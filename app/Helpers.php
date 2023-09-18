<?php
use Illuminate\Support\Facades\DB;
use App\Models\SmsRecord;

if (!function_exists('uploadFile')) {
    function uploadFile($photo = '', $path = '') {
        if (!empty($photo) && !empty($path)) {
            $extension = $photo->getClientOriginalExtension();
            $filename = floor(microtime(true)) . '.' . $extension;
            if (!is_dir($path)) mkdir($path, 0700, true);
            $photo->move($path, $filename);
            return $path . '/' . $filename;
        }
        return '';
    }
}

// get voucher code
if (!function_exists('get_code')) {
    function get_code($id, $digite = 4, $prefix = null) {
        if (!empty($id)) {
            if (!empty($prefix)) {
                return $prefix . str_pad($id, $digite, 0, STR_PAD_LEFT);
            } else {
                return str_pad($id, $digite, 0, STR_PAD_LEFT);
            }
        }
        return false;
    }
}

if (!function_exists('strSlug')) {
    function strSlug($text = '') {
        if (!empty($text)) {
            $text = trim($text);
            if (mb_detect_encoding($text) == 'UTF-8') {
                $text = str_replace(' ', '-', $text);
            } else {
                $text = str_replace(' ', '-', strtolower($text));
            }
        }
        return $text;
    }
}

if (!function_exists('strFilter')) {
    function strFilter($text = '', $remove = '_') {
        if (!empty($text)) {
            $text = str_replace($remove, ' ', $text);
            if (mb_detect_encoding($text) == 'UTF-8') {
                $text = $text;
            } else {
                $text = ucwords($text);
            }
        }
        return $text;
    }
}

// convert number
if (!function_exists('numberFilter')) {
    function numberFilter($input_number, $convert_language = null) {
        $bn = array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০");
        $en = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");
        if (!empty($convert_language) && $convert_language == 'bn') {
            return str_replace($en, $bn, $input_number);
        } else {
            return str_replace($bn, $en, $input_number);
        }
        return false;
    }
}

if (!function_exists('strLimit')) {
    function strLimit($input_string = '', $limit = 15, $link = '') {
        $string = '';
        if (!empty($input_string) && !empty($limit)) {
            $filterString = strip_tags($input_string);
            $wordArray    = explode(' ', $filterString);
            $wordCount    = count($wordArray) - 1;
            $limit        = $limit - 1;
            $limit = ($wordCount > $limit ? $limit : $wordCount);
            for ($i = 0; $i <= $limit; $i++) {
                $string .= $wordArray[$i];
                $string .= ($wordCount > $limit  && $i == $limit ? '....' : ' ');
            }
            if (!empty($link) && $wordCount > $limit) {
                $string .= $link;
            }
        }
        return $string;
    }
}

if (!function_exists('numFilter')) {
    function numFilter($number = '', $digit = 2) {
        if (!empty($number)) {
            $number = trim($number);
            if (mb_detect_encoding($number) == 'UTF-8') {
                $number = $number;
            } else {
                $number = number_format($number, $digit);
            }
        }
        return $number;
    }
}


//settings All Data
if (!function_exists('settings')){
    function settings(){
        $settings = DB::table('settings')->get();
        $data = [];
        if (!empty($settings)) {
            foreach ($settings as $key => $value) {
                if (!empty($value)) {
                    $data[$value->meta_key] = $value->meta_value;
                }
            }
        }
        $userInfo   = Auth::user();
        if(!empty($userInfo)){
            $accessInfo = DB::table('privileges')->select('privilege', 'user_id', 'access')->where('user_id', $userInfo->id)->first();
            if($userInfo->privilege != 'super' && !empty($accessInfo)){
                $data['accessInfo'] = $accessInfo;
            }else{
                $data['accessInfo'] = [];
            }
        }
        return (object)$data;
    }
}

// Privilege Check
if (!function_exists('accessPrivilege')) {
    function accessPrivilege($main_menu = '', $sub_menu = '', $action_menu = '') {
        $siteInfo = settings();
        $user_privilege = Auth::user()->privilege;
        $accessList = (!empty($siteInfo->accessInfo) ? json_decode($siteInfo->accessInfo->access) : '');

        $mainMenu = '';
        if (!empty($main_menu)) {
            if(!empty($accessList->$main_menu)){
                $main = $accessList->$main_menu;
                $mainMenu = $main->mainmenu;
            }
            $sub = '';
            if(!empty($sub_menu)) {
                if(!empty($main->submenu->$sub_menu)) {
                    $sub = $main->submenu->$sub_menu;
                }
                $action = '';
                if(!empty($action_menu)){
                    if(!empty($main->submenu->action->$action_menu)) {
                        $action = $main->submenu->action->$action_menu;
                    }
                    $accessPrivilege = ($user_privilege == 'super') || (!empty($action) && $action == $action_menu);
                }else{
                    $accessPrivilege = ($user_privilege == 'super') || (!empty($sub) && $sub == $sub_menu);
                }
            } else {
                $accessPrivilege = ($user_privilege == 'super') || (!empty($mainMenu) && $mainMenu == $main_menu);
            }
        }
        return $accessPrivilege;
    }
}


if (!function_exists('strEncode')) {
    function strEncode($string = null) {
        if (!empty($string)) {
            return base64_encode($string);
        }
    }
}

if (!function_exists('strDecode')) {
    function strDecode($string = null) {
        if (!empty($string)) {
            return base64_decode($string);
        }
    }
}


if (!function_exists('strPrefix')) {
    function strPrefix($string = null, $prefix = '*', $length = 6, $digit = 3) {
        if (!empty($string)) {
            $result = substr($string, 0, $digit) . str_pad('', $length, $prefix, STR_PAD_LEFT) . substr($string, -$digit);
            return  $result;
        }
    }
}


if (!function_exists('inWordEn')) {
    function inWordEn($num = false) {
        $num = str_replace(array(',', ' '), '' , trim($num));
        if(! $num) { return false; }
        $num = (int) $num;
        $words = [];
        $list1 = ['', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten',
            'eleven', 'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen' ];

        $list2 = ['', 'ten', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety', 'hundred'];

        $list3 = ['', 'thousand', 'million', 'billion', 'trillion' ];

        $num_length = strlen($num);
        $levels = (int) (($num_length + 2) / 3);
        $max_length = $levels * 3;
        $num = substr('00' . $num, -$max_length);
        $num_levels = str_split($num, 3);
        for ($i = 0; $i < count($num_levels); $i++) {
            $levels--;
            $hundreds = (int) ($num_levels[$i] / 100);
            $hundreds = ($hundreds ? ' ' . $list1[$hundreds] . ' hundred' . ' ' : '');
            $tens = (int) ($num_levels[$i] % 100);
            $singles = '';
            if ( $tens < 20 ) {
                $tens = ($tens ? ' ' . $list1[$tens] . ' ' : '' );
            } else {
                $tens = (int)($tens / 10);
                $tens = ' ' . $list2[$tens] . ' ';
                $singles = (int) ($num_levels[$i] % 10);
                $singles = ' ' . $list1[$singles] . ' ';
            }
            $words[] = $hundreds . $tens . $singles . ( ( $levels && ( int ) ( $num_levels[$i] ) ) ? ' ' . $list3[$levels] . ' ' : '' );
        }
        //end for loop
        $commas = count($words);
        if ($commas > 1) {
            $commas = $commas - 1;
        }
        return implode(' ', $words);
    }
}


if (!function_exists('smsLimit')){
    function smsLimit(){
        $totalSms = (int) env('SMS_LIMIT');

        return $totalSms;
    }
}

if (!function_exists('totalSendSms')){
    function totalSendSms(){
        $smsCount = (int) SmsRecord::where('is_send', 1)->sum('sms_count');
        $totalSms = (int) env('SMS_LIMIT');

        return $smsCount;
    }
}




