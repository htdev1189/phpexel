<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
?>
<form action="export.php" method="post">
    <button type="submit" name="btn_save_exel">Export to File</button>
</form>

<form action="read.php" method="post" enctype="multipart/form-data">
    <input type="file" name="file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
    <button type="submit" name="btn_read-exel">Read file</button>
</form>

