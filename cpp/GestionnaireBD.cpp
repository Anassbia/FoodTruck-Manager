#include "GestionnaireBD.h"
#include <cstring>
#include <iostream>
#include <cstdlib>

using namespace std;

GestionnaireBD::GestionnaireBD(const char* user, const char* mdp, const char* nom) {
    utilisateur = new char[50];
    motdepasse = new char[50];
    nomBD = new char[100];
    strncpy_s(utilisateur, 50, user, 49);
    strncpy_s(motdepasse, 50, mdp, 49);
    strncpy_s(nomBD, 100, nom, 99);
    connexion = nullptr;
}

GestionnaireBD::~GestionnaireBD() {
    deconnecter();
    delete[] utilisateur;
    delete[] motdepasse;
    delete[] nomBD;
}

bool GestionnaireBD::connecter() {
    deconnecter();
    try {
        sql::mysql::MySQL_Driver* driver = sql::mysql::get_mysql_driver_instance();
        char url[256] = {};
        size_t longueur = 0;
        getenv_s(&longueur, url, sizeof(url), "FOODTRUCK_DB_URL");
        connexion = driver->connect(*url ? url : "tcp://127.0.0.1:3306", utilisateur, motdepasse);
        connexion->setSchema(nomBD);
        return true;
    }
    catch (sql::SQLException& e) {
        deconnecter();
        cout << "Erreur de connexion à la base de données : " << e.what() << endl;
        return false;
    }
}

bool GestionnaireBD::recupererCamion(const char* matricule, Camion& camion) {
    if (!connexion) return false;
    try {
        sql::PreparedStatement* pstmt = connexion->prepareStatement("SELECT id_truck, matricule, password, localisation FROM trucks WHERE matricule = ?");
        pstmt->setString(1, matricule);
        sql::ResultSet* res = pstmt->executeQuery();
        if (res->next()) {
            camion.setIdCamion(res->getInt("id_truck"));
            camion.setMatricule(res->getString("matricule").c_str());
            camion.setMotdepasse(res->getString("password").c_str());
            camion.setLocalisation(res->getString("localisation").c_str());
            delete res;
            delete pstmt;
            return true;
        }
        else {
            delete res;
            delete pstmt;
            return false;
        }
    }
    catch (sql::SQLException& e) {
        cout << "Erreur lors de la récupération du camion : " << e.what() << endl;
        return false;
    }
}

void GestionnaireBD::deconnecter() {
    if (connexion) {
        delete connexion;
        connexion = nullptr;
    }
}

bool GestionnaireBD::recupererTousMenus(Liste<ElementMenu*>& listeMenus) {
    if (!connexion) return false;
    try {
        sql::Statement* stmt = connexion->createStatement();
        sql::ResultSet* res = stmt->executeQuery("SELECT id_menu, name, type, price FROM menus");
        while (res->next()) {
            int id = res->getInt("id_menu");
            std::string nomStr = res->getString("name");
            std::string typeStr = res->getString("type");
            float prix = static_cast<float>(res->getDouble("price"));
            ElementMenu* menu = new ElementMenu(id, nomStr.c_str(), typeStr.c_str(), prix);
            listeMenus.insereFinListe(menu);
        }
        delete res;
        delete stmt;
        return true;
    }
    catch (sql::SQLException& e) {
        cout << "Erreur lors de la récupération des menus : " << e.what() << endl;
        return false;
    }
}

bool GestionnaireBD::recupererMenusParCategorie(const char* categorie, Liste<ElementMenu*>& listeMenus) {
    if (!connexion) return false;
    try {
        sql::PreparedStatement* pstmt = connexion->prepareStatement("SELECT id_menu, name, type, price FROM menus WHERE type = ?");
        pstmt->setString(1, categorie);
        sql::ResultSet* res = pstmt->executeQuery();
        while (res->next()) {
            int id = res->getInt("id_menu");
            std::string nomStr = res->getString("name");
            std::string typeStr = res->getString("type");
            float prix = static_cast<float>(res->getDouble("price"));
            ElementMenu* menu = new ElementMenu(id, nomStr.c_str(), typeStr.c_str(), prix);
            listeMenus.insereFinListe(menu);
        }
        delete res;
        delete pstmt;
        return true;
    }
    catch (sql::SQLException& e) {
        cout << "Erreur lors de la récupération des menus par catégorie : " << e.what() << endl;
        return false;
    }
}

int GestionnaireBD::getNextOrderId() {
    if (!connexion) return 1;
    try {
        sql::Statement* stmt = connexion->createStatement();
        sql::ResultSet* res = stmt->executeQuery("SELECT MAX(id_NO) as max_id FROM normal_orders");
        int nextId = 1;
        if (res->next()) {
            nextId = res->getInt("max_id") + 1;
        }
        delete res;
        delete stmt;
        return nextId;
    }
    catch (sql::SQLException& e) {
        cout << "Erreur lors de la récupération du prochain ID de commande : " << e.what() << endl;
        return 1;
    }
}

bool GestionnaireBD::insererCommande(const Commande& commande, int idCamion) {
    if (!connexion || idCamion <= 0 || !commande.getElements().getTete()) return false;
    Element<ElementCommande*>* verifier = commande.getElements().getTete();
    while (verifier) {
        if (verifier->donnee->getQuantite() <= 0) return false;
        verifier = verifier->suivant;
    }
    sql::PreparedStatement* pstmt = nullptr;
    try {

        pstmt = connexion->prepareStatement(
            "INSERT INTO normal_orders (date_order, quantity, paiement_type, id_truck, id_menu) VALUES (?, ?, ?, ?, ?)"
        );
        Element<ElementCommande*>* courant = commande.getElements().getTete();
        while (courant != nullptr) {
            pstmt->setString(1, commande.getDateCommande());
            pstmt->setInt(2, courant->donnee->getQuantite());
            pstmt->setString(3, commande.getTypePaiement());
            pstmt->setInt(4, idCamion);
            pstmt->setInt(5, courant->donnee->getIdMenu());
            pstmt->execute();

            courant = courant->suivant;
        }
        delete pstmt;
        return true;
    }
    catch (sql::SQLException& e) {
        delete pstmt;
        cout << "Erreur lors de l'insertion de la commande : " << e.what() << endl;
        return false;
    }
}
