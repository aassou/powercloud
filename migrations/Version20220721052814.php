<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220721052814 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `order` (id INT AUTO_INCREMENT NOT NULL, customer_title VARCHAR(10) NOT NULL, customer_first_name VARCHAR(255) NOT NULL, customer_last_name VARCHAR(255) NOT NULL, customer_email VARCHAR(255) NOT NULL, campaign_title VARCHAR(255) NOT NULL, campaign_summary VARCHAR(255) NOT NULL, campaign_start_date DATE NOT NULL, campaign_end_date VARCHAR(255) NOT NULL, campaign_product_limit INT NOT NULL, campaign_special TINYINT(1) NOT NULL, products LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', delivery_start_date DATE NOT NULL, delivery_end_date DATE NOT NULL, permanent_order TINYINT(1) NOT NULL, created DATETIME NOT NULL, created_by VARCHAR(255) NOT NULL, updated DATETIME DEFAULT NULL, updated_by VARCHAR(255) DEFAULT NULL, is_published TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, checkin DATE NOT NULL, checkout DATE NOT NULL, guest_number INT NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, billing_address LONGTEXT NOT NULL, billing_country VARCHAR(255) NOT NULL, postal_code VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, created DATETIME NOT NULL, created_by VARCHAR(255) NOT NULL, updated DATETIME DEFAULT NULL, updated_by VARCHAR(255) DEFAULT NULL, is_published TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE `order`');
        $this->addSql('DROP TABLE reservation');
    }
}
