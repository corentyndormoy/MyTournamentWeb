<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210313181946 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE place (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, town VARCHAR(255) NOT NULL, postcode VARCHAR(5) NOT NULL, street VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE tournament (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, place_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, sport VARCHAR(255) NOT NULL, teams_number INTEGER NOT NULL, max_players_per_team_number INTEGER NOT NULL, starting_at DATETIME NOT NULL)');
        $this->addSql('CREATE INDEX IDX_BD5FB8D9DA6A219 ON tournament (place_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE place');
        $this->addSql('DROP TABLE tournament');
    }
}
