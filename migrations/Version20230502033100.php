<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230502033100 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE about (id  SERIAL NOT NULL, email_address VARCHAR(255) NOT NULL, phone_number VARCHAR(255) NOT NULL, fax_number VARCHAR(255) DEFAULT NULL, telephone VARCHAR(255) DEFAULT NULL, mission_statement VARCHAR(255) NOT NULL, vision VARCHAR(255) NOT NULL, motto VARCHAR(255) NOT NULL, history LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event (id  SERIAL  NOT NULL, event_name VARCHAR(255) NOT NULL, event_start DATE NOT NULL, event_end DATE NOT NULL, event_location VARCHAR(255) NOT NULL, event_host VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE news (id  SERIAL  NOT NULL, heading VARCHAR(255) NOT NULL, content VARCHAR(255) NOT NULL, date VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE program (id  SERIAL  NOT NULL, section_id INT DEFAULT NULL, program_code VARCHAR(255) NOT NULL, program_name VARCHAR(255) NOT NULL, program_duration VARCHAR(255) NOT NULL, program_certification VARCHAR(255) NOT NULL, program_type VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, INDEX IDX_92ED7784D823E37A (section_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reset_password_request (id INT SERIAL  NOT NULL, user_id INT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', expires_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7CE748AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE section (id  SERIAL  NOT NULL, section_code VARCHAR(255) NOT NULL, section_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE staff (id  SERIAL  NOT NULL, staff_faculty_id INT DEFAULT NULL, staff_program_id INT DEFAULT NULL, staff_id VARCHAR(255) NOT NULL, staff_first_name VARCHAR(255) NOT NULL, staff_middle_name VARCHAR(255) NOT NULL, staff_last_name VARCHAR(255) NOT NULL, staff_email VARCHAR(255) NOT NULL, staff_nrc VARCHAR(255) NOT NULL, staff_designation VARCHAR(255) NOT NULL, staff_contact VARCHAR(255) NOT NULL, INDEX IDX_426EF3928E5EBBB9 (staff_faculty_id), INDEX IDX_426EF392D8EA17DB (staff_program_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE student (id SERIAL  NOT NULL, student_program_of_study_id INT DEFAULT NULL, student_section_id INT DEFAULT NULL, student_id VARCHAR(255) NOT NULL, student_first_name VARCHAR(255) NOT NULL, student_last_name VARCHAR(255) NOT NULL, student_middle_name VARCHAR(255) NOT NULL, student_nrc VARCHAR(255) NOT NULL, student_email VARCHAR(255) NOT NULL, student_sponsor VARCHAR(255) NOT NULL, student_gender VARCHAR(255) NOT NULL, student_date_of_birth DATETIME NOT NULL, student_disability VARCHAR(255) DEFAULT NULL, INDEX IDX_B723AF3355F86682 (student_program_of_study_id), INDEX IDX_B723AF3335FC0E9B (student_section_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id SERIAL  NOT NULL, email VARCHAR(180) NOT NULL, first_name VARCHAR(180) NOT NULL, last_name VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, is_verified TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), UNIQUE INDEX UNIQ_8D93D649A9D1C132 (first_name), UNIQUE INDEX UNIQ_8D93D649C808BA5A (last_name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE program ADD CONSTRAINT FK_92ED7784D823E37A FOREIGN KEY (section_id) REFERENCES section (id)');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE staff ADD CONSTRAINT FK_426EF3928E5EBBB9 FOREIGN KEY (staff_faculty_id) REFERENCES section (id)');
        $this->addSql('ALTER TABLE staff ADD CONSTRAINT FK_426EF392D8EA17DB FOREIGN KEY (staff_program_id) REFERENCES program (id)');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF3355F86682 FOREIGN KEY (student_program_of_study_id) REFERENCES program (id)');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF3335FC0E9B FOREIGN KEY (student_section_id) REFERENCES section (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE program DROP FOREIGN KEY FK_92ED7784D823E37A');
        $this->addSql('ALTER TABLE reset_password_request DROP FOREIGN KEY FK_7CE748AA76ED395');
        $this->addSql('ALTER TABLE staff DROP FOREIGN KEY FK_426EF3928E5EBBB9');
        $this->addSql('ALTER TABLE staff DROP FOREIGN KEY FK_426EF392D8EA17DB');
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF3355F86682');
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF3335FC0E9B');
        $this->addSql('DROP TABLE about');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE news');
        $this->addSql('DROP TABLE program');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('DROP TABLE section');
        $this->addSql('DROP TABLE staff');
        $this->addSql('DROP TABLE student');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
