<?php

use App\Address;
use App\Department;
use App\Position;

$department = new Department;
$position = new Position;
$address = new Address
?>

<form id="add_employee_form" name="add_employee_form" method="POST" action="api/createEmployee.php">
    <div class="form-group row">
        <label for="first_name" class="col-sm-2 col-form-label">Имя</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="first_name" placeholder="Имя" required>
        </div>
    </div>
    <div class="form-group row">
        <label for="last_name" class="col-sm-2 col-form-label">Фамилия</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="last_name" placeholder="Фамилия" required>
        </div>
    </div>
    <div class="form-group row">
        <label for="patronymic" class="col-sm-2 col-form-label">Отчество</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="patronymic" placeholder="Отчество">
        </div>
    </div>
    <div class="form-group row">
        <label for="phone_number" class="col-sm-2 col-form-label">Номер телефона</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="phone_number" placeholder="Номер телефона" required>
        </div>
    </div>

    <div class="form-group row">
        <label for="position_id" class="col-sm-2 col-form-label">Должность</label>
        <div class="col-sm-10">
            <select class="form-control" id="position_id" placeholder="Выберете должность" required>
                <?php foreach ($position->query() as $row) { ?>
                    <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                <?php } ?>
            </select>
        </div>
    </div>

    <div class="form-group row">
        <label for="department_id" class="col-sm-2 col-form-label">Подразделение</label>
        <div class="col-sm-10">
            <select class="form-control" id="department_id" placeholder="Выберете адрес" required>
                <?php foreach ($department->query() as $row) { ?>
                    <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                <?php } ?>
            </select>
        </div>
    </div>

    <div class="form-group row">
        <label for="address_id" class="col-sm-2 col-form-label"> Адрес</label>
        <div class="col-sm-10">
            <select class="form-control" id="address_id" placeholder="Выберете адрес" required>
                <?php foreach ($address->query() as $row) { ?>
                    <option value="<?= $row['id'] ?>"><?= $row['description'] ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div id="liveAlertPlaceholder"></div>

    <div class="form-group row">
        <div class="col-sm-10">
            <input type="submit" class="btn btn-primary" value="Отправить">
        </div>
    </div>
</form>


