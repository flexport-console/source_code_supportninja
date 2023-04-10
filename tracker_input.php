<?php 
include 'connection/user_information.php';
if (!in_array("Input",$_tracker)) {
   header("location: 403.php");
}


$user_sop = "SELECT * FROM users_sop WHERE user_employee_id='$userid'";
$user_sop_res = mysqli_query($conn, $user_sop);

$user_workflow = "SELECT * FROM users_workflow WHERE user_employee_id='$userid'";
$user_workflow_res = mysqli_query($conn, $user_workflow);
$user_workflow_res_2 = mysqli_query($conn, $user_workflow);
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

<body onload="refresh_div()">

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
                        <h2 class="text-black font-w600">Tracker Input</h2>
                        <p class="mb-0">You may add your Queue here.</p>

                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <form class="distro">
                            <div class="row">
                                <div class="col-xl-2">
                                    <label><strong>Flex-ID</strong></label>
                                    <input type="text" name="flex_id" class="form-control" id="myInput" maxlength="12" required>
                                </div>
                                <div class="col-xl-2">
                                    <label><strong>SOP</strong></label>
                                    <select class="form-control" name="sop" id="sop" required>
                                        <option selected disabled></option>
                                        <?php 
                                        if (mysqli_num_rows($user_sop_res)>0) {
                                            while ($row = mysqli_fetch_assoc($user_sop_res)) { ?>

                                        <option><?php echo $row['sop_name']; ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-xl-2">
                                    <label><strong>Status</strong></label>
                                    <select class="form-control" name="status" id="status" required>
                                        <option selected disabled></option>
                                        <option>Processed</option>
                                        <option>Unprocessed</option>
                                        <option>Untouched</option>
                                        <?php 
                                        if (mysqli_num_rows($user_workflow_res)>0) {
                                            while ($row1 = mysqli_fetch_assoc($user_workflow_res)) { 
                                                $wfs = $row1['wl_name'];
                                                $r_s = mysqli_query($conn, "SELECT * FROM r_status WHERE st_workflow='$wfs'");
                                                if(mysqli_num_rows($r_s)>0) {
                                                    while ($row3 = mysqli_fetch_assoc($r_s)) { ?>
                                        <option><?php echo $row3['st_name']; ?></option>
                                        <?php
                                                    }
                                                }
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-xl-2">
                                    <label><strong>Remarks</strong></label>
                                    <select class="form-control" name="remarks" id="remarks" required>
                                        <option selected disabled></option>
                                        <option>Processed</option>
                                        <?php 
                                        if (mysqli_num_rows($user_workflow_res_2)>0) {
                                            while ($row4 = mysqli_fetch_assoc($user_workflow_res_2)) { 
                                                $wfs1 = $row4['wl_name'];
                                                $r_s1 = mysqli_query($conn, "SELECT * FROM r_remarks WHERE r_workflow='$wfs1'");
                                                if(mysqli_num_rows($r_s1)>0) {
                                                    while ($row5 = mysqli_fetch_assoc($r_s1)) { ?>
                                        <option value="<?php echo $row5['r_name']; ?>"><?php echo $row5['r_workflow']." - ".$row5['r_name']; ?></option>
                                        <?php
                                                    }
                                                }
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-xl-2">
                                    <label><strong># of Shipment</strong></label>
                                    <input type="number" name="number" id="number" value="1" class="form-control" required>
                                </div>
                                <div class="col-xl-2">
                                    <label><strong>Action</strong></label>
                                    <input hidden type="text" name="btn_submit" value="btn_submit" class="form-control">
                                    <button type="submit" class="btn btn-primary btn-sm mr-3 w-100" id="btn_input">
                                        Submit
                                    </button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>

                <?php 
                if (isset($_GET['delete']) && $_GET['delete']=="success") { ?>
                <div>
                    <div class="alert alert-outline-success alert-dismissible fade show">
                        <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                        </button> Success! Flex-ID has been deleted.
                    </div>
                </div>
                <?php
                }
                ?>

                <div hidden id="alert_punch">
                    <div class="alert alert-outline-success alert-dismissible fade show">
                        <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                        </button> Success! Break has been punch.
                    </div>
                </div>
                <div hidden id="alert_punch1">
                    <div class="alert alert-outline-secondary alert-dismissible fade show">
                        <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                        </button> Error! Break has been punch.
                    </div>
                </div>
                <div hidden id="queue_needed">
                    <div class="alert alert-outline-primary alert-dismissible fade show">
                        <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                        </button> Please wait your Queue's before you Punch "Ready".
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-3">
                                <form class="distro" action="#" method="post">
                                    <div>
                                        <input hidden type="text" name="punch_btn" value="punch_btn">
                                        <!-- <label class="mr-sm-2">Punch</label> -->
                                        <select class="form-control form-control-sm default-select" name="punch" required>
                                            <option selected disabled></option>
                                            <option value="0000000">Ready</option>
                                            <option value="9999991">First Break - Start</option>

                                            <option value="9999993">Lunch Break - Start</option>

                                            <option value="9999995">Last Break - Start</option>

                                            <option value="9999997">End Shift</option>
                                        </select>
                                        <button class="btn btn-primary btn-xxs w-100">
                                            Punch
                                        </button>
                                    </div>
                                </form>
                            </div>


                        </div>

                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive reload_table">

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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- <script src="./js/plugins-init/select2-init.js"></script> -->
</body>
<script type="text/javascript">
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
</script>




<script type="text/javascript">

    function refresh_div() {
        jQuery.ajax({
            url: 'display/tracker_input_table.php',
            type: 'POST',
            success: function(results) {
                jQuery(".reload_table").html(results);
            }
        });
    }


    // t = setInterval(refresh_div, rndInt);

    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })

    function columnColor(color) {
        var element = document.getElementById(color);

        element.classList.add("badge");
        element.classList.add("badge-rounded");
        element.classList.add("bg-success");
        element.classList.add("text-white");

        Toast.fire({
            icon: 'success',
            title: 'Ticket has been save!'
        })
        // badge badge-rounded badge-success
    }


    $('.distro').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            type: 'post',
            url: 'connection/tracker_input_save.php',
            data: $(this).serialize(),
            beforeSend: function(){
                document.getElementById("btn_input").disabled = true;
            },
            success: function(result) {
                if (result == "failed") {
                    console.log(result)
                } else if (result == "success") {
                    document.getElementById("myInput").value = '';
                    document.getElementById("status").value = '';
                    document.getElementById("remarks").value = '';
                    document.getElementById("number").value = '1';
                    refresh_div();
                } else if (result == "reload") {
                    window.location.href = "tracker_input.php?queue=submitted";
                } else if (result == "punched") {
                    document.getElementById("alert_punch").hidden = false;
                    document.getElementById("alert_punch1").hidden = true;
                    document.getElementById("queue_needed").hidden = true;
                } else if (result == "punched_already") {
                    document.getElementById("alert_punch").hidden = true;
                    document.getElementById("alert_punch1").hidden = false;
                    document.getElementById("queue_needed").hidden = true;
                }
                document.getElementById("btn_input").disabled = false;
            }
        });
    });
</script>

<script type="text/javascript">
    function confirmWithSweetAlert(id) {
        Swal.fire({
            title: 'Are you sure you?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Swal.fire(
                //   'Deleted!',
                //   'Your file has been deleted.',
                //   'success'
                // )
                window.location.href = "connection/delete_flexid.php?id=" + id+"&page=tracker_input";
            }
        });
        return false;
    }
</script>



<script type="text/javascript">
    function randomIntFromInterval(min, max) { // min and max included 
        return Math.floor(Math.random() * (max - min + 1) + min)
    }
    const rndInt = randomIntFromInterval(5000, 10000)

    function refresh_div1() {
        jQuery.ajax({
            url: 'display/tracker_distro_numbers.php',
            type: 'POST',
            success: function(results) {
                if (results == 'success') {
                    console.log(results)
                } else {
                    window.location.href = "logout.php";
                }
            }
        });
    }

    t = setInterval(refresh_div1, rndInt);
</script>

<script type="text/javascript">
    var inputField = document.getElementById("myInput");

    inputField.addEventListener("input", function() {
        if (inputField.value.length > 12) {
            inputField.value = inputField.value.substring(0, 12);
        }
    });
</script>


</html>