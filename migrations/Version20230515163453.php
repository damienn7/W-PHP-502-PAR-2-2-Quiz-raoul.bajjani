<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230515163453 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD roles LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE is_active is_active TINYINT(1) NOT NULL, CHANGE is_admin is_admin TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE user_reponse CHANGE id_user id_user INT DEFAULT NULL, CHANGE id_reponse id_reponse INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_reponse CHANGE id_reponse id_reponse INT NOT NULL, CHANGE id_user id_user INT NOT NULL');
        $this->addSql('ALTER TABLE user DROP roles, CHANGE id id INT NOT NULL, CHANGE is_active is_active TINYINT(1) DEFAULT 0 NOT NULL, CHANGE is_admin is_admin TINYINT(1) DEFAULT 0 NOT NULL');
    }
}
