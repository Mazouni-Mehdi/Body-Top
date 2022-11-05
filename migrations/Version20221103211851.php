<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221103211851 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE module ADD structure_id INT NOT NULL');
        $this->addSql('ALTER TABLE module ADD CONSTRAINT FK_C2426282534008B FOREIGN KEY (structure_id) REFERENCES structure (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C2426282534008B ON module (structure_id)');
        $this->addSql('ALTER TABLE structure DROP FOREIGN KEY FK_6F0137EAAFC2B591');
        $this->addSql('DROP INDEX UNIQ_6F0137EAAFC2B591 ON structure');
        $this->addSql('ALTER TABLE structure DROP module_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE module DROP FOREIGN KEY FK_C2426282534008B');
        $this->addSql('DROP INDEX UNIQ_C2426282534008B ON module');
        $this->addSql('ALTER TABLE module DROP structure_id');
        $this->addSql('ALTER TABLE structure ADD module_id INT NOT NULL');
        $this->addSql('ALTER TABLE structure ADD CONSTRAINT FK_6F0137EAAFC2B591 FOREIGN KEY (module_id) REFERENCES module (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6F0137EAAFC2B591 ON structure (module_id)');
    }
}
