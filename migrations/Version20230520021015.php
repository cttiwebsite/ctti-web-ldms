<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230520021015 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE event_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE news_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE program_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE reset_password_request_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE section_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE staff_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE student_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE user_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE about (id INT NOT NULL, email_address VARCHAR(255) NOT NULL, phone_number VARCHAR(255) NOT NULL, fax_number VARCHAR(255) DEFAULT NULL, telephone VARCHAR(255) DEFAULT NULL, mission_statement VARCHAR(255) NOT NULL, vision VARCHAR(255) NOT NULL, motto VARCHAR(255) NOT NULL, history TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE event (id INT NOT NULL, event_name VARCHAR(255) NOT NULL, date VARCHAR(255) DEFAULT NULL, event_location VARCHAR(255) NOT NULL, event_host VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE news (id INT NOT NULL, heading VARCHAR(255) NOT NULL, content VARCHAR(255) NOT NULL, date VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE program (id INT NOT NULL, section_id INT DEFAULT NULL, program_code VARCHAR(255) NOT NULL, program_name VARCHAR(255) NOT NULL, program_duration VARCHAR(255) NOT NULL, program_certification VARCHAR(255) NOT NULL, program_type VARCHAR(255) NOT NULL, description TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_92ED7784D823E37A ON program (section_id)');
        $this->addSql('CREATE TABLE reset_password_request (id INT NOT NULL, user_id INT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, expires_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_7CE748AA76ED395 ON reset_password_request (user_id)');
        $this->addSql('COMMENT ON COLUMN reset_password_request.requested_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN reset_password_request.expires_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE section (id INT NOT NULL, section_code VARCHAR(255) NOT NULL, section_name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE staff (id INT NOT NULL, staff_faculty_id INT DEFAULT NULL, staff_program_id INT DEFAULT NULL, staff_id VARCHAR(255) NOT NULL, staff_first_name VARCHAR(255) NOT NULL, staff_middle_name VARCHAR(255) NOT NULL, staff_last_name VARCHAR(255) NOT NULL, staff_email VARCHAR(255) NOT NULL, staff_nrc VARCHAR(255) NOT NULL, staff_designation VARCHAR(255) NOT NULL, staff_contact VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_426EF3928E5EBBB9 ON staff (staff_faculty_id)');
        $this->addSql('CREATE INDEX IDX_426EF392D8EA17DB ON staff (staff_program_id)');
        $this->addSql('CREATE TABLE student (id INT NOT NULL, student_program_of_study_id INT DEFAULT NULL, student_section_id INT DEFAULT NULL, student_id VARCHAR(255) NOT NULL, student_first_name VARCHAR(255) NOT NULL, student_last_name VARCHAR(255) NOT NULL, student_middle_name VARCHAR(255) NOT NULL, student_nrc VARCHAR(255) NOT NULL, student_email VARCHAR(255) NOT NULL, student_sponsor VARCHAR(255) NOT NULL, student_gender VARCHAR(255) NOT NULL, student_date_of_birth TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, student_disability VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B723AF3355F86682 ON student (student_program_of_study_id)');
        $this->addSql('CREATE INDEX IDX_B723AF3335FC0E9B ON student (student_section_id)');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, email VARCHAR(180) NOT NULL, first_name VARCHAR(180) NOT NULL, last_name VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, is_verified BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON "user" (email)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649A9D1C132 ON "user" (first_name)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649C808BA5A ON "user" (last_name)');
        $this->addSql('CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('CREATE OR REPLACE FUNCTION notify_messenger_messages() RETURNS TRIGGER AS $$
            BEGIN
                PERFORM pg_notify(\'messenger_messages\', NEW.queue_name::text);
                RETURN NEW;
            END;
        $$ LANGUAGE plpgsql;');
        $this->addSql('DROP TRIGGER IF EXISTS notify_trigger ON messenger_messages;');
        $this->addSql('CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON messenger_messages FOR EACH ROW EXECUTE PROCEDURE notify_messenger_messages();');
        $this->addSql('ALTER TABLE program ADD CONSTRAINT FK_92ED7784D823E37A FOREIGN KEY (section_id) REFERENCES section (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE staff ADD CONSTRAINT FK_426EF3928E5EBBB9 FOREIGN KEY (staff_faculty_id) REFERENCES section (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE staff ADD CONSTRAINT FK_426EF392D8EA17DB FOREIGN KEY (staff_program_id) REFERENCES program (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF3355F86682 FOREIGN KEY (student_program_of_study_id) REFERENCES program (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF3335FC0E9B FOREIGN KEY (student_section_id) REFERENCES section (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE event_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE news_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE program_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE reset_password_request_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE section_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE staff_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE student_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE user_id_seq CASCADE');
        $this->addSql('ALTER TABLE program DROP CONSTRAINT FK_92ED7784D823E37A');
        $this->addSql('ALTER TABLE reset_password_request DROP CONSTRAINT FK_7CE748AA76ED395');
        $this->addSql('ALTER TABLE staff DROP CONSTRAINT FK_426EF3928E5EBBB9');
        $this->addSql('ALTER TABLE staff DROP CONSTRAINT FK_426EF392D8EA17DB');
        $this->addSql('ALTER TABLE student DROP CONSTRAINT FK_B723AF3355F86682');
        $this->addSql('ALTER TABLE student DROP CONSTRAINT FK_B723AF3335FC0E9B');
        $this->addSql('DROP TABLE about');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE news');
        $this->addSql('DROP TABLE program');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('DROP TABLE section');
        $this->addSql('DROP TABLE staff');
        $this->addSql('DROP TABLE student');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
