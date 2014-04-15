<h1>All Users:</h1>

<?php
	foreach ($users as $key => $value) {
		echo $value['User']['prename']."<br>";
	}

?>