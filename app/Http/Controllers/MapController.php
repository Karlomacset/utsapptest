<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;

class MapController extends Controller
{
    //
    public function sendJob(Request $request)
    {
        //this method is used to send the job to herenow
        // it should receive via request:
        // userDB , email, loadID

        //first get the load that will be sent. this ensures that the load is sitting on the backend
        $userDB = $request->userDB;
        $email = request('email');
        $loadID = request('loadID');

        $load = Curl::to('http://localhost:5984/'.$userDB.'/'.$loadID)
                ->withHeaders([
                    'Content-Type:application/json',
                    'Authorization:Basic YWRtaW46UmVkUml2ZXI3Nz8='
                ])
                ->asJson()
                ->get();

        $location = $load->dCompany->longitude.', '.$load->dCompany->latitude;
        $jobBody = [
            "version" => "1.0",
            "job_id" => $load->loadShortID,
            "dispatcher_id" => $userDB,
            "type" => "NEW_DESTINATION",
            "asset_id" => 'ismart-asset01',
            "message" =>"This is an example job.",
            "content" => [
                "destination" => $location,
                "mode" => "fastest,truck,traffic:enabled"
            ]
        ];

        //return response([$jobBody,201]);

        // now send the details to here maps

        $res = Curl::to('https://fce.ls.hereapi.com/1/sendjob.json?apiKey=jtUWqOX2jf8upYHYgAYam0h_4ICUfrB90Pipa_T7D-g')
                ->withData($jobBody)
                ->asJson()
                ->post();

        return response([$res, 201]);
    }

    public function getJobUpdates(Request $request)
    {
        // this method will query the dispatch and get updates of all devices

        $jobBody = [
            "dispatcher_id" => $request->userDB,
        ];

        $res = Curl::to('https://fce.ls.hereapi.com/1/listupdates.json?apiKey=jtUWqOX2jf8upYHYgAYam0h_4ICUfrB90Pipa_T7D-g&dispatcher_id='.$request->userDB)
                ->withContentType('application/json')
                ->post();

        return response([$res,$request->userDB, 201]);
    }
}
