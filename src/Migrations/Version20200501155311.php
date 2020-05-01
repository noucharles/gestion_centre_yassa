<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200501155311 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, date_reservation DATETIME NOT NULL, reservation_salle INT DEFAULT NULL, reservation_table INT DEFAULT NULL, INDEX IDX_42C8495519EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C8495519EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE boisson CHANGE categorie_id categorie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE client CHANGE adresse adresse VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE commande CHANGE user_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE formation CHANGE user_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE menu CHANGE image image VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE reservation');
        $this->addSql('ALTER TABLE boisson CHANGE categorie_id categorie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE client CHANGE adresse adresse VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE commande CHANGE user_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE formation CHANGE user_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE menu CHANGE image image VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
    }
}
