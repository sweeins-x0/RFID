<?php
namespace block_attendances\output;

defined('MOODLE_INTERNAL') || die();

class renderer extends \plugin_renderer_base {
    public function table($attendances) {
        return $this->render_from_template('block_attendances/table', [
            'attendances' => array_values($attendances)
        ]);
    }
}