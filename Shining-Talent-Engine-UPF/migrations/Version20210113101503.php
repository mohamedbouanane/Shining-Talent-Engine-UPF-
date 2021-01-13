<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210113101503 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE collection_profiles (id INT AUTO_INCREMENT NOT NULL, ustilisateur_id INT DEFAULT NULL, url VARCHAR(255) DEFAULT NULL, date_creation DATE NOT NULL, description VARCHAR(255) DEFAULT NULL, INDEX IDX_7AB04B0030F9B4FE (ustilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE competence (id INT AUTO_INCREMENT NOT NULL, cv_id INT DEFAULT NULL, nom_competence VARCHAR(255) NOT NULL, INDEX IDX_94D4687FCFE419E2 (cv_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cv (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, pays VARCHAR(255) NOT NULL, ville VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, INDEX IDX_B66FFE92A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE experience_pro (id INT AUTO_INCREMENT NOT NULL, cv_id INT DEFAULT NULL, poste VARCHAR(255) NOT NULL, nom_entreprise VARCHAR(255) NOT NULL, lieu VARCHAR(255) NOT NULL, type_emploi VARCHAR(255) NOT NULL, date_debut DATE NOT NULL, date_fin DATE NOT NULL, description VARCHAR(255) DEFAULT NULL, INDEX IDX_A52CE209CFE419E2 (cv_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formation (id INT AUTO_INCREMENT NOT NULL, cv_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, annee_debut INT NOT NULL, annee_fin INT NOT NULL, description VARCHAR(255) DEFAULT NULL, INDEX IDX_404021BFCFE419E2 (cv_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, nom_complet VARCHAR(255) NOT NULL, pass VARCHAR(255) NOT NULL, profile_public TINYINT(1) NOT NULL, active_cv INT DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE collection_profiles ADD CONSTRAINT FK_7AB04B0030F9B4FE FOREIGN KEY (ustilisateur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE competence ADD CONSTRAINT FK_94D4687FCFE419E2 FOREIGN KEY (cv_id) REFERENCES cv (id)');
        $this->addSql('ALTER TABLE cv ADD CONSTRAINT FK_B66FFE92A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE experience_pro ADD CONSTRAINT FK_A52CE209CFE419E2 FOREIGN KEY (cv_id) REFERENCES cv (id)');
        $this->addSql('ALTER TABLE formation ADD CONSTRAINT FK_404021BFCFE419E2 FOREIGN KEY (cv_id) REFERENCES cv (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE competence DROP FOREIGN KEY FK_94D4687FCFE419E2');
        $this->addSql('ALTER TABLE experience_pro DROP FOREIGN KEY FK_A52CE209CFE419E2');
        $this->addSql('ALTER TABLE formation DROP FOREIGN KEY FK_404021BFCFE419E2');
        $this->addSql('ALTER TABLE collection_profiles DROP FOREIGN KEY FK_7AB04B0030F9B4FE');
        $this->addSql('ALTER TABLE cv DROP FOREIGN KEY FK_B66FFE92A76ED395');
        $this->addSql('DROP TABLE collection_profiles');
        $this->addSql('DROP TABLE competence');
        $this->addSql('DROP TABLE cv');
        $this->addSql('DROP TABLE experience_pro');
        $this->addSql('DROP TABLE formation');
        $this->addSql('DROP TABLE user');
    }
}
