<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230528170801 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE history (id INT AUTO_INCREMENT NOT NULL, date_reponse DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', score VARCHAR(255) NOT NULL, is_finished TINYINT(1) NOT NULL, is_started TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE history_user (history_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_86A6A6351E058452 (history_id), INDEX IDX_86A6A635A76ED395 (user_id), PRIMARY KEY(history_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE history_user ADD CONSTRAINT FK_86A6A6351E058452 FOREIGN KEY (history_id) REFERENCES history (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE history_user ADD CONSTRAINT FK_86A6A635A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reponse ADD history_id INT DEFAULT NULL, ADD date_responded DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT FK_5FB6DEC71E058452 FOREIGN KEY (history_id) REFERENCES history (id)');
        $this->addSql('CREATE INDEX IDX_5FB6DEC71E058452 ON reponse (history_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY FK_5FB6DEC71E058452');
        $this->addSql('ALTER TABLE history_user DROP FOREIGN KEY FK_86A6A6351E058452');
        $this->addSql('ALTER TABLE history_user DROP FOREIGN KEY FK_86A6A635A76ED395');
        $this->addSql('DROP TABLE history');
        $this->addSql('DROP TABLE history_user');
        $this->addSql('DROP INDEX IDX_5FB6DEC71E058452 ON reponse');
        $this->addSql('ALTER TABLE reponse DROP history_id, DROP date_responded');
    }
}
