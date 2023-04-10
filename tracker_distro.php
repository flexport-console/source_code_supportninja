<?php 
include 'connection/user_information.php';
include 'display/tracker_distro.php';

if (!in_array("Distro",$_tracker)) {
   header("location: 403.php");
}
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
                                        <th>Flex-ID</th>
                                        <th>Workflow</th>
                                        <th>SOP</th>
                                        <!-- <th>Time Stamp</th> -->
                                        <th>Status</th>
                                        <th>Remarks</th>
                                        <th># of Shipment</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    if (mysqli_num_rows($select_distro_res)>0) {
                                        while ($row = mysqli_fetch_assoc($select_distro_res)) {
                                    ?>
                                    <tr>
                                        <form class="distro" action="#" method="post">
                                            <td>
                                                <a href="https://core.flexport.com/shipments/<?php echo $row['q_flex_id']; ?>/documents" target="https://core.flexport.com/shipments/<?php echo $row['q_flex_id']; ?>/documents"><?php echo $row['q_flex_id']; ?></a>
                                                <input hidden type="text" name="tracker_default" value="<?php echo $row['q_id']; ?>">
                                            </td>

                                            <td><span id="<?php echo $row['q_id']; ?>" class="
                                                <?php 
                                                if ($row['q_status']=="Unprocessed") {
                                                    echo "badge badge-rounded badge-secondary text-white";
                                                }elseif ($row['q_status']=="Processed") {
                                                    echo "badge badge-rounded badge-success";
                                                }elseif ($row['q_status']=="Untouched") {
                                                    echo "badge badge-rounded badge-primary text-white";
                                                }
                                                ?>

                                                ">
                                                    <?php echo $row['q_workflow']; ?></span>
                                            </td>

                                            <td>
                                                <span class="text-muted"><?php echo $row['q_sop']; ?></span>
                                            </td>
                                            <!-- <td> -->
                                            <?php 
                                                // if (!empty($row['q_start_time']) && !empty($row['q_end_time'])) {
                                                    
                                                //     timeDiff($row['q_start_time'],$row['q_end_time']);
                                                // }
                                                ?>
                                            <!-- </td> -->
                                            <td>
                                                <select class="js-example-basic-single" name="status" required>
                                                    <?php if (!empty($row['q_status'])) {
                                                        echo '<option selected>'.$row['q_status'].'</option>';
                                                    }else{
                                                        echo '<option selected disabled></option>';
                                                    } ?>

                                                    <option>Processed</option>
                                                    <option>Unprocessed</option>
                                                    <option>Untouched</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select class="js-example-basic-single" name="remarks" required>
                                                    <?php if (!empty($row['q_remarks'])) {
                                                        echo '<option selected>'.$row['q_remarks'].'</option>';
                                                    }else{
                                                        echo '<option selected disabled></option>';
                                                    } ?>
                                                    <option>Processed</option>
                                                    <?php 
                                                    $select_remarks = mysqli_query($conn, "SELECT u.wl_name as user_workflow, r.r_name as user_remarks  FROM users_workflow u LEFT JOIN r_remarks r ON u.wl_name=r.r_workflow WHERE u.user_employee_id='$userid'");
                                                    if (mysqli_num_rows($select_remarks)>0) {

                                                        while ($row1 = mysqli_fetch_assoc($select_remarks)) {

                                                    ?>
                                                    <option value="<?php echo $row1['user_remarks']; ?>"><?php echo $row1['user_workflow']." - ".$row1['user_remarks']; ?></option>

                                                    <?php
                                                        }
                                                    }
                                                    ?>



                                                </select>
                                            </td>
                                            </td>
                                            <td>
                                                <input type="number" name="shipment" class="form-control" value="<?php echo $row['q_shipment']; ?>"
                                                <?php echo  ($row['q_status'] == "break") ? "readonly" : "" ; ?>
                                                >
                                            </td>
                                            <td>
                                                <?php 
                                                if ($row['q_status'] == "break") { ?>
                                                
                                                <?php    
                                                }else{ ?>
                                                    <button type="submit" value="update" class="btn btn-rounded btn-outline-success btn-xxs myButton">Update</button>  
                                                <?php
                                                }
                                                ?>
                                                
                                                <a onclick="return confirmWithSweetAlert(<?php echo $row['q_id']; ?>)" class="btn btn-rounded btn-outline-secondary btn-xxs myButton">Delete</a>
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