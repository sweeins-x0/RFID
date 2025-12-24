<?php
defined('MOODLE_INTERNAL') || die();

class block_attendances extends block_base {

    public function init() {
        $this->title = 'Attendances';
    }

    public function get_content() {
        global $DB, $USER;

        $today = date('Ymd');
        $logs = $DB->get_records('block_presensi_log', ['attdate' => $today]);

        if ($this->content !== null) {
            return $this->content;
        }

        $this->content = new stdClass();
        $context = context_course::instance($this->page->course->id);

        if (has_capability('block/attendances:teacher', $context)) {
            $this->content->text = 'Capability (Teacher)';
        }
        else if (has_capability('block/attendances:student', $context)) {
            $this->content->text = 'Capability (Student)';
        }
        else {
            $this->content->text = '';
        }

        return $this->content;
    }
}
