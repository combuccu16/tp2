<?php
require_once "../../models/student.php";
class StudentController
{
    private $studentModel;

    public function __construct()
    {
        $this->studentModel = new Student();
    }

    public function getStudent($id)
    {
        return $this->studentModel->getStudentById($id);
    }

    public function getAllStudents()
    {
        return $this->studentModel->getAllStudents();
    }
}
