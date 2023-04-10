<?php 
include 'connection/user_information.php';
if (!in_array("Users",$_roles)) {
   header("location: 403.php");
}

$supervisor_select = "SELECT * FROM users WHERE user_position IN ('Team Manager', 'Operations Manager', 'Director')";
$supervisor_select_res = mysqli_query($conn, $supervisor_select);

$line_business = mysqli_query($conn, "SELECT * FROM r_linebusiness");


$users_list = mysqli_query($conn, "SELECT u1.user_employee_id as employeeID, u1.user_firstname as firstname, u1.user_lastname as lastname, CONCAT(u2.user_firstname,' ',u2.user_lastname) as Team_Manager, u1.user_status as status, u1.user_position as position FROM users u1 LEFT JOIN users u2 ON u1.user_supervisor_id=u2.user_employee_id");


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>supportninja</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/new_logo.png">
    <link href="./vendor/jqvmap/css/jqvmap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./vendor/chartist/css/chartist.min.css">
    <!-- Datatable -->
    <link href="./vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="./vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="./css/style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
</head>

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
                        <h2 class="text-black font-w600">Users</h2>
                        <p class="mb-0">List of users here.</p>
                    </div>
                    <div>
                        <a href="javascript:void(0)" class="btn btn-primary btn-sm mr-3" data-toggle="modal" data-target=".bd-example-modal-lg">+ New User</a>
                    </div>
                </div>
                <hr>
                <?php 
                if (isset($_GET['user']) && $_GET['user']=="success") { 
                ?>
                <div class="alert alert-primary solid alert-right-icon alert-dismissible fade show">
                    <span><i class="mdi mdi-account-plus"></i></span>
                     <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                    </button> Success! User has been added.
                </div>

                <?php
                }
                ?>

                <?php 
                if (isset($_GET['user']) && $_GET['user']=="already") { 
                ?>
                <div class="alert alert-danger solid alert-right-icon alert-dismissible fade show">
                    <span><i class="mdi mdi-account-plus"></i></span>
                     <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                    </button> Error! User already been added.
                </div>

                <?php
                }
                ?>
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive card-table">
                            <table id="example5" class="display dataTablesCard table-responsive-xl">
                                <thead>
                                    <tr>
                                        
                                        <th>Employee ID</th>
                                        <th>Name</th>
                                        <th>Immediate Supervisor</th>
                                        <th>Line of Business</th>
                                        <th>Position</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    if (mysqli_num_rows($users_list)>0) {
                                        while ($row = mysqli_fetch_assoc($users_list)) { 
                                            $employee_fet = $row['employeeID'];
                                            $line_user = mysqli_query($conn, "SELECT * FROM users_linebusiness WHERE user_employee_id='$employee_fet'");

                                    ?>
                                    <tr>
                                       
                                        <td><span class="text-nowrap"><?php echo $employee_fet; ?></span></td>
                                        <td><?php echo $row['firstname']." ".$row['lastname']; ?></td>
                                        <td><?php echo $row['Team_Manager'] ?></td>
                                        <td>
                                            <?php 
                                            if (mysqli_num_rows($line_user)>0) {
                                                while ($rows = mysqli_fetch_assoc($line_user)) {
                                            ?>
                                                <span class="badge badge-rounded badge-outline-primary"><?php echo $rows['ul_linebusiness']; ?></span>
                                            <?php
                                                }
                                            }
                                            ?>

                                        </td>
                                        <td>
                                            <?php echo $row['position'] ?>
                                            <!-- <a href="javascript:void(0)" class="btn btn-primary text-nowrap btn-sm light"></a> -->
                                        </td>
                                        <td><span class="text-dark"><?php echo $row['status'] ?></span></td>
                                        <td>
                                            <div class="dropdown ml-auto text-right">
                                                <div class="btn-link" data-toggle="dropdown">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11Z" stroke="#2E2E2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                        <path d="M12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18Z" stroke="#2E2E2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                        <path d="M12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4Z" stroke="#2E2E2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                </div>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="user_profile.php?user=<?php echo $row['employeeID']; ?>&view=view">View Detail</a>
                                                    <a class="dropdown-item" href="user_profile.php?user=<?php echo $row['employeeID']; ?>&view=edit">Edit</a>
                                                    <!-- <a class="dropdown-item" href="#">Delete</a> -->
                                                </div>
                                            </div>
                                        </td>
                                    </tr>  


                                    <?php
                                        }
                                    }
                                    ?>
                                    
                                </tbody>
                            </table>
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
</script>

<script type="text/javascript">
    $('.distro').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            type: 'post',
            url: 'connection/queue_distro.php',
            data: $(this).serialize(),
            beforeSend: function() {
                document.getElementById("button").disabled = true;
            },
            success: function(result) {
                if (result == "success") {
                    console.log(result)
                    $("#d_employee_id").val("").trigger("change");
                    $("#d_linebusiness").val("").trigger("change");
                    $("#d_workflow").val("").trigger("change");
                    $("#d_sop").val("").trigger("change");
                    document.getElementById("QueueBox").value = "";
                    document.getElementById("button").disabled = false;
                    document.getElementById("alert_punch").hidden = false;
                }
            }
        });
    });
</script>
<!-- Datatable -->
    <script src="./vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script>
        (function($) {
            var table = $('#example5').DataTable({
                // searching: false,
                paging:true,
                select: false,
                pageLength: 50,
                //info: false,         
                lengthChange:false 
                
            });
            $('#example tbody').on('click', 'tr', function () {
                var data = table.row( this ).data();
                
            });
        })(jQuery);
    </script>
<?php 
include 'modal/users.php';
?>



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