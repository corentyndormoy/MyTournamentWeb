<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210528172915 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE "user" DROP CONSTRAINT FK_8D93D649296CD8AE');
        $this->addSql('DROP SEQUENCE user_id_seq CASCADE');
        $this->addSql('DROP TABLE "user"');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, team_id INT DEFAULT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, mail VARCHAR(255) NOT NULL, phone VARCHAR(15) DEFAULT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, gender VARCHAR(1) NOT NULL, player_number INT DEFAULT NULL, roles JSON NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE "user" ADD CONSTRAINT FK_8D93D649296CD8AE FOREIGN KEY (team_id) REFERENCES team (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }
}
