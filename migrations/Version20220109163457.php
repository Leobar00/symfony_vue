<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220109163457 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE card DROP FOREIGN KEY FK_161498D3420329B7');
        $this->addSql('DROP INDEX IDX_161498D3420329B7 ON card');
        $this->addSql('ALTER TABLE card CHANGE column_id_id column_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE card ADD CONSTRAINT FK_161498D3BE8E8ED5 FOREIGN KEY (column_id) REFERENCES `column` (id)');
        $this->addSql('CREATE INDEX IDX_161498D3BE8E8ED5 ON card (column_id)');
        $this->addSql('ALTER TABLE `column` ADD name INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE card DROP FOREIGN KEY FK_161498D3BE8E8ED5');
        $this->addSql('DROP INDEX IDX_161498D3BE8E8ED5 ON card');
        $this->addSql('ALTER TABLE card CHANGE column_id column_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE card ADD CONSTRAINT FK_161498D3420329B7 FOREIGN KEY (column_id_id) REFERENCES `column` (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_161498D3420329B7 ON card (column_id_id)');
        $this->addSql('ALTER TABLE `column` DROP name');
    }
}
