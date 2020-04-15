<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200408080539 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE quote ADD categorie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE quote ADD CONSTRAINT FK_6B71CBF4BCF5E72D FOREIGN KEY (categorie_id) REFERENCES category (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_6B71CBF4BCF5E72D ON quote (categorie_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE quote DROP FOREIGN KEY FK_6B71CBF4BCF5E72D');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP INDEX IDX_6B71CBF4BCF5E72D ON quote');
        $this->addSql('ALTER TABLE quote DROP categorie_id');
    }
}
