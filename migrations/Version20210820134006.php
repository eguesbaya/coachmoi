<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210820134006 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE activity (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, photo VARCHAR(255) DEFAULT NULL, updated_at DATETIME DEFAULT NULL, is_featured TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE availability (id INT AUTO_INCREMENT NOT NULL, weekday_id INT NOT NULL, client_id INT DEFAULT NULL, coach_id INT DEFAULT NULL, training_space_id INT DEFAULT NULL, start_time TIME NOT NULL, end_time TIME NOT NULL, INDEX IDX_3FB7A2BF48516439 (weekday_id), INDEX IDX_3FB7A2BF19EB6921 (client_id), INDEX IDX_3FB7A2BF3C105691 (coach_id), INDEX IDX_3FB7A2BFC43240D7 (training_space_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE booking_status (id INT AUTO_INCREMENT NOT NULL, status VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, practice_level_id INT DEFAULT NULL, activity_id INT DEFAULT NULL, coach_booking_id INT DEFAULT NULL, goal LONGTEXT DEFAULT NULL, budget INT DEFAULT NULL, group_size INT DEFAULT NULL, is_apt TINYINT(1) DEFAULT NULL, birthdate DATE DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, created_at DATE NOT NULL, UNIQUE INDEX UNIQ_C7440455A76ED395 (user_id), INDEX IDX_C744045558D2F8A2 (practice_level_id), INDEX IDX_C744045581C06096 (activity_id), UNIQUE INDEX UNIQ_C74404556DCD6B93 (coach_booking_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE coach (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, birthdate DATE DEFAULT NULL, has_vehicle TINYINT(1) DEFAULT NULL, qualification LONGTEXT DEFAULT NULL, equipment LONGTEXT DEFAULT NULL, biography LONGTEXT DEFAULT NULL, hourly_rate INT DEFAULT NULL, photo VARCHAR(255) DEFAULT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_3F596DCCA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE coach_activity (coach_id INT NOT NULL, activity_id INT NOT NULL, INDEX IDX_D4C810103C105691 (coach_id), INDEX IDX_D4C8101081C06096 (activity_id), PRIMARY KEY(coach_id, activity_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE coach_booking (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, training_space_id INT DEFAULT NULL, coach_id INT DEFAULT NULL, booking_status_id INT NOT NULL, created_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_5BDC059619EB6921 (client_id), INDEX IDX_5BDC0596C43240D7 (training_space_id), INDEX IDX_5BDC05963C105691 (coach_id), INDEX IDX_5BDC0596F8C5CBBE (booking_status_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE practice_level (id INT AUTO_INCREMENT NOT NULL, level VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE space_category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, photo VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE training_space (id INT AUTO_INCREMENT NOT NULL, space_category_id INT NOT NULL, name VARCHAR(255) NOT NULL, photo VARCHAR(255) DEFAULT NULL, updated_at DATETIME DEFAULT NULL, address LONGTEXT DEFAULT NULL, INDEX IDX_C6A84B57E2C6394 (space_category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE training_space_activity (training_space_id INT NOT NULL, activity_id INT NOT NULL, INDEX IDX_5385DE9EC43240D7 (training_space_id), INDEX IDX_5385DE9E81C06096 (activity_id), PRIMARY KEY(training_space_id, activity_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, password VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, roles JSON NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE weekday (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE availability ADD CONSTRAINT FK_3FB7A2BF48516439 FOREIGN KEY (weekday_id) REFERENCES weekday (id)');
        $this->addSql('ALTER TABLE availability ADD CONSTRAINT FK_3FB7A2BF19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE availability ADD CONSTRAINT FK_3FB7A2BF3C105691 FOREIGN KEY (coach_id) REFERENCES coach (id)');
        $this->addSql('ALTER TABLE availability ADD CONSTRAINT FK_3FB7A2BFC43240D7 FOREIGN KEY (training_space_id) REFERENCES training_space (id)');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C744045558D2F8A2 FOREIGN KEY (practice_level_id) REFERENCES practice_level (id)');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C744045581C06096 FOREIGN KEY (activity_id) REFERENCES activity (id)');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C74404556DCD6B93 FOREIGN KEY (coach_booking_id) REFERENCES coach_booking (id)');
        $this->addSql('ALTER TABLE coach ADD CONSTRAINT FK_3F596DCCA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE coach_activity ADD CONSTRAINT FK_D4C810103C105691 FOREIGN KEY (coach_id) REFERENCES coach (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE coach_activity ADD CONSTRAINT FK_D4C8101081C06096 FOREIGN KEY (activity_id) REFERENCES activity (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE coach_booking ADD CONSTRAINT FK_5BDC059619EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE coach_booking ADD CONSTRAINT FK_5BDC0596C43240D7 FOREIGN KEY (training_space_id) REFERENCES training_space (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE coach_booking ADD CONSTRAINT FK_5BDC05963C105691 FOREIGN KEY (coach_id) REFERENCES coach (id)');
        $this->addSql('ALTER TABLE coach_booking ADD CONSTRAINT FK_5BDC0596F8C5CBBE FOREIGN KEY (booking_status_id) REFERENCES booking_status (id)');
        $this->addSql('ALTER TABLE training_space ADD CONSTRAINT FK_C6A84B57E2C6394 FOREIGN KEY (space_category_id) REFERENCES space_category (id)');
        $this->addSql('ALTER TABLE training_space_activity ADD CONSTRAINT FK_5385DE9EC43240D7 FOREIGN KEY (training_space_id) REFERENCES training_space (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE training_space_activity ADD CONSTRAINT FK_5385DE9E81C06096 FOREIGN KEY (activity_id) REFERENCES activity (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C744045581C06096');
        $this->addSql('ALTER TABLE coach_activity DROP FOREIGN KEY FK_D4C8101081C06096');
        $this->addSql('ALTER TABLE training_space_activity DROP FOREIGN KEY FK_5385DE9E81C06096');
        $this->addSql('ALTER TABLE coach_booking DROP FOREIGN KEY FK_5BDC0596F8C5CBBE');
        $this->addSql('ALTER TABLE availability DROP FOREIGN KEY FK_3FB7A2BF19EB6921');
        $this->addSql('ALTER TABLE coach_booking DROP FOREIGN KEY FK_5BDC059619EB6921');
        $this->addSql('ALTER TABLE availability DROP FOREIGN KEY FK_3FB7A2BF3C105691');
        $this->addSql('ALTER TABLE coach_activity DROP FOREIGN KEY FK_D4C810103C105691');
        $this->addSql('ALTER TABLE coach_booking DROP FOREIGN KEY FK_5BDC05963C105691');
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C74404556DCD6B93');
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C744045558D2F8A2');
        $this->addSql('ALTER TABLE training_space DROP FOREIGN KEY FK_C6A84B57E2C6394');
        $this->addSql('ALTER TABLE availability DROP FOREIGN KEY FK_3FB7A2BFC43240D7');
        $this->addSql('ALTER TABLE coach_booking DROP FOREIGN KEY FK_5BDC0596C43240D7');
        $this->addSql('ALTER TABLE training_space_activity DROP FOREIGN KEY FK_5385DE9EC43240D7');
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C7440455A76ED395');
        $this->addSql('ALTER TABLE coach DROP FOREIGN KEY FK_3F596DCCA76ED395');
        $this->addSql('ALTER TABLE availability DROP FOREIGN KEY FK_3FB7A2BF48516439');
        $this->addSql('DROP TABLE activity');
        $this->addSql('DROP TABLE availability');
        $this->addSql('DROP TABLE booking_status');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE coach');
        $this->addSql('DROP TABLE coach_activity');
        $this->addSql('DROP TABLE coach_booking');
        $this->addSql('DROP TABLE practice_level');
        $this->addSql('DROP TABLE space_category');
        $this->addSql('DROP TABLE training_space');
        $this->addSql('DROP TABLE training_space_activity');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE weekday');
    }
}
