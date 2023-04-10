<div class="deznav">
            <div class="deznav-scroll">
				<ul class="metismenu" id="menu">
                    <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                            <i class="flaticon-381-networking"></i>
                            <span class="nav-text">Dashboard</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="index.php">Dashboard</a></li>
                            <li><a href="ticket.php">Your Queue's</a></li>
                            
                            
                        </ul>
                    </li>
                    <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                            <i class="flaticon-381-television"></i>
                            <span class="nav-text">Tracker</span>
                        </a>
                        <ul aria-expanded="false">
                            <?php if (in_array("Distro",$_tracker)) { ?>
                            <li><a href="tracker_distro.php">Tracker Distro</a></li>
                            <?php } ?>
                            <?php if (in_array("Input",$_tracker)) { ?>
                            <li><a href="tracker_input.php">Tracker Input</a></li>
                            <?php } ?>
                            <?php if (in_array("Cav",$_tracker)) { ?>
                            <li><a href="tracker_cav.php">Tracker CAV</a></li>
                            <?php } ?>
                        </ul>
                    </li>
                    <?php if (in_array("Tools",$_roles)) { ?>
                    <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                            <i class="flaticon-381-network"></i>
                            <span class="nav-text">Tools</span>
                        </a>
                        <ul aria-expanded="false">
                            <?php if (in_array("Queue",$_roles)) { ?>
                            <li><a href="queue.php">Queue</a></li>
                            <li><a href="distrubuted.php">Distributed</a></li>
                            <?php } ?>
                            <?php if (in_array("Users",$_roles)) { ?>
                            <li><a href="users.php">Users</a></li>
                            <?php } ?>
                            <?php if (in_array("Resources",$_roles)) { ?>
                            <li><a href="resources.php">Resources</a></li>
                            <?php } ?>
                            <li><a href="punch.php">Punch Break</a></li>
                        </ul>
                        
                    </li>
                    <?php } ?>
                    <?php if (in_array("Administrator",$_roles)) { ?>
                    <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                            <i class="flaticon-381-network"></i>
                            <span class="nav-text">Administrator Tools</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="_tools.php">Tools</a></li>
                            <li><a href="audit_trail.php">Audit Trail</a></li>
                        </ul>
                        
                    </li>
                    <?php } ?>
                </ul>
				
				<div class="copyright">
					<p><strong>supportninja.com</strong> © 2023 All Rights Reserved</p>
					<p>Develop by Jerramy Calites</p>
				</div>
			</div>
        </div>