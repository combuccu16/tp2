<?php
require_once '../../models/student.php';
class studentController
{
    private $studentModel;

    public function __construct()
    {
        $this->studentModel = new Student();
    }

    public function createStudent($name, $image, $birthday, $section)
    {
        if (!$this->checkImageValidity($image)) {
            echo "error: invalid image format";
            return false;
        }
        
        // Get the original filename and generate a unique name
        $originalName = basename($image['name']);
        $imageName = uniqid() . '-' . $originalName;
        
        // Upload the actual file
        if (!$this->uploadImage($image['tmp_name'], $imageName)) {
            return false;
        }
    
        return $this->studentModel->create($name, $imageName, $birthday, $section);
    }

    public function deleteStudent($id)
    {
        return $this->studentModel->deleteStudent($id);
    }

    public function editStudent($id, $name, $image, $birthday, $section)
    {
        if (!empty($image['name'])) { // Only process if new image is uploaded
            if (!$this->checkImageValidity($image)) {
                echo "error: invalid image format";
                return false;
            }
    
            $originalName = basename($image['name']);
            $imageName = uniqid() . '-' . $originalName;
    
            if (!$this->uploadImage($image['tmp_name'], $imageName)) {
                return false;
            }
        } else {
            // Keep the existing image if no new one is uploaded
            $existingStudent = $this->studentModel->getStudentById($id);
            $imageName = $existingStudent['image'];
        }
    
        return $this->studentModel->editStudent($id, $name, $imageName, $birthday, $section);
    }
    public function getStudentById($id)
    {
        return $this->studentModel->getStudentById($id);
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
    public function getAllStudents(){
        return $this->studentModel->getAllStudents();
    }
    public function countStudents()
    {
        return $this->studentModel->countStudents();
    }
    public function countStudentsBySection($section)
    {
        return $this->studentModel->countStudentsBySection($section);
    }
    public function checkImageValidity($image)
    {
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'JPG', 'JPEG', 'PNG', 'GIF'];
        $extension = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
        if(in_array($extension, $allowedExtensions)){
            return true;
        }
        return false;
    }
    public function uploadImage($tempFile, $newFilename)
    {
        // we need to first change the image name because imagine if another user uploads another image with the same name 
        $targetDir = "../../public/uploads/";
        $targetFile = $targetDir . $newFilename;

    if (move_uploaded_file($tempFile, $targetFile)) {
        return true;
    } else {
        echo "Error uploading the file.";
        return false;
    }

    }
}
