<?php

namespace Skilinskas\DiaryBundle\Service;

use Skilinskas\DiaryBundle\Entity\Grade;
use Skilinskas\DiaryBundle\Entity\GradeRepository;

class GradeService
{
    public function getGrades(GradeRepository $repository, $studentId = null, $subjectId = null, $date_from = null, $date_to = null)
    {
        if ($date_from == null) {
            $date_from = date('Y-m-d', strtotime('-7 days'));
        }
        if ($date_to == null) {
            $date_to = date('Y-m-d');
        }
        if ($studentId == '*') {
            $studentId = null;
        }
        if ($subjectId == '*') {
            $subjectId = null;
        }

        $queryBuild = $repository->createQueryBuilder('g');

        if ($studentId != null && $subjectId != null) {
            $queryBuild->where('g.date > :date_from AND g.date < :date_to AND g.studentId = :studentId AND g.subjectId = :subjectId')
                ->setParameter(':studentId', $studentId)->setParameter(':subjectId', $subjectId);
        } elseif ($subjectId != null) {
            $queryBuild->where('g.date > :date_from AND g.date < :date_to AND g.subjectId = :subjectId')
                ->setParameter(':subjectId', $subjectId);
        } elseif ($studentId != null) {
            $queryBuild->where('g.date > :date_from AND g.date < :date_to AND g.studentId = :studentId')
                ->setParameter(':studentId', $studentId);
        } else {
            $queryBuild->where('g.date > :date_from AND g.date < :date_to');
        }
        $queryBuild->setParameter(':date_from', $date_from)->setParameter(':date_to', $date_to);

        $query = $queryBuild->getQuery();

        $grades = $query->getResult();

        $result = [];
        /** @var Grade $g */
        foreach ($grades as $g) {
            array_push($result, $g->getAll());
        }
        return $result;
    }
}