<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20141207172418 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $demoData = [
            [1, 'Saityno sistemų kūrimas'],
            [2, 'Matematika'],
            [3, 'Fizika'],
            [4, 'Objektinis programavimas'],
            [5, 'Testavimas'],
        ];

        $demoGradesSql = <<<SQL
INSERT INTO Subject (`id`, `name`)
VALUES (?, ?)
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
