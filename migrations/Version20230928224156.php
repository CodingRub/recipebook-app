<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230928224156 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE aliment_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE event_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE ingredient_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE liste_course_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE note_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE preparation_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE recette_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE stock_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE tag_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE type_aliment_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE type_recette_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE aliment (id INT NOT NULL, type_id INT NOT NULL, liste_course_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, unite VARCHAR(10) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_70FF972BC54C8C93 ON aliment (type_id)');
        $this->addSql('CREATE INDEX IDX_70FF972B4680FCB ON aliment (liste_course_id)');
        $this->addSql('CREATE TABLE event (id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE ingredient (id INT NOT NULL, aliment_id INT NOT NULL, recette_id INT DEFAULT NULL, quantite INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_6BAF7870415B9F11 ON ingredient (aliment_id)');
        $this->addSql('CREATE INDEX IDX_6BAF787089312FE9 ON ingredient (recette_id)');
        $this->addSql('CREATE TABLE liste_course (id INT NOT NULL, quantite INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE note (id INT NOT NULL, recette_id INT DEFAULT NULL, note TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_CFBDFA1489312FE9 ON note (recette_id)');
        $this->addSql('CREATE TABLE preparation (id INT NOT NULL, recette_id INT DEFAULT NULL, description TEXT NOT NULL, time TIME(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_F9F0AAF489312FE9 ON preparation (recette_id)');
        $this->addSql('CREATE TABLE recette (id INT NOT NULL, type_id INT NOT NULL, name VARCHAR(255) NOT NULL, description TEXT NOT NULL, rate DOUBLE PRECISION NOT NULL, difficulte VARCHAR(15) NOT NULL, preparation_time VARCHAR(8) NOT NULL, cooking_time VARCHAR(8) NOT NULL, image_name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_49BB6390C54C8C93 ON recette (type_id)');
        $this->addSql('CREATE TABLE recette_tag (recette_id INT NOT NULL, tag_id INT NOT NULL, PRIMARY KEY(recette_id, tag_id))');
        $this->addSql('CREATE INDEX IDX_B102B4E389312FE9 ON recette_tag (recette_id)');
        $this->addSql('CREATE INDEX IDX_B102B4E3BAD26311 ON recette_tag (tag_id)');
        $this->addSql('CREATE TABLE stock (id INT NOT NULL, quantite INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE stock_aliment (stock_id INT NOT NULL, aliment_id INT NOT NULL, PRIMARY KEY(stock_id, aliment_id))');
        $this->addSql('CREATE INDEX IDX_69598788DCD6110 ON stock_aliment (stock_id)');
        $this->addSql('CREATE INDEX IDX_69598788415B9F11 ON stock_aliment (aliment_id)');
        $this->addSql('CREATE TABLE tag (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE type_aliment (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE type_recette (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('COMMENT ON COLUMN messenger_messages.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.available_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.delivered_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE OR REPLACE FUNCTION notify_messenger_messages() RETURNS TRIGGER AS $$
            BEGIN
                PERFORM pg_notify(\'messenger_messages\', NEW.queue_name::text);
                RETURN NEW;
            END;
        $$ LANGUAGE plpgsql;');
        $this->addSql('DROP TRIGGER IF EXISTS notify_trigger ON messenger_messages;');
        $this->addSql('CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON messenger_messages FOR EACH ROW EXECUTE PROCEDURE notify_messenger_messages();');
        $this->addSql('ALTER TABLE aliment ADD CONSTRAINT FK_70FF972BC54C8C93 FOREIGN KEY (type_id) REFERENCES type_aliment (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE aliment ADD CONSTRAINT FK_70FF972B4680FCB FOREIGN KEY (liste_course_id) REFERENCES liste_course (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE ingredient ADD CONSTRAINT FK_6BAF7870415B9F11 FOREIGN KEY (aliment_id) REFERENCES aliment (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE ingredient ADD CONSTRAINT FK_6BAF787089312FE9 FOREIGN KEY (recette_id) REFERENCES recette (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE note ADD CONSTRAINT FK_CFBDFA1489312FE9 FOREIGN KEY (recette_id) REFERENCES recette (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE preparation ADD CONSTRAINT FK_F9F0AAF489312FE9 FOREIGN KEY (recette_id) REFERENCES recette (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE recette ADD CONSTRAINT FK_49BB6390C54C8C93 FOREIGN KEY (type_id) REFERENCES type_recette (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE recette_tag ADD CONSTRAINT FK_B102B4E389312FE9 FOREIGN KEY (recette_id) REFERENCES recette (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE recette_tag ADD CONSTRAINT FK_B102B4E3BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE stock_aliment ADD CONSTRAINT FK_69598788DCD6110 FOREIGN KEY (stock_id) REFERENCES stock (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE stock_aliment ADD CONSTRAINT FK_69598788415B9F11 FOREIGN KEY (aliment_id) REFERENCES aliment (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE aliment_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE event_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE ingredient_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE liste_course_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE note_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE preparation_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE recette_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE stock_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE tag_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE type_aliment_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE type_recette_id_seq CASCADE');
        $this->addSql('ALTER TABLE aliment DROP CONSTRAINT FK_70FF972BC54C8C93');
        $this->addSql('ALTER TABLE aliment DROP CONSTRAINT FK_70FF972B4680FCB');
        $this->addSql('ALTER TABLE ingredient DROP CONSTRAINT FK_6BAF7870415B9F11');
        $this->addSql('ALTER TABLE ingredient DROP CONSTRAINT FK_6BAF787089312FE9');
        $this->addSql('ALTER TABLE note DROP CONSTRAINT FK_CFBDFA1489312FE9');
        $this->addSql('ALTER TABLE preparation DROP CONSTRAINT FK_F9F0AAF489312FE9');
        $this->addSql('ALTER TABLE recette DROP CONSTRAINT FK_49BB6390C54C8C93');
        $this->addSql('ALTER TABLE recette_tag DROP CONSTRAINT FK_B102B4E389312FE9');
        $this->addSql('ALTER TABLE recette_tag DROP CONSTRAINT FK_B102B4E3BAD26311');
        $this->addSql('ALTER TABLE stock_aliment DROP CONSTRAINT FK_69598788DCD6110');
        $this->addSql('ALTER TABLE stock_aliment DROP CONSTRAINT FK_69598788415B9F11');
        $this->addSql('DROP TABLE aliment');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE ingredient');
        $this->addSql('DROP TABLE liste_course');
        $this->addSql('DROP TABLE note');
        $this->addSql('DROP TABLE preparation');
        $this->addSql('DROP TABLE recette');
        $this->addSql('DROP TABLE recette_tag');
        $this->addSql('DROP TABLE stock');
        $this->addSql('DROP TABLE stock_aliment');
        $this->addSql('DROP TABLE tag');
        $this->addSql('DROP TABLE type_aliment');
        $this->addSql('DROP TABLE type_recette');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
