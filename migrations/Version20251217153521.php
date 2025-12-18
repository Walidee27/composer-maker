<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251217153521 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__order_item AS SELECT id, quantity, price, product_id FROM order_item');
        $this->addSql('DROP TABLE order_item');
        $this->addSql('CREATE TABLE order_item (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, quantity INTEGER NOT NULL, price DOUBLE PRECISION NOT NULL, product_id INTEGER NOT NULL, related_order_id INTEGER NOT NULL, CONSTRAINT FK_52EA1F094584665A FOREIGN KEY (product_id) REFERENCES product (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_52EA1F092B1C2395 FOREIGN KEY (related_order_id) REFERENCES "order" (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO order_item (id, quantity, price, product_id) SELECT id, quantity, price, product_id FROM __temp__order_item');
        $this->addSql('DROP TABLE __temp__order_item');
        $this->addSql('CREATE INDEX IDX_52EA1F094584665A ON order_item (product_id)');
        $this->addSql('CREATE INDEX IDX_52EA1F092B1C2395 ON order_item (related_order_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__order_item AS SELECT id, quantity, price, product_id FROM order_item');
        $this->addSql('DROP TABLE order_item');
        $this->addSql('CREATE TABLE order_item (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, quantity INTEGER NOT NULL, price DOUBLE PRECISION NOT NULL, product_id INTEGER NOT NULL, CONSTRAINT FK_52EA1F094584665A FOREIGN KEY (product_id) REFERENCES product (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO order_item (id, quantity, price, product_id) SELECT id, quantity, price, product_id FROM __temp__order_item');
        $this->addSql('DROP TABLE __temp__order_item');
        $this->addSql('CREATE INDEX IDX_52EA1F094584665A ON order_item (product_id)');
    }
}
