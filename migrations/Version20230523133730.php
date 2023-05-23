<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230523133730 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categorie CHANGE name name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE question CHANGE question question VARCHAR(255) NOT NULL, CHANGE id_categorie id_categorie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494E9F34925F FOREIGN KEY (id_categorie_id) REFERENCES categorie (id)');
        $this->addSql('CREATE INDEX IDX_B6F7494E9F34925F ON question (id_categorie_id)');
        $this->addSql('ALTER TABLE reponse ADD id_question_id INT NOT NULL, DROP id_question, CHANGE reponse reponse VARCHAR(255) NOT NULL, CHANGE reponse_expected reponse_expected INT NOT NULL');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT FK_5FB6DEC76353B48 FOREIGN KEY (id_question_id) REFERENCES question (id)');
        $this->addSql('CREATE INDEX IDX_5FB6DEC76353B48 ON reponse (id_question_id)');
        $this->addSql('DROP INDEX email ON user');
        $this->addSql('ALTER TABLE user CHANGE created_at created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE updated_at updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE is_active is_active TINYINT(1) NOT NULL, CHANGE is_admin is_admin TINYINT(1) NOT NULL, CHANGE roles roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', CHANGE is_verified is_verified TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE user_reponse MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE user_reponse DROP FOREIGN KEY FK_7BBC0CD6B3CA4B');
        $this->addSql('ALTER TABLE user_reponse DROP FOREIGN KEY user_reponse_ibfk_1');
        $this->addSql('DROP INDEX id_reponse ON user_reponse');
        $this->addSql('DROP INDEX id_user ON user_reponse');
        $this->addSql('DROP INDEX `primary` ON user_reponse');
        $this->addSql('ALTER TABLE user_reponse ADD user_id INT NOT NULL, ADD reponse_id INT NOT NULL, DROP id, DROP id_user, DROP id_reponse');
        $this->addSql('ALTER TABLE user_reponse ADD CONSTRAINT FK_7BBC0CDA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_reponse ADD CONSTRAINT FK_7BBC0CDCF18BB82 FOREIGN KEY (reponse_id) REFERENCES reponse (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_7BBC0CDA76ED395 ON user_reponse (user_id)');
        $this->addSql('CREATE INDEX IDX_7BBC0CDCF18BB82 ON user_reponse (reponse_id)');
        $this->addSql('ALTER TABLE user_reponse ADD PRIMARY KEY (user_id, reponse_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_reponse DROP FOREIGN KEY FK_7BBC0CDA76ED395');
        $this->addSql('ALTER TABLE user_reponse DROP FOREIGN KEY FK_7BBC0CDCF18BB82');
        $this->addSql('DROP INDEX IDX_7BBC0CDA76ED395 ON user_reponse');
        $this->addSql('DROP INDEX IDX_7BBC0CDCF18BB82 ON user_reponse');
        $this->addSql('ALTER TABLE user_reponse ADD id INT AUTO_INCREMENT NOT NULL, ADD id_user INT DEFAULT NULL, ADD id_reponse INT DEFAULT NULL, DROP user_id, DROP reponse_id, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE user_reponse ADD CONSTRAINT FK_7BBC0CD6B3CA4B FOREIGN KEY (id_user) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE user_reponse ADD CONSTRAINT user_reponse_ibfk_1 FOREIGN KEY (id_reponse) REFERENCES reponse (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX id_reponse ON user_reponse (id_reponse)');
        $this->addSql('CREATE INDEX id_user ON user_reponse (id_user)');
        $this->addSql('ALTER TABLE user CHANGE created_at created_at DATETIME DEFAULT CURRENT_TIMESTAMP, CHANGE updated_at updated_at DATETIME DEFAULT NULL, CHANGE is_active is_active TINYINT(1) DEFAULT 0, CHANGE is_admin is_admin TINYINT(1) DEFAULT 0, CHANGE is_verified is_verified TINYINT(1) DEFAULT NULL, CHANGE roles roles LONGTEXT DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX email ON user (email)');
        $this->addSql('ALTER TABLE categorie CHANGE name name VARCHAR(100) NOT NULL');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY FK_5FB6DEC76353B48');
        $this->addSql('DROP INDEX IDX_5FB6DEC76353B48 ON reponse');
        $this->addSql('ALTER TABLE reponse ADD id_question INT DEFAULT NULL, DROP id_question_id, CHANGE reponse reponse VARCHAR(255) DEFAULT NULL, CHANGE reponse_expected reponse_expected TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_B6F7494E9F34925F');
        $this->addSql('DROP INDEX IDX_B6F7494E9F34925F ON question');
        $this->addSql('ALTER TABLE question CHANGE question question VARCHAR(255) DEFAULT NULL, CHANGE id_categorie_id id_categorie INT DEFAULT NULL');
    }
}
