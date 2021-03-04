<?php
    require_once("includes/function.php");
    session_start();
    if (isset($_POST['submit'])){
        if(isset($_FILES['bordereau']) && !empty($_POST['rn']) && !empty($_POST['amount']) && !empty($_POST['bank']) && !empty($_POST['accountID'])){
            
            $query_verif_rn = $db->prepare("SELECT * FROM subscribers WHERE roll_number=:roll_number AND isActive=:isActive");
            $query_verif_rn->execute(array("roll_number" => $_POST['rn'], "isActive" => 1));
            foreach($query_verif_rn as $verif_rn_data){
                $rn_found = $verif_rn_data;
            }
            if (isset($rn_found)){
                # code...
                $bordereau_img_name = $_FILES["bordereau"]["name"];
                $bordereau_img_tmp = $_FILES["bordereau"]["tmp_name"];
                
                $query_registerPayement = $db->prepare("INSERT INTO payement(roll_number,bordereau,amount,bank,accountID,isActive) VALUES(:roll_number,:bordereau,:amount,:bank,:accountID,:isActive)");
                $query_registerPayement->execute(array(
                    "roll_number" => $_POST['rn'],
                    "bordereau" => $bordereau_img_name,
                    "amount" => $_POST['amount'],
                    "bank" => $_POST['bank'],
                    "accountID" => $_POST['accountID'],
                    "isActive" => 1
                ));
                
                move_uploaded_file($bordereau_img_tmp, "uploads/".$bordereau_img_name);
    
                $msg = "Registered successfully!";
            
            } else {
                $msgError = "Use a deffrent roll-number, because this one is deosn't exist!";
            }

        } else {
            $msgError = "You must fill out all fields!";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>SOCOBA</title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <!-- <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all"> -->
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
       
       <?php require_once("components/topbar.php"); ?>

        <!-- PAGE CONTENT-->
        <div class="page-content--bgf7">


            <!-- PAGE CONTENT-->
            <div class="page-container3">


                <section>
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-3">
                                <!-- MENU SIDEBAR-->
                                <br/><br/>
                                <aside class="menu-sidebar3 js-spe-sidebar">
                                    <nav class="navbar-sidebar2 navbar-sidebar3">
                                        <ul class="list-unstyled navbar__list">
                                            <li class="has-sub">
                                                <a href="index.php">
                                                    <i class="fas fa-desktop"></i>Dashboard
                                                    <span class="arrow">
                                                            <i class="fas fa-angle-right"></i>
                                                    </span>
                                                </a>
                                            </li>
                                            <li class=" ">
                                                <a href="subscribers.php">
                                                    <i class="fas fa-user"></i>Students</a>
                                                <span class="inbox-num">127</span>
                                            </li>
                                            <li class="active">
                                                <a href="subscriber_save_bordereau.php">
                                                    <i class="fas fa-download"></i>Register Slips</a>
                                                <span class="arrow">
                                                            <i class="fas fa-angle-right"></i>
                                                    </span>
                                            </li>
                                            <li>
                                                <a href="subscriber_bordereau_memory.php">
                                                    <i class="fas fa-save"></i>Archives</a>
                                                <span class="arrow">
                                                            <i class="fas fa-angle-right"></i>
                                                    </span>
                                            </li>
                                            <li>
                                                <a href="commerce_checkout.php">
                                                    <i class="fas fa-question"></i>FAQs</a>
                                                <!-- <span class="arrow">
                                                        <i class="fas fa-angle-right"></i>
                                                </span> -->
                                            </li>
                                            <!-- <li>
                                                <a href="commerce_checkout.php">
                                                    <i class="fas fa-exclamation-triangle"></i>About Us</a>
                                            </li> -->

                                        </ul>
                                    </nav>
                                </aside>
                                <!-- END MENU SIDEBAR-->
                            </div>


                            <div class="col-xl-9" id="scroll_path">
                                <!-- BREADCRUMB-->
                                <section class="au-breadcrumb2">
                                    <!-- <div class="container"> -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="au-breadcrumb-content">
                                                <div class="au-breadcrumb-left">
                                                    <span class="au-breadcrumb-span">You are here:</span>
                                                    <ul class="list-unstyled list-inline au-breadcrumb__list">
                                                        <li class="list-inline-item active">
                                                            <a href="subscribers.php">Subscribers</a>
                                                        </li>
                                                        <li class="list-inline-item seprate">
                                                            <span><i class="fas fa-angle-right"></i></span>
                                                        </li>
                                                        <li class="list-inline-item">Register Slips</li>
                                                    </ul>
                                                </div>
                                                <form class="au-form-icon--sm" action="subscriber_bordereau_memory.php" method="post">
                                                    <input class="au-input--w300 au-input--style2" type="text" name="search" placeholder="Search for datas &amp; reports...">
                                                    <button class="au-btn--submit2" type="submit" name="search_submit">
                                                        <i class="zmdi zmdi-search"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- </div> -->
                                </section>
                                <!-- END BREADCRUMB-->


                                <!-- *************************************
                                ************   section Alert *************
                                ************************************** -->
                                <?php 
                                    if (isset($msg)){
                                        ?>
                                        <section class="alert-wrap p-t-10 p-b-0" style="margin-top: -40px;">
                                            <div class="container">
                                                <!-- ALERT-->
                                                <div class="alert au-alert-success alert-dismissible fade show au-alert au-alert--70per m-b-30" role="alert">
                                                    <i class="zmdi zmdi-check-circle"></i>
                                                    <span class="content"><?php echo $msg; ?></span>
                                                    <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">
                                                            <i class="zmdi zmdi-close-circle"></i>
                                                        </span>
                                                    </button>
                                                </div>
                                                <!-- END ALERT-->
                                            </div>
                                        </section>
                                        <?php
                                    }
                                    
                                    if (isset($msgError)){
                                        ?>
                                        <section class="alert-wrap p-t-10 p-b-0" style="margin-top: -40px;">
                                            <div class="container">
                                                <!-- ALERT-->
                                                <div class="alert alert-danger alert-dismissible fade show au-alert au-alert--70per m-b-30" role="alert">
                                                    <i class="zmdi zmdi-close-circle"></i>
                                                    <span class="content"><?php echo $msgError; ?></span>
                                                    <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">
                                                            <i class="zmdi zmdi-close-circle"></i>
                                                        </span>
                                                    </button>
                                                </div>
                                                <!-- END ALERT-->
                                            </div>
                                        </section>
                                        <?php
                                    }
                                ?>
                                <!-- *************************************
                                ************   section Alert *************
                                ************************************** -->

                                <!-- PAGE CONTENT-->
                                <div class="page-content" style="margin-top: 0px;">
                                    <div class="row">
                                        <div class="col-12">
                                            <h3 class="title-5 m-b-0">Register Slips</h3>
                                            <small style="color: #999;">Slipfrom subscriber's Students</small>
                                            <div class="m-b-45"></div>

                                            <form action="" method="post" novalidate="novalidate" enctype="multipart/form-data">
                                                <div class="table-data__tool">
                                                    <div class="table-data__tool-left">

                                                    </div>
                                                    <div class="table-data__tool-right">
                                                        <button type="submit" name="submit" class="au-btn au-btn-icon au-btn--green au-btn--small">
                                                            <i class="fas fa-check"></i>Submit
                                                        </button>
                                                        <button class="au-btn au-btn-icon au-btn--green au-btn--small" style="background-color: #555;margin-right: 5px;" data-toggle="modal" data-target="#largeModal">
                                                            <i class="fas fa-ban"></i>Clean
                                                        </button>
                                                    </div>
                                                </div>


                                                <div class="##" style="margin-right: 7px;">
                                                    <!-- <div class="card">
                                                        <div class="card-body"> -->
                                                    <style>
                                                        .control-label {
                                                            text-transform: uppercase;
                                                            font-size: 13px;
                                                            font-weight: 600;
                                                            color: #555556;
                                                            padding: 5px 0px;
                                                        }
                                                        
                                                        .boxShadow {
                                                            -webkit-box-shadow: 0px 10px 20px 0px rgba(0, 0, 0, 0.03);
                                                            -moz-box-shadow: 0px 10px 20px 0px rgba(0, 0, 0, 0.03);
                                                            box-shadow: 0px 10px 20px 0px rgba(0, 0, 0, 0.03);
                                                        }
                                                        
                                                        #myInputForm {
                                                            padding: 25px;
                                                            -webkit-box-shadow: 0px 10px 20px 0px rgba(0, 0, 0, 0.03);
                                                            -moz-box-shadow: 0px 10px 20px 0px rgba(0, 0, 0, 0.03);
                                                            box-shadow: 0px 10px 20px 0px rgba(0, 0, 0, 0.03);
                                                            border: none;
                                                            font-size: 14px;
                                                            color: #808080;
                                                            font-family: "Poppins", sans-serif;
                                                            font-weight: 400;
                                                        }
                                                        
                                                        .smallComent {
                                                            font-size: 11px;
                                                            color: #999;
                                                            text-transform: lowercase;
                                                        }
                                                        
                                                        .type-file {
                                                            height: 315px;
                                                        }
                                                    </style>
                                                        <div class="row">
                                                            <div class="col-4">
                                                                <div class="form-group">
                                                                    <label for="cc-exp" class="control-label mb-1">Bordereau <small class="smallComent">select a slip's image...</small></label>
                                                                    <input id="myInputForm" name="bordereau" type="file" class="form-control cc-exp type-file" value="" data-val="true" data-val-required="Please enter the quantity of the item" data-val-cc-exp="Please enter a valid month and year" placeholder="_" autocomplete="cc-exp">
                                                                    <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-8">
                                                                <!-- <div class="form-group">
                                                                    <label for="cc-exp" class="control-label mb-1">Student <small class="smallComent">name of the student owner...</small></label>
                                                                    <input id="myInputForm" name="cc-exp" type="number" class="form-control cc-exp" value="" data-val="true" data-val-required="Please enter the quantity of the item" data-val-cc-exp="Please enter a valid month and year" placeholder="_" autocomplete="cc-exp">
                                                                    <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                                                </div> -->
                                                                <div class="form-group">
                                                                    <label for="cc-exp" class="control-label mb-1">Roll Number <small class="smallComent">roll number of the student owner...</small></label>
                                                                    <input id="myInputForm" name="rn" type="number" class="form-control cc-exp" value="" data-val="true" data-val-required="Please enter the quantity of the item" data-val-cc-exp="Please enter a valid month and year" placeholder="_" autocomplete="cc-exp">
                                                                    <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="cc-exp" class="control-label mb-1">Amount <small class="smallComent">amount of money payed...</small></label>
                                                                    <input id="myInputForm" name="amount" type="number" class="form-control cc-exp" value="" data-val="true" data-val-required="Please enter the quantity of the item" data-val-cc-exp="Please enter a valid month and year" placeholder="_" autocomplete="cc-exp">
                                                                    <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="cc-exp" class="control-label mb-1">Bank name <small class="smallComent">name of the bank...</small></label>
                                                                    <input id="myInputForm" name="bank" type="text" class="form-control cc-exp" value="" data-val="true" data-val-required="Please enter the quantity of the item" data-val-cc-exp="Please enter a valid month and year" placeholder="_" autocomplete="cc-exp">
                                                                    <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="cc-exp" class="control-label mb-1">Account ID <small class="smallComent">account number...</small></label>
                                                            <input id="myInputForm" name="accountID" type="number" class="form-control cc-exp" value="" data-val="true" data-val-required="Please enter the quantity of the item" data-val-cc-exp="Please enter a valid month and year" placeholder="_" autocomplete="cc-exp">
                                                            <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                                        </div>
                                                    <!-- </div>
                                                    </div> -->
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                                <!-- END PAGE CONTENT-->
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <!-- END PAGE CONTENT  -->



            <!-- COPYRIGHT-->
            <section class="p-t-60 p-b-20">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="copyright">
                                <p>Copyright © 2021. All rights reserved. Done by <a href="https://get-softworld.com">Vianney RWICHA && KASANGA Jerry</a>.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END COPYRIGHT-->
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="vendor/slick/slick.min.js">
    </script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="js/main.js"></script>
    <script src="components/sidebar.js"></script>


    <!--===============================================================================================-->
    <!--===============================================================================================-->

    <script src="api/admin.js"></script>
    <script src="api/session.js"></script>
    <script>
    </script>
    </script>

    <!-- Main JS-->
    <script src="js/main.js"></script>

</body>

</html>
<!-- end document-->