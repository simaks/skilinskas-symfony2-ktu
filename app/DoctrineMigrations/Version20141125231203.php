<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20141125231203 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $demoDataSize = 300;
        $demoDateRange = [strtotime("2014-09-01"), strtotime("2014-12-31")];
        $demoData = [];
        for ($i = 0; $i < $demoDataSize; $i++) {
            $timeStamp = rand($demoDateRange[0], $demoDateRange[1]);
            array_push(
                $demoData,
                [rand(4, 10), rand(1, 5), rand(1, 3), date("Y-m-d", $timeStamp)]
            );
        }

        $demoGradesSql = <<<SQL
INSERT INTO Grade (`grade`, `subjectId`, `studentId`, `date`)
VALUES (?, ?, ?, ?)
SQL;

        foreach ($demoData as $row) {
            $this->addSql($demoGradesSql, $row);
        }

    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
