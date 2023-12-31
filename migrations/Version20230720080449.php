<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230720080449 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` CHANGE client_id client_id INT NOT NULL');
        $this->addSql('ALTER TABLE order_item CHANGE order_id order_id INT NOT NULL');
        $this->addSql('ALTER TABLE user ADD enabled TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP enabled');
        $this->addSql('ALTER TABLE order_item CHANGE order_id order_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE `order` CHANGE client_id client_id INT DEFAULT NULL');
    }
}
