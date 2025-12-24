<?php
namespace local_attendances;

defined('MOODLE_INTERNAL') || die();

require_once("$CFG->libdir/externallib.php");

class external extends \external_api {

    public static function submit_parameters() {
        return new \external_function_parameters([
            'userid'   => new \external_value(PARAM_INT, 'userid'),
        ]);
    }

    public static function submit($userid, $courseid, $status) {
        global $DB;

        $atdate = (int) date('Ymd');
        $attime = (int) time('Hi');
        if $attime > 700
            $status = 'late';
        else if $attime > 630
            $status = 'ontime';
        else if $attime > 0
            $status = 'early';

        $record = (object)[
            'userid' => $userid,
            'status' => $status,
            'atdate' => $atdate,
            'attime' => $attime,
        ];

        $DB->insert_record('local_attendances', $record);
        $DB->insert_record('block_attendances', $record);

        return ['success' => true];
    }

    public static function submit_returns() {
        return new \external_single_structure([
            'success' => new \external_value(PARAM_BOOL, 'Result')
        ]);
    }
}
