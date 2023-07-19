<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230719100432 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE beverage_ingredient (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `order` (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, number INT NOT NULL, date DATETIME NOT NULL, is_selling TINYINT(1) NOT NULL, INDEX IDX_F5299398DC2902E0 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_item (id INT AUTO_INCREMENT NOT NULL, order_id INT NOT NULL, INDEX IDX_52EA1F09FCDAEAAA (order_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE size (id INT AUTO_INCREMENT NOT NULL, volume INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(100) NOT NULL, email VARCHAR(100) NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398DC2902E0 FOREIGN KEY (client_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE order_item ADD CONSTRAINT FK_52EA1F09FCDAEAAA FOREIGN KEY (order_id) REFERENCES `order` (id)');
        $this->addSql('ALTER TABLE aroma ADD beverage_id INT NOT NULL');
        $this->addSql('ALTER TABLE aroma ADD CONSTRAINT FK_A2B09CE49F6E812 FOREIGN KEY (beverage_id) REFERENCES beverage (id)');
        $this->addSql('CREATE INDEX IDX_A2B09CE49F6E812 ON aroma (beverage_id)');
        $this->addSql('ALTER TABLE beverage ADD creator_id INT NOT NULL');
        $this->addSql('ALTER TABLE beverage ADD CONSTRAINT FK_3D8CACBBF05788E9 FOREIGN KEY (creator_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_3D8CACBBF05788E9 ON beverage (creator_id)');
        $this->addSql('ALTER TABLE bubble ADD beverage_id INT NOT NULL');
        $this->addSql('ALTER TABLE bubble ADD CONSTRAINT FK_EB20F1F749F6E812 FOREIGN KEY (beverage_id) REFERENCES beverage (id)');
        $this->addSql('CREATE INDEX IDX_EB20F1F749F6E812 ON bubble (beverage_id)');
        $this->addSql('ALTER TABLE liquid ADD beverage_id INT NOT NULL');
        $this->addSql('ALTER TABLE liquid ADD CONSTRAINT FK_258F635349F6E812 FOREIGN KEY (beverage_id) REFERENCES beverage (id)');
        $this->addSql('CREATE INDEX IDX_258F635349F6E812 ON liquid (beverage_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE beverage DROP FOREIGN KEY FK_3D8CACBBE415FB15');
        $this->addSql('ALTER TABLE beverage DROP FOREIGN KEY FK_3D8CACBBF05788E9');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398DC2902E0');
        $this->addSql('ALTER TABLE order_item DROP FOREIGN KEY FK_52EA1F09FCDAEAAA');
        $this->addSql('ALTER TABLE size DROP FOREIGN KEY FK_F7C0246AE415FB15');
        $this->addSql('DROP TABLE beverage_ingredient');
        $this->addSql('DROP TABLE `order`');
        $this->addSql('DROP TABLE order_item');
        $this->addSql('DROP TABLE size');
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE aroma DROP FOREIGN KEY FK_A2B09CE49F6E812');
        $this->addSql('DROP INDEX IDX_A2B09CE49F6E812 ON aroma');
        $this->addSql('ALTER TABLE aroma DROP beverage_id');
        $this->addSql('DROP INDEX IDX_3D8CACBBF05788E9 ON beverage');
        $this->addSql('DROP INDEX IDX_3D8CACBBE415FB15 ON beverage');
        $this->addSql('ALTER TABLE bubble DROP FOREIGN KEY FK_EB20F1F749F6E812');
        $this->addSql('DROP INDEX IDX_EB20F1F749F6E812 ON bubble');
        $this->addSql('ALTER TABLE bubble DROP beverage_id');
        $this->addSql('ALTER TABLE liquid DROP FOREIGN KEY FK_258F635349F6E812');
        $this->addSql('DROP INDEX IDX_258F635349F6E812 ON liquid');
        $this->addSql('ALTER TABLE liquid DROP beverage_id');
    }
}
