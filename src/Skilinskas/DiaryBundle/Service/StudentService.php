<?php

namespace Skilinskas\DiaryBundle\Service;

use Skilinskas\DiaryBundle\Entity\Student;
use Skilinskas\DiaryBundle\Entity\StudentRepository;

class StudentService
{
    protected $repository;

    function __construct(StudentRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getStudents()
    {
        $students = $this->repository->findAll();
        $result = [];

        /** @var Student $s */
        foreach ($students as $s) {
            array_push($result, $s->getAll());
        }
        return $result;
    }
}