<?php

class Commons {

    public $base_url = "http://api.linkedin.com";
    public $secure_base_url = "https://api.linkedin.com";

    function getAuthorizationCode($redirect_uri) {
        $params = array('response_type' => 'code',
            'client_id' => yii::app()->params['linkedInAccess'],
            'scope' => yii::app()->params['scope'],
            'state' => uniqid('', true), // unique long string
            'redirect_uri' => $redirect_uri,
        );
        //echo "<pre>";print_r($params);exit;
        // Authentication request
        $url = 'https://www.linkedin.com/uas/oauth2/authorization?' . http_build_query($params);

        // Needed to identify request when it returns to us
        $_SESSION['state'] = $params['state'];

        // Redirect user to authenticate
        header("Location: $url");
        exit;
    }

    function getAccessToken($code, $redirect_uri) {
        $params = array('grant_type' => 'authorization_code',
            'client_id' => yii::app()->params['linkedInAccess'],
            'client_secret' => yii::app()->params['linkedInSecret'],
            'code' => $code,
            'redirect_uri' => $redirect_uri
        );

        // Access Token request
        $url = 'https://www.linkedin.com/uas/oauth2/accessToken?' . http_build_query($params);

        // Tell streams to make a POST request
        $context = stream_context_create(
                array('https' =>
                    array('method' => 'POST',
                    )
                )
        );

        // Retrieve access token information
        $response = file_get_contents($url, false, $context);

        // Native PHP object, please
        $token = json_decode($response);

        // Store access token and expiration time
        $_SESSION['access_token'] = $token->access_token; // guard this!
        $_SESSION['expires_in'] = $token->expires_in; // relative time (in seconds)
        $_SESSION['expires_at'] = time() + $_SESSION['expires_in']; // absolute time

        return true;
    }

    function fetch($method, $resource, $body = '') {
        $params = array('oauth2_access_token' => $_SESSION['access_token'],
            'format' => 'json',
        );

        // Need to use HTTPS
        $url = 'https://api.linkedin.com' . $resource . '?' . http_build_query($params);
        // Tell streams to make a (GET, POST, PUT, or DELETE) request
        $context = stream_context_create(
                array('http' =>
                    array('method' => $method,
                        'header' => 'Content-Type: application/x-www-form-urlencoded',
                        'content' => $body,
                    )
                )
        );

        // Hocus Pocus
        $response = file_get_contents($url, false, $context);

        // Native PHP object, please
        return json_decode($response);
    }

    public function sendCurlRequest($url, $method = 'POST', $type = "fb", $postData = null, $auth = null) {
        //gumte.naresh/friends
        if ($type == "fb") {
            $params = array('access_token' => Yii::app()->params['fb_access_token']);
            $url = 'https://graph.facebook.com/' . $url . '?' . http_build_query($params);
        } else {

            $params = array('oauth2_access_token' => $_SESSION['access_token'], 'format' => 'xml');
            $url = 'https://api.linkedin.com' . $url . '?' . http_build_query($params);
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        //curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_setopt($ch, CURLOPT_HEADER, true);
        if ($type == "linked") {
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/xml", "Content-length: " . strlen($postData)));
        }
        // curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);

        if (is_array($postData)) {

            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        }

        if (is_array($auth)) {
            curl_setopt($ch, CURLOPT_USERPWD, $auth['username'] . ':' . $auth['password']);
        }

        //var_dump(curl_error($ch));echo "****"; exit;
        $response = curl_exec($ch);
        if (curl_getinfo($ch, CURLINFO_HTTP_CODE) != '200') {
            $response = false;
        }
        //print_r($response);echo "Naresh";exit;
        curl_close($ch);

        return $response;
    }

}