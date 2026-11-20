<?php
include_once("config.php");
include_once("models/DB.php");
include_once("models/Lecturer.php");
include_once("views/LecturerView.php");

class LecturerController {
    private $lecturer;

    function __construct() {
        $this->lecturer = new Lecturer(Config::$db_host, Config::$db_user, Config::$db_pass, Config::$db_name);
    }

    public function index() {
        $this->lecturer->open();
        $this->lecturer->getLecturers();
        
        $data = array();
        while ($row = $this->lecturer->getResult()) {
            array_push($data, $row);
        }
        $this->lecturer->close();

        $view = new LecturerView();
        $view->render($data);
    }

    public function formAdd() {
        $view = new LecturerView();
        $view->renderForm();
    }

    public function add($data) {
        $this->lecturer->open();
        $this->lecturer->addLecturer($data);
        $this->lecturer->close();
        header("location:index.php");
    }

    public function formEdit($id) {
        $this->lecturer->open();
        $this->lecturer->getLecturerById($id);
        $data = $this->lecturer->getResult();
        $this->lecturer->close();

        $view = new LecturerView();
        $view->renderForm($data);
    }

    public function edit($id, $data) {
        $this->lecturer->open();
        $this->lecturer->updateLecturer($id, $data);
        $this->lecturer->close();
        header("location:index.php");
    }

    public function delete($id) {
        $this->lecturer->open();
        $this->lecturer->deleteLecturer($id);
        $this->lecturer->close();
        header("location:index.php");
    }
}
?>