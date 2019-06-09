<?php

class GoogleLoginApi
{
    public function GetAccessToken($client_id, $redirect_uri, $client_secret, $code)
    {
        $url = 'https://www.googleapis.com/oauth2/v4/token';

        $curlPost = 'client_id=' . $client_id . '&redirect_uri=' . $redirect_uri . '&client_secret=' . $client_secret . '&code=' . $code . '&grant_type=authorization_code';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);
        $data = json_decode(curl_exec($ch), true);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($http_code != 200)
            throw new Exception('Error : Failed to receieve access token');

        return $data;
    }

    public function GetUserProfileInfo($access_token)
    {
        $url = 'https://www.googleapis.com/oauth2/v2/userinfo?fields=name,email,gender,id,picture,verified_email';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $access_token));
        $data = json_decode(curl_exec($ch), true);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($http_code != 200)
            throw new Exception('Error : Failed to get user information');

        return $data;
    }

    public static function greeting()
    {
        if (isset($_GET['code']))
        {
            try
            {
                $gapi = new GoogleLoginApi();

                // Get the access token
                $data = $gapi->GetAccessToken(CLIENT_ID, CLIENT_REDIRECT_URL, CLIENT_SECRET, $_GET['code']);

                // Get user information
                $user_info = $gapi->GetUserProfileInfo($data['access_token']);
                return $user_info;

            } catch (Exception $e)
            {
                echo $e->getMessage();
                exit();
            }
        }
    }

    public static function destroySession()
    {
        if (session_status() != PHP_SESSION_NONE)
        {
            session_destroy();
        }
    }

    public static function startSession()
    {
        if (session_status() == PHP_SESSION_NONE)
        {
            session_start();
        }
    }
<<<<<<< HEAD

=======
>>>>>>> 994106a6ce3451877e7d77f20ff0941557e58733
}
