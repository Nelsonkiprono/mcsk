<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180822130616 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE music ADD document_file_id VARCHAR(255) DEFAULT NULL, DROP document_file');
        $this->addSql('ALTER TABLE music ADD CONSTRAINT FK_CD52224A37A4DFB0 FOREIGN KEY (document_file_id) REFERENCES document_file (id)');
        $this->addSql('CREATE INDEX IDX_CD52224A37A4DFB0 ON music (document_file_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE music DROP FOREIGN KEY FK_CD52224A37A4DFB0');
        $this->addSql('DROP INDEX IDX_CD52224A37A4DFB0 ON music');
        $this->addSql('ALTER TABLE music ADD document_file VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, DROP document_file_id');
    }
}
