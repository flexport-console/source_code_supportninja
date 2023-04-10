<?php 
include 'connection/user_information.php';
include 'display/tracker_distro.php';


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
                        <h2 class="text-black font-w600">Tickets</h2>
                        <p class="mb-0">You can see your daily tickets right here.</p>

                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-3">
                                <form class="distro" action="#" method="post">
                                    <div>
                                        <input hidden type="text" name="run_btn" value="run_btn">
                                        <!-- <label class="mr-sm-2">Punch</label> -->

                                        <input type="date" class="form-control mb-2" name="qdate">

                                        <button class="btn btn-primary btn-xxs w-100">
                                            Run
                                        </button>

                                        <a href="connection/export_daily.php" class="btn btn-secondary btn-xxs w-100">Download</a>
                                        <span class="text-center"><i>Please display first before download.</i></span>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table header-border table-responsive-sm fixed">
                                <thead>
                                    <tr>
                                        <th>Flex-ID</th>
                                        <th>Line of Business</th>
                                        <th>Workflow</th>
                                        <th>SOP</th>
                                        <th>Status</th>
                                        <th>Remarks</th>
                                        <th>Handle Time</th>
                                        <th># of Shipment</th>
                                    </tr>
                                </thead>
                                <tbody class="reload">
                                    
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
            url: 'connection/run.php',
            data: $(this).serialize(),
            success: function(result) {
               refresh_div();
                
            }
        });
    });


    function refresh_div() {
        jQuery.ajax({
            url: 'display/daily_table.php',
            type: 'POST',
            success: function(results) {
                jQuery(".reload").html(results);
            }
        });
    }
</script>









</html>