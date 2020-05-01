<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200501152735 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE boisson (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, quantite INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE boisson_commande (boisson_id INT NOT NULL, commande_id INT NOT NULL, INDEX IDX_98ACF766734B8089 (boisson_id), INDEX IDX_98ACF76682EA2E54 (commande_id), PRIMARY KEY(boisson_id, commande_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE boisson_commande ADD CONSTRAINT FK_98ACF766734B8089 FOREIGN KEY (boisson_id) REFERENCES boisson (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE boisson_commande ADD CONSTRAINT FK_98ACF76682EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commande CHANGE user_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE formation CHANGE user_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE menu CHANGE image image VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE boisson_commande DROP FOREIGN KEY FK_98ACF766734B8089');
        $this->addSql('DROP TABLE boisson');
        $this->addSql('DROP TABLE boisson_commande');
        $this->addSql('ALTER TABLE commande CHANGE user_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE formation CHANGE user_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE menu CHANGE image image VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
    }
}
