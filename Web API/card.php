<?php 
/*
	Blackfoxs Team - Abdurhman - Saleh - Abdullah - Muhammed - Joud - Mahmmod 
*/
    session_start();
    ob_start();
    include('../inc/cfg.php');
    include('../inc/func.php');
	
	switch($_GET['do']){
		case "add":
			
		break;
		case "show":
			$q1 = $con->prepare("SELECT * FROM `haj_info` WHERE id=:id");
			$q1->bindparam(":id",$_GET['cardNum']);
            $q1->execute();
			$countQ1 = $q1->rowCount(); 
			if($countQ1):
				exit(json_encode(array("status"=>"200","message"=>"Card cancelled",$q1->fetch(PDO::FETCH_ASSOC))));
			else:
				exit(json_encode(array("status"=>"208","message"=>"The card does not exist")));
			endif;
		break;
		case "cancel":
			$query = $con->prepare("SELECT * FROM `haj_info` WHERE passport_num=:pid and id=:id");
			$query->bindParam(":pid", $_GET['pid']);
			$query->bindParam(":id", $_GET['cardNum']);
			$query->execute();
			$countQ1 = $query->rowCount(); 
			if($countQ1 > 0):
				$update = $con->prepare("UPDATE `haj_info` set cardStatus=0 where id=:id");
				$update->bindParam(":id", $_GET['cardNum']);
				$update->execute();
				if($update):
					exit(json_encode(array("status"=>200,"message"=>"Card cancelled")));
				else:
					exit(json_encode(array("status"=>204,"message"=>"SQL error")));
				endif;
			else:
				exit(json_encode(array("status"=>205,"message"=>"The Card does not exist")));
			endif;
		break;
	}
	

?>