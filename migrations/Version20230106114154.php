<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230106114154 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE invites DROP FOREIGN KEY FK_37E6A6CA76ED395');
        $this->addSql('DROP TABLE invites');
        $this->addSql('ALTER TABLE invite CHANGE user_id user_id INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE invites (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, invitecode VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, doc DATE DEFAULT NULL, is_used INT DEFAULT NULL, confirmed TINYINT(1) DEFAULT NULL, INDEX IDX_37E6A6CA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE invites ADD CONSTRAINT FK_37E6A6CA76ED395 FOREIGN KEY (user_id) REFERENCES `admin` (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE invite CHANGE user_id user_id INT DEFAULT NULL');
    }
}
