<?php 
include 'connection/user_information.php';
include 'display/tracker_distro.php';

if (!in_array("Distro",$_tracker)) {
   header("location: 403.php");
}


$cav_select = "SELECT * FROM queue_cav WHERE user_employee_id='$userid' AND cav_date='$date' AND cav_submitted='pending'";
$cav_select_res = mysqli_query($conn, $cav_select);
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
                        <h2 class="text-black font-w600">Tracker Distro</h2>
                        <p class="mb-0">Your Queue's will display here.</p>

                    </div>
                </div>

                <div class="table_info">

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

                            <div class="col-xl-9 text-right mt-2">
                                <button class="btn btn-primary btn-xxs" data-toggle="modal" data-target="#backlogs">
                                    Backlogs
                                </button>
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
                                        <th class="text-nowrap">Flex-ID</th>
                                        <th class="text-nowrap">SM & DR</th>
                                        <th class="text-nowrap">SOP</th>
                                        <th class="text-nowrap">Status</th>
                                        <th class="baliktad">FIRMSCODE</th>
                                        <th class="baliktad">ARRIVAL NOTICE</th>
                                        <th class="baliktad">IT NUMBER</th>
                                        <th class="baliktad">MBL/MAWB</th>
                                        <th class="baliktad">HBL/HAWB</th>
                                        <th class="baliktad">HBLR</th>
                                        <th class="baliktad">CI/PL</th>
                                        <th class="baliktad">CARRIER</th>
                                        <th class="baliktad">PARTNER</th>
                                        <th class="baliktad">TRUCKINGLEG</th>
                                        <th class="baliktad">DECONSOLIDATION</th>
                                        <th class="baliktad">ACTION ITEM</th>
                                        <th class="baliktad">#DSPLANCUSTOM</th>
                                        <th class="baliktad">#DSCONFIRMDD</th>
                                        <th class="baliktad">CARGO MANIFEST</th>
                                        <th class="text-nowrap">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    if (mysqli_num_rows($cav_select_res)>0) {
                                        while ($row = mysqli_fetch_assoc($cav_select_res)) {
                                    ?>
                                    <tr>
                                        
                                        <form class="distro" action="#" method="post">
                                            <td class="text-nowrap">
                                            <?php echo $row['cav_flex_id']; ?>
                                            <input hidden type="text"class="form-control" name="cav_id" value="<?php echo $row['cav_id']; ?>">
                                            <input hidden type="text"class="form-control" name="cav_btn" value="cav_btn">
                                            </td>
                                            <td class="text-nowrap"><?php echo $row['cav_sm_dr']; ?></td>
                                            <td class="text-nowrap"><?php echo $row['cav_sop']; ?></td>
                                            <td class="text-nowrap">
                                                <select class="form-control" name="status" required>
                                                    <?php 
                                                    if (!empty($row['cav_status'])) {
                                                        echo "<option selected>".$row['cav_status']."</option>";
                                                    }else{
                                                        echo '<option selected disabled></option>';
                                                    }
                                                    ?>
                                                    
                                                    <option>Test</option>
                                                    <option>VALIDATED</option>
                                                    <option>ds_pending</option>
                                                    <option>Valid BT Greyed Out</option>
                                                    <option>ATLANTA</option>
                                                    <option>PENDING AI</option>
                                                </select>
                                            </td>
                                            <td>
                                                <div class="custom-control custom-checkbox mb-3 checkbox-danger check-xl">
                                                    <input type="checkbox" class="custom-control-input" value="true" <?php echo ($row['firmscode']=="TRUE") ? "checked": ""; ?> name="firmscode" id="FIRMSCODE<?php echo $row['cav_id']; ?>">
                                                    <label class="custom-control-label" for="FIRMSCODE<?php echo $row['cav_id']; ?>"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="custom-control custom-checkbox mb-3 checkbox-danger check-xl">
                                                    <input type="checkbox" class="custom-control-input" value="true"  <?php echo ($row['arrival_notice']=="TRUE") ? "checked": ""; ?>  name="arrival_notice" id="ARRIVAL_NOTICE<?php echo $row['cav_id']; ?>">
                                                    <label class="custom-control-label" for="ARRIVAL_NOTICE<?php echo $row['cav_id']; ?>"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="custom-control custom-checkbox mb-3 checkbox-danger check-xl">
                                                    <input type="checkbox" class="custom-control-input" value="true"  <?php echo ($row['it_number']=="TRUE") ? "checked": ""; ?> name="it_number" id="IT_NUMBER<?php echo $row['cav_id']; ?>">
                                                    <label class="custom-control-label" for="IT_NUMBER<?php echo $row['cav_id']; ?>"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="custom-control custom-checkbox mb-3 checkbox-danger check-xl">
                                                    <input type="checkbox" class="custom-control-input" value="true"  <?php echo ($row['mbl_mawb']=="TRUE") ? "checked": ""; ?> name="mbl_mawb" id="MBL/MAWB<?php echo $row['cav_id']; ?>">
                                                    <label class="custom-control-label" for="MBL/MAWB<?php echo $row['cav_id']; ?>"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="custom-control custom-checkbox mb-3 checkbox-danger check-xl">
                                                    <input type="checkbox" class="custom-control-input" value="true"  <?php echo ($row['hbl_hawb']=="TRUE") ? "checked": ""; ?> name="hbl_hawb" id="HBL/HAWB<?php echo $row['cav_id']; ?>">
                                                    <label class="custom-control-label" for="HBL/HAWB<?php echo $row['cav_id']; ?>"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="custom-control custom-checkbox mb-3 checkbox-danger check-xl">
                                                    <input type="checkbox" class="custom-control-input" value="true"  <?php echo ($row['hblr']=="TRUE") ? "checked": ""; ?> name="hblr" id="HBLR<?php echo $row['cav_id']; ?>">
                                                    <label class="custom-control-label" for="HBLR<?php echo $row['cav_id']; ?>"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="custom-control custom-checkbox mb-3 checkbox-danger check-xl">
                                                    <input type="checkbox" class="custom-control-input" value="true"  <?php echo ($row['ci_pl']=="TRUE") ? "checked": ""; ?> name="ci_pl" id="CI/PL<?php echo $row['cav_id']; ?>">
                                                    <label class="custom-control-label" for="CI/PL<?php echo $row['cav_id']; ?>"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="custom-control custom-checkbox mb-3 checkbox-danger check-xl">
                                                    <input type="checkbox" class="custom-control-input" value="true"  <?php echo ($row['carrier']=="TRUE") ? "checked": ""; ?> name="carrier" id="CARRIER<?php echo $row['cav_id']; ?>">
                                                    <label class="custom-control-label" for="CARRIER<?php echo $row['cav_id']; ?>"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="custom-control custom-checkbox mb-3 checkbox-danger check-xl">
                                                    <input type="checkbox" class="custom-control-input" value="true"  <?php echo ($row['partner']=="TRUE") ? "checked": ""; ?> name="partner" id="PARTNER<?php echo $row['cav_id']; ?>">
                                                    <label class="custom-control-label" for="PARTNER<?php echo $row['cav_id']; ?>"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="custom-control custom-checkbox mb-3 checkbox-danger check-xl">
                                                    <input type="checkbox" class="custom-control-input" value="true"  <?php echo ($row['dstruckingleg']=="TRUE") ? "checked": ""; ?> name="dstruckingleg" id="TRUCKINGLEG<?php echo $row['cav_id']; ?>">
                                                    <label class="custom-control-label" for="TRUCKINGLEG<?php echo $row['cav_id']; ?>"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="custom-control custom-checkbox mb-3 checkbox-danger check-xl">
                                                    <input type="checkbox" class="custom-control-input" value="true"  <?php echo ($row['deconsolidation']=="TRUE") ? "checked": ""; ?> name="deconsolidation" id="DECONSOLIDATION<?php echo $row['cav_id']; ?>">
                                                    <label class="custom-control-label" for="DECONSOLIDATION<?php echo $row['cav_id']; ?>"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="custom-control custom-checkbox mb-3 checkbox-danger check-xl">
                                                    <input type="checkbox" class="custom-control-input" value="true"  <?php echo ($row['action_item']=="TRUE") ? "checked": ""; ?> name="action_item" id="ACTION_ITEM<?php echo $row['cav_id']; ?>">
                                                    <label class="custom-control-label" for="ACTION_ITEM<?php echo $row['cav_id']; ?>"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="custom-control custom-checkbox mb-3 checkbox-danger check-xl">
                                                    <input type="checkbox" class="custom-control-input" value="true"  <?php echo ($row['dsplancustom']=="TRUE") ? "checked": ""; ?> name="dsplancustom" id="DSPLANCUSTOM<?php echo $row['cav_id']; ?>">
                                                    <label class="custom-control-label" for="DSPLANCUSTOM<?php echo $row['cav_id']; ?>"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="custom-control custom-checkbox mb-3 checkbox-danger check-xl">
                                                    <input type="checkbox" class="custom-control-input" value="true"  <?php echo ($row['dsconfirmdd']=="TRUE") ? "checked": ""; ?> name="dsconfirmdd" id="DSCONFIRMDD<?php echo $row['cav_id']; ?>">
                                                    <label class="custom-control-label" for="DSCONFIRMDD<?php echo $row['cav_id']; ?>"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="custom-control custom-checkbox mb-3 checkbox-danger check-xl">
                                                    <input type="checkbox" class="custom-control-input" value="true"  <?php echo ($row['cargo_manifest']=="TRUE") ? "checked": ""; ?> name="cargo_manifest" id="CARGO_MANIFEST<?php echo $row['cav_id']; ?>">
                                                    <label class="custom-control-label" for="CARGO_MANIFEST<?php echo $row['cav_id']; ?>"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <button type="submit" class="btn btn-primary btn-xxs">Update</button>
                                            </td>
                                        </form>
                                    
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
            url: 'connection/tracker_distro_save.php',
            data: $(this).serialize(),
            success: function(result) {
                if (result == "punched") {
                    document.getElementById("alert_punch").hidden = false;
                    document.getElementById("alert_punch1").hidden = true;
                    document.getElementById("queue_needed").hidden = true;
                } else if (result == "punched_already") {
                    document.getElementById("alert_punch").hidden = true;
                    document.getElementById("alert_punch1").hidden = false;
                    document.getElementById("queue_needed").hidden = true;
                } else if (result == "queue_needed") {
                    document.getElementById("alert_punch").hidden = true;
                    document.getElementById("alert_punch1").hidden = true;
                    document.getElementById("queue_needed").hidden = false;
                } else if (result == "reload") {
                    window.location.href = "tracker_distro.php?queue=submitted";
                } else {
                    columnColor(result)
                }

                // console.log(result)
                
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
                window.location.href = "connection/delete_flexid.php?id=" + id+"&page=tracker_distro";
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
    function refresh_div() {
        jQuery.ajax({
            url: 'display/tracker_distro_numbers.php',
            type: 'POST',
            success: function(results) {
                if (results=='success') {
                    console.log(results)
                }else{
                    window.location.href = "logout.php";
                }
            }
        });
    }

    t = setInterval(refresh_div, rndInt);
</script>




</html>