<?php 
include 'connection/user_information.php';
if (!in_array("Users",$_roles)) {
   header("location: 403.php");
}

$break = "SELECT b.user_employee_id as employeeID, concat(u.user_firstname, ' ', u.user_lastname) as fullname_ninja, b.q_remarks as category, b.q_date as qdate, b.q_time as qtime FROM queue b LEFT JOIN users u ON b.user_employee_id=u.user_employee_id WHERE b.q_lineofbusiness='break' ORDER BY b.q_id DESC LIMIT 1000";
$break_res = mysqli_query($conn, $break);


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
                        <h2 class="text-black font-w600">Punch Break</h2>
                        <p class="mb-0">All user's Punch break will shown here.</p>
                    </div>
                </div>
                <hr>
               
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive card-table">
                            <table id="example5" class="display dataTablesCard table-responsive-xl">
                                <thead>
                                    <tr>
                                       <th>#</th>
                                       <th>Employee ID</th>
                                       <th>Full Name</th>
                                       <th>Date</th>
                                       <th>Time</th>
                                       <th>Category</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (mysqli_num_rows($break_res)>0) {
                                        $x=1;
                                        while ($row = mysqli_fetch_assoc($break_res)) {
                                    ?>
                                    <tr>
                                       <td><?php echo $x; ?></td>
                                       <td><?php echo $row['employeeID']; ?></td>
                                       <td><?php echo $row['fullname_ninja']; ?></td>
                                       <td><?php echo $row['qdate']; ?></td>
                                       <td><?php echo $row['qtime']; ?></td>
                                       <td>
                                        <span
                                        class="
                                       <?php 
                                        if ($row['category'] == "Ready") {
                                            echo "badge badge-rounded badge-outline-primary";
                                        }elseif ($row['category'] == "First Break - Start" || $row['category'] == "First Break - End") {
                                            echo "badge badge-rounded badge-outline-secondary";
                                        }elseif ($row['category'] == "Lunch Break - Start" || $row['category'] == "Lunch Break - End") {
                                            echo "badge badge-rounded badge-outline-info";
                                        }elseif ($row['category'] == "Last Break - Start" || $row['category'] == "Last Break - End") {
                                            echo "badge badge-rounded badge-outline-warning";
                                        }elseif ($row['category'] == "End Shift") {
                                            echo "badge badge-rounded badge-outline-danger";
                                        }
                                       ?>
                                       "

                                        ><?php echo $row['category']; ?></span>

                                       </td>

                                   </tr>

                                    <?php
                                        $x+=1;
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
</html>