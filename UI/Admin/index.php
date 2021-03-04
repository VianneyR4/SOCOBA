<?php
    require_once("includes/function.php");
    session_start();
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
    <div class="page-wrapper" id="app">
       
    <?php require_once("components/topbar.php"); ?>


        <!-- PAGE CONTENT-->
        <div class="page-content--bgf7">
            <div class="container" style="padding: 0px 0px;">
                <div class="row">
                    <div class="col-xl-3">
                        <!-- MENU SIDEBAR-->
                        <br/><br/>

                        <aside class="menu-sidebar3 js-spe-sidebar">
                            <nav class="navbar-sidebar2 navbar-sidebar3">
                                <ul class="list-unstyled navbar__list">
                                    <li class="has-sub active">
                                        <a href="index.php">
                                            <i class="fas fa-desktop"></i>Dashboard
                                            <span class="arrow">
                                                    <i class="fas fa-angle-right"></i>
                                            </span>
                                        </a>
                                    </li>
                                    <li class=" ">
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


                    <div class="col-xl-9">
                        <!-- BREADCRUMB-->
                        <section class="au-breadcrumb2">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="au-breadcrumb-content">
                                            <div class="au-breadcrumb-left">
                                                <span class="au-breadcrumb-span">You are here:</span>
                                                <ul class="list-unstyled list-inline au-breadcrumb__list">
                                                    <li class="list-inline-item active">
                                                        <a href="#">Home</a>
                                                    </li>
                                                    <li class="list-inline-item seprate">
                                                        <span>/</span>
                                                    </li>
                                                    <li class="list-inline-item">Dashboard</li>
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
                            </div>
                        </section>
                        <!-- END BREADCRUMB-->




                        <!-- WELCOME-->
                        <section class="welcome p-t-0">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h1 class="title-4">Welcome
                                            <span>{{ admin.fname }} {{ admin.lname }}!</span>
                                        </h1>
                                        <hr class="line-seprate">
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!-- END WELCOME-->



                        <!-- STATISTIC-->
                        <section class="statistic statistic2">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-6 col-lg-3">
                                        <div class="statistic__item statistic__item--green">
                                            <h2 class="number">
                                            <?php
                                                $query_select= $db->prepare("SELECT * FROM subscribers WHERE isActive=:isActive ORDER BY id");
                                                $query_select->execute(array(
                                                    "isActive" => 1
                                                ));
                                                $counter_subscriber=0;
                                                foreach($query_select as $data_subscriber){
                                                    $counter_subscriber+=1;
                                                }
                                                echo $counter_subscriber;
                                            ?>
                                            </h2>
                                            <span class="desc">Subscribers</span>
                                            <div class="icon">
                                                <i class="zmdi zmdi-account-o"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-3">
                                        <div class="statistic__item statistic__item--orange">
                                            <h2 class="number">
                                            <?php
                                                $query_select= $db->prepare("SELECT * FROM entries_caisse WHERE isActive=:isActive ORDER BY id");
                                                $query_select->execute(array(
                                                    "isActive" => 1
                                                ));
                                                $counter_entries_caisse=0;
                                                foreach($query_select as $data_subscriber){
                                                    $counter_entries_caisse+=1;
                                                }
                                                echo $counter_entries_caisse;
                                            ?>
                                            </h2>
                                            <span class="desc">items sold</span>
                                            <div class="icon">
                                                <i class="zmdi zmdi-shopping-cart"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-3">
                                        <div class="statistic__item statistic__item--blue">
                                            <h2 class="number">1,086</h2>
                                            <!-- <span class="desc">this week</span> -->
                                            <span class="desc">last week</span>
                                            <div class="icon">
                                                <i class="zmdi zmdi-calendar-note"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-3">
                                        <div class="statistic__item statistic__item--red">
                                            <h2 class="number">
                                            <?php
                                                $query_select= $db->prepare("SELECT * FROM entries_caisse WHERE isActive=:isActive ORDER BY id");
                                                $query_select->execute(array(
                                                    "isActive" => 1
                                                ));
                                                $counter_entries_caisse_amount=0;
                                                foreach($query_select as $data_subscriber){
                                                    $counter_entries_caisse_amount += $data_subscriber['unite_price'] * $data_subscriber['quantity'];
                                                }
                                                echo $counter_entries_caisse_amount.' RWF';
                                            ?>
                                            </h2>
                                            <span class="desc">total earnings</span>
                                            <div class="icon">
                                                <i class="zmdi zmdi-money"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!-- END STATISTIC-->


                    </div>
                </div>

                <div style="min-height: 25vh;"></div>
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

    </div>



    <!--===============================================================================================-->
    <!--===============================================================================================-->
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.0"></script>
    <script src="https://unpkg.com/vue-router@2.0.0"></script>
    <!--===============================================================================================-->
    <!--===============================================================================================-->
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
    <script src="components/sidebar.js"></script>


    <!--===============================================================================================-->
    <!--===============================================================================================-->

    <script src="api/admin.js"></script>
    <script src="api/session.js"></script>
    <script>
    </script>

</body>

</html>
<!-- end document-->