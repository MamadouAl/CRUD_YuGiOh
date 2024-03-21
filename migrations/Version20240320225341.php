<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240320225341 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE carte_possedee (carte_id INT NOT NULL, edition_id INT NOT NULL, langue_id INT NOT NULL, quantite INT NOT NULL, INDEX IDX_6AD38973C9C7CEB6 (carte_id), INDEX IDX_6AD3897374281A5E (edition_id), INDEX IDX_6AD389732AADBACD (langue_id), PRIMARY KEY(carte_id, edition_id, langue_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE carte_possedee ADD CONSTRAINT FK_6AD38973C9C7CEB6 FOREIGN KEY (carte_id) REFERENCES carte (id)');
        $this->addSql('ALTER TABLE carte_possedee ADD CONSTRAINT FK_6AD3897374281A5E FOREIGN KEY (edition_id) REFERENCES edition (id)');
        $this->addSql('ALTER TABLE carte_possedee ADD CONSTRAINT FK_6AD389732AADBACD FOREIGN KEY (langue_id) REFERENCES langue (id)');
        $this->addSql('DROP TABLE p12_relation');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE p12_relation (num_carte INT AUTO_INCREMENT NOT NULL, carte_nom VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_bin`, carte_categorie VARCHAR(10) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_bin`, carte_attribut VARCHAR(30) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_bin`, carte_niveau INT DEFAULT NULL, carte_description TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_bin`, carte_image VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_bin`, carte_type VARCHAR(30) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_bin`, carte_specificite VARCHAR(30) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_bin`, carteATK INT DEFAULT NULL, carteDEF INT DEFAULT NULL, nom_edition VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_bin`, date_edition DATE DEFAULT NULL, carte_rarete VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_bin`, PRIMARY KEY(num_carte)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_bin` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('ALTER TABLE carte_possedee DROP FOREIGN KEY FK_6AD38973C9C7CEB6');
        $this->addSql('ALTER TABLE carte_possedee DROP FOREIGN KEY FK_6AD3897374281A5E');
        $this->addSql('ALTER TABLE carte_possedee DROP FOREIGN KEY FK_6AD389732AADBACD');
        $this->addSql('DROP TABLE carte_possedee');
    }
}
