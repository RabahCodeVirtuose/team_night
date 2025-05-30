<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250530103245 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE adresse (id SERIAL NOT NULL, utilisateur_id INT DEFAULT NULL, rue VARCHAR(255) NOT NULL, ville VARCHAR(255) NOT NULL, code_postal VARCHAR(255) NOT NULL, pays VARCHAR(255) NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_C35F0816FB88E14F ON adresse (utilisateur_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE code_promo (id SERIAL NOT NULL, code VARCHAR(255) NOT NULL, reduction_pourcentage DOUBLE PRECISION NOT NULL, date_expiration TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, utilisation_max INT NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE collaborateur (id SERIAL NOT NULL, utilisateur_id INT DEFAULT NULL, description TEXT NOT NULL, is_disponible BOOLEAN NOT NULL, note_globale DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_770CBCD3FB88E14F ON collaborateur (utilisateur_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE commentaire (id SERIAL NOT NULL, utilisateur_id INT DEFAULT NULL, publication_id INT DEFAULT NULL, contenu TEXT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, is_visible BOOLEAN NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_67F068BCFB88E14F ON commentaire (utilisateur_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_67F068BC38B217A7 ON commentaire (publication_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE devis (id SERIAL NOT NULL, panier_id INT DEFAULT NULL, date_creation TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, montant_total DOUBLE PRECISION NOT NULL, fichier_pdf VARCHAR(255) NOT NULL, statut VARCHAR(255) NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_8B27C52BF77D927C ON devis (panier_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE event (id SERIAL NOT NULL, titre VARCHAR(255) NOT NULL, description TEXT NOT NULL, categorie VARCHAR(255) NOT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, lieu VARCHAR(255) NOT NULL, nb_invites INT NOT NULL, prix_base DOUBLE PRECISION NOT NULL, is_disponible BOOLEAN NOT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE facture (id SERIAL NOT NULL, paiement_id INT DEFAULT NULL, utilisateur_id INT DEFAULT NULL, numero VARCHAR(255) NOT NULL, date_emission TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, montant_total DOUBLE PRECISION NOT NULL, fichier_pdf VARCHAR(255) NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_FE8664102A4C4478 ON facture (paiement_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_FE866410FB88E14F ON facture (utilisateur_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE fidelite (id SERIAL NOT NULL, utilisateur_id INT DEFAULT NULL, points INT NOT NULL, niveau VARCHAR(255) NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_EF425B23FB88E14F ON fidelite (utilisateur_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE media (id SERIAL NOT NULL, event_id INT DEFAULT NULL, publication_id INT DEFAULT NULL, service_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, fichier VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, ordre INT NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_6A2CA10C71F7E88B ON media (event_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_6A2CA10C38B217A7 ON media (publication_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_6A2CA10CED5CA9E6 ON media (service_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE notification (id SERIAL NOT NULL, utilisateur_id INT DEFAULT NULL, type public."notification_type" NOT NULL, message VARCHAR(255) NOT NULL, is_read BOOLEAN NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, target_url VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_BF5476CAFB88E14F ON notification (utilisateur_id)
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN notification.type IS '(DC2Type:notification_type)'
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE pack (id SERIAL NOT NULL, nom VARCHAR(255) NOT NULL, description TEXT NOT NULL, prix DOUBLE PRECISION NOT NULL, is_disponible BOOLEAN NOT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE pack_reservation (pack_id INT NOT NULL, reservation_id INT NOT NULL, PRIMARY KEY(pack_id, reservation_id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_B63E948C1919B217 ON pack_reservation (pack_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_B63E948CB83297E7 ON pack_reservation (reservation_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE paiement (id SERIAL NOT NULL, paiement_option_id INT DEFAULT NULL, panier_id INT DEFAULT NULL, montant DOUBLE PRECISION NOT NULL, methode VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, date_paiement TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_B1DC7A1E61026325 ON paiement (paiement_option_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_B1DC7A1EF77D927C ON paiement (panier_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE paiement_option (id SERIAL NOT NULL, nom VARCHAR(255) NOT NULL, description TEXT NOT NULL, is_disponible BOOLEAN NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE panier (id SERIAL NOT NULL, code_promo_id INT DEFAULT NULL, date_creation TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, statut VARCHAR(255) NOT NULL, total_estime DOUBLE PRECISION NOT NULL, montant_restant_apayer DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_24CC0DF2294102D4 ON panier (code_promo_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE publication (id SERIAL NOT NULL, utilisateur_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, contenu TEXT NOT NULL, categorie VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, is_published BOOLEAN NOT NULL, is_apporved BOOLEAN NOT NULL, is_souvenir BOOLEAN NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_AF3C6779FB88E14F ON publication (utilisateur_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE publication_event (publication_id INT NOT NULL, event_id INT NOT NULL, PRIMARY KEY(publication_id, event_id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_DE704C2B38B217A7 ON publication_event (publication_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_DE704C2B71F7E88B ON publication_event (event_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE reaction (id SERIAL NOT NULL, utilisateur_id INT DEFAULT NULL, publication_id INT DEFAULT NULL, type public."reaction_type" NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_A4D707F7FB88E14F ON reaction (utilisateur_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_A4D707F738B217A7 ON reaction (publication_id)
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN reaction.type IS '(DC2Type:reaction_type)'
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE reservation (id SERIAL NOT NULL, utilisateur_id INT DEFAULT NULL, panier_id INT DEFAULT NULL, date_reservation TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, commentaire TEXT NOT NULL, status VARCHAR(255) NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_42C84955FB88E14F ON reservation (utilisateur_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_42C84955F77D927C ON reservation (panier_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE service (id SERIAL NOT NULL, collaborateur_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, description TEXT NOT NULL, categorie VARCHAR(255) NOT NULL, prix_base DOUBLE PRECISION NOT NULL, is_actif BOOLEAN NOT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_E19D9AD2A848E3B1 ON service (collaborateur_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE service_reservation (service_id INT NOT NULL, reservation_id INT NOT NULL, PRIMARY KEY(service_id, reservation_id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_8E526FF9ED5CA9E6 ON service_reservation (service_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_8E526FF9B83297E7 ON service_reservation (reservation_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE service_pack (service_id INT NOT NULL, pack_id INT NOT NULL, PRIMARY KEY(service_id, pack_id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_599DEACFED5CA9E6 ON service_pack (service_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_599DEACF1919B217 ON service_pack (pack_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE users (id SERIAL NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, roles JSON NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, is_verified BOOLEAN NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE adresse ADD CONSTRAINT FK_C35F0816FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE collaborateur ADD CONSTRAINT FK_770CBCD3FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC38B217A7 FOREIGN KEY (publication_id) REFERENCES publication (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE devis ADD CONSTRAINT FK_8B27C52BF77D927C FOREIGN KEY (panier_id) REFERENCES panier (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE facture ADD CONSTRAINT FK_FE8664102A4C4478 FOREIGN KEY (paiement_id) REFERENCES paiement (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE facture ADD CONSTRAINT FK_FE866410FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE fidelite ADD CONSTRAINT FK_EF425B23FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE media ADD CONSTRAINT FK_6A2CA10C71F7E88B FOREIGN KEY (event_id) REFERENCES event (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE media ADD CONSTRAINT FK_6A2CA10C38B217A7 FOREIGN KEY (publication_id) REFERENCES publication (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE media ADD CONSTRAINT FK_6A2CA10CED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE notification ADD CONSTRAINT FK_BF5476CAFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE pack_reservation ADD CONSTRAINT FK_B63E948C1919B217 FOREIGN KEY (pack_id) REFERENCES pack (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE pack_reservation ADD CONSTRAINT FK_B63E948CB83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE paiement ADD CONSTRAINT FK_B1DC7A1E61026325 FOREIGN KEY (paiement_option_id) REFERENCES paiement_option (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE paiement ADD CONSTRAINT FK_B1DC7A1EF77D927C FOREIGN KEY (panier_id) REFERENCES panier (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE panier ADD CONSTRAINT FK_24CC0DF2294102D4 FOREIGN KEY (code_promo_id) REFERENCES code_promo (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE publication ADD CONSTRAINT FK_AF3C6779FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE publication_event ADD CONSTRAINT FK_DE704C2B38B217A7 FOREIGN KEY (publication_id) REFERENCES publication (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE publication_event ADD CONSTRAINT FK_DE704C2B71F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reaction ADD CONSTRAINT FK_A4D707F7FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reaction ADD CONSTRAINT FK_A4D707F738B217A7 FOREIGN KEY (publication_id) REFERENCES publication (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation ADD CONSTRAINT FK_42C84955FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation ADD CONSTRAINT FK_42C84955F77D927C FOREIGN KEY (panier_id) REFERENCES panier (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE service ADD CONSTRAINT FK_E19D9AD2A848E3B1 FOREIGN KEY (collaborateur_id) REFERENCES collaborateur (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE service_reservation ADD CONSTRAINT FK_8E526FF9ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE service_reservation ADD CONSTRAINT FK_8E526FF9B83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE service_pack ADD CONSTRAINT FK_599DEACFED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE service_pack ADD CONSTRAINT FK_599DEACF1919B217 FOREIGN KEY (pack_id) REFERENCES pack (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE SCHEMA public
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE adresse DROP CONSTRAINT FK_C35F0816FB88E14F
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE collaborateur DROP CONSTRAINT FK_770CBCD3FB88E14F
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE commentaire DROP CONSTRAINT FK_67F068BCFB88E14F
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE commentaire DROP CONSTRAINT FK_67F068BC38B217A7
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE devis DROP CONSTRAINT FK_8B27C52BF77D927C
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE facture DROP CONSTRAINT FK_FE8664102A4C4478
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE facture DROP CONSTRAINT FK_FE866410FB88E14F
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE fidelite DROP CONSTRAINT FK_EF425B23FB88E14F
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE media DROP CONSTRAINT FK_6A2CA10C71F7E88B
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE media DROP CONSTRAINT FK_6A2CA10C38B217A7
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE media DROP CONSTRAINT FK_6A2CA10CED5CA9E6
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE notification DROP CONSTRAINT FK_BF5476CAFB88E14F
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE pack_reservation DROP CONSTRAINT FK_B63E948C1919B217
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE pack_reservation DROP CONSTRAINT FK_B63E948CB83297E7
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE paiement DROP CONSTRAINT FK_B1DC7A1E61026325
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE paiement DROP CONSTRAINT FK_B1DC7A1EF77D927C
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE panier DROP CONSTRAINT FK_24CC0DF2294102D4
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE publication DROP CONSTRAINT FK_AF3C6779FB88E14F
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE publication_event DROP CONSTRAINT FK_DE704C2B38B217A7
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE publication_event DROP CONSTRAINT FK_DE704C2B71F7E88B
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reaction DROP CONSTRAINT FK_A4D707F7FB88E14F
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reaction DROP CONSTRAINT FK_A4D707F738B217A7
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation DROP CONSTRAINT FK_42C84955FB88E14F
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation DROP CONSTRAINT FK_42C84955F77D927C
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE service DROP CONSTRAINT FK_E19D9AD2A848E3B1
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE service_reservation DROP CONSTRAINT FK_8E526FF9ED5CA9E6
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE service_reservation DROP CONSTRAINT FK_8E526FF9B83297E7
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE service_pack DROP CONSTRAINT FK_599DEACFED5CA9E6
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE service_pack DROP CONSTRAINT FK_599DEACF1919B217
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE adresse
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE code_promo
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE collaborateur
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE commentaire
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE devis
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE event
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE facture
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE fidelite
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE media
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE notification
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE pack
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE pack_reservation
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE paiement
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE paiement_option
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE panier
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE publication
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE publication_event
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE reaction
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE reservation
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE service
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE service_reservation
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE service_pack
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE users
        SQL);
    }
}
