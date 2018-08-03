<?php 
/*
	Blackfoxs Team - Abdurhman - Saleh - Abdullah - Muhammed - Joud - Mahmmod 
*/
    session_start();
    ob_start();
    include('../inc/cfg.php');
    include('../inc/func.php');

    #$count = checkLogin($con);
	$query = $con->prepare("SELECT * FROM `bfsCP` WHERE username=:username and password=:password");
	$query->bindParam(":username", $_GET['username']);
	$query->bindParam(":password", md5($_GET['password']));
    $query->execute();
    $countQ1 = $query->rowCount(); 
    if($countQ1 > 0):
		$token = md5(rand(1,99999999999).rand(1,99999999999));
		$update = $con->prepare("UPDATE `bfsCP` SET `token`=:token WHERE `username`=:username;");
        $update->bindParam(":token", $token);
        $update->bindParam(":username", $_GET['username']);
        $update->execute();
		if($update):
		    exit(json_encode(array("status"=>200,"message"=>"Login Successfully.","token"=>$token)));
		else:
			exit(json_encode(array("status"=>201,"message"=>"SQL Error")));
		endif;
	else:
		exit(json_encode(array("status"=>202,"message"=>"Username and password not match.")));
    endif;
	

?>
