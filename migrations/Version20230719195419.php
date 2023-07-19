<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230719195419 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE aroma DROP FOREIGN KEY FK_A2B09CE49F6E812');
        $this->addSql('DROP INDEX IDX_A2B09CE49F6E812 ON aroma');
        $this->addSql('ALTER TABLE aroma DROP beverage_id');
        $this->addSql('ALTER TABLE beverage ADD liquid_id INT DEFAULT NULL, ADD aroma_id INT DEFAULT NULL, ADD bubble_id INT DEFAULT NULL, CHANGE price price NUMERIC(4, 2) NOT NULL');
        $this->addSql('ALTER TABLE beverage ADD CONSTRAINT FK_3D8CACBB3B6CF329 FOREIGN KEY (liquid_id) REFERENCES liquid (id)');
        $this->addSql('ALTER TABLE beverage ADD CONSTRAINT FK_3D8CACBB800E3C79 FOREIGN KEY (aroma_id) REFERENCES aroma (id)');
        $this->addSql('ALTER TABLE beverage ADD CONSTRAINT FK_3D8CACBBE00350BA FOREIGN KEY (bubble_id) REFERENCES bubble (id)');
        $this->addSql('CREATE INDEX IDX_3D8CACBB3B6CF329 ON beverage (liquid_id)');
        $this->addSql('CREATE INDEX IDX_3D8CACBB800E3C79 ON beverage (aroma_id)');
        $this->addSql('CREATE INDEX IDX_3D8CACBBE00350BA ON beverage (bubble_id)');
        $this->addSql('ALTER TABLE beverage RENAME INDEX idx_3d8cacbbf05788e9 TO IDX_3D8CACBB61220EA6');
        $this->addSql('ALTER TABLE beverage_ingredient MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON beverage_ingredient');
        $this->addSql('ALTER TABLE beverage_ingredient ADD beverage_id INT NOT NULL, ADD ingredient_id INT NOT NULL, DROP id');
        $this->addSql('ALTER TABLE beverage_ingredient ADD CONSTRAINT FK_59832E6749F6E812 FOREIGN KEY (beverage_id) REFERENCES beverage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE beverage_ingredient ADD CONSTRAINT FK_59832E67933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredient (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_59832E6749F6E812 ON beverage_ingredient (beverage_id)');
        $this->addSql('CREATE INDEX IDX_59832E67933FE08C ON beverage_ingredient (ingredient_id)');
        $this->addSql('ALTER TABLE beverage_ingredient ADD PRIMARY KEY (beverage_id, ingredient_id)');
        $this->addSql('ALTER TABLE bubble DROP FOREIGN KEY FK_EB20F1F749F6E812');
        $this->addSql('DROP INDEX IDX_EB20F1F749F6E812 ON bubble');
        $this->addSql('ALTER TABLE bubble DROP beverage_id');
        $this->addSql('ALTER TABLE liquid DROP FOREIGN KEY FK_258F635349F6E812');
        $this->addSql('DROP INDEX IDX_258F635349F6E812 ON liquid');
        $this->addSql('ALTER TABLE liquid DROP beverage_id');
        $this->addSql('ALTER TABLE `order` RENAME INDEX idx_f5299398dc2902e0 TO IDX_F529939819EB6921');
        $this->addSql('ALTER TABLE order_item RENAME INDEX idx_52ea1f09fcdaeaaa TO IDX_52EA1F098D9F6D38');
        $this->addSql('ALTER TABLE user ADD roles JSON NOT NULL, CHANGE email email VARCHAR(180) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_8D93D649E7927C74 ON user');
        $this->addSql('ALTER TABLE user DROP roles, CHANGE email email VARCHAR(100) NOT NULL');
        $this->addSql('ALTER TABLE aroma ADD beverage_id INT NOT NULL');
        $this->addSql('ALTER TABLE aroma ADD CONSTRAINT FK_A2B09CE49F6E812 FOREIGN KEY (beverage_id) REFERENCES beverage (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_A2B09CE49F6E812 ON aroma (beverage_id)');
        $this->addSql('ALTER TABLE order_item RENAME INDEX idx_52ea1f098d9f6d38 TO IDX_52EA1F09FCDAEAAA');
        $this->addSql('ALTER TABLE beverage DROP FOREIGN KEY FK_3D8CACBB3B6CF329');
        $this->addSql('ALTER TABLE beverage DROP FOREIGN KEY FK_3D8CACBB800E3C79');
        $this->addSql('ALTER TABLE beverage DROP FOREIGN KEY FK_3D8CACBBE00350BA');
        $this->addSql('DROP INDEX IDX_3D8CACBB3B6CF329 ON beverage');
        $this->addSql('DROP INDEX IDX_3D8CACBB800E3C79 ON beverage');
        $this->addSql('DROP INDEX IDX_3D8CACBBE00350BA ON beverage');
        $this->addSql('ALTER TABLE beverage DROP liquid_id, DROP aroma_id, DROP bubble_id, CHANGE price price INT NOT NULL');
        $this->addSql('ALTER TABLE beverage RENAME INDEX idx_3d8cacbb61220ea6 TO IDX_3D8CACBBF05788E9');
        $this->addSql('ALTER TABLE `order` RENAME INDEX idx_f529939819eb6921 TO IDX_F5299398DC2902E0');
        $this->addSql('ALTER TABLE liquid ADD beverage_id INT NOT NULL');
        $this->addSql('ALTER TABLE liquid ADD CONSTRAINT FK_258F635349F6E812 FOREIGN KEY (beverage_id) REFERENCES beverage (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_258F635349F6E812 ON liquid (beverage_id)');
        $this->addSql('ALTER TABLE beverage_ingredient DROP FOREIGN KEY FK_59832E6749F6E812');
        $this->addSql('ALTER TABLE beverage_ingredient DROP FOREIGN KEY FK_59832E67933FE08C');
        $this->addSql('DROP INDEX IDX_59832E6749F6E812 ON beverage_ingredient');
        $this->addSql('DROP INDEX IDX_59832E67933FE08C ON beverage_ingredient');
        $this->addSql('ALTER TABLE beverage_ingredient ADD id INT AUTO_INCREMENT NOT NULL, DROP beverage_id, DROP ingredient_id, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE bubble ADD beverage_id INT NOT NULL');
        $this->addSql('ALTER TABLE bubble ADD CONSTRAINT FK_EB20F1F749F6E812 FOREIGN KEY (beverage_id) REFERENCES beverage (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_EB20F1F749F6E812 ON bubble (beverage_id)');
    }
}
