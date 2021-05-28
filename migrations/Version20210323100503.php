<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210323100503 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE team (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('DROP INDEX IDX_5BF54558DA6A219');
        $this->addSql('CREATE TEMPORARY TABLE __temp__field AS SELECT id, place_id, name FROM field');
        $this->addSql('DROP TABLE field');
        $this->addSql('CREATE TABLE field (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, place_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL COLLATE BINARY, CONSTRAINT FK_5BF54558DA6A219 FOREIGN KEY (place_id) REFERENCES place (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO field (id, place_id, name) SELECT id, place_id, name FROM __temp__field');
        $this->addSql('DROP TABLE __temp__field');
        $this->addSql('CREATE INDEX IDX_5BF54558DA6A219 ON field (place_id)');
        $this->addSql('DROP INDEX IDX_BD5FB8D9DA6A219');
        $this->addSql('CREATE TEMPORARY TABLE __temp__tournament AS SELECT id, place_id, name, sport, teams_number, max_players_per_team_number, starting_at FROM tournament');
        $this->addSql('DROP TABLE tournament');
        $this->addSql('CREATE TABLE tournament (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, place_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL COLLATE BINARY, sport VARCHAR(255) NOT NULL COLLATE BINARY, teams_number INTEGER NOT NULL, max_players_per_team_number INTEGER NOT NULL, starting_at DATETIME NOT NULL, CONSTRAINT FK_BD5FB8D9DA6A219 FOREIGN KEY (place_id) REFERENCES place (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO tournament (id, place_id, name, sport, teams_number, max_players_per_team_number, starting_at) SELECT id, place_id, name, sport, teams_number, max_players_per_team_number, starting_at FROM __temp__tournament');
        $this->addSql('DROP TABLE __temp__tournament');
        $this->addSql('CREATE INDEX IDX_BD5FB8D9DA6A219 ON tournament (place_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, first_name, last_name, mail, phone, username, password, gender, player_number, roles FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, team_id INTEGER DEFAULT NULL, first_name VARCHAR(255) NOT NULL COLLATE BINARY, last_name VARCHAR(255) NOT NULL COLLATE BINARY, mail VARCHAR(255) NOT NULL COLLATE BINARY, phone VARCHAR(15) DEFAULT NULL COLLATE BINARY, username VARCHAR(255) NOT NULL COLLATE BINARY, password VARCHAR(255) NOT NULL COLLATE BINARY, gender VARCHAR(1) NOT NULL COLLATE BINARY, player_number INTEGER DEFAULT NULL, roles CLOB NOT NULL COLLATE BINARY --(DC2Type:json)
        , CONSTRAINT FK_8D93D649296CD8AE FOREIGN KEY (team_id) REFERENCES team (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO user (id, first_name, last_name, mail, phone, username, password, gender, player_number, roles) SELECT id, first_name, last_name, mail, phone, username, password, gender, player_number, roles FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
        $this->addSql('CREATE INDEX IDX_8D93D649296CD8AE ON user (team_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE team');
        $this->addSql('DROP INDEX IDX_5BF54558DA6A219');
        $this->addSql('CREATE TEMPORARY TABLE __temp__field AS SELECT id, place_id, name FROM field');
        $this->addSql('DROP TABLE field');
        $this->addSql('CREATE TABLE field (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, place_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO field (id, place_id, name) SELECT id, place_id, name FROM __temp__field');
        $this->addSql('DROP TABLE __temp__field');
        $this->addSql('CREATE INDEX IDX_5BF54558DA6A219 ON field (place_id)');
        $this->addSql('DROP INDEX IDX_BD5FB8D9DA6A219');
        $this->addSql('CREATE TEMPORARY TABLE __temp__tournament AS SELECT id, place_id, name, sport, teams_number, max_players_per_team_number, starting_at FROM tournament');
        $this->addSql('DROP TABLE tournament');
        $this->addSql('CREATE TABLE tournament (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, place_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, sport VARCHAR(255) NOT NULL, teams_number INTEGER NOT NULL, max_players_per_team_number INTEGER NOT NULL, starting_at DATETIME NOT NULL)');
        $this->addSql('INSERT INTO tournament (id, place_id, name, sport, teams_number, max_players_per_team_number, starting_at) SELECT id, place_id, name, sport, teams_number, max_players_per_team_number, starting_at FROM __temp__tournament');
        $this->addSql('DROP TABLE __temp__tournament');
        $this->addSql('CREATE INDEX IDX_BD5FB8D9DA6A219 ON tournament (place_id)');
        $this->addSql('DROP INDEX IDX_8D93D649296CD8AE');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, first_name, last_name, mail, phone, username, password, gender, player_number, roles FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, mail VARCHAR(255) NOT NULL, phone VARCHAR(15) DEFAULT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, gender VARCHAR(1) NOT NULL, player_number INTEGER DEFAULT NULL, roles CLOB NOT NULL --(DC2Type:json)
        )');
        $this->addSql('INSERT INTO user (id, first_name, last_name, mail, phone, username, password, gender, player_number, roles) SELECT id, first_name, last_name, mail, phone, username, password, gender, player_number, roles FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
    }
}
