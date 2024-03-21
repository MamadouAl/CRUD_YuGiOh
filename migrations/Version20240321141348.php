<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240321141348 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE p12_relation_num_carte_seq CASCADE');
        $this->addSql('CREATE TABLE carte_possedee (carte_id INT NOT NULL, edition_id INT NOT NULL, langue_id INT NOT NULL, quantite INT NOT NULL, PRIMARY KEY(carte_id, edition_id, langue_id))');
        $this->addSql('CREATE INDEX IDX_6AD38973C9C7CEB6 ON carte_possedee (carte_id)');
        $this->addSql('CREATE INDEX IDX_6AD3897374281A5E ON carte_possedee (edition_id)');
        $this->addSql('CREATE INDEX IDX_6AD389732AADBACD ON carte_possedee (langue_id)');
        $this->addSql('ALTER TABLE carte_possedee ADD CONSTRAINT FK_6AD38973C9C7CEB6 FOREIGN KEY (carte_id) REFERENCES carte (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE carte_possedee ADD CONSTRAINT FK_6AD3897374281A5E FOREIGN KEY (edition_id) REFERENCES edition (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE carte_possedee ADD CONSTRAINT FK_6AD389732AADBACD FOREIGN KEY (langue_id) REFERENCES langue (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE p12_relation');
        $this->addSql('ALTER TABLE carte ALTER carte_description TYPE TEXT');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE p12_relation_num_carte_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE p12_relation (num_carte SERIAL NOT NULL, carte_nom VARCHAR(255) DEFAULT NULL, carte_categorie VARCHAR(10) DEFAULT NULL, carte_attribut VARCHAR(30) DEFAULT NULL, carte_niveau INT DEFAULT NULL, carte_description TEXT DEFAULT NULL, carte_image VARCHAR(255) DEFAULT NULL, carte_type VARCHAR(30) DEFAULT NULL, carte_specificite VARCHAR(30) DEFAULT NULL, carteatk INT DEFAULT NULL, cartedef INT DEFAULT NULL, nom_edition VARCHAR(255) DEFAULT NULL, date_edition DATE DEFAULT NULL, carte_rarete VARCHAR(255) DEFAULT NULL, PRIMARY KEY(num_carte))');
        $this->addSql('ALTER TABLE carte_possedee DROP CONSTRAINT FK_6AD38973C9C7CEB6');
        $this->addSql('ALTER TABLE carte_possedee DROP CONSTRAINT FK_6AD3897374281A5E');
        $this->addSql('ALTER TABLE carte_possedee DROP CONSTRAINT FK_6AD389732AADBACD');
        $this->addSql('DROP TABLE carte_possedee');
        $this->addSql('ALTER TABLE carte ALTER carte_description TYPE TEXT');
        $this->addSql('ALTER TABLE carte ALTER carte_description TYPE TEXT');
    }
}
