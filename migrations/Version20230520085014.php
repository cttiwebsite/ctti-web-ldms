<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230520085014 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event ADD date VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE event DROP event_start');
        $this->addSql('ALTER TABLE event DROP event_end');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE event ADD event_start DATE NOT NULL');
        $this->addSql('ALTER TABLE event ADD event_end DATE NOT NULL');
        $this->addSql('ALTER TABLE event DROP date');
    }
}
