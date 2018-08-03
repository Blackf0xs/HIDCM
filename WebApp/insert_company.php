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
        <title>Hajj ID - Add Company</title>
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
				
				
				
				
				
				<div class="row">
                    <div class="col-12">
                        <div class="card m-b-30">
                            <div class="card-body">

                                <h4 class="mt-0 header-title">Add Company </h4>
								<hr>
							<form method='POST'>
                                    <div class="col-xs-4">
                                        <label>Full Name</label>
                                        <input type="text" class="form-control" name="name" placeholder="Full Name"/>
                                    </div>
									
									<div class="col-xs-4">
                                        <label>Hotel</label>
                                        <input type="text" class="form-control" name="hotel" placeholder="Passport Number"/>
                                    </div>
									
									<div class="col-xs-4">
                                        <label>Detalis</label>
                                        <input type="text" class="form-control" name="detalis" placeholder="Visa Number"/>
                                    </div>
									
									<div class="col-xs-4">
                                        <label>Location</label>
                                        <input type="date" name="location" class="form-control" placeholder="Birthday" /required><br>
                                    </div>
									
									<div class="col-xs-4">
                                        <label>Company Code</label>
                                        <input type="number" name="do" class="form-control" placeholder="Company Code"/>
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
<?php 

        if(isset($_POST['do'])) {
            $new = $con->prepare("INSERT INTO `companies` VALUES(NULL, :n1, :n2, :n3, :n4)");
            $new->bindParam(":n1", $_POST['name']);
            $new->bindParam(":n2", $_POST['hotel']);
            $new->bindParam(":n3", $_POST['detalis']);
            $new->bindParam(":n4", $_POST['location']);
            $new->execute();
            if($new) { 
                print 'Add Complete';
            } else {
                print 'error';
            }
	}
    } else {
        header("Location: login.php");
    }

?>

      <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/modernizr.min.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/jquery.nicescroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>

        <!-- Required datatable js -->
        <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
        <!-- Buttons examples -->
        <script src="assets/plugins/datatables/dataTables.buttons.min.js"></script>
        <script src="assets/plugins/datatables/buttons.bootstrap4.min.js"></script>
        <script src="assets/plugins/datatables/jszip.min.js"></script>
        <script src="assets/plugins/datatables/pdfmake.min.js"></script>
        <script src="assets/plugins/datatables/vfs_fonts.js"></script>
        <script src="assets/plugins/datatables/buttons.html5.min.js"></script>
        <script src="assets/plugins/datatables/buttons.print.min.js"></script>
        <script src="assets/plugins/datatables/buttons.colVis.min.js"></script>
        <!-- Responsive examples -->
        <script src="assets/plugins/datatables/dataTables.responsive.min.js"></script>
        <script src="assets/plugins/datatables/responsive.bootstrap4.min.js"></script>

        <!-- Datatable init js -->
        <script src="assets/pages/datatables.init.js"></script>

        <!-- App js -->
        <script src="assets/js/app.js"></script>

    </body>
</html>