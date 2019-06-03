<?php
// SU_AMEND START - Unit descriptor: Main function - is this being used?
function unit_descriptor($course){
	global $CFG;
	require_once('../config.php');
	$category = core_course_category::get($course->category)->get_formatted_name();
	if(isset($category)){
		$catname = strtolower('x'.$category);
		$coursecode = substr($course->shortname, 0, strpos($course->shortname, "_"));
		//$coursefullname = $course->fullname;
		//$startdate = '<br /><div class="solent_startdate">'.$course->startdate.'</div>';

		if(strpos($catname, 'unit pages') !== false){
			$descriptor = '../amendments/course_docs/unit_descriptors/'.$coursecode.'.doc'; //STRING TO LOCATE THE UNIT CODE .DOC
			$descriptorx = '../amendments/course_docs/unit_descriptors/'.$coursecode.'.docx'; //STRING TO LOCATE THE UNIT CODE .DOCX
			//CHECK IF THE FILE EXISTS
			if (file_exists($descriptor)){
				return "<a href='".$descriptor."' class='unit_desc' target='_blank'>Unit Descriptor</a>";//IF IT DOES EXIST ADD THE LINK
			}elseif (file_exists($descriptorx)){
				return "<a href='".$descriptorx."'  class='unit_desc' target='_blank'>Unit Descriptor</a>";//IF IT DOES EXIST ADD THE LINK
			}else{
				return "<span class='unit_desc'>No unit descriptor available</span>";//IF IT DOSN'T EXIST ADD ALTERNATIVE LINK
			}

			//echo "Unit Descriptors for 2016 are currently awaiting publication";
		}

		if(strpos($catname, 'course pages') !== false){
			return '<a href="http://learn.solent.ac.uk/mod/data/view.php?d=288&perpage=1000&search='. $course->idnumber .'&sort=0&order=ASC&advanced=0&filter=1&f_1174=&f_1175=&f_1176=&f_1177=&f_1178=&f_1179=&f_1180=&u_fn=&u_ln="  class="unit_desc" target="_blank">External Examiner Report</a>';
		}
	}
}
// SSU_AMEND END
?>
