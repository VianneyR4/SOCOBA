<?php
    require_once("includes/function.php");
    session_start();
    if (isset($_POST['submit'])){
        if(!empty($_POST['myName']) && !empty($_POST['receiverName']) && !empty($_POST['moneyAmount']) && !empty($_POST['currency']) && !empty($_POST['motif'])){
              
            $query_registerExites = $db->prepare("INSERT INTO exit_caisse(id_admin,receiver_name,amount,cyrrency,justification) VALUES(:id_admin,:receiver_name,:amount,:cyrrency,:justification)");
            $query_registerExites->execute(array(
                "id_admin" => $_POST['myName'],
                "receiver_name" => $_POST['receiverName'],
                "amount" => $_POST['moneyAmount'],
                "cyrrency" => $_POST['currency'],
                "justification" => $_POST['motif'],
            ));
            $msg = "Successfull!";

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
                                            <li>
                                                <a href="commerce.php">
                                                    <i class="fas fa-chart-bar"></i>Items</a>
                                                <span class="inbox-num">3</span>
                                            </li>
                                            <li>
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
                                            <li class="active ">
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
                                                        <li class="list-inline-item">Repport</li>
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
                                            <h3 class="title-5 m-b-0">Repports</h3>
                                            <small style="color: #999;">You can get repport even by filter</small>
                                            <div class="m-b-45"></div>

                                          <form  action="" method="post" novalidate="novalidate">
                                            <div class="table-data__tool">
                                                <div class="table-data__tool-left">
                                                    <div class="rs-select2--light rs-select2--sm" style="width: 180px;">
                                                        <div class="form-group boxShadow">
                                                            <input id="cc-exp" name="myName" type="date" class="cc-exp" value="" data-val="true" data-val-required="Please enter the quantity of the item" data-val-cc-exp="Please enter a valid month and year" placeholder="My name" autocomplete="cc-exp" style="border: none;padding: 9px 10px;border-radius: 3px; font-size: 14px;outline: none;color: #777">
                                                            <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                                        </div>
                                                    </div>
                                                    <div class="rs-select2--light rs-select2--sm" style="width: 20px;">
                                                        To
                                                    </div>
                                                    <div class="rs-select2--light rs-select2--sm" style="width: 180px;">
                                                        <div class="form-group boxShadow">
                                                            <input id="cc-exp" name="receiverName" type="date" class="cc-exp" value="" data-val="true" data-val-required="Please enter the quantity of the item" data-val-cc-exp="Please enter a valid month and year" placeholder="Receiver name" autocomplete="cc-exp" style="border: none;padding: 9px 10px;border-radius: 3px; font-size: 14px;outline: none;color: #777">
                                                            <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="table-data__tool-right">
                                                    <button type="submit" name="submit" class="au-btn au-btn-icon au-btn--green au-btn--small" style="background-color: #555;margin-right: 5px;" data-toggle="modal" data-target="#largeModal">
                                                        <i class="fas fa-check"></i>Filter
                                                    </button>
                                                    <button onclick="exportTableToExcel('tblData', 'Canteen Repprot'),exportTableToExcel('tblData2', 'Canteen Repprot')" class="au-btn au-btn-icon au-btn--green au-btn--small" data-toggle="modal" data-target="#largeModal">
                                                        <i class="fas fa-arrow-down"></i>Download
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
                                                        color: #555;
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
                                                </style>


                                                <div style="min-height: 200px;">
                                                
                                                    <div class="table-responsive table-responsive-data2">
                                                        <table class="table table-data2" id="tblData">
                                                            <thead>
                                                                <tr>
                                                                    <th></th>
                                                                    <th>item name</th>
                                                                    <th>quantity</th>
                                                                    <th>unit price</th>
                                                                    <th>total price</th>
                                                                    <th>nature</th>
                                                                    <th>date</th>
                                                                </tr>
                                                            </thead>

                                                            <tbody>
                                                                <?php 
                                                                    $query_select= $db->prepare("SELECT * FROM entries_caisse WHERE isActive=:isActive ORDER BY id");
                                                                    $query_select->execute(array(
                                                                        "isActive" => 1
                                                                    ));
                                                                    $getTotal=0;
                                                                    foreach($query_select as $data_stock){
                                                                        ?>
                                                                        

                                                                            <tr class="tr-shadow">
                                                                                <td>
                                                                                    ENTRY
                                                                                </td>
                                                                                <td>
                                                                                    <?php 
                                                                                        $query_select2= $db->prepare("SELECT * FROM stock WHERE id=:id ORDER BY id");
                                                                                        $query_select2->execute(array(
                                                                                            "id" => $data_stock['item_name']
                                                                                        ));
                                                                                        foreach($query_select2 as $data_stock2){
                                                                                            echo $data_stock2['item_name'];
                                                                                    ?>
                                                                                </td>
                                                                                <td>
                                                                                    <?php 
                                                                                            echo $data_stock['quantity'].' '.$data_stock2['qtt_type']; 
                                                                                            
                                                                                        }
                                                                                    ?>
                                                                                </td>
                                                                                <td><?php echo $data_stock['unite_price'].' '.$data_stock['currency']; ?></td>
                                                                                <td><?php echo $data_stock['quantity']*$data_stock['unite_price'].' '.$data_stock['currency']; ?></td>
                                                                                <td>
                                                                                <?php 
                                                                                    if ($data_stock['nature'] != "cash"){
                                                                                        echo '<span class="status--denied">'.$data_stock['nature'] .'</span>';
                                                                                    } else {
                                                                                        echo '<span class="status--process">'.$data_stock['nature'] .'</span>';
                                                                                    }
                                                                                ?>
                                                                                </td>
                                                                                <td><?php echo $data_stock['createdAt']; ?></td>
                                                                            </tr>
                                                                            <tr class="spacer"></tr>
                                                                        <?php
                                                                        $getTotal+=$data_stock['quantity']*$data_stock['unite_price'];
                                                                    }
                                                                ?>
                                                                

                                                                            <tr class="tr-shadow">
                                                                                <td>
                                                                                    Total
                                                                                </td>
                                                                                <td> </td>
                                                                                <td> </td>
                                                                                <td> </td>
                                                                                <td><?php echo $getTotal." RWF"; ?></td>
                                                                                <td> </td>
                                                                                <td></td>
                                                                            </tr>
                                                                            <tr class="spacer"></tr>
                                                            </tbody>

                                                            
                                                            <thead>
                                                                <tr>
                                                                    <th></th>
                                                                    <th>Admin Name</th>
                                                                    <th>Receiver</th>
                                                                    <th></th>
                                                                    <th>Amount</th>
                                                                    <th>Justification</th>
                                                                    <th>date</th>
                                                                </tr>
                                                            </thead>

                                                            <tbody>
                                                                <?php 
                                                                    $query_select= $db->prepare("SELECT * FROM exit_caisse ORDER BY id");
                                                                    $query_select->execute();
                                                                    $getTotal=0;
                                                                    foreach($query_select as $data_stock){
                                                                        ?>
                                                                        

                                                                            <tr class="tr-shadow">
                                                                                <td>
                                                                                    EXITS
                                                                                </td>
                                                                                <td><?php echo $data_stock['id_admin'];?></td>
                                                                                <td><?php echo $data_stock['receiver_name'];?></td>
                                                                                <td></td>
                                                                                <td><?php echo $data_stock['amount'].' '.$data_stock['cyrrency'];?></td>
                                                                                <td><?php echo $data_stock['justification'];?></td>
                                                                                <td><?php echo $data_stock['created_at']; ?></td>
                                                                            </tr>
                                                                            <tr class="spacer"></tr>
                                                                        <?php
                                                                        $getTotal+=$data_stock['amount'];
                                                                    }
                                                                ?>
                                                                

                                                                            <tr class="tr-shadow">
                                                                                <td>
                                                                                    Total
                                                                                </td>
                                                                                <td> </td>
                                                                                <td> </td>
                                                                                <td> </td>
                                                                                <td><?php echo $getTotal." RWF"; ?></td>
                                                                                <td> </td>
                                                                                <td></td>
                                                                            </tr>
                                                                            <tr class="spacer"></tr>
                                                            </tbody>
                                                            
                                                        </table>
                                                    </div>

                                                </div>

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


    <script>
        function exportTableToExcel(tableID, filename = ''){
            var downloadLink;
            var dataType = 'application/vnd.ms-excel';
            var tableSelect = document.getElementById(tableID);
            var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
            
            // Specify file name
            filename = filename?filename+'.xls':'excel_data.xls';
            
            // Create download link element
            downloadLink = document.createElement("a");
            
            document.body.appendChild(downloadLink);
            
            if(navigator.msSaveOrOpenBlob){
                var blob = new Blob(['\ufeff', tableHTML], {
                    type: dataType
                });
                navigator.msSaveOrOpenBlob( blob, filename);
            }else{
                // Create a link to the file
                downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
            
                // Setting the file name
                downloadLink.download = filename;
                
                //triggering the function
                downloadLink.click();
            }
        }
    </script>

</body>

</html>
<!-- end document-->