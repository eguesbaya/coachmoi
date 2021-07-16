<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210715083929 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE coach_booking DROP FOREIGN KEY FK_5BDC0596C43240D7');
        $this->addSql('ALTER TABLE coach_booking ADD CONSTRAINT FK_5BDC0596C43240D7 FOREIGN KEY (training_space_id) REFERENCES training_space (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE coach_booking DROP FOREIGN KEY FK_5BDC0596C43240D7');
        $this->addSql('ALTER TABLE coach_booking ADD CONSTRAINT FK_5BDC0596C43240D7 FOREIGN KEY (training_space_id) REFERENCES training_space (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
    }
}
