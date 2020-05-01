<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200501154257 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, numero INT NOT NULL, adresse VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client_formation (client_id INT NOT NULL, formation_id INT NOT NULL, INDEX IDX_AB60F1B019EB6921 (client_id), INDEX IDX_AB60F1B05200282E (formation_id), PRIMARY KEY(client_id, formation_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE client_formation ADD CONSTRAINT FK_AB60F1B019EB6921 FOREIGN KEY (client_id) REFERENCES client (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE client_formation ADD CONSTRAINT FK_AB60F1B05200282E FOREIGN KEY (formation_id) REFERENCES formation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE boisson CHANGE categorie_id categorie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commande CHANGE user_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE formation CHANGE user_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE menu CHANGE image image VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE client_formation DROP FOREIGN KEY FK_AB60F1B019EB6921');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE client_formation');
        $this->addSql('ALTER TABLE boisson CHANGE categorie_id categorie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commande CHANGE user_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE formation CHANGE user_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE menu CHANGE image image VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
    }
}
