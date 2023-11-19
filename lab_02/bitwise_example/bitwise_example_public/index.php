<?php
/** index.php
	* PHP program to perform bitwise analysis
	*
	* Feature 1: Form is displayed
	* Feature 2: A value is entered, sanitised and validated,
	* pocessed and the appropriate output is displayed
*/
	ini_set('display_errors', 'On');
	ini_set('html_errors', 'On');
	ini_set('xdebug.trace_output_name', 'bitwise.%t');
	xdebug_start_trace();
	include 'bitwise_example/bootstrap.php';
	xdebug_stop_trace();
?>
