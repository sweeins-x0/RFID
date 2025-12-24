<?php
defined('MOODLE_INTERNAL') || die();

class block_attendances extends block_base {

    public function init() {
        $this->title = 'Attendances';
    }

    public function get_content() {
        global $DB, $USER;

        $this->content = new stdClass();

        try {
            $attendances = $DB->get_records('block_attendances', ['attdate' => (int) date('Ymd')]);
        }
        catch (dml_exception $e) {
            $this->content->text = $e->getMessage();
            return $this->content;
        }

        if ($this->content !== null) {
            return $this->content;
        }

        $context = context_course::instance($this->page->course->id);

        if (has_capability('block/attendances:teacher', $context)) {
            $this->content->text = 'Capability (Teacher)';
            foreach ($attendances as $attendance) {
                $this->content->text .= $attendance->userid;
            }
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
