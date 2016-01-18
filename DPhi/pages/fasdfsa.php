
			<?php
				require_once('../includes/session.php');
				require_once('../includes/functions.php');
				confirm_logged_in();
				require_once('../includes/connect.php');
				include('../includes/layout/h1.php');
				echo '<title>Delta Phi Xi</title>';
				include('../includes/layout/h2.php');
				include('../pages/nav.php');
				include('../includes/layout/b1.php');
				echo "<div class='info'>
		ADF<br />
ASDF<br />
SDF
				</div>";
				include('../includes/layout/b2.php');
				?>