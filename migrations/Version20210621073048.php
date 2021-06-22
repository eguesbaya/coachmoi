<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210621073048 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE activity (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, photo VARCHAR(255) DEFAULT NULL, is_featured TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE coach (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, birthdate DATE NOT NULL, has_vehicle TINYINT(1) NOT NULL, qualification LONGTEXT NOT NULL, equipment LONGTEXT DEFAULT NULL, biography LONGTEXT NOT NULL, hourly_rate INT NOT NULL, photo VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_3F596DCCA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE coach_activity (coach_id INT NOT NULL, activity_id INT NOT NULL, INDEX IDX_D4C810103C105691 (coach_id), INDEX IDX_D4C8101081C06096 (activity_id), PRIMARY KEY(coach_id, activity_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE space_category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, photo VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE training_space (id INT AUTO_INCREMENT NOT NULL, space_category_id INT NOT NULL, name VARCHAR(255) NOT NULL, photo VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, address VARCHAR(255) NOT NULL, INDEX IDX_C6A84B57E2C6394 (space_category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, password VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, roles JSON NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE coach ADD CONSTRAINT FK_3F596DCCA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE coach_activity ADD CONSTRAINT FK_D4C810103C105691 FOREIGN KEY (coach_id) REFERENCES coach (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE coach_activity ADD CONSTRAINT FK_D4C8101081C06096 FOREIGN KEY (activity_id) REFERENCES activity (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE training_space ADD CONSTRAINT FK_C6A84B57E2C6394 FOREIGN KEY (space_category_id) REFERENCES space_category (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE coach_activity DROP FOREIGN KEY FK_D4C8101081C06096');
        $this->addSql('ALTER TABLE coach_activity DROP FOREIGN KEY FK_D4C810103C105691');
        $this->addSql('ALTER TABLE training_space DROP FOREIGN KEY FK_C6A84B57E2C6394');
        $this->addSql('ALTER TABLE coach DROP FOREIGN KEY FK_3F596DCCA76ED395');
        $this->addSql('DROP TABLE activity');
        $this->addSql('DROP TABLE coach');
        $this->addSql('DROP TABLE coach_activity');
        $this->addSql('DROP TABLE space_category');
        $this->addSql('DROP TABLE training_space');
        $this->addSql('DROP TABLE user');
    }
}
