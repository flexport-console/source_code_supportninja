<?php 
include 'connection/user_information.php';
include 'display/tracker_distro.php';

if (!in_array("Queue",$_roles)) {
   header("location: 403.php");
}





$queue_sel_employee = "SELECT * FROM users WHERE user_position NOT IN ('Team Manager', 'Operations Manager', 'Director')";
$queue_sel_employee_res = mysqli_query($conn, $queue_sel_employee);

$queue_sel_linebusiness = "SELECT * FROM r_linebusiness";
$queue_sel_linebusiness_res = mysqli_query($conn, $queue_sel_linebusiness);

$queue_sel_workflow = "SELECT * FROM r_linebusiness";
$queue_sel_workflow_res = mysqli_query($conn, $queue_sel_workflow);


$queue_sel_sop = "SELECT * FROM r_linebusiness";
$queue_sel_sop_res = mysqli_query($conn, $queue_sel_sop);

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
                        <h2 class="text-black font-w600">Queue Distro</h2>
                        <p class="mb-0">You may distro to agent here.</p>

                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header d-sm-flex d-block pb-0 border-0">
                                <div class="mr-auto pr-3">
                                    <h4 class="text-black fs-20 mb-0">Queue Panel</h4>
                                </div>
                            </div>
                            <hr>

                            <div class="card-body">

                                <div hidden id="alert_punch">
                                    <div class="alert alert-outline-success alert-dismissible fade show">
                                        <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                                        </button> Success! Timestart has been punch on your First Queue.
                                    </div>
                                </div>


                                <form class="distro" action="#" method="post">
                                    <input hidden type="text" class="form-control" name="btn_queue" value="btn_queue">
                                    <div class="mb-1">
                                        <label>Name</label>
                                        <select class="js-example-basic-single" id="d_employee_id" name="d_employee_id" required>   
                                            <option selected disabled></option>  
                                            <?php 
                                            if (mysqli_num_rows($queue_sel_employee_res)>0) {
                                                while ($row = mysqli_fetch_assoc($queue_sel_employee_res)) {
                                            ?>
                                                <option value="<?php echo $row['user_employee_id']; ?>"><?php echo $row['user_firstname']." ".$row['user_lastname']; ?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-1">
                                        <label>Line of Business</label>
                                        <select class="js-example-basic-single" id="d_linebusiness" name="d_linebusiness" required>     
                                            <option selected disabled></option>  
                                            <?php 
                                            if (mysqli_num_rows($queue_sel_linebusiness_res)>0) {
                                                while ($row = mysqli_fetch_assoc($queue_sel_linebusiness_res)) {
                                            ?>
                                                <option ><?php echo $row['line_name']; ?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-1">
                                        <label>Workflow</label>
                                        <select class="js-example-basic-single" id="d_workflow" name="d_workflow" required>     
                                            <option selected disabled></option>  
                                            <?php 
                                            if (mysqli_num_rows($queue_sel_workflow_res)>0) {
                                                while ($row = mysqli_fetch_assoc($queue_sel_workflow_res)) {
                                                    $line_name = $row['line_name'];
                                            ?>
                                                    <optgroup label="<?php echo $line_name; ?>">
                                                        <?php 
                                                        $nested_workflow = mysqli_query($conn,"SELECT * FROM r_workflow WHERE w_linebusiness='$line_name'");
                                                        if (mysqli_num_rows($nested_workflow)>0) {
                                                            while ($nested = mysqli_fetch_assoc($nested_workflow)) {
                                                        ?>
                                                            <option><?php echo $nested['w_name']; ?></option>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </optgroup>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-1">
                                        <label>SOP</label>
                                        <select class="js-example-basic-single" id="d_sop" name="d_sop" required>   
                                            <option selected disabled></option>   
                                            <?php 
                                            if (mysqli_num_rows($queue_sel_sop_res)>0) {
                                                while ($row = mysqli_fetch_assoc($queue_sel_sop_res)) {
                                                    $line_name = $row['line_name'];
                                            ?>
                                                    <optgroup label="<?php echo $line_name; ?>">
                                                        <?php 
                                                        $nested_workflow = mysqli_query($conn,"SELECT * FROM r_sop WHERE s_linebusiness='$line_name'");
                                                        if (mysqli_num_rows($nested_workflow)>0) {
                                                            while ($nested = mysqli_fetch_assoc($nested_workflow)) {
                                                        ?>
                                                            <option value="<?php echo $nested['s_name']; ?>"><?php echo $nested['s_workflow']." - ".$nested['s_name']; ?></option>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </optgroup>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-1">
                                        <label>Queue</label>
                                        <textarea class="form-control" name="d_queue" id="QueueBox" placeholder="Type your message..." rows="10"></textarea>
                                    </div>
                                    <div class="mt-2 w-100">
                                        <button id="button" type="submit" class="btn btn-primary"><i class="fa fa-location-arrow"></i> Add Queue</button>
                                    </div>
                                </form>
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
                console.log(result)
            }
        });
    });

</script>

<!-- <script type="text/javascript">
    var box = document.getElementById('QueueBox');
    var charlimit = 7; // char limit per line
    box.onkeyup = function() {
        var lines = box.value.split('\n');
        for (var i = 0; i < lines.length; i++) {
            if (lines[i].length <= charlimit) continue;
            var j = 0;
            space = charlimit;
            while (j++ <= charlimit) {
                if (lines[i].charAt(j) === ' ') space = j;
            }
            lines[i + 1] = lines[i].substring(space + 1) + (lines[i + 1] || "");
            lines[i] = lines[i].substring(0, space);
        }
        box.value = lines.slice(0, 999999).join('\n');
    };
</script>

<script type="text/javascript">
    $('#QueueBox').keypress(function(e) {
        var a = [];
        var k = e.which;

        for (i = 48; i < 58; i++)
            a.push(i);

        if (!(a.indexOf(k) >= 0))
            e.preventDefault();
    });
</script> -->

</html>