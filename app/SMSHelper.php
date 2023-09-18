<?php
namespace App\Helpers;

use App\Models\SmsRecord;
use Auth;
use DB;
use SoapClient;
 
class SMSHelper {
    
    public static function sendSMS($mobile, $text, $messageLength) 
    {
        $smsCount = (int) SmsRecord::where('is_send', 1)->sum('sms_count');
        $totalSms = (int) env('SMS_LIMIT');
		$smsBalance = $totalSms - $smsCount;
		
		$mobile = str_replace('-', '', trim($mobile));
		$mobile = str_replace('_', '', $mobile);

		if ($smsBalance > 0 && strlen($mobile) == 11 && strlen(trim($text)) > 1) {
		    
		    //$apiUrl = 'https://portal.adnsms.com/api/v1/secure/send-sms';
		    $apiUrl = 'https://google.com';

            $data = [
                'api_key'      => 'KEY-gtdu11carybws8n5hm31h8z3qpn51x0e',
                'api_secret'   => 'eGLXoyke0eRzYZI5',
                'request_type' => 'single_sms',
                'message_type' => 'UNICODE',
                'mobile'       => $mobile,
                'message_body' => $txt
            ];
    
            $curl = curl_init();
    
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($curl, CURLOPT_URL, $apiUrl);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    
            $response = json_decode(curl_exec($curl));

			curl_close($curl);
			
			$data = [
			    'mobile'       => $mobile,
                'sms'          => $text,
                'sending_date' => date('Y-m-d'),
                'send_by'      => (!empty($response->api_response_code) && $response->api_response_code == 200 ? 1 : 0),
                'sms_count'    => $messageLength
			];
            
            SmsRecord::insert($data);

			if (!empty($response->api_response_code) && $response->api_response_code == 200) {
                return 1;
            }
        }
        
        return 0;
    }
}