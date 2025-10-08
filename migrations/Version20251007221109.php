<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251007221109 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Transfer date_start and date_end from refuge to reservation';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('
            INSERT INTO reservation (date_start, date_end, refuge_id)
            SELECT date_start, date_end, id FROM refuge
            WHERE date_start IS NOT NULL AND date_end IS NOT NULL
        ');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
