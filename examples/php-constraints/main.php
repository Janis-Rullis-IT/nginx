<?php
switch ($_SERVER['REQUEST_URI']) {
	case '/static-text';
		die('Static');
		break;
	default:
		die('Index');
		break;
}

?>