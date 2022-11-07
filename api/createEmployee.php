<?php

set_include_path(dirname(__DIR__, 1));
require '_autoload.php';

use App\Employee;

$employee = new Employee;
$employee->load($_POST);
try {
    $employee->save();
    print_r(json_encode(['success' => true]));
} catch (PDOException $e) {
    print_r(json_encode(['success' => false, 'message' => $e->getMessage()]));
}
