<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211209222034 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE departement (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE villes (id INT AUTO_INCREMENT NOT NULL, departement_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_19209FD8CCF9E01E (departement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE villes ADD CONSTRAINT FK_19209FD8CCF9E01E FOREIGN KEY (departement_id) REFERENCES departement (id)');
        $this->addSql('DROP TABLE agglomeration');
        $this->addSql('ALTER TABLE conteneur ADD ville_id INT DEFAULT NULL, DROP numero_colonne, DROP type_colonne, DROP adresse, DROP code_postal, DROP etat');
        $this->addSql('ALTER TABLE conteneur ADD CONSTRAINT FK_E9628FD2A73F0036 FOREIGN KEY (ville_id) REFERENCES villes (id)');
        $this->addSql('CREATE INDEX IDX_E9628FD2A73F0036 ON conteneur (ville_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE villes DROP FOREIGN KEY FK_19209FD8CCF9E01E');
        $this->addSql('ALTER TABLE conteneur DROP FOREIGN KEY FK_E9628FD2A73F0036');
        $this->addSql('CREATE TABLE agglomeration (id INT AUTO_INCREMENT NOT NULL, departement VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, region VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE departement');
        $this->addSql('DROP TABLE villes');
        $this->addSql('DROP INDEX IDX_E9628FD2A73F0036 ON conteneur');
        $this->addSql('ALTER TABLE conteneur ADD numero_colonne VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD type_colonne VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD adresse VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD code_postal INT NOT NULL, ADD etat VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP ville_id');
    }
}
