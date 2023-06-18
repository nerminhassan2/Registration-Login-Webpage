<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

set_time_limit(0);
class APIController extends Controller
{
    public function ContactWithAPI(Request $request)
    {
        $month = $request["month"];
        $year = $request["year"];
        $day = $request["day"];
        $nameArray = array();
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://online-movie-database.p.rapidapi.com/actors/list-born-today?month=" . $month . "&day=" . $day,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "X-RapidAPI-Host: online-movie-database.p.rapidapi.com",
                "X-RapidAPI-Key: 622e95e536mshb04916934d1a8bep1abedfjsn24172cf650b3"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        if ($err) {
            return response()->json(['output' => "cURL Error #:" . $err], 200);
        } else {
            $data = json_decode($response, true);
            $pattern = "/\/name\/(.*?)\//"; // regular expression to extract the value between "/name/" and "/"

            for ($i = 0; $i < count($data); $i++) {
                if (preg_match($pattern, $data[$i], $matches)) {
                    $value = $matches[1];
                    sleep(0.2);
                    $curll = curl_init();
                    curl_setopt_array($curll, [
                        CURLOPT_URL => "https://online-movie-database.p.rapidapi.com/actors/get-bio?nconst=" . $value,
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => "",
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 30,
                        CURLOPT_SSL_VERIFYPEER => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => "GET",
                        CURLOPT_HTTPHEADER => [
                            "X-RapidAPI-Host: online-movie-database.p.rapidapi.com",
                            "X-RapidAPI-Key: 622e95e536mshb04916934d1a8bep1abedfjsn24172cf650b3"
                        ],
                    ]);

                    $res = curl_exec($curll);
                    $errr = curl_error($curll);

                    curl_close($curll);

                    if ($errr) {
                        return response()->json(['output' => "cURL Error #:" . $errr], 200);
                    } else {
                        $dataa = json_decode($res, true);
                        $name = $dataa['name'];
                        array_push($nameArray, $name);
                    }
                } else {
                    return response()->json(['output' => "No match found.\n"], 200);
                }
            }
            return response()->json(['output' => $nameArray], 200);
        }
    }
}
