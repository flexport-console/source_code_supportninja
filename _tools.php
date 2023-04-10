<?php 
include 'connection/user_information.php';

$users_selection = "SELECT * FROM users";
$users_selection_role = mysqli_query($conn, $users_selection);
$users_selection_tracker = mysqli_query($conn, $users_selection);
if (!in_array("Administrator",$_roles)) {
   header("location: 403.php");
}


?>

<!DOCTYPE html>
<html lang="en">

<?php include 'pages/header.php'; ?>
<link href="./vendor/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style type="text/css">
	table.fixed { table-layout:fixed!important; }
	table.fixed td { overflow: hidden!important; }
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
                        <h2 class="text-black font-w600">Administrator Tools</h2>
                        <p class="mb-0">Admin role have an access on this page.</p>

                    </div>
                </div>
                <?php 
                if (isset($_GET['tracker']) && $_GET['tracker']=="success") {
                ?>
                <div class="alert alert-outline-success text-success alert-dismissible fade show">
                    <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                    </button>Success! Tracker has been assigned to the user.
                </div>
                <?php
                }
                ?>

                <?php 
                if (isset($_GET['tracker']) && $_GET['tracker']=="tracker") {
                ?>
                <div class="alert alert-outline-warning text-warning alert-dismissible fade show">
                    <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                    </button>Tracker has already been assigned.
                </div>
                <?php
                }
                ?>


                <?php 
                if (isset($_GET['role']) && $_GET['role']=="success") {
                ?>
                <div class="alert alert-outline-success text-success alert-dismissible fade show">
                    <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                    </button>Role has been assigned to user.
                </div>
                <?php
                }
                ?>

                <div class="row">
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header d-sm-flex d-block pb-0 border-0">
                                <div class="mr-auto pr-3">
                                    <h4 class="text-black fs-20 mb-0">Role to user</h4>
                                </div>
                            </div>
                            <hr>
                            <div class="card-body">
                                <form action="connection/_tools.php" method="post">
                                    <div>
                                        <label>Name</label>
                                        <select class="js-example-basic-single" name="employeeid" required>
                                            <option selected disabled></option>
                                            <?php
                                            if (mysqli_num_rows($users_selection_role)>0) {
                                                while ($row = mysqli_fetch_assoc($users_selection_role)) {
                                            ?>
                                                <option value="<?php echo $row['user_employee_id']; ?>"><?php echo $row['user_firstname']." ".$row['user_lastname']; ?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div>
                                        <label>Role</label>
                                        <select class="js-example-basic-multiple" name="role[]" multiple="multiple" required>
                                            <option disabled></option>
                                            <option>Administrator</option>
                                            <option>Tools</option>
                                            <option>Queue</option>
                                            <option>Users</option>
                                            <option>Resources</option>
                                        </select>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-xl-6">
                                            <button type="submit" name="rolebtn" class="btn btn-primary btn-sm w-100">Add</button>
                                        
                                        </div>
                                        <div class="col-xl-6">
                                            <button type="button" class="btn btn-secondary btn-sm w-100 text-white">Cancel</button>
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
                                    <h4 class="text-black fs-20 mb-0">Assigned Tracker</h4>
                                </div>
                            </div>
                            <hr>
                            <div class="card-body">
                                <form action="connection/_tools.php" method="post">
                                    <div>
                                        <label>Name</label>
                                        <select class="js-example-basic-single" name="employeeid" required>
                                            <option selected disabled></option>
                                            <?php
                                            if (mysqli_num_rows($users_selection_tracker)>0) {
                                                while ($row = mysqli_fetch_assoc($users_selection_tracker)) {
                                            ?>
                                                <option value="<?php echo $row['user_employee_id']; ?>"><?php echo $row['user_firstname']." ".$row['user_lastname']; ?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div>
                                        <label>Role</label>
                                        <select class="js-example-basic-single" name="tracker" required>
                                            <option selected disabled></option>
                                            <option>Distro</option>
                                            <option>Input</option>
                                            <option>Cav</option>
                                        </select>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-xl-6">
                                            <button type="submit" name="trackerbtn" class="btn btn-primary btn-sm w-100">Add</button>
                                        
                                        </div>
                                        <div class="col-xl-6">
                                            <button type="button" class="btn btn-secondary btn-sm w-100 text-white">Cancel</button>
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
                                    <h4 class="text-black fs-20 mb-0">Test</h4>
                                </div>
                            </div>
                            <hr>
                            <div class="card-body">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Test</th>
                                            <th>Test</th>
                                            <th>Test</th>
                                            <th>Test</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Test</td>
                                            <td>Test</td>
                                            <td>Test</td>
                                            <td>Test</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header d-sm-flex d-block pb-0 border-0">
                                <div class="mr-auto pr-3">
                                    <h4 class="text-black fs-20 mb-0">Test</h4>
                                </div>
                            </div>
                            <hr>
                            <div class="card-body">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Test</th>
                                            <th>Test</th>
                                            <th>Test</th>
                                            <th>Test</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Test</td>
                                            <td>Test</td>
                                            <td>Test</td>
                                            <td>Test</td>
                                        </tr>
                                    </tbody>
                                </table>
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
</body>
<script type="text/javascript">
	$(document).ready(function() {
	    $('.js-example-basic-single').select2();
	});

    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });
</script>


</html>