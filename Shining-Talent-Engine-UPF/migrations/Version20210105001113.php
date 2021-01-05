<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210105001113 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE admin (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cv_competence (cv_id INT NOT NULL, competence_id INT NOT NULL, INDEX IDX_EB22FDEDCFE419E2 (cv_id), INDEX IDX_EB22FDED15761DAB (competence_id), PRIMARY KEY(cv_id, competence_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cv_formation (cv_id INT NOT NULL, formation_id INT NOT NULL, INDEX IDX_DCD808F3CFE419E2 (cv_id), INDEX IDX_DCD808F35200282E (formation_id), PRIMARY KEY(cv_id, formation_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cv_experience_pro (cv_id INT NOT NULL, experience_pro_id INT NOT NULL, INDEX IDX_CBE19BABCFE419E2 (cv_id), INDEX IDX_CBE19BAB37000397 (experience_pro_id), PRIMARY KEY(cv_id, experience_pro_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etudiant (id INT AUTO_INCREMENT NOT NULL, active_cv_id INT NOT NULL, public_profile_state TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_717E22E349D9ABA4 (active_cv_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE responsable (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cv_competence ADD CONSTRAINT FK_EB22FDEDCFE419E2 FOREIGN KEY (cv_id) REFERENCES cv (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cv_competence ADD CONSTRAINT FK_EB22FDED15761DAB FOREIGN KEY (competence_id) REFERENCES competence (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cv_formation ADD CONSTRAINT FK_DCD808F3CFE419E2 FOREIGN KEY (cv_id) REFERENCES cv (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cv_formation ADD CONSTRAINT FK_DCD808F35200282E FOREIGN KEY (formation_id) REFERENCES formation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cv_experience_pro ADD CONSTRAINT FK_CBE19BABCFE419E2 FOREIGN KEY (cv_id) REFERENCES cv (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cv_experience_pro ADD CONSTRAINT FK_CBE19BAB37000397 FOREIGN KEY (experience_pro_id) REFERENCES experience_pro (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE etudiant ADD CONSTRAINT FK_717E22E349D9ABA4 FOREIGN KEY (active_cv_id) REFERENCES cv (id)');
        $this->addSql('DROP TABLE filiere');
        $this->addSql('DROP TABLE promotion');
        $this->addSql('ALTER TABLE competence CHANGE nom_competence nom_competence VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE cv ADD etudiant_id INT NOT NULL, ADD address VARCHAR(255) NOT NULL, DROP addresse, DROP ls_experience_pro, DROP ls_formation, DROP ls_competences, DROP ls_langues, DROP description, CHANGE titre titre VARCHAR(255) NOT NULL, CHANGE pays pays VARCHAR(255) NOT NULL, CHANGE ville ville VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE cv ADD CONSTRAINT FK_B66FFE92DDEAB1A3 FOREIGN KEY (etudiant_id) REFERENCES etudiant (id)');
        $this->addSql('CREATE INDEX IDX_B66FFE92DDEAB1A3 ON cv (etudiant_id)');
        $this->addSql('ALTER TABLE experience_pro ADD ville VARCHAR(255) NOT NULL, DROP lieu, CHANGE poste poste VARCHAR(255) NOT NULL, CHANGE nom_entreprise nom_entreprise VARCHAR(255) NOT NULL, CHANGE type_emploi type_emploi VARCHAR(255) NOT NULL, CHANGE date_fin date_fin DATE DEFAULT NULL, CHANGE description description VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE formation ADD nom_formation VARCHAR(255) NOT NULL, DROP titre');
        $this->addSql('DROP INDEX UNIQ_1D1C63B350EAE44 ON utilisateur');
        $this->addSql('ALTER TABLE utilisateur ADD responsable_id INT DEFAULT NULL, ADD admin_id INT DEFAULT NULL, ADD etudiant_id INT DEFAULT NULL, DROP id_utilisateur, DROP roles, DROP pass, CHANGE nom_complet nom_complet VARCHAR(255) NOT NULL, CHANGE mail mail VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B353C59D72 FOREIGN KEY (responsable_id) REFERENCES responsable (id)');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B3642B8210 FOREIGN KEY (admin_id) REFERENCES admin (id)');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B3DDEAB1A3 FOREIGN KEY (etudiant_id) REFERENCES etudiant (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1D1C63B353C59D72 ON utilisateur (responsable_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1D1C63B3642B8210 ON utilisateur (admin_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1D1C63B3DDEAB1A3 ON utilisateur (etudiant_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B3642B8210');
        $this->addSql('ALTER TABLE cv DROP FOREIGN KEY FK_B66FFE92DDEAB1A3');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B3DDEAB1A3');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B353C59D72');
        $this->addSql('CREATE TABLE filiere (id INT AUTO_INCREMENT NOT NULL, nom_filiere VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ls_promotion INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE promotion (id INT AUTO_INCREMENT NOT NULL, annee_de_debut INT NOT NULL, annee_promotion INT NOT NULL, ls_etudiants VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE admin');
        $this->addSql('DROP TABLE cv_competence');
        $this->addSql('DROP TABLE cv_formation');
        $this->addSql('DROP TABLE cv_experience_pro');
        $this->addSql('DROP TABLE etudiant');
        $this->addSql('DROP TABLE responsable');
        $this->addSql('ALTER TABLE competence CHANGE nom_competence nom_competence VARCHAR(40) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('DROP INDEX IDX_B66FFE92DDEAB1A3 ON cv');
        $this->addSql('ALTER TABLE cv ADD addresse VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD ls_formation INT NOT NULL, ADD ls_competences INT NOT NULL, ADD ls_langues VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD description VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP address, CHANGE titre titre VARCHAR(40) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE pays pays VARCHAR(30) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE ville ville VARCHAR(30) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE etudiant_id ls_experience_pro INT NOT NULL');
        $this->addSql('ALTER TABLE experience_pro ADD lieu VARCHAR(40) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP ville, CHANGE poste poste VARCHAR(30) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE nom_entreprise nom_entreprise VARCHAR(40) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE type_emploi type_emploi VARCHAR(30) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE date_fin date_fin DATE NOT NULL, CHANGE description description VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE formation ADD titre VARCHAR(30) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP nom_formation');
        $this->addSql('DROP INDEX UNIQ_1D1C63B353C59D72 ON utilisateur');
        $this->addSql('DROP INDEX UNIQ_1D1C63B3642B8210 ON utilisateur');
        $this->addSql('DROP INDEX UNIQ_1D1C63B3DDEAB1A3 ON utilisateur');
        $this->addSql('ALTER TABLE utilisateur ADD id_utilisateur VARCHAR(180) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:json)\', ADD pass VARCHAR(45) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP responsable_id, DROP admin_id, DROP etudiant_id, CHANGE nom_complet nom_complet VARCHAR(45) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE mail mail VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1D1C63B350EAE44 ON utilisateur (id_utilisateur)');
    }
}
