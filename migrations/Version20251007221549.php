<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251007221549 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Remove date_start and date_end from refuge';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE refuge DROP date_start');
        $this->addSql('ALTER TABLE refuge DROP date_end');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE refuge ADD date_start TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE refuge ADD date_end TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
    }
}
