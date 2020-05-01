<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200501153606 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE boisson ADD categorie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE boisson ADD CONSTRAINT FK_8B97C84DBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('CREATE INDEX IDX_8B97C84DBCF5E72D ON boisson (categorie_id)');
        $this->addSql('ALTER TABLE commande CHANGE user_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE formation CHANGE user_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE menu CHANGE image image VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE boisson DROP FOREIGN KEY FK_8B97C84DBCF5E72D');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP INDEX IDX_8B97C84DBCF5E72D ON boisson');
        $this->addSql('ALTER TABLE boisson DROP categorie_id');
        $this->addSql('ALTER TABLE commande CHANGE user_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE formation CHANGE user_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE menu CHANGE image image VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
    }
}
