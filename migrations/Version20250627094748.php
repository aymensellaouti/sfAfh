<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250627094748 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE hobby (id INT AUTO_INCREMENT NOT NULL, designation VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE job (id INT AUTO_INCREMENT NOT NULL, designation VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE person_hobby (person_id INT NOT NULL, hobby_id INT NOT NULL, INDEX IDX_9552ECF3217BBB47 (person_id), INDEX IDX_9552ECF3322B2123 (hobby_id), PRIMARY KEY(person_id, hobby_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE person_hobby ADD CONSTRAINT FK_9552ECF3217BBB47 FOREIGN KEY (person_id) REFERENCES person (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE person_hobby ADD CONSTRAINT FK_9552ECF3322B2123 FOREIGN KEY (hobby_id) REFERENCES hobby (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE person ADD job_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE person ADD CONSTRAINT FK_34DCD176BE04EA9 FOREIGN KEY (job_id) REFERENCES job (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_34DCD176BE04EA9 ON person (job_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE person DROP FOREIGN KEY FK_34DCD176BE04EA9
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE person_hobby DROP FOREIGN KEY FK_9552ECF3217BBB47
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE person_hobby DROP FOREIGN KEY FK_9552ECF3322B2123
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE hobby
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE job
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE person_hobby
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_34DCD176BE04EA9 ON person
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE person DROP job_id
        SQL);
    }
}
