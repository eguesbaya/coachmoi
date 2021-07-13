<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210713090004 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client ADD coach_booking_id INT DEFAULT NULL, CHANGE activity_id activity_id INT DEFAULT NULL, CHANGE created_at created_at DATE NOT NULL');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C74404556DCD6B93 FOREIGN KEY (coach_booking_id) REFERENCES coach_booking (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C74404556DCD6B93 ON client (coach_booking_id)');
        $this->addSql('ALTER TABLE coach_booking CHANGE created_at created_at DATETIME NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C74404556DCD6B93');
        $this->addSql('DROP INDEX UNIQ_C74404556DCD6B93 ON client');
        $this->addSql('ALTER TABLE client DROP coach_booking_id, CHANGE activity_id activity_id INT NOT NULL, CHANGE created_at created_at DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE coach_booking CHANGE created_at created_at DATETIME DEFAULT NULL');
    }
}
