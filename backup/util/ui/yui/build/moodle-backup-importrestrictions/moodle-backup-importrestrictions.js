YUI.add('moodle-backup-importrestrictions', function (Y, NAME) {

/**
 * SU_AMEND - Backup: Import restrctions
 *
 * @module moodle-backup-importrestrictions
 */

/**
 * SU_AMEND - Backup: Import restrctions
 *
 * @class M.core_backup.importrestrictions
 */


// Namespace for the backup.
M.core_backup = M.core_backup || {};

M.core_backup.importrestrictions = function() {

	  Y.all('input[type="checkbox"]').each(function(checkbox){
		  
			var name = checkbox.get("name");
			var id = checkbox.get("id");
			var element = document.getElementById(id);
			var labeltext = element.parentNode.innerHTML;

			if((name.search("assign") != -1) || (name.search("turnitin") != -1)){
				checkbox.set("checked", false);
				checkbox.set("disabled", true);
			}

			if(((labeltext.search("Moderation") != -1) && (labeltext.search("External Examiners") != -1)
				&& (labeltext.search("Private Folder") != -1))) {
					checkbox.set("checked", false);
					checkbox.set("disabled", true);
			}
			

			if(labeltext.search("THIS IS A HIDDEN LABEL") != -1
                || labeltext.search("Unit Announcements") != -1
                || labeltext.search("Module Conversation") != -1
                || labeltext.search("Frequently Asked Questions") != -1
				|| labeltext.search("Here you could put the teaching") != -1
				|| labeltext.search("You could add a link to the") != -1
				|| labeltext.search("For guidance and support with researching") != -1 // New
				|| labeltext.search("Assignment checklist") != -1 // New
				|| labeltext.search("The Library provides additional support") != -1 // New
				|| labeltext.search("Unit readings") != -1
				|| labeltext.search("Reading list") != -1
				|| labeltext.search("Module reading") != -1
				|| labeltext.search("Assignment checklist") != -1
				|| labeltext.search("Assessment checklist") != -1
				|| labeltext.search("Put everything relating to all unit assessment") != -1
				|| labeltext.search("Put everything relating to unit assessment") != -1
				|| labeltext.search("What counts as supporting materials") != -1
				|| labeltext.search("Ask your students to contribute") != -1
				|| labeltext.search("Found something interesting") != -1
				|| labeltext.search("Add your contact details and availability") != -1
				|| labeltext.search("Have you got a question about your") != -1
				|| labeltext.search("Communicating online should be treated") != -1
				|| labeltext.search("COLLEAGUES - WE ARE HERE TO HELP") != -1
				|| labeltext.search("Learning journey") != -1
				|| labeltext.search("Becoming a student is a process") != -1
				|| labeltext.search("All of these succeeding tabs are for your") != -1
				|| labeltext.search("Replace this content with a summary") != -1
				|| labeltext.search("Here you could put the teaching") != -1
				|| labeltext.search("For guidance and support with researching") != -1
				|| labeltext.search("The checklist tool for assessments has been") != -1
				|| labeltext.search("The Library provides additional support for") != -1
				|| labeltext.search("SEND MESSAGES THROUGH SOL INSTEAD") != -1			){
					checkbox.set("checked", false);
					checkbox.set("disabled", true);
			}
	});
};


}, '@VERSION@', {"requires": ["node", "node-event-simulate", "moodle-core-notification-confirm"]});
