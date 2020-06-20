<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200614052454 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user_to_friends (id INT AUTO_INCREMENT NOT NULL, user INT NOT NULL, friend INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user CHANGE city city INT DEFAULT NULL, CHANGE gender gender INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649C7470A42 FOREIGN KEY (gender) REFERENCES gender (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6492D5B0234 FOREIGN KEY (city) REFERENCES city (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649C7470A42 ON user (gender)');
        $this->addSql('CREATE INDEX IDX_8D93D6492D5B0234 ON user (city)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE user_to_friends');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649C7470A42');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6492D5B0234');
        $this->addSql('DROP INDEX IDX_8D93D649C7470A42 ON user');
        $this->addSql('DROP INDEX IDX_8D93D6492D5B0234 ON user');
        $this->addSql('ALTER TABLE user CHANGE gender gender INT NOT NULL, CHANGE city city INT NOT NULL');
    }
}
