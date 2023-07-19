<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230719195655 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE order_item ADD beverage_id INT DEFAULT NULL, ADD size_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE order_item ADD CONSTRAINT FK_52EA1F0949F6E812 FOREIGN KEY (beverage_id) REFERENCES beverage (id)');
        $this->addSql('ALTER TABLE order_item ADD CONSTRAINT FK_52EA1F09498DA827 FOREIGN KEY (size_id) REFERENCES size (id)');
        $this->addSql('CREATE INDEX IDX_52EA1F0949F6E812 ON order_item (beverage_id)');
        $this->addSql('CREATE INDEX IDX_52EA1F09498DA827 ON order_item (size_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE order_item DROP FOREIGN KEY FK_52EA1F0949F6E812');
        $this->addSql('ALTER TABLE order_item DROP FOREIGN KEY FK_52EA1F09498DA827');
        $this->addSql('DROP INDEX IDX_52EA1F0949F6E812 ON order_item');
        $this->addSql('DROP INDEX IDX_52EA1F09498DA827 ON order_item');
        $this->addSql('ALTER TABLE order_item DROP beverage_id, DROP size_id');
    }
}
