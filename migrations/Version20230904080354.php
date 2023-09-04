<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230904080354 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE artistes_festivals (artistes_id INT NOT NULL, festivals_id INT NOT NULL, INDEX IDX_FA1AAC2F96E1EAF4 (artistes_id), INDEX IDX_FA1AAC2F12F492DD (festivals_id), PRIMARY KEY(artistes_id, festivals_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE artistes_festivals ADD CONSTRAINT FK_FA1AAC2F96E1EAF4 FOREIGN KEY (artistes_id) REFERENCES artistes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artistes_festivals ADD CONSTRAINT FK_FA1AAC2F12F492DD FOREIGN KEY (festivals_id) REFERENCES festivals (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE artistes_festivals DROP FOREIGN KEY FK_FA1AAC2F96E1EAF4');
        $this->addSql('ALTER TABLE artistes_festivals DROP FOREIGN KEY FK_FA1AAC2F12F492DD');
        $this->addSql('DROP TABLE artistes_festivals');
    }
}
