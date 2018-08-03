<!DOCTYPE html>
<?php 
    session_start();
    ob_start();
    include('inc/cfg.php');
    include('inc/func.php');

    $count = checkLogin($con);

    if($count == 1) {
?>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>Hajj ID - Add Card</title>
        <meta content="Admin Dashboard" name="description" />
        <meta content="Themesdesign" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App Icons -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- App css -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />

    </head>


    <body>

        <!-- Loader -->
        <div id="preloader"><div id="status"><div class="spinner"></div></div></div>

        <!-- Navigation Bar-->
        <? include("header.php"); ?>
        <!-- End Navigation Bar-->
	<center>
        <div class="wrapper col-sm-5">
            <div class="container-fluid">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="btn-group pull-right">
                                <ol class="breadcrumb hide-phone p-0 m-0">
                                    <li class="breadcrumb-item"><a href="#">Add new card</a></li>
                                    <li class="breadcrumb-item active">Dashboard</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->

                <div class="row">
                    <div class="col-12">
                        <div class="card m-b-30">
                            <div class="card-body">

                                <h4 class="mt-0 header-title">Add New Card </h4>
								<hr>
							<form method='POST' enctype='multipart/form-data'>
                                    <div class="col-xs-4">
                                        <label>Full Name</label>
                                        <input type="text" class="form-control" name="name" placeholder="Full Name"/>
                                    </div>
									
									<div class="col-xs-4">
                                        <label>Passport Number</label>
                                        <input type="text" class="form-control" name="passportNumber" placeholder="Passport Number"/>
                                    </div>
									
									<div class="col-xs-4">
                                        <label>Visa Number</label>
                                        <input type="text" class="form-control" name="visaNumber" placeholder="Visa Number"/>
                                    </div>
									
									<div class="col-xs-4">
                                        <label>Date</label>
                                        <input type="date" name="birthday" class="form-control" placeholder="Birthday" /required><br>
                                    </div>
									
									<div class="col-xs-4">
                                        <label>Nationality</label>
                                        <input type="text" class="form-control" name="nationality" placeholder="Nationality"/>
                                    </div>
									
									<div class="col-xs-4">
                                        <label>Gender</label>
                                            <select name='gender' class="form-control">
													<option value='male'>Male</option>   
													<option value='female'>Female</option>   
													<option value='other'>Other</option>   
											</select><br>
                                    </div>
									
									
									<input type='file' name='image'>
										
									<br><br>
									
                                    <div class="form-group">
                                        <label>Description of his health condition</label>
                                        <div>
                                            <textarea class="form-control" name="status" rows="5"></textarea>
                                        </div>
                                    </div>
									
									<div class="col-xs-4">
                                        <label>Blood Type</label>
                                        <input type="text" name="blood" class="form-control" placeholder="Blood Type"/>
                                    </div>
									
									<div class="col-xs-4">
                                        <label>Company Code</label>
                                        <input type="number" name="cc" class="form-control" placeholder="Company Code"/>
                                    </div>
									
									<br>
									
                                    <div class="form-group">
                                        <div>
                                            <input type="submit" name="add" class="btn btn-primary" value="Add The Data">
                                            <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                                                Cancel
                                            </button>
                                        </div>
                                    </div>
                                </form>
        <!-- end wrapper -->

  <br><br> 
<?php
    
        if(isset($_POST['add'])) {
			print_r($_POST);
                $img = base64_encode(file_get_contents($file_tmp));
                # (`id`, `full_name`, `passport_num`, `visa_num`, `birthday`, `nationality`, `gender`, `picture`, `status`, `blood_type`)
            
                # (NULL, '0o', 'ok', 'k908', '2018-08-27', '98', '89', '898', '9898', '1',      '89');
              $file_tmp = $_FILES['image']['tmp_name'];
                $img = base64_encode(file_get_contents($file_tmp));
                $add = $con->prepare("INSERT INTO `haj_info` VALUES (NULL, :na, :pp, :vn, :bd, :nt, :ge, :ig, :hl, '1', :bl, '0', :cc);");
                $add->bindParam(":na", $_POST['name']); # name
                $add->bindParam(":pp", $_POST['passportNumber']); # passport
                $add->bindParam(":vn", $_POST['visaNumber']); # visa
                $add->bindParam(":bd", $_POST['birthday']); # birthday
                $add->bindParam(":nt", $_POST['nationality']); # saudi ?
                $add->bindParam(":ge", $_POST['gender']); # m ? f ?
                $add->bindParam(":ig", $img); # img 
                $add->bindParam(":hl", $_POST['status']); # health status
                $add->bindParam(":bl", $_POST['blood']); #blood type
                $add->bindParam(":cc", $_POST['cc']);
                $add->execute();
								
                if($add) {
                    print "{$_POST['name']} Has been add";
                } else {
                    print "Cannot Add err";
                }
            }else{
				echo 'any';
			}
    } else {
        header("Location: login.php");
        exit;
    }
?>

        <!-- Footer -->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        © 2018 Hajj ID <i class="mdi mdi-heart text-danger"></i> by BlackFox's.
                    </div>
                </div>
            </div>
        </footer>
        <!-- End Footer -->


        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/modernizr.min.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/jquery.nicescroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>

        <!-- Parsley js -->
        <script type="text/javascript" src="assets/plugins/parsleyjs/parsley.min.js"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                $('form').parsley();
            });
        </script>

        <!-- App js -->
        <script src="assets/js/app.js"></script>

    </body>
</html>