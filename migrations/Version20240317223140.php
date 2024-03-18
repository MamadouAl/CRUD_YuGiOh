<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240317223140 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE carte DROP num_carte, CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE carte_attribut carte_attribut VARCHAR(255) NOT NULL, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE edition DROP num_edition');
        $this->addSql('ALTER TABLE langue DROP num_langue');
        $this->addSql('ALTER TABLE carte MODIFY carte_description LONGTEXT');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE carte MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON carte');
        $this->addSql('ALTER TABLE carte ADD num_carte INT NOT NULL, CHANGE id id INT NOT NULL, CHANGE carte_attribut carte_attribut VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE edition ADD num_edition INT NOT NULL');
        $this->addSql('ALTER TABLE langue ADD num_langue INT NOT NULL');
    }
}
