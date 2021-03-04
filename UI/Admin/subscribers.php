<?php
    require_once("includes/function.php");
    session_start();
    if (isset($_POST['Add_subscriber'])){
        if(!empty($_POST['fname']) && !empty($_POST['sname']) && !empty($_POST['rn']) && !empty($_POST['phone']) && !empty($_POST['email']) && !empty($_POST['gender'])){
              
			if (isset($_FILES['avatar'])) {
				# code...
				$avatar_name = $_FILES["avatar"]["name"];
				$avatar_tmp = $_FILES["avatar"]["tmp_name"];
            } else{
                $avatar_name = "none";
            }

            $address = "none";
            $defaultPassword = "123456";
            $isActive = 1;

            $query_verif_rn = $db->prepare("SELECT * FROM subscribers WHERE roll_number=:roll_number");
            $query_verif_rn->execute(array("roll_number" => $_POST['rn']));
            foreach($query_verif_rn as $verif_rn_data){
                $rn_found = $verif_rn_data;
            }
            if (!isset($rn_found)){
                
                $query_verif_email = $db->prepare("SELECT * FROM subscribers WHERE email=:email");
                $query_verif_email->execute(array("email" => $_POST['email']));
                foreach($query_verif_email as $verif_email_data){
                    $email_found = $verif_email_data;
                }
                if (!isset($email_found)){
                    $query_register_subscriber = $db->prepare("INSERT INTO subscribers(f_name,s_name,roll_number,phone,addres,gender,avatar,email,password,isClaimed,isActive) VALUES(:f_name,:s_name,:roll_number,:phone,:addres,:gender,:avatar,:email,:password,:isClaimed,:isActive)");
                    $query_register_subscriber->execute(array(
                        "f_name" => $_POST['fname'],
                        "s_name" => $_POST['sname'],
                        "roll_number" => $_POST['rn'],
                        "phone" => $_POST['phone'],
                        "addres" => $address,
                        "gender" => $_POST['gender'],
                        "avatar" => $avatar_name,
                        "email" => $_POST['email'],
                        "password" => $defaultPassword,
                        "isClaimed" => 0,
                        "isActive" => $isActive
                    ));
                    
                    if (isset($_FILES['avatar'])) {
                        # code...
                        move_uploaded_file($avatar_tmp, "uploads/".$avatar_name);
                    }
                    $msg = "Successfull!   [Defeault password: '123456']";
                } else {
                    $msgError = "Use a deffrent email addres, because this one is already used!";
                }

            } else {
                $msgError = "Use a deffrent roll-number, because this one is already used!";
            }
        } else {
            $msgError = "You must fill out all fields!";
        }
    }

    
    if (isset($_POST['Update_subscriber'])){
        if(!empty($_POST['fname']) && !empty($_POST['sname']) && !empty($_POST['rn']) && !empty($_POST['phone']) && !empty($_POST['email']) && !empty($_POST['gender'])){
            
            $query_update_subscriber = $db->prepare("UPDATE subscribers SET f_name=:f_name, s_name=:s_name, roll_number=:roll_number, phone=:phone, gender=:gender,  email=:email  WHERE id=:id");
            $query_update_subscriber->execute(array(
                "f_name" => $_POST['fname'],
                "s_name" => $_POST['sname'],
                "roll_number" => $_POST['rn'],
                "phone" => $_POST['phone'],
                "gender" => $_POST['gender'],
                "email" => $_POST['email'],
                "id" => $_POST['idItem']
            ));

            $msg = "Subscriber updated successfully";
        } else {
            $msgError = "You must fill out all fields!";
        }
    }

    
    if (isset($_GET['item_id'])){
        $query_deleteItem = $db->prepare("UPDATE subscribers SET isActive=:isActive WHERE id=:id");
        $query_deleteItem->execute(array(
            "isActive" => 0,
            "id" => $_GET['item_id']
        ));
        $msgError = "Item deleted successfully";
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
                                            <li class="active ">
                                                <a href="subscribers.php">
                                                    <i class="fas fa-user"></i>Students</a>
                                                <span class="inbox-num">127</span>
                                            </li>
                                            <li>
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
                                                            <a href="#">Subscribers</a>
                                                        </li>
                                                        <li class="list-inline-item seprate">
                                                            <span><i class="fas fa-angle-right"></i></span>
                                                        </li>
                                                        <li class="list-inline-item">Students</li>
                                                    </ul>
                                                </div>
                                                <form class="au-form-icon--sm" action="" method="post">
                                                    <input class="au-input--w300 au-input--style2" type="text" placeholder="Search for datas &amp; reports...">
                                                    <button class="au-btn--submit2" type="submit">
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

                                        <div class="col-md-12">
                                            <h3 class="title-5">student data table</h3>
                                            <small style="color: #999;">List of all subscribed students </small>
                                            <div class="m-b-45"></div>

                                            <div class="table-data__tool">
                                                <div class="table-data__tool-left">
                                                </div>
                                                <div class="table-data__tool-right">
                                                    <button class="au-btn au-btn-icon au-btn--green au-btn--small" data-toggle="modal" data-target="#largeModal">
                                                        <i class="zmdi zmdi-plus"></i>add Student
                                                    </button>

                                                    <!-- modal large -->
                                                    <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg" style="width: 600px;" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header bg-light">
                                                                    <h5 class="modal-title" id="largeModalLabel">Add Student</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="##" style="padding: 25px;">
                                                                    <!-- <div class="card">
                                                                        <div class="card-body"> -->
                                                                    <form action="" method="post" novalidate="novalidate">
                                                                        <div class="row">
                                                                            <div class="col-6">
                                                                                <div class="form-group">
                                                                                    <label for="cc-exp" class="control-label mb-1">First-name</label>
                                                                                    <input id="cc-exp" name="fname" type="text" class="form-control cc-exp" value="" data-val="true" data-val-required="Please enter the quantity of the item" data-val-cc-exp="Please enter a valid month and year" placeholder="" autocomplete="cc-exp">
                                                                                    <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-6">
                                                                                <div class="form-group">
                                                                                    <label for="cc-exp" class="control-label mb-1">Second-name</label>
                                                                                    <input id="cc-exp" name="sname" type="text" class="form-control cc-exp" value="" data-val="true" data-val-required="Please enter the quantity of the item" data-val-cc-exp="Please enter a valid month and year" placeholder="" autocomplete="cc-exp">
                                                                                    <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-6">
                                                                                <div class="form-group">
                                                                                    <label for="cc-exp" class="control-label mb-1">Roll Number</label>
                                                                                    <input id="cc-exp" name="rn" type="text" class="form-control cc-exp" value="" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="" autocomplete="cc-exp">
                                                                                    <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-6">
                                                                                <div class="form-group">
                                                                                    <label for="cc-exp" class="control-label mb-1">Phone</label>
                                                                                    <input id="cc-exp" name="phone" type="text" class="form-control cc-exp" value="" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="" autocomplete="cc-exp">
                                                                                    <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-8">
                                                                                <div class="form-group">
                                                                                    <label for="cc-exp" class="control-label mb-1">E-mail</label>
                                                                                    <input id="cc-exp" name="email" type="text" class="form-control cc-exp" value="" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="" autocomplete="cc-exp">
                                                                                    <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-4">
                                                                                <label for="x_card_code" class="control-label mb-1">Gender</label>
                                                                                <div class="rs-select2--dark rs-select2--sm rs-select2--dark2" style="width:100%;">
                                                                                    <select class="js-select2" name="gender">
                                                                                        <option selected="selected">Select</option>
                                                                                        <option value="M">Man</option>
                                                                                        <option value="F">Woman</option>
                                                                                    </select>
                                                                                    <div class="dropDownSelect2"></div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div>
                                                                            <button type="submit" name="Add_subscriber" class="btn btn-lg  btn-block  au-btn au-btn-icon au-btn--green au-btn--small">
                                                                                <span id="payment-button-amount">Add Student</span>
                                                                                <!-- <i class="fa fa-send"></i> -->
                                                                                <span id="payment-button-sending" style="display:none;">Adding…</span>
                                                                            </button>
                                                                        </div>
                                                                    </form>
                                                                    <!-- </div>
                                                                    </div> -->
                                                                </div>
                                                                <div class="modal-footer" style="padding: 14px 25px;">
                                                                    <button type="" class="btn btn-danger" data-dismiss="modal" style="font-size: 14px;padding: 8px 20px;">Cancel</button>
                                                                    <button type="" class="btn btn-primary" style="font-size: 14px;padding: 8px 20px;">Confirm</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- end modal large -->


                                                    <button class="au-btn au-btn-icon au-btn--green au-btn--small" style="background-color: #555;margin-right: 5px;">
																											<i class="fas fa-copy"></i>Get Report
																									</button>
                                                </div>
                                            </div>

                                            <style>
                                                #claimPath {
                                                    background-color: #eee;
                                                    padding: 0px 10px 2px;
                                                    border-radius: 5px;
                                                    color: #bababa;
                                                }
                                                
                                                #claimPathYes {
                                                    background-color: #4388e2;
                                                    padding: 0px 10px 2px;
                                                    border-radius: 5px;
                                                    color: #fff;
                                                }
                                                
                                                #advensM {
                                                    background-color: #f7dc44;
                                                    padding: 0px 3.5px 2px;
                                                    margin: 0px 3px 0px;
                                                    border-radius: 10px;
                                                    font-size: 12px;
                                                    color: #fff;
                                                }
                                                
                                                .boxShadow {
                                                    -webkit-box-shadow: 0px 10px 20px 0px rgba(0, 0, 0, 0.03);
                                                    -moz-box-shadow: 0px 10px 20px 0px rgba(0, 0, 0, 0.03);
                                                    box-shadow: 0px 10px 20px 0px rgba(0, 0, 0, 0.03);
                                                }
                                                
                                                .dropdownMore {
                                                    background: #fff;
                                                    border: 0.5px solid #dedede;
                                                    position: absolute;
                                                    border-radius: 3px;
                                                    overflow: hidden;
                                                    margin-top: 40px;
                                                    z-index: 99;
                                                }
                                                
                                                .dropdownMore a {
                                                    padding: 10px 15px;
                                                    width: 100%;
                                                    transition: none;
                                                    color: #808080;
                                                }
                                                
                                                .dropdownMore a:hover {
                                                    background-color: #3265d3;
                                                    color: #fff;
                                                }
                                                
                                                #p_relativet {
                                                    position: relative;
                                                }
                                            </style>



                                            <?php

                                                $query_select_modal= $db->prepare("SELECT * FROM subscribers WHERE isActive=:isActive ORDER BY id");
                                                $query_select_modal->execute(array(
                                                    "isActive" => 1
                                                ));

                                                foreach($query_select_modal as $data_subscriber){
                                                    ?>

                                                    <!-- modal large -->
                                                    <div class="modal fade" id="largeModal<?php echo $data_subscriber['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg" style="width: 600px;" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header bg-light">
                                                                    <h5 class="modal-title" id="largeModalLabel">Add Student</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="##" style="padding: 25px;">
                                                                    <!-- <div class="card">
                                                                        <div class="card-body"> -->
                                                                    <form action="" method="post" novalidate="novalidate">
                                                                        <div class="row">
                                                                            <div class="col-6">
                                                                                <div class="form-group">
                                                                                    <label for="cc-exp" class="control-label mb-1">First-name</label>
                                                                                    <input id="cc-exp" name="fname" type="text" class="form-control cc-exp" value="<?php echo $data_subscriber['f_name']; ?>" data-val="true" data-val-required="Please enter the quantity of the item" data-val-cc-exp="Please enter a valid month and year" placeholder="" autocomplete="cc-exp">
                                                                                    <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-6">
                                                                                <div class="form-group">
                                                                                    <label for="cc-exp" class="control-label mb-1">Second-name</label>
                                                                                    <input id="cc-exp" name="sname" type="text" class="form-control cc-exp" value="<?php echo $data_subscriber['s_name']; ?>" data-val="true" data-val-required="Please enter the quantity of the item" data-val-cc-exp="Please enter a valid month and year" placeholder="" autocomplete="cc-exp">
                                                                                    <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-6">
                                                                                <div class="form-group">
                                                                                    <label for="cc-exp" class="control-label mb-1">Roll Number</label>
                                                                                    <input id="cc-exp" name="rn" type="text" class="form-control cc-exp" value="<?php echo $data_subscriber['roll_number']; ?>" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="" autocomplete="cc-exp">
                                                                                    <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-6">
                                                                                <div class="form-group">
                                                                                    <label for="cc-exp" class="control-label mb-1">Phone</label>
                                                                                    <input id="cc-exp" name="phone" type="text" class="form-control cc-exp" value="<?php echo $data_subscriber['phone']; ?>" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="" autocomplete="cc-exp">
                                                                                    <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-8">
                                                                                <div class="form-group">
                                                                                    <label for="cc-exp" class="control-label mb-1">E-mail</label>
                                                                                    <input id="cc-exp" name="email" type="text" class="form-control cc-exp" value="<?php echo $data_subscriber['email']; ?>" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="" autocomplete="cc-exp">
                                                                                    <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-4">
                                                                                <label for="x_card_code" class="control-label mb-1">Gender</label>
                                                                                <div class="rs-select2--dark rs-select2--sm rs-select2--dark2" style="width:100%;">
                                                                                    <select class="js-select2" name="gender">
                                                                                        <option value="<?php echo $data_subscriber['gender']; ?>" selected="selected"><?php echo $data_subscriber['gender']; ?></option>
                                                                                        <option value="M">Man</option>
                                                                                        <option value="F">Woman</option>
                                                                                    </select>
                                                                                    <div class="dropDownSelect2"></div>
                                                                                    <input type="text" name="idItem" value="<?php echo $data_subscriber['id']; ?>" style="visibility: hidden; height: 0px;" />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div>
                                                                            <button type="submit" name="Update_subscriber" class="btn btn-lg  btn-block  au-btn au-btn-icon au-btn--green au-btn--small">
                                                                                <span id="payment-button-amount">Add Student</span>
                                                                                <!-- <i class="fa fa-send"></i> -->
                                                                                <span id="payment-button-sending" style="display:none;">Adding…</span>
                                                                            </button>
                                                                        </div>
                                                                    </form>
                                                                    <!-- </div>
                                                                    </div> -->
                                                                </div>
                                                                <div class="modal-footer" style="padding: 14px 25px;">
                                                                    <button type="" class="btn btn-danger" data-dismiss="modal" style="font-size: 14px;padding: 8px 20px;">Cancel</button>
                                                                    <button type="" class="btn btn-primary" style="font-size: 14px;padding: 8px 20px;">Confirm</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- end modal large -->

                                                    <?php
                                                }
                                            
                                            ?>


                                            <div class="table-responsive table-responsive-data2">
                                                <table class="table table-data2">
                                                    <thead>
                                                        <tr>
                                                            <th>First-name</th>
                                                            <th>Last-name</th>
                                                            <th>Claiming</th>
                                                            <th>Payement</th>
                                                            <th>bigining</th>
                                                            <!-- <th>bigining of the month</th> -->
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <?php
                                                            if(isset($_POST['search_submit'])){
                                                                $query_select= $db->prepare("SELECT * FROM subscribers WHERE isActive=:isActive AND roll_number=:roll_number ORDER BY id");
                                                                $query_select->execute(array(
                                                                    "isActive" => 1,
                                                                    "roll_number" => $_POST['search']
                                                                ));
                                                            } else{
                                                                $query_select= $db->prepare("SELECT * FROM subscribers WHERE isActive=:isActive ORDER BY id");
                                                                $query_select->execute(array(
                                                                    "isActive" => 1
                                                                ));
                                                            }

                                                            foreach($query_select as $data_subscriber){
                                                                ?>

                                                                <tr class="tr-shadow">

                                                                    <td><?php echo $data_subscriber["f_name"] ?></td>
                                                                    <td><?php echo $data_subscriber["s_name"] ?></td>
                                                                    <?php 
                                                                        if ($data_subscriber["isClaimed"] != 1){
                                                                            ?>
                                                                            <td><span id="claimPath"><small><i class="fas fa-ban"></i> claim</small></span></td>
                                                                            <?php
                                                                        } else {
                                                                            ?>
                                                                            <td><span id="claimPathYes"><small><i class="fas fa-check"></i> claim</small></span></td>
                                                                            <?php
                                                                        }
                                                                    ?>
                                                                    <td>
                                                                        <?php
                                                                            $query_select_payement= $db->prepare("SELECT * FROM payement WHERE roll_number=:roll_number");
                                                                            $query_select_payement->execute(array(
                                                                                "roll_number" => $data_subscriber["roll_number"]
                                                                            ));
                                                                            $total_payed = 0;
                                                                            foreach($query_select_payement as $data_subscriber_payement){
                                                                                $total_payed += $data_subscriber_payement['amount'];
                                                                            }
                                                                        ?>
                                                                        <span class="status--process"><?php echo $total_payed; ?> RWF
                                                                            <!-- <sub id="advensM"><small>+2</small></sub> -->
                                                                        </span>
                                                                    </td>
                                                                    <td><?php echo $data_subscriber["create_at"] ?></td>
                                                                    <td>
                                                                        <div class="table-data-feature" id="p_relative">
                                                                            <!-- <button class="item" data-placement="top" title="Edit" data-toggle="modal" data-target="#largeModal">
                                                                                    <i class="zmdi zmdi-edit"></i>
                                                                            </button> -->
                                                                            <button class="item" data-placement="top" title="Edit" data-toggle="modal" data-target="#largeModal<?php echo $data_subscriber['id']; ?>">
                                                                                    <i class="zmdi zmdi-edit"></i>
                                                                            </button>
                                                                            <!-- <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                                                    <i class="zmdi zmdi-delete"></i>
                                                                            </button> -->
                                                                            <a href="subscribers.php?item_id=<?php echo $data_subscriber['id']; ?>" class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                                                    <i class="zmdi zmdi-delete"></i>
                                                                            </a>
                                                                            <button onclick="openMore(<?php  ?>)" class="item btnMore" data-toggle="tooltip" data-placement="top" title="More">
                                                                                    <i class="zmdi zmdi-more"></i>
                                                                            </button>
                                                                            <!-- <div class="dropdownMore boxShadow" id="more<?php  ?>">
                                                                                <a href="admin_student_view.php">View</a><br/>
                                                                                <a href="save_bordereau.php?name&other">Payment</a>
                                                                            </div> -->
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr class="spacer"></tr>

                                                                <?php
                                                            }
                                                        ?>



                                                        <!-- <tr class="tr-shadow">
                                                            <td>Sonia</td>
                                                            <td>Olela EMUNGU</td>
                                                            <td><span id="claimPathYes"><small><i class="fas fa-check"></i> claim</small></span></td>
                                                            <td>
                                                                <span class="status--denied">12000.00 RWF</span>
                                                            </td>
                                                            <td>2020-04-23 02:12</td>
                                                            <td>
                                                                <div class="table-data-feature">
                                                                    <button class="item" data-placement="top" title="Edit" data-toggle="modal" data-target="#largeModal">
                                                                            <i class="zmdi zmdi-edit"></i>
                                                                    </button>
                                                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                                            <i class="zmdi zmdi-delete"></i>
                                                                    </button>
                                                                    <button class="item" data-toggle="tooltip" data-placement="top" title="More">
                                                                            <i class="zmdi zmdi-more"></i>
                                                                    </button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr class="spacer"></tr>
                                                        <tr class="tr-shadow">

                                                            <td>Vianney</td>
                                                            <td>Rwicha BASWIRA</td>
                                                            <td><span id="claimPath"><small><i class="fas fa-ban"></i> claim</small></span></td>
                                                            <td>
                                                                <span class="status--process">35000.00 RWF<sub id="advensM"><small>+2</small></sub></span>
                                                            </td>
                                                            <td>2020-04-23 02:12</td>
                                                            <td>
                                                                <div class="table-data-feature">
                                                                    <button class="item" data-placement="top" title="Edit" data-toggle="modal" data-target="#largeModal">
                                                                            <i class="zmdi zmdi-edit"></i>
                                                                    </button>
                                                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                                            <i class="zmdi zmdi-delete"></i>
                                                                    </button>
                                                                    <button class="item" data-toggle="tooltip" data-placement="top" title="More">
                                                                            <i class="zmdi zmdi-more"></i>
                                                                    </button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr class="spacer"></tr>
                                                        <tr class="tr-shadow">
                                                            <td>Sonia</td>
                                                            <td>Olela EMUNGU</td>
                                                            <td><span id="claimPathYes"><small><i class="fas fa-check"></i> claim</small></span></td>
                                                            <td>
                                                                <span class="status--denied">12000.00 RWF</span>
                                                            </td>
                                                            <td>2020-04-23 02:12</td>
                                                            <td>
                                                                <div class="table-data-feature">
                                                                    <button class="item" data-placement="top" title="Edit" data-toggle="modal" data-target="#largeModal">
                                                                            <i class="zmdi zmdi-edit"></i>
                                                                    </button>
                                                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                                            <i class="zmdi zmdi-delete"></i>
                                                                    </button>
                                                                    <button class="item" data-toggle="tooltip" data-placement="top" title="More">
                                                                            <i class="zmdi zmdi-more"></i>
                                                                    </button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr class="spacer"></tr> -->

                                                    </tbody>
                                                </table>
                                            </div>
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
    <script src="js/animation.js"></script>

</body>

</html>
<!-- end document-->