<?php

namespace Database\Seeders;
use App\Models\JneDestination;

use Illuminate\Database\Seeder;

class JneDestinationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        JneDestination::truncate();
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://apiv2.jne.co.id:10101/insert/getdestination',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => 'username=username&api_key=api_key',
        CURLOPT_HTTPHEADER => array(
            'content_type: application/x-www-form-urlencoded',
            'Accept: application/json',
            'Content-Type: application/x-www-form-urlencoded'
        ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        // echo $response;
        $data = json_decode($response);

        foreach ($data->detail as $key => $value) {
            JneDestination::create([

                "name" => $value->City_Name,
                "code" => $value->City_Code,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()

            ]);
        }
    }
}
