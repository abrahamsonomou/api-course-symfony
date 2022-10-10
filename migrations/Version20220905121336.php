<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220905121336 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categorie DROP FOREIGN KEY FK_497DD6347ECF78B0');
        $this->addSql('DROP INDEX IDX_497DD6347ECF78B0 ON categorie');
        $this->addSql('ALTER TABLE categorie DROP cours_id, CHANGE description description VARCHAR(20000) NOT NULL');
        $this->addSql('ALTER TABLE cours ADD formateur_id INT NOT NULL, ADD categorie_id INT NOT NULL, CHANGE resume resume VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE cours ADD CONSTRAINT FK_FDCA8C9C155D8F51 FOREIGN KEY (formateur_id) REFERENCES teacher (id)');
        $this->addSql('ALTER TABLE cours ADD CONSTRAINT FK_FDCA8C9CBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('CREATE INDEX IDX_FDCA8C9C155D8F51 ON cours (formateur_id)');
        $this->addSql('CREATE INDEX IDX_FDCA8C9CBCF5E72D ON cours (categorie_id)');
        $this->addSql('ALTER TABLE event CHANGE description description VARCHAR(20000) NOT NULL');
        $this->addSql('ALTER TABLE teacher DROP FOREIGN KEY FK_B0F6A6D57ECF78B0');
        $this->addSql('DROP INDEX IDX_B0F6A6D57ECF78B0 ON teacher');
        $this->addSql('ALTER TABLE teacher DROP cours_id, CHANGE resume resume VARCHAR(2000) NOT NULL');
        $this->addSql('ALTER TABLE temoignage CHANGE contenu contenu VARCHAR(20000) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categorie ADD cours_id INT DEFAULT NULL, CHANGE description description VARCHAR(3000) NOT NULL');
        $this->addSql('ALTER TABLE categorie ADD CONSTRAINT FK_497DD6347ECF78B0 FOREIGN KEY (cours_id) REFERENCES cours (id)');
        $this->addSql('CREATE INDEX IDX_497DD6347ECF78B0 ON categorie (cours_id)');
        $this->addSql('ALTER TABLE cours DROP FOREIGN KEY FK_FDCA8C9C155D8F51');
        $this->addSql('ALTER TABLE cours DROP FOREIGN KEY FK_FDCA8C9CBCF5E72D');
        $this->addSql('DROP INDEX IDX_FDCA8C9C155D8F51 ON cours');
        $this->addSql('DROP INDEX IDX_FDCA8C9CBCF5E72D ON cours');
        $this->addSql('ALTER TABLE cours DROP formateur_id, DROP categorie_id, CHANGE resume resume MEDIUMTEXT NOT NULL');
        $this->addSql('ALTER TABLE event CHANGE description description MEDIUMTEXT NOT NULL');
        $this->addSql('ALTER TABLE teacher ADD cours_id INT DEFAULT NULL, CHANGE resume resume VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE teacher ADD CONSTRAINT FK_B0F6A6D57ECF78B0 FOREIGN KEY (cours_id) REFERENCES cours (id)');
        $this->addSql('CREATE INDEX IDX_B0F6A6D57ECF78B0 ON teacher (cours_id)');
        $this->addSql('ALTER TABLE temoignage CHANGE contenu contenu MEDIUMTEXT NOT NULL');
    }
}
