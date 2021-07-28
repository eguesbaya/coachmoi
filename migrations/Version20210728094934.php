<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210728094934 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('INSERT INTO space_category (name, photo, description)  VALUES ("En visio", "https://bit.ly/3xebK64", "Des cours de sport en ligne et en groupe, le tout supervisé par un coach certifié"), ("En extérieur", "https://bit.ly/3wo6ooB", "Vous avez envie de faire du sport en plein air? Optez pour le coaching en extérieur."), ("En salle", "https://bit.ly/3cpnieI", "Les infrastructures de qualité et une large gamme d\'équipements en accès libre.")');
    
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('TRUNCATE TABLE space_category');
    }

}
