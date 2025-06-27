<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250627084739 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE dossier CHANGE person_id person_id INT DEFAULT NULL
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
            ALTER TABLE dossier DROP FOREIGN KEY FK_3D48E037217BBB47
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE dossier DROP FOREIGN KEY FK_3D48E0378BAC62AF
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE dossier DROP FOREIGN KEY FK_3D48E03775B74E2D
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
            ALTER TABLE dossier CHANGE person_id person_id INT NOT NULL
        SQL);
    }
}
