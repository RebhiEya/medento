<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251217094527 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE rendez_vous (id INT AUTO_INCREMENT NOT NULL, date DATETIME NOT NULL, status VARCHAR(255) NOT NULL, patient VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ordonnance DROP FOREIGN KEY FK_924B326CACD757B');
        $this->addSql('ALTER TABLE ordonnance DROP FOREIGN KEY FK_924B326C6B899279');
        $this->addSql('DROP TABLE ordonnance');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ordonnance (id INT AUTO_INCREMENT NOT NULL, patient_id INT NOT NULL, dentiste_id INT NOT NULL, date DATETIME NOT NULL, contenu LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, medicaments LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, recommandations LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_924B326C6B899279 (patient_id), INDEX IDX_924B326CACD757B (dentiste_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE ordonnance ADD CONSTRAINT FK_924B326CACD757B FOREIGN KEY (dentiste_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE ordonnance ADD CONSTRAINT FK_924B326C6B899279 FOREIGN KEY (patient_id) REFERENCES user (id)');
        $this->addSql('DROP TABLE rendez_vous');
    }
}
