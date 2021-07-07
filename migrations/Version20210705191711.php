<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210705191711 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE coach_booking (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, coach_id INT DEFAULT NULL, training_space_id INT DEFAULT NULL, INDEX IDX_5BDC059619EB6921 (client_id), INDEX IDX_5BDC05963C105691 (coach_id), INDEX IDX_5BDC0596C43240D7 (training_space_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE coach_booking ADD CONSTRAINT FK_5BDC059619EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE coach_booking ADD CONSTRAINT FK_5BDC05963C105691 FOREIGN KEY (coach_id) REFERENCES coach (id)');
        $this->addSql('ALTER TABLE coach_booking ADD CONSTRAINT FK_5BDC0596C43240D7 FOREIGN KEY (training_space_id) REFERENCES training_space (id)');
        $this->addSql('ALTER TABLE client ADD activity_id INT NOT NULL, ADD created_at DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C744045581C06096 FOREIGN KEY (activity_id) REFERENCES activity (id)');
        $this->addSql('CREATE INDEX IDX_C744045581C06096 ON client (activity_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE coach_booking');
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C744045581C06096');
        $this->addSql('DROP INDEX IDX_C744045581C06096 ON client');
        $this->addSql('ALTER TABLE client DROP activity_id, DROP created_at');
    }
}
