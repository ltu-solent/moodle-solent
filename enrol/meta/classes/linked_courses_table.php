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

namespace enrol_meta;

use core\lang_string;
use core\output\html_writer;
use core\url;
use core_table\sql_table;
use stdClass;

/**
 * Class linked_courses_table
 *
 * @package    enrol_meta
 * @copyright  2026 Southampton Solent University {@link https://www.solent.ac.uk}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class linked_courses_table extends sql_table {
    /**
     * linked_courses_table constructor.
     *
     * @param string $uniqueid
     * @param int $courseid
     */
    public function __construct(string $uniqueid, int $courseid) {
        parent::__construct($uniqueid);

        $select = "e.id, e.enrol, e.status, e.courseid, e.customint1, c.fullname, c.shortname";
        $from = "{enrol} e
            JOIN {course} c ON c.id = e.courseid";
        $where = "e.customint1 = :courseid";
        $columns = [
            'course' => new lang_string('course'),
            'status' => new lang_string('status', 'enrol_meta'),
        ];
        $this->define_columns(array_keys($columns));
        $this->define_headers(array_values($columns));
        $this->set_sql($select, $from, $where, ['courseid' => $courseid]);
        $this->define_baseurl(new url('/enrol/instances.php', ['id' => $courseid]));
        $this->collapsible(false);
        $this->sortable(false);
        $this->pageable(false);
        $this->set_caption(get_string('linkedcourses', 'enrol_meta'), []);
    }

    /**
     * Course column
     *
     * @param stdClass $row
     * @return string
     */
    public function col_course(stdClass $row): string {
        $url = new url('/course/view.php', ['id' => $row->courseid]);
        // Make this return the formatted name as per config.
        return html_writer::link($url, format_string($row->fullname));
    }

    /**
     * Status column
     *
     * @param stdClass $row
     * @return string
     */
    public function col_status(stdClass $row): string {
        return get_string('status' . $row->status, 'enrol_meta');
    }

    /**
     * Sets the pagesize variable to the given integer, the totalrows variable
     * to the given integer, and the use_pages variable to true.
     * @param int $perpage
     * @param int $total
     * @return void
     */
    public function pagesize($perpage, $total) {
        $this->pagesize  = $perpage;
        $this->totalrows = $total;
        $this->use_pages = false;
    }

    /**
     * Don't print anything if there's nothing to display.
     *
     * @return void
     */
    public function print_nothing_to_display() {
    }
}
