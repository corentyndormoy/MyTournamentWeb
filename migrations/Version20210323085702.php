<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210323085702 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE field (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, place_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE INDEX IDX_5BF54558DA6A219 ON field (place_id)');
        $this->addSql('DROP INDEX IDX_BD5FB8D9DA6A219');
        $this->addSql('CREATE TEMPORARY TABLE __temp__tournament AS SELECT id, place_id, name, sport, teams_number, max_players_per_team_number, starting_at FROM tournament');
        $this->addSql('DROP TABLE tournament');
        $this->addSql('CREATE TABLE tournament (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, place_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL COLLATE BINARY, sport VARCHAR(255) NOT NULL COLLATE BINARY, teams_number INTEGER NOT NULL, max_players_per_team_number INTEGER NOT NULL, starting_at DATETIME NOT NULL, CONSTRAINT FK_BD5FB8D9DA6A219 FOREIGN KEY (place_id) REFERENCES place (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO tournament (id, place_id, name, sport, teams_number, max_players_per_team_number, starting_at) SELECT id, place_id, name, sport, teams_number, max_players_per_team_number, starting_at FROM __temp__tournament');
        $this->addSql('DROP TABLE __temp__tournament');
        $this->addSql('CREATE INDEX IDX_BD5FB8D9DA6A219 ON tournament (place_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE field');
        $this->addSql('DROP INDEX IDX_BD5FB8D9DA6A219');
        $this->addSql('CREATE TEMPORARY TABLE __temp__tournament AS SELECT id, place_id, name, sport, teams_number, max_players_per_team_number, starting_at FROM tournament');
        $this->addSql('DROP TABLE tournament');
        $this->addSql('CREATE TABLE tournament (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, place_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, sport VARCHAR(255) NOT NULL, teams_number INTEGER NOT NULL, max_players_per_team_number INTEGER NOT NULL, starting_at DATETIME NOT NULL)');
        $this->addSql('INSERT INTO tournament (id, place_id, name, sport, teams_number, max_players_per_team_number, starting_at) SELECT id, place_id, name, sport, teams_number, max_players_per_team_number, starting_at FROM __temp__tournament');
        $this->addSql('DROP TABLE __temp__tournament');
        $this->addSql('CREATE INDEX IDX_BD5FB8D9DA6A219 ON tournament (place_id)');
    }
}
