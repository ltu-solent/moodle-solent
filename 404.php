<?php
// SU_AMEND START
require_once ('config.php');
global $CFG, $DB;

$theerrorr = $_SERVER ['REQUEST_URI']; // PICK UP THE ERROR FROM THE URL
$theerrorr = substr($theerrorr, 1); // STRIP OUT THE FORWARD SLASH

$sql = "SELECT url FROM {customurls} WHERE custom_name = ?";
$result_customurls = $DB->get_record_sql($sql, array($theerrorr));

if($result_customurls){
	header('Location:' . $result_customurls->url);
}else{
	$PAGE->set_context ( context_system::instance () );
	$PAGE->set_pagelayout ( 'embedded' );
	$PAGE->set_title ( "Object Not Found" );
	$PAGE->set_heading ( "Object Not Found!" );
	$PAGE->set_url ( '/404.php' );

	echo $OUTPUT->header();

	echo '	<h2>Error 404 - Page not found!</h2>
			<p> The requested URL (' .  $theerrorr . ') was not found on this server. <br /><br />

				If you entered the URL manually please check your
				spelling and try again. </p>

			<p> If you think this is a server error, please contact
			the <a href="mailto:ltu@solent.ac.uk">webmaster</a>.</p>

			<address>
				<a href="/">' . $CFG->wwwroot . '</a><br />

				<span>
				' . date ( "m/d/Y h:i:s a", time () ) . '
				<br />
			</address>
			<script>
			function goBack() {
				window.history.back()
			}
			</script>
			<button onclick="goBack()">Go Back</button>';
	echo $OUTPUT->footer ();
// SU_AMEND END
}
?>
