<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210618080112 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE availability DROP FOREIGN KEY FK_3FB7A2BF19EB6921');
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C744045558D2F8A2');
        $this->addSql('DROP TABLE availability');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE practice_level');
        $this->addSql('ALTER TABLE training_space ADD space_category_id INT NOT NULL');
        $this->addSql('ALTER TABLE training_space ADD CONSTRAINT FK_C6A84B57E2C6394 FOREIGN KEY (space_category_id) REFERENCES space_category (id)');
        $this->addSql('CREATE INDEX IDX_C6A84B57E2C6394 ON training_space (space_category_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE availability (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, coach_id INT NOT NULL, training_space_id INT NOT NULL, weekday VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, start_time DATETIME NOT NULL, end_time DATETIME NOT NULL, INDEX IDX_3FB7A2BF19EB6921 (client_id), INDEX IDX_3FB7A2BF3C105691 (coach_id), INDEX IDX_3FB7A2BFC43240D7 (training_space_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, activity_id INT NOT NULL, practice_level_id INT NOT NULL, birthdate DATE NOT NULL, address VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, goal LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, budget INT NOT NULL, group_size INT NOT NULL, is_apt TINYINT(1) NOT NULL, INDEX IDX_C744045558D2F8A2 (practice_level_id), INDEX IDX_C744045581C06096 (activity_id), UNIQUE INDEX UNIQ_C7440455A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE practice_level (id INT AUTO_INCREMENT NOT NULL, level VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE availability ADD CONSTRAINT FK_3FB7A2BF19EB6921 FOREIGN KEY (client_id) REFERENCES client (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE availability ADD CONSTRAINT FK_3FB7A2BF3C105691 FOREIGN KEY (coach_id) REFERENCES coach (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE availability ADD CONSTRAINT FK_3FB7A2BFC43240D7 FOREIGN KEY (training_space_id) REFERENCES training_space (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C744045558D2F8A2 FOREIGN KEY (practice_level_id) REFERENCES practice_level (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C744045581C06096 FOREIGN KEY (activity_id) REFERENCES activity (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE training_space DROP FOREIGN KEY FK_C6A84B57E2C6394');
        $this->addSql('DROP INDEX IDX_C6A84B57E2C6394 ON training_space');
        $this->addSql('ALTER TABLE training_space DROP space_category_id');
    }
}
