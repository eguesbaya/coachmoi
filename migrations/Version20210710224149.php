<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210710224149 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE booking_status (id INT AUTO_INCREMENT NOT NULL, status VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE coach_booking ADD booking_status_id INT NOT NULL');
        $this->addSql('ALTER TABLE coach_booking ADD CONSTRAINT FK_5BDC0596F8C5CBBE FOREIGN KEY (booking_status_id) REFERENCES booking_status (id)');
        $this->addSql('CREATE INDEX IDX_5BDC0596F8C5CBBE ON coach_booking (booking_status_id)');
    }
 
    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE coach_booking DROP FOREIGN KEY FK_5BDC0596F8C5CBBE');
        $this->addSql('DROP TABLE booking_status');
        $this->addSql('DROP INDEX IDX_5BDC0596F8C5CBBE ON coach_booking');
        $this->addSql('ALTER TABLE coach_booking DROP booking_status_id');
    }
}
