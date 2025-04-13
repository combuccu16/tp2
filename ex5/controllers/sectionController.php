<?php
require_once '../../models/section.php';
class SectionController
{
    private $sectionModel;

    public function __construct()
    {
        $this->sectionModel = new Section();
    }

    public function createSection($designation, $description)
    {
        return $this->sectionModel->create($designation, $description);
    }

    public function deleteSection($id)
    {
        $this->sectionModel->delete($id);
    }

    public function editSection($id, $designation, $description)
    {
        return $this->sectionModel->update($id, $designation, $description);
    }
    public function getSections($limit, $offset)
    {
        return $this->sectionModel->getSections($limit, $offset);
    }
    public function getAllSections()
    {
        return $this->sectionModel->getAllSections();
    }
    public function countSections()
    {
        return $this->sectionModel->countSections();
    }
    public function getSectionsByDesignation($designation , $offset , $limit)
    {
        return $this->sectionModel->getSectionsByDesignation($designation , $offset , $limit);
    }

}
