<?php
include_once("Template.php");

class LecturerView {
    public function render($data) {
        $no = 1;
        $dataLecturer = null;
        foreach ($data as $val) {
            $dataLecturer .= "<tr>
                <td>" . $no++ . "</td>
                <td>" . $val['name'] . "</td>
                <td>" . $val['nidn'] . "</td>
                <td>" . $val['phone'] . "</td>
                <td>" . $val['join_date'] . "</td>
                <td>" . $val['email'] . "</td>
                <td>
                    <a href='index.php?id_edit=" . $val['id'] . "' class='btn btn-warning btn-sm'>Edit</a>
                    <a href='index.php?id_hapus=" . $val['id'] . "' class='btn btn-danger btn-sm' onclick=\"return confirm('Yakin hapus data?')\">Delete</a>
                </td>
            </tr>";
        }

        $tpl = new Template("templates/lecturer.html");
        $tpl->replace("DATA_TABEL", $dataLecturer);
        $tpl->write();
    }

    public function renderForm($data = null) {
        $tpl = new Template("templates/lecturer_form.html");
        if ($data != null) {
            $tpl->replace("DATA_TITLE", "Edit Lecturer");
            $tpl->replace("DATA_ACTION", "index.php?update=" . $data['id']);
            $tpl->replace("DATA_NAME", $data['name']);
            $tpl->replace("DATA_NIDN", $data['nidn']);
            $tpl->replace("DATA_PHONE", $data['phone']);
            $tpl->replace("DATA_JOIN_DATE", $data['join_date']);
            $tpl->replace("DATA_EMAIL", $data['email']);
        } else {
            $tpl->replace("DATA_TITLE", "Add New Lecturer");
            $tpl->replace("DATA_ACTION", "index.php?add=true");
            $tpl->replace("DATA_NAME", "");
            $tpl->replace("DATA_NIDN", "");
            $tpl->replace("DATA_PHONE", "");
            $tpl->replace("DATA_JOIN_DATE", "");
            $tpl->replace("DATA_EMAIL", "");
        }
        $tpl->write();
    }
}
?>