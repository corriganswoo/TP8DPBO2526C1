<?php
class Lecturer extends DB {
    function getLecturers() {
        $query = "SELECT * FROM lecturers";
        return $this->execute($query);
    }

    function getLecturerById($id) {
        $query = "SELECT * FROM lecturers WHERE id = '$id'";
        return $this->execute($query);
    }

    function addLecturer($data) {
        $name = $data['name'];
        $nidn = $data['nidn'];
        $phone = $data['phone'];
        $join_date = $data['join_date'];
        $email = $data['email'];

        $query = "INSERT INTO lecturers (name, nidn, phone, join_date, email) 
                  VALUES ('$name', '$nidn', '$phone', '$join_date', '$email')";
        return $this->execute($query);
    }

    function updateLecturer($id, $data) {
        $name = $data['name'];
        $nidn = $data['nidn'];
        $phone = $data['phone'];
        $join_date = $data['join_date'];
        $email = $data['email'];

        $query = "UPDATE lecturers SET 
                  name='$name', nidn='$nidn', phone='$phone', join_date='$join_date', email='$email' 
                  WHERE id='$id'";
        return $this->execute($query);
    }

    function deleteLecturer($id) {
        $query = "DELETE FROM lecturers WHERE id = '$id'";
        return $this->execute($query);
    }
}
?>