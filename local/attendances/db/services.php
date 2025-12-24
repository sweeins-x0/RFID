<?php

$functions = [
    'local_attendances_submit' => [
        'classname'  => 'local_attendances\external',
        'methodname' => 'submit',
        'type'       => 'write',
    ]
];

$services = [
    'Attendances' => [
        'functions' => ['local_attendances_submit'],
        'enabled'   => 1,
    ]
];
