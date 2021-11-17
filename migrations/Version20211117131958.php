<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211117131958 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE villes (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE conteneur ADD ville_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE conteneur ADD CONSTRAINT FK_E9628FD2A73F0036 FOREIGN KEY (ville_id) REFERENCES villes (id)');
        $this->addSql('CREATE INDEX IDX_E9628FD2A73F0036 ON conteneur (ville_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE conteneur DROP FOREIGN KEY FK_E9628FD2A73F0036');
        $this->addSql('DROP TABLE villes');
        $this->addSql('DROP INDEX IDX_E9628FD2A73F0036 ON conteneur');
        $this->addSql('ALTER TABLE conteneur DROP ville_id');
    }
}
