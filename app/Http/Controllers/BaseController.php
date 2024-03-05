<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use GuzzleHttp\Client;

class BaseController extends Controller
{
    public function dashboard(){
        if(!Session::has('Company') && !Session::has('UserName')) {
            return redirect('/login');
        }else{
            return view('general.dashboard');
        }
    }

    public function login(){
        return view('general.login');
    }

    public function getlogin(Request $request){
        $username = $request->get('username');
        $password = $request->get('password');

        // dd($username, $password);

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://linxsystems.flowgear.net/Login/'.$username.'/'.$password.'/DimsUserManager/pc',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Key=Z1kIE-gMhWtkEsAeBIVtuvEbjjOrYCIk6Z3UZCaA4sScng7gLNlTYivrGCb2Jdo2-4LMZMAC6y1IqMKOADAZSw'
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        //echo $response;
        if($response) {
            $response = (json_decode($response, true));
        }

        $sessionUserID = ($response[0]['intAutoId']);
        $sessionUsername = ($response[0]['UserName']);
        $sessionIP = ($response[0]['IP']);
        $sessionCompany = ($response[0]['Company']);
        $sessionGUID = ($response[0]['strCompany']);

        Session::put('UserId', $sessionUserID);
        Session::put('UserName', $sessionUsername);
        Session::put('IP', $sessionIP);
        Session::put('Company', $sessionCompany);
        Session::put('GUID', $sessionGUID);

        $IPInfo = $this->getIPAddress();

        $userIP = $IPInfo->original["ip_address"];
        $latitude = $IPInfo->original["latitude"];
        $longitude = $IPInfo->original["longitude"];

        Session::put('userIP', $userIP);
        Session::put('userLatLng', $latitude . ', ' . $longitude);
        // dd($response);

        return response()->json($response);
    }

    public function endsession(){
        Session::flush();
        return response("Success");
    } 

    public function getIPAddress()
    {
        $client = new Client();
        
        try {
            // Get public IP address
            $ipResponse = $client->request('GET', 'https://api.ipify.org');
            $ipAddress = $ipResponse->getBody()->getContents();

            // Get coordinates
            $coordinatesResponse = $client->request('GET', 'http://ip-api.com/json/' . $ipAddress);
            $coordinatesData = json_decode($coordinatesResponse->getBody()->getContents(), true);

            $latitude = $coordinatesData['lat'];
            $longitude = $coordinatesData['lon'];

            return response()->json([
                'ip_address' => $ipAddress,
                'latitude' => $latitude,
                'longitude' => $longitude
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
