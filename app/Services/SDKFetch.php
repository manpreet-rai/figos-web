<?php

namespace App\Services;

class SDKFetch {

    public static function getData()
    {
        $url = env('FIREBASE_API_URL');
        $data = array('secret-key' => env('FIREBASE_API_SECRET'));

        // use key 'http' even if you send the request to https://...
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data)
            )
        );

        try {
            $context  = stream_context_create($options);
            $json = file_get_contents($url, false, $context);

            if ($json === FALSE) {
                return "Cannot get data right now, please try later";
            }

            return json_decode($json);
        }
        catch (\Exception $exception) {
            return "Cannot get data right now, please try later";
        }
    }
}
