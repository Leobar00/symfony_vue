<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220109164410 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE card ADD colonna_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE card ADD CONSTRAINT FK_161498D3AE5C3BCA FOREIGN KEY (colonna_id) REFERENCES colonna (id)');
        $this->addSql('CREATE INDEX IDX_161498D3AE5C3BCA ON card (colonna_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE card DROP FOREIGN KEY FK_161498D3AE5C3BCA');
        $this->addSql('DROP INDEX IDX_161498D3AE5C3BCA ON card');
        $this->addSql('ALTER TABLE card DROP colonna_id');
    }
}
