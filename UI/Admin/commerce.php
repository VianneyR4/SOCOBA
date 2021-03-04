
<?php
    require_once("includes/function.php");
    session_start();
    if (isset($_POST['addItem'])){
        if(!empty($_POST['item_name']) && !empty($_POST['Qtt']) && !empty($_POST['Qtt_alert']) && !empty($_POST['Qtt_type']) && !empty($_POST['unit_price']) && !empty($_POST['currency'])){
            $query_addItem = $db->prepare("INSERT INTO stock(item_name,quantity,qtt_alert,qtt_type,unites_price,currency, isActive) VALUES(:item_name,:quantity,:qtt_alert,:qtt_type,:unites_price,:currency,:isActive)");
            $query_addItem->execute(array(
                "item_name" => $_POST['item_name'],
                "quantity" => $_POST['Qtt'],
                "qtt_alert" => $_POST['Qtt_alert'],
                "qtt_type" => $_POST['Qtt_type'],
                "unites_price" => $_POST['unit_price'],
                "currency" => $_POST['currency'],
                "isActive" => 1
            ));
            $msg = "Item added successfully";
        } else {
            $msgError = "You must fill out all fields!";
        }
    }

    if (isset($_GET['item_id'])){
        $query_deleteItem = $db->prepare("UPDATE stock SET isActive=:isActive WHERE id=:id");
        $query_deleteItem->execute(array(
            "isActive" => 0,
            "id" => $_GET['item_id']
        ));
        $msgError = "Item deleted successfully";
    } 

    if (isset($_POST['updateItem'])){
        if(!empty($_POST['item_name']) && !empty($_POST['Qtt']) && !empty($_POST['Qtt_alert']) && !empty($_POST['Qtt_type']) && !empty($_POST['unit_price']) && !empty($_POST['currency'])){
            $query_addItem = $db->prepare("UPDATE stock SET item_name=:item_name, quantity=:quantity, qtt_alert=:qtt_alert, qtt_type=:qtt_type, unites_price=:unites_price, currency=:currency,  isActive=:isActive WHERE id=:id");
            $query_addItem->execute(array(
                "item_name" => $_POST['item_name'],
                "quantity" => $_POST['Qtt'],
                "qtt_alert" => $_POST['Qtt_alert'],
                "qtt_type" => $_POST['Qtt_type'],
                "unites_price" => $_POST['unit_price'],
                "currency" => $_POST['currency'],
                "isActive" => 1,
                "id" => $_POST['idItem']
            ));
            $msg = "Item updated successfully";
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
                                            <li class="active ">
                                                <a href="commerce.php">
                                                    <i class="fas fa-chart-bar"></i>Stock</a>
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
                                                            <a href="#">Commerce</a>
                                                        </li>
                                                        <li class="list-inline-item seprate">
                                                            <span><i class="fas fa-angle-right"></i></span>
                                                        </li>
                                                        <li class="list-inline-item">Items</li>
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
                                                <div class="alert alert-denger alert-dismissible fade show au-alert au-alert--70per m-b-30" role="alert">
                                                    <i class="zmdi zmdi-check-circle"></i>
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
                                            <h3 class="title-5">data table</h3>
                                            <small style="color: #999;">List of all items</small>
                                            <div class="m-b-45"></div>

                                            <div class="table-data__tool">
                                                <div class="table-data__tool-left">
                                                </div>
                                                <div class="table-data__tool-right">
                                                    <button class="au-btn au-btn-icon au-btn--green au-btn--small" data-toggle="modal" data-target="#largeModal">
                                                        <i class="zmdi zmdi-plus"></i>add item
                                                    </button>

                                                    <!-- modal large -->
                                                    <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg" style="width: 600px;" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header bg-light">
                                                                    <h5 class="modal-title" id="largeModalLabel">Add Item</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="##" style="padding: 25px;">
                                                                    <!-- <div class="card">
                                                                        <div class="card-body"> -->

                                                                    <form action="" method="post" novalidate="novalidate">
                                                                        <div class="form-group">
                                                                            <label for="cc-payment" class="control-label mb-1">Name</label>
                                                                            <input id="cc-pament" name="item_name" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-4">
                                                                                <div class="form-group">
                                                                                    <label for="cc-exp" class="control-label mb-1">Quantity</label>
                                                                                    <input id="cc-exp" name="Qtt" type="number" class="form-control cc-exp" value="" data-val="true" data-val-required="Please enter the quantity of the item" data-val-cc-exp="Please enter a valid month and year" placeholder="" autocomplete="cc-exp" required>
                                                                                    <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-4">
                                                                                <label for="x_card_code" class="control-label mb-1">Qtt. Alert</label>
                                                                                <div class="input-group">
                                                                                    <input id="x_card_code" name="Qtt_alert" type="number" class="form-control cc-cvc" value="" data-val="true" data-val-required="Please enter the quantity alert" data-val-cc-cvc="Please enter a valid security code" autocomplete="off" required>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-4">
                                                                                <label for="x_card_code" class="control-label mb-1">Qtt. Type</label>
                                                                                <div class="rs-select2--dark rs-select2--sm rs-select2--dark2" style="width:100%;">
                                                                                    <select class="js-select2" name="Qtt_type" required>
                                                                                            <option selected="selected">Select</option>
                                                                                            <option value="Pieces">Piece</option>
                                                                                            <option value="Bottles">Bottle</option>
                                                                                            <option value="Liters">Liter</option>
                                                                                    </select>
                                                                                    <div class="dropDownSelect2"></div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-8">
                                                                                <div class="form-group">
                                                                                    <label for="cc-exp" class="control-label mb-1">Unit Price</label>
                                                                                    <input id="cc-exp" name="unit_price" type="number" class="form-control cc-exp" value="" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="" autocomplete="cc-exp" required>
                                                                                    <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-4">
                                                                                <label for="x_card_code" class="control-label mb-1">Currency</label>
                                                                                <div class="rs-select2--dark rs-select2--sm rs-select2--dark2" style="width:100%;">
                                                                                    <select class="js-select2" name="currency" required>
                                                                                        <option value="RWF">RWF</option>
                                                                                        <option value="FC">FC</option>
                                                                                        <option value="USD">USD</option>
                                                                                    </select>
                                                                                    <div class="dropDownSelect2"></div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div>
                                                                            <button type="submit" name="addItem" class="btn btn-lg  btn-block  au-btn au-btn-icon au-btn--green au-btn--small">
                                                                                <span id="payment-button-amount">Add Item </span>
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
                                                </div>
                                            </div>



                                            <div class="table-responsive table-responsive-data2">
                                                <table class="table table-data2">
                                                    <thead>
                                                        <tr>
                                                            <th>
                                                                <label class="au-checkbox">
                                                                        <input type="checkbox">
                                                                        <span class="au-checkmark"></span>
                                                                </label>
                                                            </th>
                                                            <th>name</th>
                                                            <th>quantity</th>
                                                            <th>unit price</th>
                                                            <th>total price</th>
                                                            <th>date</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        <?php 
                                                            $query_select= $db->prepare("SELECT * FROM stock WHERE isActive=:isActive ORDER BY id");
                                                            $query_select->execute(array(
                                                                "isActive" => 1
                                                            ));
                                                            foreach($query_select as $data_stock){
                                                                ?>
                                                                

                                                    
                                                                <!-- modal large -->
                                                                <div class="modal fade" id="largeModal<?php echo $data_stock['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog modal-lg" style="width: 600px;" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header bg-light">
                                                                                <h5 class="modal-title" id="largeModalLabel">Edit Item</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="##" style="padding: 25px;">
                                                                                <!-- <div class="card">
                                                                                    <div class="card-body"> -->

                                                                                <form action="" method="post" novalidate="novalidate">
                                                                                    <div class="form-group">
                                                                                        <label for="cc-payment" class="control-label mb-1">Name</label>
                                                                                        <input id="cc-pament" name="item_name" value="<?php echo $data_stock['item_name']; ?>" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                        <div class="col-4">
                                                                                            <div class="form-group">
                                                                                                <label for="cc-exp" class="control-label mb-1">Quantity</label>
                                                                                                <input id="cc-exp" name="Qtt" value="<?php echo $data_stock['quantity']; ?>" type="number" class="form-control cc-exp" value="" data-val="true" data-val-required="Please enter the quantity of the item" data-val-cc-exp="Please enter a valid month and year" placeholder="" autocomplete="cc-exp" required>
                                                                                                <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-4">
                                                                                            <label for="x_card_code" class="control-label mb-1">Qtt. Alert</label>
                                                                                            <div class="input-group">
                                                                                                <input id="x_card_code" name="Qtt_alert" value="<?php echo $data_stock['qtt_alert']; ?>" type="number" class="form-control cc-cvc" value="" data-val="true" data-val-required="Please enter the quantity alert" data-val-cc-cvc="Please enter a valid security code" autocomplete="off" required>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-4">
                                                                                            <label for="x_card_code" class="control-label mb-1">Qtt. Type</label>
                                                                                            <div class="rs-select2--dark rs-select2--sm rs-select2--dark2" style="width:100%;">
                                                                                                <select class="js-select2" name="Qtt_type" required>
                                                                                                        <option value="<?php echo $data_stock['qtt_type']; ?>"><?php echo $data_stock['qtt_type']; ?></option>
                                                                                                        <option value="Pieces">Piece</option>
                                                                                                        <option value="Bottles">Bottle</option>
                                                                                                        <option value="Liters">Liter</option>
                                                                                                </select>
                                                                                                <div class="dropDownSelect2"></div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                        <div class="col-8">
                                                                                            <div class="form-group">
                                                                                                <label for="cc-exp" class="control-label mb-1">Unit Price</label>
                                                                                                <input id="cc-exp" name="unit_price" value="<?php echo $data_stock['unites_price']; ?>" type="number" class="form-control cc-exp" value="" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="" autocomplete="cc-exp" required>
                                                                                                <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-4">
                                                                                            <label for="x_card_code" class="control-label mb-1">Currency</label>
                                                                                            <div class="rs-select2--dark rs-select2--sm rs-select2--dark2" style="width:100%;">
                                                                                                <select class="js-select2" name="currency" required>
                                                                                                    <option value="RWF">RWF</option>
                                                                                                    <option value="FC">FC</option>
                                                                                                    <option value="USD">USD</option>
                                                                                                </select>
                                                                                                <div class="dropDownSelect2"></div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <input name="idItem" value="<?php echo $data_stock['id']; ?>" style="visibility: hidden;" />
                                                                                    <div>
                                                                                        <button type="submit" name="updateItem" class="btn btn-lg  btn-block  au-btn au-btn-icon au-btn--green au-btn--small">
                                                                                            <span id="payment-button-amount">Update </span>
                                                                                            <!-- <i class="fa fa-send"></i> -->
                                                                                            <span id="payment-button-sending" style="display:none;">Updating...</span>
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


                                                                    <tr class="tr-shadow">
                                                                        <td>
                                                                            <label class="au-checkbox">
                                                                                <input type="checkbox">
                                                                                <span class="au-checkmark"></span>
                                                                            </label>
                                                                        </td>
                                                                        <td><?php echo $data_stock['item_name']; ?></td>
                                                                        <td>
                                                                            <?php 
                                                                                if ($data_stock['quantity'] <= $data_stock['qtt_alert']){
                                                                                    echo '<span class="status--denied">'.$data_stock['quantity'] .' '.$data_stock['qtt_type'] .'</span>';
                                                                                } else {
                                                                                    echo '<span class="status--process">'.$data_stock['quantity'] .' '.$data_stock['qtt_type'] .'</span>';
                                                                                }
                                                                            ?>
                                                                        </td>
                                                                        <td><?php echo $data_stock['unites_price'].' '.$data_stock['currency']; ?></td>
                                                                        <td><?php echo $data_stock['quantity']*$data_stock['unites_price'].' '.$data_stock['currency']; ?></td>
                                                                        <td><?php echo $data_stock['created_at']; ?></td>
                                                                        <td>
                                                                            <div class="table-data-feature">
                                                                                <button class="item" data-placement="top" title="Edit" data-toggle="modal" data-target="#largeModal<?php echo $data_stock['id']; ?>">
                                                                                        <i class="zmdi zmdi-edit"></i>
                                                                                </button>
                                                                                <a href="commerce.php?item_id=<?php echo $data_stock['id']; ?>" class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                                                        <i class="zmdi zmdi-delete"></i>
                                                                                </a>
                                                                                <button class="item" data-toggle="tooltip" data-placement="top" title="More">
                                                                                        <i class="zmdi zmdi-more"></i>
                                                                                </button>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr class="spacer"></tr>
                                                                <?php
                                                            }
                                                        ?>
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

</body>

</html>
<!-- end document-->