    <?php
    defined('MOODLE_INTERNAL') || die();

    class block_attendances extends block_base {

        public function init() {
            $this->title = 'Attendances';
        }

        public function get_content() {
            if ($this->content !== null)
                return $this->content;

            $context = context_course::instance($this->page->course->id);
            $this->content = new stdClass();
            $attendances = [];
            
            if (!$this->get_database($this->content, $attendances))
                return $this->content;

            if (has_capability('block/attendances:teacher', $context))
                $this->render_teacher($this->content, $attendances);

            else if (has_capability('block/attendances:student', $context))
                $this->render_student($this->content, $attendances);

            return $this->content;
        }

        private function get_database(&$content, &$attendances) {
            global $DB, $USER;

            try {
                $attendances = $DB->get_records('block_attendances', ['atdate' => (int) date('Ymd')]);
            }
            catch (dml_exception $e) {
                $content->text = $e->getMessage();
                return false;
            }

            return true;
        }

        private function render_teacher(&$content, &$attendances) {
            global $PAGE;            

            $renderer = $PAGE->get_renderer('block_attendances');
            $this->content->text = $renderer->table($attendances);
        }

        private function render_student($content, $attendances) {

        }
    }