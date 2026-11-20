<?php
include_once("controllers/LecturerController.php");

$lecturer = new LecturerController();

if (isset($_GET['form_add'])) {
    $lecturer->formAdd();
} elseif (isset($_GET['add']) && isset($_POST['submit'])) {
    $lecturer->add($_POST);
} elseif (isset($_GET['id_edit'])) {
    $lecturer->formEdit($_GET['id_edit']);
} elseif (isset($_GET['update']) && isset($_POST['submit'])) {
    $lecturer->edit($_GET['update'], $_POST);
} elseif (isset($_GET['id_hapus'])) {
    $lecturer->delete($_GET['id_hapus']);
} else {
    $lecturer->index();
}
?>