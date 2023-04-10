<?php 
include 'connection/user_information.php';

if (!in_array("Administrator",$_roles)) {
   header("location: 403.php");
}


$audit = "SELECT concat(u.user_firstname,' ',u.user_lastname) as name, a.au_desc as qdesc, a.au_time as qtime, a.au_date as qdate, a.au_page as page, a.au_ip as ip, a.au_category as category  FROM audit_trail a INNER JOIN users u ON u.user_employee_id=a.user_employee_id ORDER BY a.au_id DESC LIMIT 2000;";
$audit_res = mysqli_query($conn, $audit);
?>

<!DOCTYPE html>
<html lang="en">

<?php include 'pages/header.php'; ?>
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css" rel="stylesheet">
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
                        <h2 class="text-black font-w600">Audit Trail</h2>
                        <p class="mb-0">All user's activity will shown here.</p>

                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table header-border table-responsive-sm fixed">
                                <thead>
                                    <tr>
                                       <th>#</th>
                                       <th>Name</th>
                                       <th>Description</th>
                                       <th>Time</th>
                                       <th>Date</th>
                                       <th>Page</th>
                                       <th>IP</th>
                                       <th>Category</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (mysqli_num_rows($audit_res)>0) {
                                        $x=1;
                                        while ($row = mysqli_fetch_assoc($audit_res)) {
                                    ?>
                                    <tr>
                                       <td><?php echo $x; ?></td>
                                       <td><?php echo $row['name']; ?></td>
                                       <td><?php echo $row['qdesc']; ?></td>
                                       <td><?php echo $row['qtime']; ?></td>
                                       <td><?php echo $row['qdate']; ?></td>
                                       <td><?php echo $row['page']; ?></td>
                                       <td><?php echo $row['ip']; ?></td>
                                       <td><span
                                        class="
                                       <?php 
                                        if ($row['category'] == "login") {
                                            echo "badge badge-rounded badge-outline-success";
                                        }elseif ($row['category'] == "queue") {
                                            echo "badge badge-rounded badge-outline-danger";
                                        }elseif ($row['category'] == "account") {
                                            echo "badge badge-rounded badge-outline-info";
                                        }elseif ($row['category'] == "resources") {
                                            echo "badge badge-rounded badge-outline-warning";
                                        }
                                       ?>
                                       "
                                        ><?php echo $row['category']; ?></span></td>
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
    <!-- <script src="./vendor/sweetalert2/dist/sweetalert2.min.js"></script> -->
    <!-- <script src="./js/plugins-init/sweetalert.init.js"></script> -->
    <script src="
    https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js
    "></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- <script src="./js/plugins-init/select2-init.js"></script> -->
<?php include 'modal/backlogs.php'; ?>
</body>



</html>