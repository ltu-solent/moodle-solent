<<<<<<< HEAD
<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Output contents of local/customurls/404.php page.
 *
 * @package   local_customurls
 * @author    Mark Sharp <mark.sharp@solent.ac.uk>
 * @copyright 2021 Solent University {@link https://www.solent.ac.uk}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


require_once('config.php');
include_once('local/customurls/404.php');
exit(1);
=======
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
>>>>>>> Solent amendments
