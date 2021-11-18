<?php

namespace Database\Seeders;
use App\Models\JneOrigin;

use Illuminate\Database\Seeder;

class JneOriginSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        JneOrigin::truncate();
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://apiv2.jne.co.id:10101/insert/getorigin',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => 'username=username&api_key=username',
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
            JneOrigin::create([

                "name" => $value->City_Name,
                "code" => $value->City_Code,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()

            ]);
        }
    }
}
