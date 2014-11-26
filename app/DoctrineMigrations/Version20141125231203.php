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
        $demoData = [
            [rand(0, 10), 'Saitynai' . rand(1, 5), date("Y-m-".str_pad(rand(0,28), 2, '0', STR_PAD_LEFT))],
            [rand(0, 10), 'Saitynai' . rand(1, 5), date("Y-m-".str_pad(rand(0,28), 2, '0', STR_PAD_LEFT))],
            [rand(0, 10), 'Saitynai' . rand(1, 5), date("Y-m-".str_pad(rand(0,28), 2, '0', STR_PAD_LEFT))],
            [rand(0, 10), 'Saitynai' . rand(1, 5), date("Y-m-".str_pad(rand(0,28), 2, '0', STR_PAD_LEFT))],
            [rand(0, 10), 'Saitynai' . rand(1, 5), date("Y-m-".str_pad(rand(0,28), 2, '0', STR_PAD_LEFT))],
            [rand(0, 10), 'Saitynai' . rand(1, 5), date("Y-m-".str_pad(rand(0,28), 2, '0', STR_PAD_LEFT))],
            [rand(0, 10), 'Saitynai' . rand(1, 5), date("Y-m-".str_pad(rand(0,28), 2, '0', STR_PAD_LEFT))],
            [rand(0, 10), 'Saitynai' . rand(1, 5), date("Y-m-".str_pad(rand(0,28), 2, '0', STR_PAD_LEFT))],
            [rand(0, 10), 'Saitynai' . rand(1, 5), date("Y-m-".str_pad(rand(0,28), 2, '0', STR_PAD_LEFT))],
        ];

        $demoGradesSql = <<<SQL
INSERT INTO Grade (`grade`, `subject`, `date`)
VALUES (?, ?, ?)
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
