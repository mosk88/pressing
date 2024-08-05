<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240625114027 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE garment DROP FOREIGN KEY FK_B881175CA76ED395');
        $this->addSql('ALTER TABLE garment DROP FOREIGN KEY FK_B881175CCFFE9AD6');
        $this->addSql('DROP INDEX IDX_B881175CA76ED395 ON garment');
        $this->addSql('DROP INDEX IDX_B881175CCFFE9AD6 ON garment');
        $this->addSql('ALTER TABLE garment DROP user_id, DROP orders_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE garment ADD user_id INT DEFAULT NULL, ADD orders_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE garment ADD CONSTRAINT FK_B881175CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE garment ADD CONSTRAINT FK_B881175CCFFE9AD6 FOREIGN KEY (orders_id) REFERENCES `order` (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_B881175CA76ED395 ON garment (user_id)');
        $this->addSql('CREATE INDEX IDX_B881175CCFFE9AD6 ON garment (orders_id)');
    }
}
