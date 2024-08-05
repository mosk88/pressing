<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240625091445 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE garment_service (garment_id INT NOT NULL, service_id INT NOT NULL, INDEX IDX_C07EBBCE9CDB257C (garment_id), INDEX IDX_C07EBBCEED5CA9E6 (service_id), PRIMARY KEY(garment_id, service_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE garment_service ADD CONSTRAINT FK_C07EBBCE9CDB257C FOREIGN KEY (garment_id) REFERENCES garment (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE garment_service ADD CONSTRAINT FK_C07EBBCEED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE garment ADD user_id INT DEFAULT NULL, ADD orders_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE garment ADD CONSTRAINT FK_B881175CA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE garment ADD CONSTRAINT FK_B881175CCFFE9AD6 FOREIGN KEY (orders_id) REFERENCES `order` (id)');
        $this->addSql('CREATE INDEX IDX_B881175CA76ED395 ON garment (user_id)');
        $this->addSql('CREATE INDEX IDX_B881175CCFFE9AD6 ON garment (orders_id)');
        $this->addSql('ALTER TABLE `order` ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_F5299398A76ED395 ON `order` (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE garment_service DROP FOREIGN KEY FK_C07EBBCE9CDB257C');
        $this->addSql('ALTER TABLE garment_service DROP FOREIGN KEY FK_C07EBBCEED5CA9E6');
        $this->addSql('DROP TABLE garment_service');
        $this->addSql('ALTER TABLE garment DROP FOREIGN KEY FK_B881175CA76ED395');
        $this->addSql('ALTER TABLE garment DROP FOREIGN KEY FK_B881175CCFFE9AD6');
        $this->addSql('DROP INDEX IDX_B881175CA76ED395 ON garment');
        $this->addSql('DROP INDEX IDX_B881175CCFFE9AD6 ON garment');
        $this->addSql('ALTER TABLE garment DROP user_id, DROP orders_id');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398A76ED395');
        $this->addSql('DROP INDEX IDX_F5299398A76ED395 ON `order`');
        $this->addSql('ALTER TABLE `order` DROP user_id');
    }
}
