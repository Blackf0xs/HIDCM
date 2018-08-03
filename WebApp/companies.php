<!DOCTYPE html>
<?php  session_start();   ob_start(); 

    /*
                        1, aug, 2018
            [BlackFoxs Team] in Hajj Hackathon Event
        Abdullah - Abdulrahman - Saleh - Joud - Mahmoud
    */

    include('inc/cfg.php');
    include('inc/func.php');
    ######

    if(isset($_GET['log']) == 'out') {
        session_destroy();
    }

    $count = checkLogin($con);
    print $count."<br>";
    if($count == 1) {
        
        # counts Admins
        $query3 = $con->prepare("SELECT * FROM `bfsCP`;");
        $query3->execute();
        $countQ3 = $query3->rowCount();
        
        # counts ppl
        $query = $con->prepare("SELECT * FROM `haj_info`;");
        $query->execute();
        $countQ1 = $query->rowCount(); # haj infos 
      
?>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>Hajj ID - Companies</title>
        <meta content="Admin Dashboard" name="description" />
        <meta content="Themesdesign" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App Icons -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!--Morris Chart CSS -->
        <link rel="stylesheet" href="assets/plugins/morris/morris.css">

        <!-- App css -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />

    </head>


    <body>

        <!-- Loader -->
        <div id="preloader"><div id="status"><div class="spinner"></div></div></div>

        
		<? include("header.php"); ?>
    
    <br><br>
<div class="wrapper">
    <div class="container-fluid">

        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="btn-group pull-right">
                        <ol class="breadcrumb hide-phone p-0 m-0">
                            <li class="breadcrumb-item"><a href="#">Companies</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Dashboard</h4>
        
        </div>
            </div>
        </div>
        <!--  kaabaa -->    
        <div class="row">
            <div class="col-md-4 col-xl-6">
                <div class="mini-stat clearfix bg-white">
                    <span class="mini-stat-icon bg-light"><img src="img/kaaba.jpg" height="52" width="52"></img></span>
                    <div class="mini-stat-info text-right text-muted">
                        <span class="counter text-warning"><?php echo $countQ1; ?></span>Total Registration
                    </div>
                </div>
            </div>
            
        
            <div class="col-md-4 col-xl-6">
                <div class="mini-stat clearfix bg-info">
                    <span class="mini-stat-icon bg-light"><img src="img/adm.png" height="52" width="52"></img></span>
                    <div class="mini-stat-info text-right text-light">
                        <span class="counter text-light"><?php echo $countQ3; ?></span>Admins
                    </div>
                </div>
            </div>    
    
        </div>
        <!-- end -->
		
                <div class="row">
                    <div class="col-12">
                        <div class="card m-b-30">
                            <div class="card-body">

<?php 
    /*
                        1, aug, 2018
            [BlackFoxs Team] in Hajj Hackathon Event
        Abdullah - Abdulrahman - Saleh - Joudi - Mahmoud
        
    */
   

    /*
        here check if opened file.php if not page then move it to page 1 ;p
    */
    $count = checkLogin($con);
    print $count."<br>";

    if($count == 1) {
        
        $page = intval($_GET['page']);
        if($page == "") {
            header("Location: ?page=1");
        }


        # limit 
        $limit = 20; # results in page
        $all = $con->prepare("SELECT * FROM `companies`;"); # extract all data 
        $all->execute(); # execute MySQL CMD
        $count = $all->RowCount(); # count it
        $total_pages = ceil($count / $limit); # ceil function make number closer =) 

        $start = ($page-1)*$limit;  # 1*20 = ?
        $show = $con->prepare("SELECT * FROM `companies` ORDER BY `id` DESC LIMIT $start, $limit;"); 
        # SELECT ALL INFOS ORDER IT FROM NEWS TO OLD THEN GIVE A RESULT LIMIT FROM 1 TO 20 ( line: 18 )
        $show->execute(); # execute MySQL CMD Line ( 25 )

        print "<h3>Total: {$count} </h3>"; # give me all results number ( count it )
        #  Full texts 	id 	company_name 	enterance_port 	enternace_date 	flight_number 	hotel_name 	hotel_detalis 	hotel_location 	passport_safe_num 	hajj_office
        echo '<table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%"> 
                <tr>
                    <th>id</th>
                    <th>company_name</th>
                    <th>hotel_name</th>
                    <th>hotel_detalis</th>
                    <th>hotel_location</th>

                </tr>';
        foreach($show as $row) { 

            $id = $row['id']; 
            $fn = $row['company_name']; 
            $na = $row['hotel_name']; 
            $gn = $row['hotel_detalis']; 
            $pc = $row['hotel_location']; 
      

            print "<tr>
                    <td>{$id}</td>
                    <td>{$fn}</td>
                    <td>{$na}</td>
                    <td>{$gn}</td>
                    <td><a href='{$pc}'>Location</a></td>

                </tr>";

        }
        print '</tr></table><center><br><br>';
        for($page=1; $page <= $total_pages ; $page++) {
            echo "<a href='?page={$page}'> {$page} </a>";
        }
        echo "</center>";
    
	}
	}else {
        header("Location: login.php");
        exit;
    }
	
?>

</div>
                </div>
                </div>
                </div>
            </div> <!-- end col -->
        </div>
    </div>
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