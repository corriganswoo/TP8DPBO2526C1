<?php
class Course extends DB {
    function getCourses() {
        $query = "SELECT courses.*, lecturers.name AS lecturer_name 
                  FROM courses 
                  JOIN lecturers ON courses.lecturer_id = lecturers.id";
        return $this->execute($query);
    }

    function getCourseById($id) {
        $query = "SELECT * FROM courses WHERE id = '$id'";
        return $this->execute($query);
    }

    function addCourse($data) {
        $code = $data['course_code'];
        $name = $data['course_name'];
        $credits = $data['credits'];
        $lecturer_id = $data['lecturer_id'];

        $query = "INSERT INTO courses (course_code, course_name, credits, lecturer_id) 
                  VALUES ('$code', '$name', '$credits', '$lecturer_id')";
        return $this->execute($query);
    }

    function updateCourse($id, $data) {
        $code = $data['course_code'];
        $name = $data['course_name'];
        $credits = $data['credits'];
        $lecturer_id = $data['lecturer_id'];

        $query = "UPDATE courses SET 
                  course_code='$code', course_name='$name', credits='$credits', lecturer_id='$lecturer_id' 
                  WHERE id='$id'";
        return $this->execute($query);
    }

    function deleteCourse($id) {
        $query = "DELETE FROM courses WHERE id = '$id'";
        return $this->execute($query);
    }
}
?>