<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ManagerController extends Controller
{
    public function dimsUserManager(){
        return view('manager.dims.dimsUserManager');
    }

    public function getDimsUsers(){
        $IP = Session::get('IP');
        $Key = env('FG_DIMS_API_KEY');
        $GUID = Session::get('GUID');
        $managerID =  Session::get('UserId');
        $managerUsername =  Session::get('UserName');
        $userIP = Session::get('userIP');
        $userLatLng = Session::get('userLatLng');

        $curl = curl_init();

        $postData = '{
            "intManagerID": "'.$managerID.'",
            "strIP": "'.$userIP.'",
            "strCoords": "'.$userLatLng.'",
            "strManagerUsername": "'.$managerUsername.'",
            "data": {
                "strCompanyGUID": "'.$GUID.'",
                "additionalData": [
                    {
                        "OtherData": "'.$GUID.'"
                    }
                ]
            }
        }';

        // dd($postData);

        curl_setopt_array($curl, array(
            CURLOPT_URL => $IP."getDIMSUsers",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $postData,
            CURLOPT_HTTPHEADER => array(
                "Authorization: Key=$Key",
                "Content-Type: text/plain"
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        if($response) {
            $response = json_decode($response, false);
            if (!is_array($response) || !isset($response[0])) {
                $response = [$response]; // Wrap the response in an array
            }
        }

        // dd($response);

        return $response;
    }

    public function createDimsUsers(Request $request){
        $IP = Session::get('IP');
        $Key = env('FG_DIMS_API_KEY');
        $GUID = Session::get('GUID');
        $managerID =  Session::get('UserId');
        $managerUsername =  Session::get('UserName');
        $userIP = Session::get('userIP');
        $userLatLng = Session::get('userLatLng');

        $postUser = $request->get('postUser');

        $curl = curl_init();

        $postData = '{
            "intManagerID": "'.$managerID.'",
            "strIP": "'.$userIP.'",
            "strCoords": "'.$userLatLng.'",
            "strManagerUsername": "'.$managerUsername.'",
            "data": {
                "strCompanyGUID": "'.$GUID.'",
                "additionalData": ['.$postUser.'"]
            }
        }';

        // dd($postData);

        curl_setopt_array($curl, array(
            CURLOPT_URL => $IP."createDIMSUsers",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $postData,
            CURLOPT_HTTPHEADER => array(
                "Authorization: Key=$Key",
                "Content-Type: text/plain"
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        if($response) {
            $response = json_decode($response, false);
            if (!is_array($response) || !isset($response[0])) {
                $response = [$response]; // Wrap the response in an array
            }
        }

        // dd($response);

        return $response;
    }
}
