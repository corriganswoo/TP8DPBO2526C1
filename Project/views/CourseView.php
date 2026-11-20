<?php
include_once("Template.php");

class CourseView {
    public function render($data) {
        $no = 1;
        $dataCourse = null;
        foreach ($data as $val) {
            $dataCourse .= "<tr>
                <td>" . $no++ . "</td>
                <td>" . $val['course_code'] . "</td>
                <td>" . $val['course_name'] . "</td>
                <td>" . $val['credits'] . "</td>
                <td>" . $val['lecturer_name'] . "</td>
                <td>
                    <a href='course.php?id_edit=" . $val['id'] . "' class='btn btn-warning btn-sm'>Edit</a>
                    <a href='course.php?id_hapus=" . $val['id'] . "' class='btn btn-danger btn-sm' onclick=\"return confirm('Yakin hapus data?')\">Delete</a>
                </td>
            </tr>";
        }

        $tpl = new Template("templates/course.html");
        $tpl->replace("DATA_TABEL", $dataCourse);
        $tpl->write();
    }

    public function renderForm($lecturers, $courseData = null) {
        $options = "";
        foreach ($lecturers as $lec) {
            $selected = ($courseData != null && $courseData['lecturer_id'] == $lec['id']) ? "selected" : "";
            $options .= "<option value='" . $lec['id'] . "' $selected>" . $lec['name'] . " (" . $lec['nidn'] . ")</option>";
        }

        $tpl = new Template("templates/course_form.html");
        $tpl->replace("DATA_LECTURERS", $options);

        if ($courseData != null) {
            $tpl->replace("DATA_TITLE", "Edit Course");
            $tpl->replace("DATA_ACTION", "course.php?update=" . $courseData['id']);
            $tpl->replace("DATA_CODE", $courseData['course_code']);
            $tpl->replace("DATA_NAME", $courseData['course_name']);
            $tpl->replace("DATA_CREDITS", $courseData['credits']);
        } else {
            $tpl->replace("DATA_TITLE", "Add New Course");
            $tpl->replace("DATA_ACTION", "course.php?add=true");
            $tpl->replace("DATA_CODE", "");
            $tpl->replace("DATA_NAME", "");
            $tpl->replace("DATA_CREDITS", "");
        }
        $tpl->write();
    }
}
?>