<?php

    /*
                        1, aug, 2018
            [BlackFoxs Team] in Hajj Hackathon Event
        Abdullah - Abdulrahman - Saleh - Joudi - Mahmoud
        
    */

    function checkLogin($con) {
        $checker = $con->prepare("SELECT * FROM `bfsCP` WHERE `username`=:ses AND `password`=:pwd;");
        $checker->bindParam(":ses", $_SESSION['bfslogin']); 
        $checker->bindParam(":pwd", $_SESSION['bfspassw']); 
        $checker->execute();
        $count = $checker->rowCount();
        return $count;
    }
    # connection
    function cURL($url, $opt) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HEADER, $opt);
        curl_setopt($ch, CURLOPT_NOBODY, $opt);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_8) AppleWebKit/534.30 (KHTML, like Gecko) Chrome/12.0.742.112 Safari/534.30');
        $output = curl_exec($ch);
        return $output;
        curl_close($ch);
    }
    
    function googleCaptcha($data) {
        $secret = "6LdJxxwUAAAAAC-SfaHLfu7glEGgmb8-mFaeVBeC"; # g00gl3 secrect key 
        $google = "https://www.google.com/recaptcha/api/siteverify?secret={$secret}&response={$data}";
        $response = cURL($google, false);
        $response = json_decode($response, true);
        return $response;
    }


    function token($opt) {
        $shuffle = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()_-=", 5)), 0, 20);
        if($opt == 1) {
            return md5($shuffle);
        } elseif($opt == 0) {
            return $shuffle;
        }
    }

    # mail function u need to add mail function and letter
    function sender() {
        print '';
    }
    
?>