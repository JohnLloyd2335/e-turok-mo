<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\UserActivityLog;

class SendSMSController extends Controller
{
    public function send(Request $request)
    {

        $request->validate([
            'message' => 'required',
            'contact_no' => 'required',
        ]);
        try{

            $message = $request->message; // message na i-sesend
            $key = "a8e079383b535b6ba242c0fcef393d34f85ab21a"; // pa palitan po ng key nyo na naka save sa inyong .env file or type nyo na lang po rekta dito tanggalin na lang po yung Config::get().
            $device = 129; //device id
            $sim = 1; // sim na gagamitin nyo po
            $contact_no = $request->contact_no;
            $contact_no = ltrim($contact_no, $contact_no[0] );
            
            $phoneNumber = '+63'.$contact_no; // phone number nung sesendan

           
        
            if($message !=null && $phoneNumber !=null){
                $url = "https://sms.teamssprogram.com/api/send/sms/SendSMS?key=".$key."&device=".$device."&sim=".$sim."&phone=".$phoneNumber."&message=".urlencode($message);
                $curl = curl_init($url);
                curl_setopt($curl,CURLOPT_RETURNTRANSFER, true);
                $curl_response = curl_exec($curl);
        
        
                if($curl_response === false){
                    $info = curl_getinfo($curl);
                    curl_close($curl);
                    die('Error occurred'.var_export($info));
                }
        
                curl_close($curl);
        
                $response  = json_decode($curl_response);
        
                if($response->status == 200){
                    UserActivityLog::create([
                        'user_id' => auth()->user()->id,
                        'activity' => 'Send SMS',
                        'description' => 'Message sent to: '.$phoneNumber,
                        'date_time'=> now(),
                    ]);
                    return redirect()->back()->with('success','Message Send');
                }else{
                    return redirect()->back()->with('error','Technical Problem');
                }
        
            }
        }
        
        catch(Exception $ex){
            return redirect()->back()->with('error','Technical Problem: '. $ex);
        }

        
    }
}
