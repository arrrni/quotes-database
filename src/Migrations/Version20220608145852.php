<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20220608145852 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create quote table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE SEQUENCE quote_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE quote (id UUID NOT NULL, quote_id INT NOT NULL, content TEXT NOT NULL, score INT DEFAULT 0 NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN quote.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN quote.created_at IS \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP SEQUENCE quote_id_seq CASCADE');
        $this->addSql('DROP TABLE quote');
    }
}
