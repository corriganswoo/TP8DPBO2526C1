<?php
include_once("controllers/CourseController.php");

$course = new CourseController();

if (isset($_GET['form_add'])) {
    $course->formAdd();
} elseif (isset($_GET['add']) && isset($_POST['submit'])) {
    $course->add($_POST);
} elseif (isset($_GET['id_edit'])) {
    $course->formEdit($_GET['id_edit']);
} elseif (isset($_GET['update']) && isset($_POST['submit'])) {
    $course->edit($_GET['update'], $_POST);
} elseif (isset($_GET['id_hapus'])) {
    $course->delete($_GET['id_hapus']);
} else {
    $course->index();
}
?>