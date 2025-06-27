<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250627084455 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Création des tables City et Gouvernorat et ajout des relations';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE city (id INT AUTO_INCREMENT NOT NULL, gouvernorat_id INT NOT NULL, name VARCHAR(50) NOT NULL, INDEX IDX_2D5B023475B74E2D (gouvernorat_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE gouvernorat (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE city ADD CONSTRAINT FK_2D5B023475B74E2D FOREIGN KEY (gouvernorat_id) REFERENCES gouvernorat (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE dossier ADD person_id INT NOT NULL, ADD city_id INT DEFAULT NULL, ADD gouvernorat_id INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE dossier ADD CONSTRAINT FK_3D48E037217BBB47 FOREIGN KEY (person_id) REFERENCES person (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE dossier ADD CONSTRAINT FK_3D48E0378BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE dossier ADD CONSTRAINT FK_3D48E03775B74E2D FOREIGN KEY (gouvernorat_id) REFERENCES gouvernorat (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_3D48E037217BBB47 ON dossier (person_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_3D48E0378BAC62AF ON dossier (city_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_3D48E03775B74E2D ON dossier (gouvernorat_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE dossier DROP FOREIGN KEY FK_3D48E0378BAC62AF
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE dossier DROP FOREIGN KEY FK_3D48E03775B74E2D
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE city DROP FOREIGN KEY FK_2D5B023475B74E2D
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE city
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE gouvernorat
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE dossier DROP FOREIGN KEY FK_3D48E037217BBB47
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX UNIQ_3D48E037217BBB47 ON dossier
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_3D48E0378BAC62AF ON dossier
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_3D48E03775B74E2D ON dossier
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE dossier DROP person_id, DROP city_id, DROP gouvernorat_id
        SQL);
    }
}
