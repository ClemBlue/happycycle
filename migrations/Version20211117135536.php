<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211117135536 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE villes ADD departement_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE villes ADD CONSTRAINT FK_19209FD8CCF9E01E FOREIGN KEY (departement_id) REFERENCES departement (id)');
        $this->addSql('CREATE INDEX IDX_19209FD8CCF9E01E ON villes (departement_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE villes DROP FOREIGN KEY FK_19209FD8CCF9E01E');
        $this->addSql('DROP INDEX IDX_19209FD8CCF9E01E ON villes');
        $this->addSql('ALTER TABLE villes DROP departement_id');
    }
}
