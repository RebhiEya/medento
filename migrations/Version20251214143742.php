<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251214143742 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ordonnance ADD patient_id INT NOT NULL, ADD dentiste_id INT NOT NULL, CHANGE contenu contenu LONGTEXT NOT NULL, CHANGE medicaments medicaments LONGTEXT NOT NULL, CHANGE recommandations recommandations LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE ordonnance ADD CONSTRAINT FK_924B326C6B899279 FOREIGN KEY (patient_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE ordonnance ADD CONSTRAINT FK_924B326CACD757B FOREIGN KEY (dentiste_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_924B326C6B899279 ON ordonnance (patient_id)');
        $this->addSql('CREATE INDEX IDX_924B326CACD757B ON ordonnance (dentiste_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ordonnance DROP FOREIGN KEY FK_924B326C6B899279');
        $this->addSql('ALTER TABLE ordonnance DROP FOREIGN KEY FK_924B326CACD757B');
        $this->addSql('DROP INDEX IDX_924B326C6B899279 ON ordonnance');
        $this->addSql('DROP INDEX IDX_924B326CACD757B ON ordonnance');
        $this->addSql('ALTER TABLE ordonnance DROP patient_id, DROP dentiste_id, CHANGE contenu contenu VARCHAR(255) NOT NULL, CHANGE medicaments medicaments VARCHAR(255) NOT NULL, CHANGE recommandations recommandations VARCHAR(255) NOT NULL');
    }
}
