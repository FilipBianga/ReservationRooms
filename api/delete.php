<?php
include("../config.php");

if (isset($_POST["id"])) {
    $db->deleteById('reservation',$_POST['id']);
}
