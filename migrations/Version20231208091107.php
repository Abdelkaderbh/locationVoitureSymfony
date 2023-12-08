<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231208091107 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE modele DROP FOREIGN KEY FK_10028558181A8BA');
        $this->addSql('DROP INDEX IDX_10028558181A8BA ON modele');
        $this->addSql('ALTER TABLE modele DROP voiture_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE modele ADD voiture_id INT NOT NULL');
        $this->addSql('ALTER TABLE modele ADD CONSTRAINT FK_10028558181A8BA FOREIGN KEY (voiture_id) REFERENCES cars (id)');
        $this->addSql('CREATE INDEX IDX_10028558181A8BA ON modele (voiture_id)');
    }
}
