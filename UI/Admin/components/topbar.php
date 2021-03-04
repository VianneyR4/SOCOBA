 <!-- HEADER DESKTOP-->
 <header class="header-desktop3 d-none d-lg-block">
            <div class="section__content section__content--p35">
                <div class="header3-wrap">
                    <div class="header__logo">
                        <a href="#">
                            <img style="height: 45px" src="images/icon/socobaLogo.png" alt="CoolAdmin" />
                        </a>
                    </div>
                    <div class="header__navbar">
                        <ul class="list-unstyled">
                            <li class="active has-sub">
                                <a href="index.php">
                                    <i class="fas fa-desktop"></i>
                                    <span class="bot-line"></span>Dashboard
                                </a>
                            </li>
                            <li>
                                <a href="commerce.php">
                                    <i class="fas fa-cart-arrow-down"></i>
                                    <span class="bot-line"></span>Commerce</a>
                            </li>
                            <li>
                                <a href="subscribers.php">
                                    <i class="fas fa-star"></i>
                                    <span class="bot-line"></span>Subscribers</a>
                            </li>

                            <li class="has-sub">
                                <a href="#">
                                    <i class="fas fa-copy"></i>
                                    <span class="bot-line"></span>Reports</a>
                                <ul class="header3-sub-list list-unstyled">
                                    <li>
                                        <a href="commerce_report.php">Commerce Report</a>
                                    </li>
                                    <li>
                                        <a href="borrowing_report.php">Borrowing Report</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="header__tool">

                        <div class="header-button-item has-noti js-item-menu">
                            <i class="zmdi zmdi-notifications"></i>
                            <div class="notifi-dropdown js-dropdown">
                                <div class="notifi__title">
                                    <p>You have 3 Notifications</p>
                                </div>
                                <div class="notifi__item">
                                    <div class="bg-c1 img-cir img-40">
                                        <i class="zmdi zmdi-email-open"></i>
                                    </div>
                                    <div class="content">
                                        <p>You got a email notification</p>
                                        <span class="date">April 12, 2018 06:50</span>
                                    </div>
                                </div>
                                <div class="notifi__item">
                                    <div class="bg-c2 img-cir img-40">
                                        <i class="zmdi zmdi-account-box"></i>
                                    </div>
                                    <div class="content">
                                        <p>Your account has been blocked</p>
                                        <span class="date">April 12, 2018 06:50</span>
                                    </div>
                                </div>
                                <div class="notifi__item">
                                    <div class="bg-c3 img-cir img-40">
                                        <i class="zmdi zmdi-file-text"></i>
                                    </div>
                                    <div class="content">
                                        <p>You got a new file</p>
                                        <span class="date">April 12, 2018 06:50</span>
                                    </div>
                                </div>
                                <div class="notifi__footer">
                                    <a href="#">All notifications</a>
                                </div>
                            </div>
                        </div>
                        <div class="account-wrap">
                            <div class="account-item account-item--style2 clearfix js-item-menu">
                                <!-- <div class="d-flex" > -->
                                <div class="image" @click="showAccountDropdownVar==false? showAccountDropdownVar=true : showAccountDropdownVar=false">
                                    <img src="images/icon/avatar-01.jpg" alt="Vianney R" />
                                </div>
                                <div class="content" @click="showAccountDropdownVar==false? showAccountDropdownVar=true : showAccountDropdownVar=false">
                                    <a class="js-acc-btn" href="#">Vianney Rwicha</a>
                                </div>
                                <!-- </div> -->
                                <div class="account-dropdown js-dropdown" :class="showAccountDropdownVar? 'show' : ''">
                                    <div class="info clearfix">
                                        <div class="image">
                                            <a href="#">
                                                <img src="images/icon/avatar-01.jpg" alt="Vianney R" />
                                            </a>
                                        </div>
                                        <div class="content">
                                            <h5 class="name">
                                                <a href="#">Vianney Rwicha</a>
                                            </h5>
                                            <span class="email">vianneyrwicha@gmail.com</span>
                                        </div>
                                    </div>
                                    <div class="account-dropdown__body">
                                        <div class="account-dropdown__item">
                                            <a href="#">
                                                <i class="zmdi zmdi-account"></i>Account</a>
                                        </div>
                                        <div class="account-dropdown__item">
                                            <a href="#">
                                                <i class="zmdi zmdi-settings"></i>Setting</a>
                                        </div>
                                    </div>
                                    <div class="account-dropdown__footer">
                                        <a href="#" onclick="logout()">
                                            <i class="zmdi zmdi-power"></i>Logout</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- END HEADER DESKTOP-->

        <!-- HEADER MOBILE-->
        <header class="header-mobile header-mobile-2 d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="index.php">
                            <img height="50px" src="images/icon/logo-white.png" alt="CoolAdmin" />
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-desktop"></i>Dashboard</a>
                        </li>
                        <li>
                            <a href="commerce.php">
                                <i class="fas fa-cart-arrow-down"></i>Commerce</a>
                        </li>
                        <li>
                            <a href="subscribers.php">
                                <i class="fas fa-star"></i>Subscribers</a>
                        </li>
                        <li class="has-sub">
                            <a href="staff.php">
                                <i class="fas fa-desktop"></i>Staff</a>
                        </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-copy"></i>Reports</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li>
                                    <a href="commerce_report.php">Commerce Report</a>
                                </li>
                                <li>
                                    <a href="borrowing_report.php">Borrowing Report</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <div class="sub-header-mobile-2 d-block d-lg-none">
            <div class="header__tool">
                <div class="header-button-item has-noti js-item-menu">
                    <i class="zmdi zmdi-notifications"></i>
                    <div class="notifi-dropdown notifi-dropdown--no-bor js-dropdown">
                        <div class="notifi__title">
                            <p>You have 3 Notifications</p>
                        </div>
                        <div class="notifi__item">
                            <div class="bg-c1 img-cir img-40">
                                <i class="zmdi zmdi-email-open"></i>
                            </div>
                            <div class="content">
                                <p>You got a email notification</p>
                                <span class="date">April 12, 2018 06:50</span>
                            </div>
                        </div>
                        <div class="notifi__item">
                            <div class="bg-c2 img-cir img-40">
                                <i class="zmdi zmdi-account-box"></i>
                            </div>
                            <div class="content">
                                <p>Your account has been blocked</p>
                                <span class="date">April 12, 2018 06:50</span>
                            </div>
                        </div>
                        <div class="notifi__item">
                            <div class="bg-c3 img-cir img-40">
                                <i class="zmdi zmdi-file-text"></i>
                            </div>
                            <div class="content">
                                <p>You got a new file</p>
                                <span class="date">April 12, 2018 06:50</span>
                            </div>
                        </div>
                        <div class="notifi__footer">
                            <a href="#">All notifications</a>
                        </div>
                    </div>
                </div>
                <div class="account-wrap">
                    <div class="account-item account-item--style2 clearfix js-item-menu">
                        <!-- <div class="d-flex" > -->
                        <div class="image" @click="showAccountDropdownVar==false? showAccountDropdownVar=true : showAccountDropdownVar=false">
                            <img src="images/icon/avatar-01.jpg" alt="Vianney R" />
                        </div>
                        <div class="content" @click="showAccountDropdownVar==false? showAccountDropdownVar=true : showAccountDropdownVar=false">
                            <a class="js-acc-btn" href="#">Vianney Rwicha</a>
                        </div>
                        <!-- </div> -->
                        <div class="account-dropdown js-dropdown" :class="showAccountDropdownVar? 'show' : ''">
                            <div class="info clearfix">
                                <div class="image">
                                    <a href="#">
                                        <img src="images/icon/avatar-01.jpg" alt="Vianney R" />
                                    </a>
                                </div>
                                <div class="content">
                                    <h5 class="name">
                                        <a href="#">Vianney Rwicha</a>
                                    </h5>
                                    <span class="email">vianneyrwicha@gmail.com</span>
                                </div>
                            </div>
                            <div class="account-dropdown__body">
                                <div class="account-dropdown__item">
                                    <a href="#">
                                        <i class="zmdi zmdi-account"></i>Account</a>
                                </div>
                                <div class="account-dropdown__item">
                                    <a href="#">
                                        <i class="zmdi zmdi-settings"></i>Setting</a>
                                </div>
                            </div>
                            <div class="account-dropdown__footer">
                                <a href="#" onclick="logout()">
                                    <i class="zmdi zmdi-power"></i>Logout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END HEADER MOBILE -->