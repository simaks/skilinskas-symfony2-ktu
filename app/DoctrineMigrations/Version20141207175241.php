<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20141207175241 extends AbstractMigration
{
    public function up(Schema $schema)
    {        $demoData = [
        [1, 'Simas', 'Skilinskas', date('Y-m-d')],
        [2, 'Studentas', 'Studentauskas', date('Y-m-d')],
        [3, 'Vardenis', 'Pavardenis', date('Y-m-d')],
    ];

        $demoGradesSql = <<<SQL
INSERT INTO Student (`id`, `name`, `surname`, `birth`)
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
