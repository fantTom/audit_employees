<?php
if (empty($view)) {
    $view = '_table.php';
}
$title = 'Учет сотрудников';
?>
<!DOCTYPE html>
<html lang='en'>
<?php include 'head.php' ?>
<body>
<?php include 'header.php' ?>
<main class="container">
    <div class="row">
        <div class="col-xs-12">
            <?php include $view ?>
        </div>
    </div>
</main>
<?php include 'footer.php' ?>
</body>

</html>