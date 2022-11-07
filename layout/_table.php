<?php

use App\Employee;

$employee = new Employee;
?>
<div class="table-responsive">
<table class="table table-bordered table-hover">
    <thead>
    <tr>
        <?php foreach ($employee->fields() as $key => $field) { ?>
            <th><?= $field ?></th>
        <?php } ?>
    </tr>

    <thead>
    <tbody>
    <?php foreach ($employee->query() as $row) { ?>
        <tr>
            <?php foreach ($employee->fields() as $key => $field) { ?>
                <td><?= $row[$key] ?></td>
            <?php } ?>
        </tr>
    <?php } ?>
    </tbody>
</table>
</div>


<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addEmployeeModal">
    Добавить сотрудника
</button>

<!-- Modal -->
<div class="modal fade" id="addEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="addEmployeeModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addEmployeeModalTitle">Добавить сотрудника</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php require '_form.php'?>
            </div>
        </div>
    </div>
</div>