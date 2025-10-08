<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251007183119 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create reservation table';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE reservation (id SERIAL NOT NULL, refuge_id INT NOT NULL, date_start TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, date_end TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_42C84955AD3404C1 ON reservation (refuge_id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955AD3404C1 FOREIGN KEY (refuge_id) REFERENCES refuge (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE reservation DROP CONSTRAINT FK_42C84955AD3404C1');
        $this->addSql('DROP TABLE reservation');
    }
}
