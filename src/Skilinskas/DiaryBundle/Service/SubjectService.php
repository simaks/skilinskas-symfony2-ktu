<?php

namespace Skilinskas\DiaryBundle\Service;

use Skilinskas\DiaryBundle\Entity\Subject;
use Doctrine\ORM\EntityRepository;

class SubjectService
{
    protected $repository;

    function __construct(EntityRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getSubjects()
    {
        $subjects = $this->repository->findAll();
        $result = [];

        /** @var Subject $s */
        foreach ($subjects as $s) {
            array_push($result, $s->getAll());
        }
        return $result;
    }
}