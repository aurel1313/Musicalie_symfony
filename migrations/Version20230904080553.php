<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230904080553 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE festivals ADD departements_id INT NOT NULL');
        $this->addSql('ALTER TABLE festivals ADD CONSTRAINT FK_8F6F88781DB279A6 FOREIGN KEY (departements_id) REFERENCES departements (id)');
        $this->addSql('CREATE INDEX IDX_8F6F88781DB279A6 ON festivals (departements_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE festivals DROP FOREIGN KEY FK_8F6F88781DB279A6');
        $this->addSql('DROP INDEX IDX_8F6F88781DB279A6 ON festivals');
        $this->addSql('ALTER TABLE festivals DROP departements_id');
    }
}
