<?php 
    ob_start();
    include('inc/cfg.php');


    $xsec = $con->prepare("SELECT * FROM `bfsCP` WHERE `token`=:token");
    $xsec->bindParam(":token", $_GET['reset']);
    $xsec->execute();
    $count = $xsec->rowCount($xsec);
    if($count > 0) {
        foreach($xsec as $row) {
            if(isset($_GET['reset']) == $row['token']) {
                print "
                <form method='POST'>
                    <center>
                        <br><br>
                        <h3>Change Your Password</h3>
                        <input type='password' name='pass1' placeholder='Enter Your Password'><br>
                        <input type='password' name='pass2' placeholder='Confirm Your Password'><br><br>
                        <input type='submit' value='Change Password' name='do'>
                        <br>
                    </center>
                </form>";
                if(isset($_POST['do'])) {
                    
                    if($_POST['pass1'] == $_POST['pass2']) {
                        
                        $update = $con->prepare("UPDATE `bfsCP` SET `password`=:pwd,`token`='' WHERE `token`=:reset;");
                        $update->bindParam(":pwd", md5($_POST['pass2']));
                        $update->bindParam(":reset", $_GET['reset']);
                        $update->execute();
                        
                        if($update) {
                            print 'Password Updated .';
                            header("Location: login.php");
                        } else {
                            print 'Cannot Change The Password .';
                        }
                        
                    } else {
                        print "Password Is Not Match";
                    }
                }
            }
        }
    } else {
        header("Location: login.php");
    }
    


?>