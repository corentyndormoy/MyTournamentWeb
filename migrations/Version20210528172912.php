<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210528172912 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE field_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE place_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE sport_match_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE team_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE tournament_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE user_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE field (id INT NOT NULL, place_id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5BF54558DA6A219 ON field (place_id)');
        $this->addSql('CREATE TABLE place (id INT NOT NULL, town VARCHAR(255) NOT NULL, postcode VARCHAR(5) NOT NULL, street VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE sport_match (id INT NOT NULL, first_team_id INT NOT NULL, second_team_id INT NOT NULL, field_id INT NOT NULL, tournament_id INT NOT NULL, starting_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, duration TIME(0) WITHOUT TIME ZONE NOT NULL, first_team_score INT DEFAULT NULL, second_team_score INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_CE27A41C3AE0B452 ON sport_match (first_team_id)');
        $this->addSql('CREATE INDEX IDX_CE27A41C3E2E58C3 ON sport_match (second_team_id)');
        $this->addSql('CREATE INDEX IDX_CE27A41C443707B0 ON sport_match (field_id)');
        $this->addSql('CREATE INDEX IDX_CE27A41C33D1A3E7 ON sport_match (tournament_id)');
        $this->addSql('CREATE TABLE team (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE tournament (id INT NOT NULL, place_id INT NOT NULL, name VARCHAR(255) NOT NULL, sport VARCHAR(255) NOT NULL, teams_number INT NOT NULL, max_players_per_team_number INT NOT NULL, starting_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_BD5FB8D9DA6A219 ON tournament (place_id)');
        $this->addSql('CREATE TABLE user (id INT NOT NULL, team_id INT DEFAULT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, mail VARCHAR(255) NOT NULL, phone VARCHAR(15) DEFAULT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, gender VARCHAR(1) NOT NULL, player_number INT DEFAULT NULL, roles JSON NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_8D93D649296CD8AE ON user (team_id)');
        $this->addSql('ALTER TABLE field ADD CONSTRAINT FK_5BF54558DA6A219 FOREIGN KEY (place_id) REFERENCES place (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE sport_match ADD CONSTRAINT FK_CE27A41C3AE0B452 FOREIGN KEY (first_team_id) REFERENCES team (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE sport_match ADD CONSTRAINT FK_CE27A41C3E2E58C3 FOREIGN KEY (second_team_id) REFERENCES team (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE sport_match ADD CONSTRAINT FK_CE27A41C443707B0 FOREIGN KEY (field_id) REFERENCES field (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE sport_match ADD CONSTRAINT FK_CE27A41C33D1A3E7 FOREIGN KEY (tournament_id) REFERENCES tournament (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tournament ADD CONSTRAINT FK_BD5FB8D9DA6A219 FOREIGN KEY (place_id) REFERENCES place (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649296CD8AE FOREIGN KEY (team_id) REFERENCES team (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE sport_match DROP CONSTRAINT FK_CE27A41C443707B0');
        $this->addSql('ALTER TABLE field DROP CONSTRAINT FK_5BF54558DA6A219');
        $this->addSql('ALTER TABLE tournament DROP CONSTRAINT FK_BD5FB8D9DA6A219');
        $this->addSql('ALTER TABLE sport_match DROP CONSTRAINT FK_CE27A41C3AE0B452');
        $this->addSql('ALTER TABLE sport_match DROP CONSTRAINT FK_CE27A41C3E2E58C3');
        $this->addSql('ALTER TABLE user DROP CONSTRAINT FK_8D93D649296CD8AE');
        $this->addSql('ALTER TABLE sport_match DROP CONSTRAINT FK_CE27A41C33D1A3E7');
        $this->addSql('DROP SEQUENCE field_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE place_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE sport_match_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE team_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE tournament_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE user_id_seq CASCADE');
        $this->addSql('DROP TABLE field');
        $this->addSql('DROP TABLE place');
        $this->addSql('DROP TABLE sport_match');
        $this->addSql('DROP TABLE team');
        $this->addSql('DROP TABLE tournament');
        $this->addSql('DROP TABLE user');
    }
}
