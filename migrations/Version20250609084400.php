<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250609084400 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE SEQUENCE loan_id_seq INCREMENT BY 1 MINVALUE 1 START 1
        SQL);

        $this->addSql(<<<'SQL'
            CREATE TABLE loan (id INT NOT NULL, customer_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, credit_time_in_days INT NOT NULL, interest DOUBLE PRECISION NOT NULL, body INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, closed_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_C5D30D039395C3F3 ON loan (customer_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_C5D30D039395C3F3 ON loan (customer_id) WHERE closed_at IS NULL
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN loan.created_at IS '(DC2Type:datetime_immutable)'
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN loan.closed_at IS '(DC2Type:datetime_immutable)'
        SQL);

        $this->addSql(<<<'SQL'
            ALTER TABLE loan ADD CONSTRAINT FK_C5D30D039395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

        $this->addSql(<<<'SQL'
            DROP SEQUENCE loan_id_seq CASCADE
        SQL);

        $this->addSql(<<<'SQL'
            ALTER TABLE loan DROP CONSTRAINT FK_C5D30D039395C3F3
        SQL);

        $this->addSql(<<<'SQL'
            DROP TABLE loan
        SQL);
    }
}
