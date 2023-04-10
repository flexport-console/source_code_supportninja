<?php 
include 'connection/user_information.php';


?>

<!DOCTYPE html>
<html lang="en">

<?php include 'pages/header.php'; ?>
<link href="./vendor/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style type="text/css">
    table.fixed {
        table-layout: fixed !important;
    }

    table.fixed td {
        overflow: hidden !important;
    }
</style>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <a href="index.php" class="brand-logo">
                <img class="logo-abbr" src="./images/new_branding.png" alt="">
                <img class="logo-compact" src="./images/long_logo.png" alt="">
                <img class="brand-title" src="./images/long_logo.png" alt="">
            </a>

            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->


        <!--**********************************
            Header start
        ***********************************-->
        <?php include 'pages/navbar_header.php' ?>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <?php include 'pages/sidebar.php' ?>
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- row -->
            <div class="container-fluid">
                <div class="form-head d-flex align-items-center mb-sm-4 mb-3">
                    <div class="mr-auto">
                        <h2 class="text-black font-w600">Your setting</h2>
                        <p class="mb-0">You may change your information here.</p>

                    </div>
                </div>
                <?php 
                if (isset($_GET['password']) && $_GET['password']=="success") { ?>
                    <div class="alert alert-success solid alert-dismissible fade show">
                        <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span></button>
                        <strong>Success!</strong> Your password has been changed.
                    </div>

                <?php 
                }
                ?>

                <?php 
                if (isset($_GET['password']) && $_GET['password']=="incorrect_password") { ?>
                    <div class="alert alert-danger solid alert-dismissible fade show">
                        <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span></button>
                        <strong>Incorrect!</strong> Your current password is incorrect. Please try again.
                    </div>

                <?php 
                }
                ?>

                <?php 
                if (isset($_GET['password']) && $_GET['password']=="error_occured") { ?>
                    <div class="alert alert-danger solid alert-dismissible fade show">
                        <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span></button>
                        <strong>Error occured!</strong> Please report it to your immediate supervisor.
                    </div>

                <?php 
                }
                ?>

                <?php 
                if (isset($_GET['update']) && $_GET['update']=="success") { ?>
                    <div class="alert alert-success solid alert-dismissible fade show">
                        <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span></button>
                        <strong>Success!</strong> Account information has been updated.
                    </div>

                <?php 
                }
                ?>

                <div class="row">
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header d-sm-flex d-block pb-0 border-0">
                                <div class="mr-auto pr-3">
                                    <h4 class="text-black fs-20 mb-0">Account Information</h4>
                                </div>
                            </div>
                            <hr>
                            <div class="card-body">
                                <form action="connection/user_settings.php" method="post">
                                    <div class="row">
                                        <div class="col-xl-6 form-group">
                                            <label class="text-dark">Employee ID</label>
                                            <input type="text" id="numbers_only" name="employee_id" maxlength="7" class="form-control" value="<?php echo $user_information['employeeID'] ?>" readonly>
                                        </div>
                                        <div class="col-xl-6 form-group">
                                            <label class="text-dark">SN Email</label>
                                            <input type="email" name="email" class="form-control" value="<?php echo $user_information['email'] ?>" required>
                                        </div>
                                        <div class="col-xl-6 form-group">
                                            <label class="text-dark">First Name</label>
                                            <input type="text" name="firstname" class="form-control" value="<?php echo $user_information['firstname'] ?>" required>
                                        </div>
                                        <div class="col-xl-6 form-group">
                                            <label class="text-dark">Last Name</label>
                                            <input type="text" name="lastname" class="form-control" value="<?php echo $user_information['lastname'] ?>" required>
                                        </div>
                                        <div class="col-xl-6 form-group">
                                                <button type="submit" name="acc_info" class="btn btn-primary btn-sm">Save change</button>
                                        </div>
                                    </div>
                                </form>
                            </div>


                        </div>
                    </div>




                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header d-sm-flex d-block pb-0 border-0">
                                <div class="mr-auto pr-3">
                                    <h4 class="text-black fs-20 mb-0">Change Password</h4>
                                </div>
                            </div>
                            <hr>
                            <div class="card-body">
                                <div class="form-validation">
                                    <form class="form-valide" action="connection/user_settings.php" method="post">
                                        <div class="row">
                                            <div class="form-group col-lg-12">
                                                <label>Current Password</label>
                                                <div class="">
                                                    <input type="password" class="form-control" id="val-old-password" name="val-old-password" placeholder="Enter your old password">
                                                </div>
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label>New Password</label>
                                                <div class="">
                                                    <input type="password" class="form-control" id="val-password" name="val-password" placeholder="Choose a safe one..">
                                                </div>
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label>Confirm Password Password</label>
                                                <div class="">
                                                    <input type="password" class="form-control" id="val-confirm-password" name="val-confirm-password" placeholder="Please confirm your password">
                                                </div>
                                            </div>



                                            <div class="col-xl-6 form-group">
                                                <button type="submit" name="change_password" class="btn btn-primary btn-sm">Change Password</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>


            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->

        <!--**********************************
            Footer start
        ***********************************-->
        <?php include 'pages/footer.php'; ?>
        <!--**********************************
            Footer end
        ***********************************-->

        <!--**********************************
           Support ticket button start
        ***********************************-->

        <!--**********************************
           Support ticket button end
        ***********************************-->


    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="./vendor/global/global.min.js"></script>
    <script src="./vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="./vendor/chart.js/Chart.bundle.min.js"></script>
    <script src="./js/custom.min.js"></script>
    <script src="./js/deznav-init.js"></script>

    <!-- sweetalert -->
    <script src="./vendor/sweetalert2/dist/sweetalert2.min.js"></script>
    <!-- <script src="./js/plugins-init/sweetalert.init.js"></script> -->


    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- <script src="./js/plugins-init/select2-init.js"></script> -->


    <!-- Jquery Validation -->
    <script src="./vendor/jquery-validation/jquery.validate.min.js"></script>
    <!-- Form validate init -->
    <script src="./js/plugins-init/jquery.validate-init.js"></script>
</body>
<script type="text/javascript">
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });

    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });
</script>
<script type="text/javascript">
    $('#numbers_only').keypress(function(e) {
        var a = [];
        var k = e.which;

        for (i = 48; i < 58; i++)
            a.push(i);

        if (!(a.indexOf(k) >= 0))
            e.preventDefault();
    });
</script>

</html>