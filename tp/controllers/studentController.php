<?php
require_once '../../models/student.php';
class studentController
{
    private $studentModel;

    public function __construct()
    {
        $this->studentModel = new Student();
    }

    public function createStudent($name, $birthday, $section)
    {
        return $this->studentModel->create($name, $birthday, $section);
    }

    public function deleteStudent($id)
    {
        return $this->studentModel->deleteStudent($id);
    }

    public function editStudent($id, $name, $birthday, $section)
    {
        return $this->studentModel->editStudent($id, $name, $birthday, $section);
    }
    public function getStudents($limit, $offset)
    {
        return $this->studentModel->getStudents($limit, $offset);
    }
    public function getStudentsByName($limit, $offset, $name)
    {
        return $this->studentModel->getStudentsByName($limit, $offset, $name);
    }
    public function getStudentsBySection($section, $offset, $limit)
    {
        return $this->studentModel->getStudentsBySection($section, $offset, $limit);
    }
}
