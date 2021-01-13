<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210113100944 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE collection_profiles (id INT AUTO_INCREMENT NOT NULL, ustilisateur_id INT DEFAULT NULL, url VARCHAR(255) DEFAULT NULL, date_creation DATE NOT NULL, description VARCHAR(255) DEFAULT NULL, INDEX IDX_7AB04B0030F9B4FE (ustilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE collection_profiles ADD CONSTRAINT FK_7AB04B0030F9B4FE FOREIGN KEY (ustilisateur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE cv ADD address VARCHAR(255) NOT NULL, DROP adresse, DROP description');
        $this->addSql('ALTER TABLE experience_pro CHANGE description description VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE formation CHANGE description description VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD active_cv INT DEFAULT NULL, DROP mail');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE collection_profiles');
        $this->addSql('ALTER TABLE cv ADD description VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE address adresse VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE experience_pro CHANGE description description VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE formation CHANGE description description VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user ADD mail VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP active_cv');
    }
}
