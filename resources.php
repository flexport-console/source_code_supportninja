<?php 
include 'connection/user_information.php';
include 'display/resources_select.php';

if (!in_array("Resources",$_roles)) {
   header("location: 403.php");
}

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
    <!-- Datatable -->
    <link href="./vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    <!-- Custom Stylesheet -->
    <link href="./vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="./css/style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
                        <h2 class="text-black font-w600">Resources</h2>
                        <p class="mb-0">You can Add Line of Business, Wokflow, Remarks, SOP and Remarks here.</p>

                    </div>
                </div>
                <?php include 'modal/resources.php'; ?>
                <div class="row">
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Line of Business</h4>
                                <button type="button" class="btn btn-primary btn-xxs" data-toggle="modal" data-target="#linebusiness">Add<span class="btn-icon-right"><i class="fa fa-plus" aria-hidden="true"></i></span>
                                </button>
                            </div>
                            
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="workflow" class="display">
                                        <thead>
                                            <tr>
                                                <th>Line of Business</th>
                                                <th>Added By</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php 
                                            if (mysqli_num_rows($linebusiness_table)>0) {
                                                while ($row = mysqli_fetch_assoc($linebusiness_table)) { ?>
                                                    <tr>
                                                        <td><?php echo $row['linebusiness']; ?></td>
                                                        <td><?php echo $row['full_name']; ?></td>
                                                    </tr>

                                            <?php
                                                }
                                            }
                                            ?>
                                            
                                            
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Line of Business</th>
                                                <th>Added By</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Workflow</h4>
                                <button type="button" class="btn btn-primary btn-xxs" data-toggle="modal" data-target="#workflow_modal">Add<span class="btn-icon-right"><i class="fa fa-plus" aria-hidden="true"></i></span>
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="workflow" class="display">
                                        <thead>
                                            <tr>
                                                <th>Workflow</th>
                                                <th>Line of Business</th>
                                                
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            if (mysqli_num_rows($workflow_table)>0) {
                                                while ($row = mysqli_fetch_assoc($workflow_table)) { ?>
                                                    <tr>
                                                        <td><?php echo $row['workflow']; ?></td>
                                                        <td><?php echo $row['linebusiness']; ?></td>
                                                        
                                                        
                                                    </tr>

                                            <?php
                                                }
                                            }
                                            ?>
                                            
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Workflow</th>
                                                <th>Line of Business</th>
                                               
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">SOP</h4>
                                <button type="button" class="btn btn-primary btn-xxs" data-toggle="modal" data-target="#sop_modal">Add<span class="btn-icon-right"><i class="fa fa-plus" aria-hidden="true"></i></span>
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="sop" class="display">
                                        <thead>
                                            <tr>
                                                <th>SOP</th>
                                                <th>Workflow</th>
                                                <th>Line of Business</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            if (mysqli_num_rows($sop_table)>0) {
                                                while ($row = mysqli_fetch_assoc($sop_table)) { ?>
                                                    <tr>
                                                        <td><?php echo $row['s_name']; ?></td>
                                                        <td><?php echo $row['s_workflow']; ?></td>
                                                        <td><?php echo $row['s_linebusiness']; ?></td>
                                                        
                                                    </tr>

                                            <?php
                                                }
                                            }
                                            ?>
                                            
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>SOP</th>
                                                <th>Workflow</th>
                                                <th>Line of Business</th>
                                                
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Remarks</h4>
                                <button type="button" class="btn btn-primary btn-xxs" data-toggle="modal" data-target="#remarks_modal">Add<span class="btn-icon-right"><i class="fa fa-plus" aria-hidden="true"></i></span>
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="sop" class="display">
                                        <thead>
                                            <tr>
                                                <th>Remarks</th>
                                                <th>Workflow</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            if (mysqli_num_rows($remarks_table)>0) {
                                                while ($row = mysqli_fetch_assoc($remarks_table)) { ?>
                                                    <tr>
                                                        <td><?php echo $row['r_name']; ?></td>
                                                        <td><?php echo $row['r_workflow']; ?></td>
                                                        <td><?php echo $row['r_status']; ?></td>
                                                        
                                                    </tr>

                                            <?php
                                                }
                                            }
                                            ?>
                                            
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Remarks</th>
                                                <th>Workflow</th>
                                                <th>Status</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                     <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Status</h4>
                                <button type="button" class="btn btn-primary btn-xxs" data-toggle="modal" data-target="#status_modal">Add<span class="btn-icon-right"><i class="fa fa-plus" aria-hidden="true"></i></span>
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="sop" class="display">
                                        <thead>
                                            <tr>
                                                <th>Status</th>
                                                <th>Workflow</th>
                                                <th>Added By</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            if (mysqli_num_rows($status_table)>0) {
                                                while ($row = mysqli_fetch_assoc($status_table)) { ?>
                                                    <tr>
                                                        <td><?php echo $row['status']; ?></td>
                                                        <td><?php echo $row['workflow']; ?></td>
                                                        <td><?php echo $row['full_name']; ?></td>

                                                    </tr>
                                            <?php
                                                }
                                            }
                                            ?>
                                            
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Remarks</th>
                                                <th>Added By</th>
                                            </tr>
                                        </tfoot>
                                    </table>
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
                if (result =="success") {
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
    <script src="./js/plugins-init/datatables.init.js"></script>
    <!-- SELECT2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</html>