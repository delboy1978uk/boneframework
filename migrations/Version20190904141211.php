<?php declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190904141211 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE Beer');
        $this->addSql('DROP TABLE Dragon');
        $this->addSql('DROP TABLE Orc');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE Beer (id INT AUTO_INCREMENT NOT NULL, brewer VARCHAR(30) DEFAULT NULL COLLATE utf8_unicode_ci, name VARCHAR(30) NOT NULL COLLATE utf8_unicode_ci, bestBeforeDate DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE Dragon (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(30) NOT NULL COLLATE utf8_unicode_ci, dob DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE Orc (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(30) NOT NULL COLLATE utf8_unicode_ci, dob DATE DEFAULT NULL, eventTime DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
    }
}
