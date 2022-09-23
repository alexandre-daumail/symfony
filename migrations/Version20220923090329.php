<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220923090329 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE articles DROP created_at');
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E91EBAF6CC');
        $this->addSql('DROP INDEX IDX_1483A5E91EBAF6CC ON users');
        $this->addSql('ALTER TABLE users ADD posts_id INT DEFAULT NULL, DROP articles_id');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E9D5E258C5 FOREIGN KEY (posts_id) REFERENCES articles (id)');
        $this->addSql('CREATE INDEX IDX_1483A5E9D5E258C5 ON users (posts_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE articles ADD created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E9D5E258C5');
        $this->addSql('DROP INDEX IDX_1483A5E9D5E258C5 ON users');
        $this->addSql('ALTER TABLE users ADD articles_id INT NOT NULL, DROP posts_id');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E91EBAF6CC FOREIGN KEY (articles_id) REFERENCES articles (id)');
        $this->addSql('CREATE INDEX IDX_1483A5E91EBAF6CC ON users (articles_id)');
    }
}
