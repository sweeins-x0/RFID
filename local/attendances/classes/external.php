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

    public static function submit($userid) {
        global $DB;

        // e2a2ece15eb08fdebc7e971645350753

        $atdate = (int) date('Ymd');
        $attime = (int) date('Hi');
        if ($attime > 700)
            $status = 'late';
        else if ($attime > 630)
            $status = 'ontime';
        else if ($attime > 0)
            $status = 'early';

        $record = (object)[
            'userid' => $userid,
            'status' => $status,
            'atdate' => $atdate,
            'attime' => $attime,
        ];

        $DB->insert_record('local_attendances', $record);
        $DB->insert_record('block_attendances', $record);

        return [
            'success' => true,
            'status' => $status,
        ];
    }

    public static function submit_returns() {
        return new \external_single_structure([
            'success' => new \external_value(PARAM_BOOL, 'Success'),
            'status'  => new \external_value(PARAM_TEXT, 'Status')
        ]);
    }
}
