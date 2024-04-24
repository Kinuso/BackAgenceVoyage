<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240424141448 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE av_trip_av_category (av_trip_id INT NOT NULL, av_category_id INT NOT NULL, INDEX IDX_FA729D81EAC0AD7D (av_trip_id), INDEX IDX_FA729D81ED565DB2 (av_category_id), PRIMARY KEY(av_trip_id, av_category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE av_trip_av_country (av_trip_id INT NOT NULL, av_country_id INT NOT NULL, INDEX IDX_D47FF53DEAC0AD7D (av_trip_id), INDEX IDX_D47FF53DE6851EA9 (av_country_id), PRIMARY KEY(av_trip_id, av_country_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE av_trip_av_category ADD CONSTRAINT FK_FA729D81EAC0AD7D FOREIGN KEY (av_trip_id) REFERENCES av_trip (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE av_trip_av_category ADD CONSTRAINT FK_FA729D81ED565DB2 FOREIGN KEY (av_category_id) REFERENCES av_category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE av_trip_av_country ADD CONSTRAINT FK_D47FF53DEAC0AD7D FOREIGN KEY (av_trip_id) REFERENCES av_trip (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE av_trip_av_country ADD CONSTRAINT FK_D47FF53DE6851EA9 FOREIGN KEY (av_country_id) REFERENCES av_country (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE av_reservation ADD trip_id_id INT NOT NULL, ADD av_status_id INT NOT NULL');
        $this->addSql('ALTER TABLE av_reservation ADD CONSTRAINT FK_BDD88905A50F1E14 FOREIGN KEY (trip_id_id) REFERENCES av_trip (id)');
        $this->addSql('ALTER TABLE av_reservation ADD CONSTRAINT FK_BDD889051B54B76E FOREIGN KEY (av_status_id) REFERENCES av_status (id)');
        $this->addSql('CREATE INDEX IDX_BDD88905A50F1E14 ON av_reservation (trip_id_id)');
        $this->addSql('CREATE INDEX IDX_BDD889051B54B76E ON av_reservation (av_status_id)');
        $this->addSql('ALTER TABLE av_trip ADD av_user_id INT NOT NULL');
        $this->addSql('ALTER TABLE av_trip ADD CONSTRAINT FK_808704CEE81250E6 FOREIGN KEY (av_user_id) REFERENCES av_user (id)');
        $this->addSql('CREATE INDEX IDX_808704CEE81250E6 ON av_trip (av_user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE av_trip_av_category DROP FOREIGN KEY FK_FA729D81EAC0AD7D');
        $this->addSql('ALTER TABLE av_trip_av_category DROP FOREIGN KEY FK_FA729D81ED565DB2');
        $this->addSql('ALTER TABLE av_trip_av_country DROP FOREIGN KEY FK_D47FF53DEAC0AD7D');
        $this->addSql('ALTER TABLE av_trip_av_country DROP FOREIGN KEY FK_D47FF53DE6851EA9');
        $this->addSql('DROP TABLE av_trip_av_category');
        $this->addSql('DROP TABLE av_trip_av_country');
        $this->addSql('ALTER TABLE av_reservation DROP FOREIGN KEY FK_BDD88905A50F1E14');
        $this->addSql('ALTER TABLE av_reservation DROP FOREIGN KEY FK_BDD889051B54B76E');
        $this->addSql('DROP INDEX IDX_BDD88905A50F1E14 ON av_reservation');
        $this->addSql('DROP INDEX IDX_BDD889051B54B76E ON av_reservation');
        $this->addSql('ALTER TABLE av_reservation DROP trip_id_id, DROP av_status_id');
        $this->addSql('ALTER TABLE av_trip DROP FOREIGN KEY FK_808704CEE81250E6');
        $this->addSql('DROP INDEX IDX_808704CEE81250E6 ON av_trip');
        $this->addSql('ALTER TABLE av_trip DROP av_user_id');
    }
}
