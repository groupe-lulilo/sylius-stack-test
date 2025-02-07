<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250207151206 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE brand (id SERIAL NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE article ADD brand_id INT');
        $this->addSql('ALTER TABLE article DROP brand');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E6644F5D008 FOREIGN KEY (brand_id) REFERENCES brand (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_23A0E6644F5D008 ON article (brand_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE article DROP CONSTRAINT FK_23A0E6644F5D008');
        $this->addSql('DROP TABLE brand');
        $this->addSql('DROP INDEX IDX_23A0E6644F5D008');
        $this->addSql('ALTER TABLE article ADD brand VARCHAR(255) DEFAULT \'Unknown\'');
        $this->addSql('ALTER TABLE article DROP brand_id');
    }
}
