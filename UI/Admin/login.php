<!DOCTYPE html>
<html lang="en">

<head>
    <title>SOCOBA Admin Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/favicon.ico" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!--===============================================================================================-->
    <script src="lib/w3Data.js"></script>
    <!--===============================================================================================-->
</head>

<body>
    <div class="limiter">
        <div class="alert topRight alert-danger alert-dismissible fade" id="myAlert2" role="alert">
            <strong>Error!</strong> <span id="inarMessage2"></span>
            <button type="button" class="close" onclick="hideAlert2()" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-pic js-tilt" data-tilt>
                    <img src="images/img-01.png" alt="IMG">
                </div>

                <div action="" method="POST" class="login100-form validate-form">
                    <span class="login100-form-title">
						Admin Login
					</span>

                    <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                        <input class="input100" id="input1" type="text" name="email" placeholder="Email">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                        <input class="input100" id="input2" type="password" name="pass" placeholder="Password">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
                    </div>

                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn submit-btn" id="submit" onclick="loginVerification()">
							Login
						</button>
                    </div>

                    <div class="text-center p-t-12">
                        <span class="txt1">
							Forgot
						</span>
                        <a class="txt2" href="#">
							Username / Password?
						</a>
                    </div>

                    <center>
                        <br/>
                        <img id="loader" height="40" src="images/icons/loader.gif" style="display: none;" />
                    </center>

                    <div class="alert alert-danger alert-dismissible fade" id="myAlert" role="alert">
                        <strong>Error!</strong> <span id="inarMessage"></span>
                        <button type="button" class="close" onclick="hideAlert()" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                    </div>


                    <div class="text-center p-t-10">
                        <a class="txt2" href="#">
							Create your Account
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!--===============================================================================================-->
    <!--===============================================================================================-->
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.0"></script>
    <script src="https://unpkg.com/vue-router@2.0.0"></script>
    <!--===============================================================================================-->
    <!--===============================================================================================-->
    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/bootstrap/js/popper.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/tilt/tilt.jquery.min.js"></script>
    <script>
        $('.js-tilt').tilt({
            scale: 1.1
        })
    </script>

    <!--===============================================================================================-->
    <script src="js/mainLogin.js"></script>
    <!--===============================================================================================-->
    <!--===============================================================================================-->

    <script src="api/admin.js"></script>
    <script>
        let url_string = window.location.href;
        let url = new URL(url_string);
        let getStatut = url.searchParams.get("status");
        console.log("Error Status: ", getStatut);

        function funcTimeOut() {
            let myVar = setTimeout(hideAlert2, 5000);
        }

        const hideAlert2 = () => {
            document.getElementById("myAlert2").classList.remove("show");
        };

        if (getStatut != null) {
            document.getElementById("myAlert2").classList.add("show");
            funcTimeOut();
            if (getStatut == 0) {
                document.getElementById("inarMessage2").innerHTML = "You mast login first!";
            } else if (getStatut == 1) {
                document.getElementById("inarMessage2").innerHTML = "Your session has expired!";
            }
        }

        let submit1 = document.getElementById("input1");
        submit1.addEventListener("keyup", function(event) {
            if (event.keyCode === 13) {
                event.preventDefault();
                document.getElementById("submit").click();
            }
        });
        let submit2 = document.getElementById("input2");
        submit2.addEventListener("keyup", function(event) {
            if (event.keyCode === 13) {
                event.preventDefault();
                document.getElementById("submit").click();
            }
        });


        let loaderElement = document.getElementById("loader");
        // loaderElement.style.display = "none";

        const loginVerification = () => {

            loaderElement.style.display = "block";
            document.getElementById("myAlert").classList.remove("show");

            let email = document.getElementsByName("email")[0].value;
            let password = document.getElementsByName("pass")[0].value;
            let varErrorMsg = null;

            if (email != "" && password != "") {
                login(email, password).then((response) => {


                        if (response.status != 400) {
                            window.location = "index.php";
                            localStorage.setItem("token", response.token);
                            localStorage.setItem("id", response.adminId);
                            loaderElement.style.display = "none";
                        } else {
                            if (response.message == "Email not found!") {
                                document.getElementById("inarMessage").innerHTML = response.message
                                document.getElementById("myAlert").classList.toggle("show");
                                loaderElement.style.display = "none";
                            } else if (response.message == "Invalid password!") {
                                document.getElementById("inarMessage").innerHTML = response.message
                                document.getElementById("myAlert").classList.toggle("show");
                                loaderElement.style.display = "none";
                            } else {
                                document.getElementById("inarMessage").innerHTML = response.message
                                document.getElementById("myAlert").classList.toggle("show");
                                loaderElement.style.display = "none";
                            }
                        }
                    })
                    .catch((err) => {
                        document.getElementById("inarMessage").innerHTML = "Server error!"
                        document.getElementById("myAlert").classList.toggle("show");
                        loaderElement.style.display = "none";
                    })
            }
        }

        const hideAlert = () => {
            document.getElementById("myAlert").classList.remove("show");
        };
    </script>
    <!--===============================================================================================-->

</body>

</html>