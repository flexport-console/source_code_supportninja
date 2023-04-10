<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>supportninja</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/new_logo.png">
    <link href="./css/style.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
</head>



<body class="h-100 bg-flexport-black">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content bg-flexport-whie">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
									<div class="text-center mb-3">
										<a href="#"><img class="" src="images/new_sni.png" alt=""></a>
									</div>
                                    <h4 class="text-center mb-4 flexport-black">Sign in your account</h4>

                                    
                                    <?php 
                                    if (isset($_GET['status']) && $_GET['status']=="locked") { ?>
                                        <div class="alert alert-danger solid alert-square"><strong>Account Locked.</strong>
                                            <p>Please contact your immediate supervisor.</p>
                                        </div>
                                        
                                    <?php
                                    }
                                    ?>

                                    <?php 
                                    if (isset($_GET['status']) && $_GET['status']=="notfound") { ?>
                                        <div class="alert alert-danger solid alert-square"><strong>Employee ID Not found.</strong>
                                            <p>Please contact your immediate supervisor to register your Employee ID.</p>
                                        </div>
                                        
                                    <?php
                                    }
                                    ?>


                                    <?php 
                                    if (isset($_GET['status']) && $_GET['status']=="incorrect") { ?>
                                        <div class="alert alert-danger solid alert-square"><strong>Incorrect Employee ID or Password.</strong>
                                            <p>Please try again.</p>
                                        </div>

                                    <?php
                                    }
                                    ?>
                                    


                                    <form class="form-valide-with-icon" action="connection/login_validate.php" method="post">
                                        <div class="form-group">
                                            <label class="text-label flexport-black">Employee ID *</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                                                </div>
                                                <input type="text" class="form-control" id="val-username1" name="val-username" placeholder="Enter a Employee ID.." onkeypress="return isNumber(event)">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="text-label flexport-black">Password *</label>
                                            <div class="input-group transparent-append">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                                                </div>
                                                <input type="password" class="form-control" id="val-password1" name="val-password" placeholder="Enter a Password..">
                                                
                                            </div>
                                        </div>
                                        <div class="form-row d-flex justify-content-between text-white mt-4 mb-2">
                                            <!-- TEST -->
                                            
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" name="button" class="btn bg-flexport-blue text-white btn-block">Sign Me In</button>
                                        </div>
                                    </form>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="./vendor/global/global.min.js"></script>
	<script src="./vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="./js/custom.min.js"></script>
    <script src="./js/deznav-init.js"></script>

    <!-- Jquery Validation -->
    <script src="./vendor/jquery-validation/jquery.validate.min.js"></script>
    <!-- Form validate init -->
    <script src="./js/plugins-init/jquery.validate-init.js"></script>
</body>
<script>
    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }
</script>
</html>