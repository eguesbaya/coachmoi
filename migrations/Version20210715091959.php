<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210715091959 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE coach CHANGE birthdate birthdate DATE DEFAULT NULL, CHANGE has_vehicle has_vehicle TINYINT(1) DEFAULT NULL, CHANGE qualification qualification LONGTEXT DEFAULT NULL, CHANGE biography biography LONGTEXT DEFAULT NULL, CHANGE hourly_rate hourly_rate INT DEFAULT NULL, CHANGE photo photo VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE coach CHANGE birthdate birthdate DATE NOT NULL, CHANGE has_vehicle has_vehicle TINYINT(1) NOT NULL, CHANGE qualification qualification LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE biography biography LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE hourly_rate hourly_rate INT NOT NULL, CHANGE photo photo VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
