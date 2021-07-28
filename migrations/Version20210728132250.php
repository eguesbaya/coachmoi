<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210728132250 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('INSERT INTO weekday (name)  VALUES ("Lundi"), ("Mardi"), ("Mercredi"), ("Jeudi"), ("Vendredi"), ("Samedi"), ("Dimanche")');
        $this->addSql('INSERT INTO practice_level (level) VALUES ("Débutant"), ("Intermédiaire"), ("Avancé"), ("Pro")');
        $this->addSql('INSERT INTO booking_status (status) VALUES ("À faire"), ("En cours"), ("Réalisée"), ("Annulée")');
   
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('TRUNCATE TABLE weekday');
        $this->addSql('TRUNCATE TABLE practice_level');
        $this->addSql('TRUNCATE TABLE booking_status');
    }
}
