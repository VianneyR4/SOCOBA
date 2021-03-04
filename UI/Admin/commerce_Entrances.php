<?php
    require_once("includes/function.php");
    session_start();
    if (isset($_POST['submit'])){
        if(!empty($_POST['item_name']) && !empty($_POST['quantity']) && !empty($_POST['unit_price']) && !empty($_POST['currency'])){
              
            $query_selectStok= $db->prepare("SELECT * FROM stock WHERE id=:id");
            $query_selectStok->execute(array("id" => $_POST['item_name']));
            foreach($query_selectStok as $query_selectStokData){
                $newQuantity = $query_selectStokData['quantity'] - $_POST['quantity'];

                if($newQuantity >= 0){
                    $query_addItem = $db->prepare("INSERT INTO entries_caisse(nature,item_name,quantity,unite_price,currency, isActive) VALUES(:nature,:item_name,:quantity,:unit_price,:currency,:isActive)");
                    $query_addItem->execute(array(
                        "nature" => "cash",
                        "item_name" => $_POST['item_name'],
                        "quantity" => $_POST['quantity'],
                        "unit_price" => $_POST['unit_price'],
                        "currency" => $_POST['currency'],
                        "isActive" => 1
                    ));
                    $msg = "Successfull!";

                    $query_deleteItem = $db->prepare("UPDATE stock SET quantity=:quantity WHERE id=:id");
                    $query_deleteItem->execute(array(
                        "quantity" => $newQuantity,
                        "id" => $_POST['item_name']
                    ));
                } else{
                    $msgError = "imposible to sall quantity up than the stock quantity (".$query_selectStokData['quantity']." ".$query_selectStokData['qtt_type'].")!";
                }
            }
        }  else {
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
                                            <li>
                                                <a href="commerce.php">
                                                    <i class="fas fa-chart-bar"></i>Items</a>
                                                <span class="inbox-num">3</span>
                                            </li>
                                            <li class="active ">
                                                <a href="commerce_entrances.php">
                                                    <i class="fas fa-check"></i>Entries</a>
                                                <span class="arrow">
                                                            <i class="fas fa-angle-right"></i>
                                                    </span>
                                            </li>
                                            <li>
                                                <a href="commerce_checkout.php">
                                                    <i class="fas fa-shopping-cart"></i>Exits</a>
                                                <span class="arrow">
                                                            <i class="fas fa-angle-right"></i>
                                                    </span>
                                            </li>
                                            <li>
                                                <a href="commerce_report.php">
                                                    <i class="fas fa-copy"></i>Report</a>
                                                <span class="inbox-num">1</span>
                                            </li>
                                            <li>
                                                <a href="commerce_checkout.php">
                                                    <i class="fas fa-question"></i>FAQs</a>
                                                <!-- <span class="arrow">
                                                        <i class="fas fa-angle-right"></i>
                                                </span> -->
                                            </li>

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
                                                            <a href="commerce.php">Commerce</a>
                                                        </li>
                                                        <li class="list-inline-item seprate">
                                                            <span><i class="fas fa-angle-right"></i></span>
                                                        </li>
                                                        <li class="list-inline-item">Entries</li>
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
                                        <div class="col-12">
                                            <h3 class="title-5 m-b-0">All Entry's mouvements</h3>
                                            <small style="color: #999;">Money earned after selling</small>
                                            <div class="m-b-45"></div>

                                            <div class="table-data__tool">
                                                <div class="table-data__tool-left">
                                                    <!-- <div class="rs-select2--light rs-select2--md">
                                                        <select class="js-select2" name="property" id="natureChoiceId" onchange="natureChoiceFunc()">
                                                                <option value="">Nature --</option>
                                                                <option value="1" selected="selected">Cash</option>
                                                                <option value="2">Credit</option>
                                                        </select>
                                                        <div class="dropDownSelect2"></div>
                                                    </div>
                                                    <div id="CashNatureName" class="rs-select2--light rs-select2--sm " style="width: 200px;">
                                                        <div class="form-group boxShadow">
                                                            <input id="cc-exp" name="cc-exp" type="text" class="cc-exp" value="" data-val="true" data-val-required="Please enter the quantity of the item" data-val-cc-exp="Please enter a valid month and year" placeholder="Name" autocomplete="cc-exp" style="border: none;padding: 9px 10px;border-radius: 2.5px; font-size: 14px;outline: none;color: #777">
                                                            <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                                        </div>
                                                    </div>
                                                    <div id="CashNatureDay" class="rs-select2--light rs-select2--sm ">
                                                        <div class="form-group boxShadow">
                                                            <input id="cc-exp" name="cc-exp" type="date" class="cc-exp" value="" data-val="true" data-val-required="Please enter the quantity of the item" data-val-cc-exp="Please enter a valid month and year" placeholder="Name" autocomplete="cc-exp" style="border: none;padding: 9px 10px;border-radius: 2.5px; font-size: 14px;outline: none;color: #777">
                                                            <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                                        </div>
                                                    </div> -->
                                                </div>
                                                
                                        <form action="" method="post" novalidate="novalidate">
                                                <div class="table-data__tool-right">
                                                    <button class="au-btn au-btn-icon au-btn--green au-btn--small" type="submit" name="submit">
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

                                                    select.form-control{
                                                        height: 75px !important;
                                                    }
                                                </style>
                                                <!-- <form action="" method="post" novalidate="novalidate"> -->
                                                    <div class="form-group">
                                                        <label for="cc-payment" class="control-label mb-1">Item Name <small class="smallComent">name of the product...</small></label>
                                                        <!-- <input id="myInputForm" name="item_name" type="text" class="form-control" aria-required="true" placeholder="_" aria-invalid="false"> -->
                                                        <select id="myInputForm" name="item_name" class="form-control" aria-required="true" placeholder="_" aria-invalid="false">
                                                        
                                                        <option>Select item here</option>

                                                        <?php 
                                                            $query_select= $db->prepare("SELECT * FROM stock WHERE isActive=:isActive ORDER BY id");
                                                            $query_select->execute(array(
                                                                "isActive" => 1
                                                            ));
                                                            foreach($query_select as $data_stock){
                                                                ?>
                                                                <option value="<?php echo $data_stock['id'] ?>"><?php echo $data_stock['item_name'] ?></option>
                                                                <?php
                                                            }
                                                        ?>
                                                        </select>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <div class="form-group">
                                                                <label for="cc-exp" class="control-label mb-1">Quantity <small class="smallComent">qtt. sold...</small></label>
                                                                <input id="myInputForm" name="quantity" type="number" class="form-control cc-exp" value="" data-val="true" data-val-required="Please enter the quantity of the item" data-val-cc-exp="Please enter a valid month and year" placeholder="_" autocomplete="cc-exp">
                                                                <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-8">
                                                            <label for="x_card_code" class="control-label mb-1">Unit Price <small class="smallComent">price per piece...</small></label>
                                                            <div class="input-group">
                                                                <input id="myInputForm" name="unit_price" type="number" class="form-control cc-cvc" value="" data-val="true" data-val-required="Please enter the quantity alert" data-val-cc-cvc="Please enter a valid security code" placeholder="_" autocomplete="off">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <!-- <div class="col-8">
                                                            <div class="form-group">
                                                                <label for="cc-exp" class="control-label mb-1">Total Price  <small class="smallComent">the global price...</small></label>
                                                                <input id="myInputForm" name="total_price" type="number" class="form-control cc-exp" value="" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="_" autocomplete="cc-exp">
                                                                <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                                            </div>
                                                        </div> -->
                                                        <div class="col-4">
                                                            <label for="x_card_code" class="control-label mb-1">Currency <small class="smallComent">currency of money...</small></label>
                                                            <div class="rs-select2--dark rs-select2--sm rs-select2--dark2" style="width:100%;">
                                                                <select class="js-select2" name="currency">
                                                                        <option value="RWF">RWF</option>
                                                                        <option value="FC">FC</option>
                                                                        <option value="USD">USD</option>
                                                                </select>
                                                                <div class="dropDownSelect2"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                                <!-- </div>
                                                </div> -->
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
        let natureChoiceValue = document.getElementById("natureChoiceId").value;
        natureChoiceFunc = () => {
            alert(natureChoiceValue);
            if (natureChoiceValue == 1) {
                document.getElmenentById("CashNatureName").style.display = "none";
                document.getElmenentById("CashNatureDay").style.display = "none";
            } 
            else if (natureChoiceValue == 2) {
                document.getElmenentById("CashNatureName").style.display = "block";
                document.getElmenentById("CashNatureDay").style.display = "block";
            }
        }
    </script>
    </script>

    <!-- Main JS-->
    <script src="js/main.js"></script>

</body>

</html>
<!-- end document-->