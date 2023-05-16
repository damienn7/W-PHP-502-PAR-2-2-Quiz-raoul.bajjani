<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230516124142 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user CHANGE created_at created_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE user_reponse DROP FOREIGN KEY user_reponse_ibfk_2');
        $this->addSql('ALTER TABLE user_reponse ADD CONSTRAINT FK_7BBC0CD6B3CA4B FOREIGN KEY (id_user) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_reponse RENAME INDEX user_reponse_ibfk_2 TO id_reponse');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_reponse DROP FOREIGN KEY FK_7BBC0CD6B3CA4B');
        $this->addSql('ALTER TABLE user_reponse RENAME INDEX id_reponse TO user_reponse_ibfk_2');
        $this->addSql('ALTER TABLE user CHANGE created_at created_at DATETIME DEFAULT CURRENT_TIMESTAMP');
    }
}
