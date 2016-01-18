<?php
require_once('../../includes/initialize.php');

include_layout_template('admin_header');
echo $session->protected_content();
include_layout_template('admin_footer');

function content(){
?>
<ul>
	<li><a href="logs.php">Logs</a></li>
	<li><a href="../login/logout.php">Log out</a></li>
</ul>
<?php
}
?>