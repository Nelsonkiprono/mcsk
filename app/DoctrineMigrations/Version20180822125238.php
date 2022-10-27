<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180822125238 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE music DROP FOREIGN KEY FK_CD52224A37A4DFB0');
        $this->addSql('DROP INDEX IDX_CD52224A37A4DFB0 ON music');
        $this->addSql('ALTER TABLE music ADD declaration_type VARCHAR(255) NOT NULL, ADD track_title VARCHAR(255) NOT NULL, ADD recording_title VARCHAR(255) NOT NULL, ADD year_production INT NOT NULL, ADD music_style VARCHAR(255) DEFAULT NULL, ADD duration VARCHAR(255) DEFAULT NULL, ADD background_vocals VARCHAR(255) DEFAULT NULL, ADD track_programming VARCHAR(255) DEFAULT NULL, ADD other_instrumentalists VARCHAR(255) DEFAULT NULL, ADD document_file VARCHAR(255) NOT NULL, DROP date_of_production, CHANGE document_file_id music_category VARCHAR(255) DEFAULT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE music ADD document_file_id VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, ADD date_of_production DATE NOT NULL, DROP declaration_type, DROP track_title, DROP recording_title, DROP year_production, DROP music_category, DROP music_style, DROP duration, DROP background_vocals, DROP track_programming, DROP other_instrumentalists, DROP document_file');
        $this->addSql('ALTER TABLE music ADD CONSTRAINT FK_CD52224A37A4DFB0 FOREIGN KEY (document_file_id) REFERENCES document_file (id)');
        $this->addSql('CREATE INDEX IDX_CD52224A37A4DFB0 ON music (document_file_id)');
    }
}
