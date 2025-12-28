<?php

$functions = [
    'local_attendances_submit' => [
        'classname'  => 'local_attendances\external',
        'classpath'  => 'local/attendances/classes/external.php',
        'methodname' => 'submit',
        'description'=> 'Submit',
        'type'       => 'write',
    ]
];

$services = [
    'Attendances' => [
        'functions' => ['local_attendances_submit'],
        'enabled'   => 1,
    ]
];