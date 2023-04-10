<?php 
include 'connection/user_information.php';



$count_today_q = "SELECT count(*) as Queue_today FROM queue WHERE q_date='$date' AND user_employee_id='$user_employee_id' AND q_status!='break'";
$count_today_q_res = mysqli_query($conn, $count_today_q);
$count_today_q_num = mysqli_fetch_assoc($count_today_q_res );

$count_processed = "SELECT count(*) as Processed_today FROM queue WHERE q_date='$date' AND user_employee_id='$user_employee_id' AND q_status='Processed'";
$count_processed_res = mysqli_query($conn, $count_processed);
$count_processed_num = mysqli_fetch_assoc($count_processed_res);



$count_shipment = "SELECT sum(q_shipment) as Shipment_today FROM queue WHERE q_date='$date' AND user_employee_id='$user_employee_id' AND q_status='Processed'";
$count_shipment_res = mysqli_query($conn, $count_shipment);
$count_shipment_num = mysqli_fetch_assoc($count_shipment_res);




if ($count_today_q_num['Queue_today']>0) {
	$decimal_processed = $count_processed_num['Processed_today'] / $count_today_q_num['Queue_today']; // example decimal value
	$percent_processed = number_format($decimal_processed * 100, 2) . '%'; // convert decimal to percent with two decimal places
}else{
	$percent_processed = 0;
}



$count_Unprocessed = "SELECT count(*) as Unprocessed_today FROM queue WHERE q_date='$date' AND user_employee_id='$user_employee_id' AND q_status='Unprocessed'";
$count_Unprocessed_res = mysqli_query($conn, $count_Unprocessed);
$count_Unprocessed_num = mysqli_fetch_assoc($count_Unprocessed_res);



if ($count_today_q_num['Queue_today']>0) {
	$decimal_unprocessed = $count_Unprocessed_num['Unprocessed_today'] / $count_today_q_num['Queue_today']; // example decimal value
	$percent_unprocessed = number_format($decimal_unprocessed * 100, 2) . '%'; // convert decimal to percent with two decimal places
}else{
	$percent_unprocessed = 0;
}




$count_Untouched = "SELECT count(*) as Untouched_today FROM queue WHERE q_date='$date' AND user_employee_id='$user_employee_id' AND q_status='Untouched'";
$count_Untouched_res = mysqli_query($conn, $count_Untouched);
$count_Untouched_num = mysqli_fetch_assoc($count_Untouched_res);


if ($count_today_q_num['Queue_today']>0) {
	$decimal_untouched = $count_Untouched_num['Untouched_today'] / $count_today_q_num['Queue_today']; // example decimal value
	$percent_untouched = number_format($decimal_untouched * 100, 2) . '%'; // convert decimal to percent with two decimal places
}else{
	$percent_untouched = 0;
}


$monthly_queue = mysqli_query($conn, "SELECT count(*) as monthly_queue FROM queue WHERE q_date LIKE '%$month%' AND user_employee_id='$user_employee_id' AND q_status!='break'");
$monthly_queue_num = mysqli_fetch_assoc($monthly_queue);

$monthly_processed = mysqli_query($conn, "SELECT count(*) as monthly_processed FROM queue WHERE q_date LIKE '%$month%' AND user_employee_id='$user_employee_id' AND q_status='Processed' AND q_submitted='queue'");
$monthly_processed_num = mysqli_fetch_assoc($monthly_processed);

$monthly_unprocessed = mysqli_query($conn, "SELECT count(*) as monthly_unprocessed FROM queue WHERE q_date LIKE '%$month%' AND user_employee_id='$user_employee_id' AND q_status='Unprocessed' AND q_submitted='queue'");
$monthly_unprocessed_num = mysqli_fetch_assoc($monthly_unprocessed);

$monthly_untouched = mysqli_query($conn, "SELECT count(*) as monthly_untouched FROM queue WHERE q_date LIKE '%$month%' AND user_employee_id='$user_employee_id' AND q_status='Untouched' AND q_submitted='queue'");
$monthly_untouched_num = mysqli_fetch_assoc($monthly_untouched);


$monthly_shipment = mysqli_query($conn, "SELECT sum(q_shipment) as monthly_shipment FROM queue WHERE q_date LIKE '%$month%' AND user_employee_id='$user_employee_id' AND q_status='Processed' AND q_submitted='queue'");
$monthly_shipment_num = mysqli_fetch_assoc($monthly_shipment);


$break = "SELECT b.q_remarks as category, b.q_date as qdate, b.q_time as qtime FROM queue b LEFT JOIN users u ON b.user_employee_id=u.user_employee_id WHERE b.user_employee_id='$user_employee_id' AND b.q_lineofbusiness='break' ORDER BY b.q_id DESC LIMIT 10";
$break_res = mysqli_query($conn, $break);


?>

<!DOCTYPE html>
<html lang="en">

<?php include 'pages/header.php'; ?>
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
						<h2 class="text-black font-w600">Dashboard</h2>
						<!-- <p class="mb-0">Your stats will shown here.</p> -->
					</div>
				</div>
				<div class="row">
					<div class="col-xl-2 col-sm-6">
						<div class="card">
							<div class="card-body">
								<div class="media align-items-center">
									<div class="media-body mr-3">
										<h2 class="fs-34 text-black font-w600"><?php echo $count_today_q_num['Queue_today']; ?></h2>
										<span>Today's Queues</span>
									</div>
									<svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
										<g clip-path="url(#clip0)">
										<path d="M32.04 4.08H31.24V2.04C31.24 0.8 30.4 0 29.2 0C28 0 27.16 0.8 27.16 2.04V4.08H13.88V2.04C13.88 0.8 13.08 0 11.84 0C10.6 0 9.80002 0.8 9.80002 2.04V4.08H7.96002C4.08002 4.08 0.800018 7.36 0.800018 11.24V32.88C0.800018 36.76 4.08002 40.04 7.96002 40.04H32.04C35.92 40.04 39.2 36.76 39.2 32.88V11.24C39.2 7.36 35.92 4.08 32.04 4.08ZM7.96002 8.16H32.04C33.68 8.16 35.12 9.6 35.12 11.24V14.08H4.88002V11.24C4.88002 9.6 6.32002 8.16 7.96002 8.16ZM32.04 35.92H7.96002C6.32002 35.92 4.88002 34.48 4.88002 32.84V18.16H35.08V32.84C35.12 34.48 33.68 35.92 32.04 35.92Z" fill="#45dabe"/>
										<path d="M16.12 20.6H14.48C13.44 20.6 12.84 21.4 12.84 22.24V24.08C12.84 25.12 13.64 25.72 14.48 25.72H16.12C17.16 25.72 17.76 24.92 17.76 24.08V22.44C17.96 21.44 17.16 20.6 16.12 20.6Z" fill="#45dabe"/>
										<path d="M25.52 20.6H23.88C22.84 20.6 22.24 21.4 22.24 22.24V24.08C22.24 25.12 23.04 25.72 23.88 25.72H25.52C26.56 25.72 27.16 24.92 27.16 24.08V22.44C27.16 21.44 26.32 20.6 25.52 20.6Z" fill="#45dabe"/>
										<path d="M16.12 28.56H14.48C13.44 28.56 12.84 29.36 12.84 30.2V31.84C12.84 32.88 13.64 33.48 14.48 33.48H16.12C17.16 33.48 17.76 32.68 17.76 31.84V30.2C17.96 29.4 17.16 28.56 16.12 28.56Z" fill="#45dabe"/>
										</g>
										<defs>
										<clipPath id="clip0">
										<rect width="40" height="40" fill="white"/>
										</clipPath>
										</defs>
									</svg>
								</div>
							</div>
							<div class="progress  rounded-0" style="height:4px;">
								<div class="progress-bar rounded-0 bg-secondary progress-animated" style="width: 100%; height:4px;" role="progressbar">
									<span class="sr-only">100% Complete</span>
								</div>
							</div>
						</div>
					</div>

					<div class="col-xl-3 col-sm-6">
						<div class="card">
							<div class="card-body">
								<div class="media align-items-center">
									<div class="media-body mr-3">
										<h2 class="fs-34 text-black font-w600"><?php echo $count_processed_num['Processed_today']; ?></h2>
										<span>Processed</span>
									</div>
									<svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
										<g clip-path="url(#clip0)">
										<path d="M32.04 4.08H31.24V2.04C31.24 0.8 30.4 0 29.2 0C28 0 27.16 0.8 27.16 2.04V4.08H13.88V2.04C13.88 0.8 13.08 0 11.84 0C10.6 0 9.80002 0.8 9.80002 2.04V4.08H7.96002C4.08002 4.08 0.800018 7.36 0.800018 11.24V32.88C0.800018 36.76 4.08002 40.04 7.96002 40.04H32.04C35.92 40.04 39.2 36.76 39.2 32.88V11.24C39.2 7.36 35.92 4.08 32.04 4.08ZM7.96002 8.16H32.04C33.68 8.16 35.12 9.6 35.12 11.24V14.08H4.88002V11.24C4.88002 9.6 6.32002 8.16 7.96002 8.16ZM32.04 35.92H7.96002C6.32002 35.92 4.88002 34.48 4.88002 32.84V18.16H35.08V32.84C35.12 34.48 33.68 35.92 32.04 35.92Z" fill="#45dabe"/>
										<path d="M16.12 20.6H14.48C13.44 20.6 12.84 21.4 12.84 22.24V24.08C12.84 25.12 13.64 25.72 14.48 25.72H16.12C17.16 25.72 17.76 24.92 17.76 24.08V22.44C17.96 21.44 17.16 20.6 16.12 20.6Z" fill="#45dabe"/>
										<path d="M25.52 20.6H23.88C22.84 20.6 22.24 21.4 22.24 22.24V24.08C22.24 25.12 23.04 25.72 23.88 25.72H25.52C26.56 25.72 27.16 24.92 27.16 24.08V22.44C27.16 21.44 26.32 20.6 25.52 20.6Z" fill="#45dabe"/>
										<path d="M16.12 28.56H14.48C13.44 28.56 12.84 29.36 12.84 30.2V31.84C12.84 32.88 13.64 33.48 14.48 33.48H16.12C17.16 33.48 17.76 32.68 17.76 31.84V30.2C17.96 29.4 17.16 28.56 16.12 28.56Z" fill="#45dabe"/>
										</g>
										<defs>
										<clipPath id="clip0">
										<rect width="40" height="40" fill="white"/>
										</clipPath>
										</defs>
									</svg>
								</div>
							</div>
							<div class="progress  rounded-0" style="height:4px;">
								<div class="progress-bar rounded-0 bg-success progress-animated" style="width: <?php echo $percent_processed; ?>; height:4px;" role="progressbar">
									<span class="sr-only"><?php echo $percent_processed; ?> Complete</span>
								</div>
							</div>
						</div>
					</div>

					<div class="col-xl-3 col-sm-6">
						<div class="card">
							<div class="card-body">
								<div class="media align-items-center">
									<div class="media-body mr-3">
										<h2 class="fs-34 text-black font-w600"><?php echo $count_shipment_num['Shipment_today']; ?></h2>
										<span># of Shipments</span>
									</div>
									<svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
										<g clip-path="url(#clip0)">
										<path d="M32.04 4.08H31.24V2.04C31.24 0.8 30.4 0 29.2 0C28 0 27.16 0.8 27.16 2.04V4.08H13.88V2.04C13.88 0.8 13.08 0 11.84 0C10.6 0 9.80002 0.8 9.80002 2.04V4.08H7.96002C4.08002 4.08 0.800018 7.36 0.800018 11.24V32.88C0.800018 36.76 4.08002 40.04 7.96002 40.04H32.04C35.92 40.04 39.2 36.76 39.2 32.88V11.24C39.2 7.36 35.92 4.08 32.04 4.08ZM7.96002 8.16H32.04C33.68 8.16 35.12 9.6 35.12 11.24V14.08H4.88002V11.24C4.88002 9.6 6.32002 8.16 7.96002 8.16ZM32.04 35.92H7.96002C6.32002 35.92 4.88002 34.48 4.88002 32.84V18.16H35.08V32.84C35.12 34.48 33.68 35.92 32.04 35.92Z" fill="#45dabe"/>
										<path d="M16.12 20.6H14.48C13.44 20.6 12.84 21.4 12.84 22.24V24.08C12.84 25.12 13.64 25.72 14.48 25.72H16.12C17.16 25.72 17.76 24.92 17.76 24.08V22.44C17.96 21.44 17.16 20.6 16.12 20.6Z" fill="#45dabe"/>
										<path d="M25.52 20.6H23.88C22.84 20.6 22.24 21.4 22.24 22.24V24.08C22.24 25.12 23.04 25.72 23.88 25.72H25.52C26.56 25.72 27.16 24.92 27.16 24.08V22.44C27.16 21.44 26.32 20.6 25.52 20.6Z" fill="#45dabe"/>
										<path d="M16.12 28.56H14.48C13.44 28.56 12.84 29.36 12.84 30.2V31.84C12.84 32.88 13.64 33.48 14.48 33.48H16.12C17.16 33.48 17.76 32.68 17.76 31.84V30.2C17.96 29.4 17.16 28.56 16.12 28.56Z" fill="#45dabe"/>
										</g>
										<defs>
										<clipPath id="clip0">
										<rect width="40" height="40" fill="white"/>
										</clipPath>
										</defs>
									</svg>
								</div>
							</div>
							<div class="progress  rounded-0" style="height:4px;">
								<div class="progress-bar rounded-0 bg-success progress-animated" style="width: 100%; height:4px;" role="progressbar">
									<span class="sr-only">100% Complete</span>
								</div>
							</div>
						</div>
					</div>

					<div class="col-xl-2 col-sm-6">
						<div class="card">
							<div class="card-body">
								<div class="media align-items-center">
									<div class="media-body mr-3">
										<h2 class="fs-34 text-black font-w600"><?php echo $count_Unprocessed_num['Unprocessed_today']; ?></h2>
										<span>Unprocessed</span>
									</div>
									<svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
										<g clip-path="url(#clip0)">
										<path d="M32.04 4.08H31.24V2.04C31.24 0.8 30.4 0 29.2 0C28 0 27.16 0.8 27.16 2.04V4.08H13.88V2.04C13.88 0.8 13.08 0 11.84 0C10.6 0 9.80002 0.8 9.80002 2.04V4.08H7.96002C4.08002 4.08 0.800018 7.36 0.800018 11.24V32.88C0.800018 36.76 4.08002 40.04 7.96002 40.04H32.04C35.92 40.04 39.2 36.76 39.2 32.88V11.24C39.2 7.36 35.92 4.08 32.04 4.08ZM7.96002 8.16H32.04C33.68 8.16 35.12 9.6 35.12 11.24V14.08H4.88002V11.24C4.88002 9.6 6.32002 8.16 7.96002 8.16ZM32.04 35.92H7.96002C6.32002 35.92 4.88002 34.48 4.88002 32.84V18.16H35.08V32.84C35.12 34.48 33.68 35.92 32.04 35.92Z" fill="#fa5959"/>
										<path d="M16.12 20.6H14.48C13.44 20.6 12.84 21.4 12.84 22.24V24.08C12.84 25.12 13.64 25.72 14.48 25.72H16.12C17.16 25.72 17.76 24.92 17.76 24.08V22.44C17.96 21.44 17.16 20.6 16.12 20.6Z" fill="#fa5959"/>
										<path d="M25.52 20.6H23.88C22.84 20.6 22.24 21.4 22.24 22.24V24.08C22.24 25.12 23.04 25.72 23.88 25.72H25.52C26.56 25.72 27.16 24.92 27.16 24.08V22.44C27.16 21.44 26.32 20.6 25.52 20.6Z" fill="#fa5959"/>
										<path d="M16.12 28.56H14.48C13.44 28.56 12.84 29.36 12.84 30.2V31.84C12.84 32.88 13.64 33.48 14.48 33.48H16.12C17.16 33.48 17.76 32.68 17.76 31.84V30.2C17.96 29.4 17.16 28.56 16.12 28.56Z" fill="#fa5959"/>
										</g>
										<defs>
										<clipPath id="clip0">
										<rect width="40" height="40" fill="white"/>
										</clipPath>
										</defs>
									</svg>
								</div>
							</div>
							<div class="progress  rounded-0" style="height:4px;">
								<div class="progress-bar rounded-0 bg-secondary progress-animated" style="width: <?php echo $percent_unprocessed; ?>; height:4px;" role="progressbar">
									<span class="sr-only"><?php echo $percent_unprocessed; ?> Complete</span>
								</div>
							</div>
						</div>
					</div>

					<div class="col-xl-2 col-sm-6">
						<div class="card">
							<div class="card-body">
								<div class="media align-items-center">
									<div class="media-body mr-3">
										<h2 class="fs-34 text-black font-w600"><?php echo $count_Untouched_num['Untouched_today']; ?></h2>
										<span>Untouched</span>
									</div>
									<svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
										<g clip-path="url(#clip0)">
										<path d="M32.04 4.08H31.24V2.04C31.24 0.8 30.4 0 29.2 0C28 0 27.16 0.8 27.16 2.04V4.08H13.88V2.04C13.88 0.8 13.08 0 11.84 0C10.6 0 9.80002 0.8 9.80002 2.04V4.08H7.96002C4.08002 4.08 0.800018 7.36 0.800018 11.24V32.88C0.800018 36.76 4.08002 40.04 7.96002 40.04H32.04C35.92 40.04 39.2 36.76 39.2 32.88V11.24C39.2 7.36 35.92 4.08 32.04 4.08ZM7.96002 8.16H32.04C33.68 8.16 35.12 9.6 35.12 11.24V14.08H4.88002V11.24C4.88002 9.6 6.32002 8.16 7.96002 8.16ZM32.04 35.92H7.96002C6.32002 35.92 4.88002 34.48 4.88002 32.84V18.16H35.08V32.84C35.12 34.48 33.68 35.92 32.04 35.92Z" fill="#24303e"/>
										<path d="M16.12 20.6H14.48C13.44 20.6 12.84 21.4 12.84 22.24V24.08C12.84 25.12 13.64 25.72 14.48 25.72H16.12C17.16 25.72 17.76 24.92 17.76 24.08V22.44C17.96 21.44 17.16 20.6 16.12 20.6Z" fill="#24303e"/>
										<path d="M25.52 20.6H23.88C22.84 20.6 22.24 21.4 22.24 22.24V24.08C22.24 25.12 23.04 25.72 23.88 25.72H25.52C26.56 25.72 27.16 24.92 27.16 24.08V22.44C27.16 21.44 26.32 20.6 25.52 20.6Z" fill="#24303e"/>
										<path d="M16.12 28.56H14.48C13.44 28.56 12.84 29.36 12.84 30.2V31.84C12.84 32.88 13.64 33.48 14.48 33.48H16.12C17.16 33.48 17.76 32.68 17.76 31.84V30.2C17.96 29.4 17.16 28.56 16.12 28.56Z" fill="#24303e"/>
										</g>
										<defs>
										<clipPath id="clip0">
										<rect width="40" height="40" fill="white"/>
										</clipPath>
										</defs>
									</svg>
								</div>
							</div>
							<div class="progress  rounded-0" style="height:4px;">
								<div class="progress-bar rounded-0 bg-primary progress-animated" style="width: <?php echo $percent_untouched; ?>; height:4px;" role="progressbar">
									<span class="sr-only"><?php echo $percent_untouched; ?> Complete</span>
								</div>
							</div>
						</div>
					</div>
					
				</div>



				<div class="row">
					<!-- Left Box -->
					<div class="col-xl-6">
						<div class="row">
							<div class="col-xl-12">	
								<div class="card">
									<div class="card-header d-sm-flex d-block pb-0 border-0">
										<div class="mr-auto pr-3">
											<h4 class="text-black fs-20 mb-0">User Information</h4>
										</div>
									</div>
									<hr>
									<div class="card-body">
										<div class="row">
											<div class="col-5">
												<p>Employee ID</p>
												<p>Immediate Supervisor</p>
												<p>Position</p>
												<p>Line of Business</p>

												<i class="fi fi-rs-screen"></i>
											</div>
											<div class="col-7">
												<p><strong><?php echo $user_information['employeeID']; ?></strong></p>
												<p><strong><?php echo $user_information['Manage_name']; ?></strong></p>
												<p><strong><?php echo $user_information['position']; ?></strong></p>
												<p class="badge badge-rounded badge-outline-primary">Visibility</p>
												
											</div>
										</div>
									</div>
								</div>
							</div>


							<div class="col-xl-12">	
								<div class="card">
									<div class="card-header d-sm-flex d-block pb-0 border-0">
										<div class="mr-auto pr-3">
											<h4 class="text-black fs-20 mb-0">Break Disposition</h4>
										</div>
									</div>
									<hr>
									<div class="card-body">
										<div>
											<table class="table">
												<thead>
													<tr>
														<th>#</th>
														<th>Name</th>
														<th>Time</th>
														<th>Date</th>
													</tr>
												</thead>
												<tbody>
													<?php 
													if (mysqli_num_rows($break_res)>0) {
														$colNumb =1;
														while ($bbbb = mysqli_fetch_assoc($break_res)) {
													?>
													<tr>
														<td><strong><?php echo $colNumb; ?></strong></td>
														<td><span
															class="
															<?php 
					                                        if ($bbbb['category'] == "Ready") {
					                                            echo "badge badge-rounded badge-outline-primary";
					                                        }elseif ($bbbb['category'] == "First Break - Start" || $bbbb['category'] == "First Break - End") {
					                                            echo "badge badge-rounded badge-outline-secondary";
					                                        }elseif ($bbbb['category'] == "Lunch Break - Start" || $bbbb['category'] == "Lunch Break - End") {
					                                            echo "badge badge-rounded badge-outline-info";
					                                        }elseif ($bbbb['category'] == "Last Break - Start" || $bbbb['category'] == "Last Break - End") {
					                                            echo "badge badge-rounded badge-outline-warning";
					                                        }elseif ($bbbb['category'] == "End Shift") {
					                                            echo "badge badge-rounded badge-outline-danger";
					                                        }
					                                       ?>
															"
															><?php echo $bbbb['category']; ?></span></td>
														<td><?php echo $bbbb['qtime']; ?></td>
														<td><?php echo $bbbb['qdate']; ?></td>
													</tr>


													<?php 
													$colNumb+=1;
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
					</div>


					<!-- Right Box -->
					<div class="col-xl-6">
						<div class="row">
							<div class="col-xl-12">	
								<div class="card">
									<div class="card-header d-sm-flex d-block pb-0 border-0">
										<div class="mr-auto pr-3">
											<h4 class="text-black fs-20 mb-0"><?php echo $month; ?> Summary</h4>
										</div>
									</div>
									<hr>
									<div class="card-body">
										<div class="row">
											<div class="col-5">
												<p>Number of Queue</p>
												<p>Processed</p>
												<p>Unprocessed</p>
												<p>Untouched</p>
												<p># of Shipment</p>
											</div>
											<div class="col-7">
												<p><strong><?php echo $monthly_queue_num['monthly_queue']; ?></strong></p>
												<p><strong><?php echo $monthly_processed_num['monthly_processed']; ?></strong></p>
												<p><strong><?php echo $monthly_unprocessed_num['monthly_unprocessed']; ?></strong></p>
												<p><strong><?php echo $monthly_untouched_num['monthly_untouched']; ?></strong></p>
												<p><strong><?php echo $monthly_shipment_num['monthly_shipment']; ?></strong></p>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- <div class="col-xl-12">	
								<div class="card">
									<div class="card-header d-sm-flex d-block pb-0 border-0">
										<div class="mr-auto pr-3">
											<h4 class="text-black fs-20 mb-0">Patient Percentage</h4>
										</div>
									</div>
									<div class="card-body">
										TEST
									</div>
								</div>
							</div> -->
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
	<script src="vendor/bootstrap-datetimepicker/js/moment.js"></script>
	<script src="vendor/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
	<!-- Chart piety plugin files -->
    <script src="./vendor/peity/jquery.peity.min.js"></script>
	
	<!-- Apex Chart -->
	<script src="./vendor/apexchart/apexchart.js"></script>
	
	<!-- Dashboard 1 -->
	<script src="./js/dashboard/dashboard-1.js"></script>
	<script>
		$(function () {
			$('#datetimepicker1').datetimepicker({
				inline: true,
			});
		});
	</script>
</body>
</html>