<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240320144841 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE client_clientid_seq CASCADE');
        $this->addSql('DROP SEQUENCE categorie_categorieid_seq CASCADE');
        $this->addSql('DROP SEQUENCE produit_produitid_seq CASCADE');
        $this->addSql('DROP SEQUENCE commande_commandeid_seq CASCADE');
        $this->addSql('DROP SEQUENCE panier_panierid_seq CASCADE');
        $this->addSql('DROP SEQUENCE player_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE quantikgame_gameid_seq CASCADE');
        $this->addSql('DROP SEQUENCE p03_auteur_aut_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE p12_relation_num_carte_seq CASCADE');
        $this->addSql('ALTER TABLE quantikgame DROP CONSTRAINT quantikgame_playerone_fkey');
        $this->addSql('ALTER TABLE quantikgame DROP CONSTRAINT quantikgame_playertwo_fkey');
        $this->addSql('ALTER TABLE produit_commande DROP CONSTRAINT produit_commande_commandeid_fkey');
        $this->addSql('ALTER TABLE produit_commande DROP CONSTRAINT produit_commande_produitid_fkey');
        $this->addSql('ALTER TABLE produit_panier DROP CONSTRAINT produit_panier_panierid_fkey');
        $this->addSql('ALTER TABLE produit_panier DROP CONSTRAINT produit_panier_produitid_fkey');
        $this->addSql('ALTER TABLE commande DROP CONSTRAINT commande_clientid_fkey');
        $this->addSql('ALTER TABLE produit DROP CONSTRAINT produit_categorieid_fkey');
        $this->addSql('ALTER TABLE p03_produire DROP CONSTRAINT p03_produire_aut_id_fkey');
        $this->addSql('ALTER TABLE p03_produire DROP CONSTRAINT p03_produire_bd_num_fkey');
        $this->addSql('ALTER TABLE panier DROP CONSTRAINT panier_clientid_fkey');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE quantikgame');
        $this->addSql('DROP TABLE player');
        $this->addSql('DROP TABLE produit_commande');
        $this->addSql('DROP TABLE produit_panier');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE p03_auteur');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE p12_relation');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE p03_album');
        $this->addSql('DROP TABLE p03_produire');
        $this->addSql('DROP TABLE panier');
        $this->addSql('ALTER TABLE carte ALTER carte_description TYPE TEXT');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE client_clientid_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE categorie_categorieid_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE produit_produitid_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE commande_commandeid_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE panier_panierid_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE player_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE quantikgame_gameid_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE p03_auteur_aut_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE p12_relation_num_carte_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE categorie (categorieid SERIAL NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(categorieid))');
        $this->addSql('CREATE TABLE quantikgame (gameid SERIAL NOT NULL, playerone INT NOT NULL, playertwo INT DEFAULT NULL, gamestatus VARCHAR(100) DEFAULT \'constructed\' NOT NULL, json TEXT NOT NULL, PRIMARY KEY(gameid))');
        $this->addSql('CREATE INDEX IDX_1163570B85CBB61E ON quantikgame (playerone)');
        $this->addSql('CREATE INDEX IDX_1163570BEE6DBA89 ON quantikgame (playertwo)');
        $this->addSql('CREATE TABLE player (id SERIAL NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX player_name_key ON player (name)');
        $this->addSql('CREATE TABLE produit_commande (commandeid INT NOT NULL, produitid INT NOT NULL, quantite INT NOT NULL, PRIMARY KEY(commandeid, produitid))');
        $this->addSql('CREATE INDEX IDX_47F5946E1A1D08DC ON produit_commande (commandeid)');
        $this->addSql('CREATE INDEX IDX_47F5946ECC4052C3 ON produit_commande (produitid)');
        $this->addSql('CREATE TABLE produit_panier (panierid INT NOT NULL, produitid INT NOT NULL, quantite INT NOT NULL, PRIMARY KEY(panierid, produitid))');
        $this->addSql('CREATE INDEX IDX_D39EC6C8E702BC1E ON produit_panier (panierid)');
        $this->addSql('CREATE INDEX IDX_D39EC6C8CC4052C3 ON produit_panier (produitid)');
        $this->addSql('CREATE TABLE commande (commandeid SERIAL NOT NULL, clientid INT DEFAULT NULL, datecommande DATE NOT NULL, statut VARCHAR(50) NOT NULL, PRIMARY KEY(commandeid))');
        $this->addSql('CREATE INDEX IDX_6EEAA67D7F98CD1C ON commande (clientid)');
        $this->addSql('CREATE TABLE p03_auteur (aut_id SERIAL NOT NULL, aut_nom VARCHAR(50) NOT NULL, aut_prenom VARCHAR(50) NOT NULL, PRIMARY KEY(aut_id))');
        $this->addSql('CREATE TABLE produit (produitid SERIAL NOT NULL, categorieid INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, prix NUMERIC(10, 2) NOT NULL, image_url VARCHAR(255) DEFAULT NULL, image_url2 VARCHAR(255) DEFAULT NULL, image_url3 VARCHAR(255) DEFAULT NULL, image_url4 VARCHAR(255) DEFAULT NULL, image_url5 VARCHAR(255) DEFAULT NULL, PRIMARY KEY(produitid))');
        $this->addSql('CREATE INDEX IDX_29A5EC276BA3AA3B ON produit (categorieid)');
        $this->addSql('CREATE TABLE p12_relation (num_carte SERIAL NOT NULL, carte_nom VARCHAR(255) DEFAULT NULL, carte_categorie VARCHAR(10) DEFAULT NULL, carte_attribut VARCHAR(30) DEFAULT NULL, carte_niveau INT DEFAULT NULL, carte_description TEXT DEFAULT NULL, carte_image VARCHAR(255) DEFAULT NULL, carte_type VARCHAR(30) DEFAULT NULL, carte_specificite VARCHAR(30) DEFAULT NULL, carteatk INT DEFAULT NULL, cartedef INT DEFAULT NULL, nom_edition VARCHAR(255) DEFAULT NULL, date_edition DATE DEFAULT NULL, carte_rarete VARCHAR(255) DEFAULT NULL, PRIMARY KEY(num_carte))');
        $this->addSql('CREATE TABLE client (clientid SERIAL NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, passwd VARCHAR(255) NOT NULL, reset_passwd VARCHAR(255) DEFAULT NULL, profil_img VARCHAR(255) DEFAULT NULL, telephone INT DEFAULT NULL, adresselivraison VARCHAR(255) DEFAULT NULL, ville VARCHAR(15) DEFAULT NULL, codepostale INT DEFAULT 0, role VARCHAR(8) DEFAULT \'user\' NOT NULL, PRIMARY KEY(clientid))');
        $this->addSql('CREATE UNIQUE INDEX client_email_key ON client (email)');
        $this->addSql('CREATE TABLE p03_album (bd_num INT NOT NULL, bd_titre VARCHAR(100) NOT NULL, bd_annee INT NOT NULL, bd_nbpages INT DEFAULT NULL, bd_prix DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(bd_num))');
        $this->addSql('CREATE TABLE p03_produire (aut_id INT NOT NULL, bd_num INT NOT NULL, aut_role VARCHAR(50) NOT NULL, PRIMARY KEY(aut_id, bd_num, aut_role))');
        $this->addSql('CREATE INDEX IDX_205BA9293E05390A ON p03_produire (aut_id)');
        $this->addSql('CREATE INDEX IDX_205BA9292820B7F7 ON p03_produire (bd_num)');
        $this->addSql('CREATE TABLE panier (panierid SERIAL NOT NULL, clientid INT DEFAULT NULL, datecreation DATE NOT NULL, PRIMARY KEY(panierid))');
        $this->addSql('CREATE INDEX IDX_24CC0DF27F98CD1C ON panier (clientid)');
        $this->addSql('ALTER TABLE quantikgame ADD CONSTRAINT quantikgame_playerone_fkey FOREIGN KEY (playerone) REFERENCES player (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE quantikgame ADD CONSTRAINT quantikgame_playertwo_fkey FOREIGN KEY (playertwo) REFERENCES player (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE produit_commande ADD CONSTRAINT produit_commande_commandeid_fkey FOREIGN KEY (commandeid) REFERENCES commande (commandeid) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE produit_commande ADD CONSTRAINT produit_commande_produitid_fkey FOREIGN KEY (produitid) REFERENCES produit (produitid) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE produit_panier ADD CONSTRAINT produit_panier_panierid_fkey FOREIGN KEY (panierid) REFERENCES panier (panierid) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE produit_panier ADD CONSTRAINT produit_panier_produitid_fkey FOREIGN KEY (produitid) REFERENCES produit (produitid) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT commande_clientid_fkey FOREIGN KEY (clientid) REFERENCES client (clientid) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT produit_categorieid_fkey FOREIGN KEY (categorieid) REFERENCES categorie (categorieid) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE p03_produire ADD CONSTRAINT p03_produire_aut_id_fkey FOREIGN KEY (aut_id) REFERENCES p03_auteur (aut_id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE p03_produire ADD CONSTRAINT p03_produire_bd_num_fkey FOREIGN KEY (bd_num) REFERENCES p03_album (bd_num) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE panier ADD CONSTRAINT panier_clientid_fkey FOREIGN KEY (clientid) REFERENCES client (clientid) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE carte ALTER carte_description TYPE TEXT');
        $this->addSql('ALTER TABLE carte ALTER carte_description TYPE TEXT');
    }
}
