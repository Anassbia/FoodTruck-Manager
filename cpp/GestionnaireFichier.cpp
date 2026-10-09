#include "GestionnaireFichier.h"
#include "GestionnaireBD.h"
#include <cstring>
#include <iostream>
#include <fstream>

GestionnaireFichier::GestionnaireFichier(GestionnaireBD* gbd, const char* nomFichier) {
    this->nomFichier = new char[strlen(nomFichier) + 1];
    strncpy_s(this->nomFichier, strlen(nomFichier) + 1, nomFichier, strlen(nomFichier));

    char* dirPath = new char[strlen(nomFichier) + 1];
    strncpy_s(dirPath, strlen(nomFichier) + 1, nomFichier, strlen(nomFichier));
    char* lastSlash = strrchr(dirPath, '/');
    char* lastBackslash = strrchr(dirPath, '\\');
    if (lastBackslash && (!lastSlash || lastBackslash > lastSlash)) lastSlash = lastBackslash;
    if (lastSlash) {
        *(lastSlash + 1) = '\0';
    }
    else {
        dirPath[0] = '\0';
    }

    this->nomFichierMenus = new char[strlen(dirPath) + strlen("menus_cache.txt") + 1];
    strncpy_s(this->nomFichierMenus, strlen(dirPath) + strlen("menus_cache.txt") + 1, dirPath, strlen(dirPath));
    strcat_s(this->nomFichierMenus, strlen(dirPath) + strlen("menus_cache.txt") + 1, "menus_cache.txt");
    delete[] dirPath;

    this->commandesEnAttente = new Liste<Commande*>();
    this->menusCache = new Liste<ElementMenu*>();
    this->modeHorsLigne = false;
    this->gestionnaireBD = gbd;

    std::ofstream fichier(nomFichier, std::ios::app);
    fichier.close();
    std::ofstream fichierMenus(nomFichierMenus, std::ios::app);
    fichierMenus.close();
}

GestionnaireFichier::~GestionnaireFichier() {
    delete[] nomFichier;
    delete[] nomFichierMenus;
    viderCommandesEnAttente();
    viderMenusCache();
    delete commandesEnAttente;
    delete menusCache;
}

bool GestionnaireFichier::estModeHorsLigne() const {
    return modeHorsLigne;
}

void GestionnaireFichier::setModeHorsLigne(bool mode) {
    modeHorsLigne = mode;
}

Liste<Commande*>* GestionnaireFichier::getCommandesEnAttente() const {
    return commandesEnAttente;
}

const char* GestionnaireFichier::getNomFichier() const {
    return nomFichier;
}

Liste<ElementMenu*>* GestionnaireFichier::getMenusCache() const {
    return menusCache;
}

bool GestionnaireFichier::sauvegarderCommande(const Commande& commande) {
    if (!modeHorsLigne) return false;

    std::ofstream fichier(nomFichier, std::ios::app);
    if (!fichier.is_open()) {
        std::cout << "Erreur: Impossible d'ouvrir le fichier pour sauvegarder la commande." << std::endl;
        return false;
    }

    fichier << "COMMANDE" << std::endl;
    fichier << commande.getIdCommande() << std::endl;
    fichier << commande.getDateCommande() << std::endl;
    fichier << commande.getTypePaiement() << std::endl;

    const Liste<ElementCommande*>& elements = commande.getElements();
    Element<ElementCommande*>* courant = elements.getTete();
    while (courant != nullptr) {
        fichier << "ELEMENT" << std::endl;
        fichier << courant->donnee->getIdMenu() << std::endl;
        fichier << courant->donnee->getNom() << std::endl;
        fichier << courant->donnee->getQuantite() << std::endl;
        fichier << courant->donnee->getPrix() << std::endl;
        courant = courant->suivant;
    }

    fichier << "FIN_COMMANDE" << std::endl;
    fichier.close();

    Commande* nouvelleCommande = new Commande(commande);
    commandesEnAttente->insereFinListe(nouvelleCommande);

    return true;
}

bool GestionnaireFichier::chargerCommandesEnAttente() {
    std::ifstream fichier(nomFichier);
    if (!fichier.is_open()) {
        std::cout << "Erreur: Impossible d'ouvrir le fichier des commandes en attente." << std::endl;
        return false;
    }

    viderCommandesEnAttente();
    char ligne[256];
    Commande* commandeCourante = nullptr;

    while (fichier.getline(ligne, 256)) {
        if (strcmp(ligne, "COMMANDE") == 0) {
            commandeCourante = new Commande();

            fichier.getline(ligne, 256);
            commandeCourante->setIdCommande(atoi(ligne));

            fichier.getline(ligne, 256);
            char* date = new char[strlen(ligne) + 1];
            strncpy_s(date, strlen(ligne) + 1, ligne, strlen(ligne));
            commandeCourante->setDateCommande(date);
            delete[] date;

            fichier.getline(ligne, 256);
            char* paiement = new char[strlen(ligne) + 1];
            strncpy_s(paiement, strlen(ligne) + 1, ligne, strlen(ligne));
            commandeCourante->setTypePaiement(paiement);
            delete[] paiement;
        }
        else if (strcmp(ligne, "ELEMENT") == 0 && commandeCourante) {
            ElementCommande* element = new ElementCommande();

            fichier.getline(ligne, 256);
            element->setIdMenu(atoi(ligne));

            fichier.getline(ligne, 256);
            char* nom = new char[strlen(ligne) + 1];
            strncpy_s(nom, strlen(ligne) + 1, ligne, strlen(ligne));
            element->setNom(nom);
            delete[] nom;

            fichier.getline(ligne, 256);
            element->setQuantite(atoi(ligne));

            fichier.getline(ligne, 256);
            element->setPrix(static_cast<float>(atof(ligne)));

            commandeCourante->getElements().insereFinListe(element);
        }
        else if (strcmp(ligne, "FIN_COMMANDE") == 0 && commandeCourante) {
            commandesEnAttente->insereFinListe(commandeCourante);
            commandeCourante = nullptr;
        }
    }

    fichier.close();
    return true;
}

bool GestionnaireFichier::synchroniserCommandes() {
    if (modeHorsLigne) return false;

    bool succes = true;

    Element<Commande*>* courant = commandesEnAttente->getTete();
    while (courant != nullptr) {
        if (!gestionnaireBD->insererCommande(*courant->donnee, 0)) {
            std::cout << "Erreur lors de la synchronisation de la commande " << courant->donnee->getIdCommande() << std::endl;
            succes = false;
        }
        courant = courant->suivant;
    }

    if (succes) {
        viderCommandesEnAttente();
        std::ofstream fichier(nomFichier, std::ios::trunc);
        fichier.close();
    }

    return succes;
}

void GestionnaireFichier::viderCommandesEnAttente() {
    Element<Commande*>* courant = commandesEnAttente->getTete();
    while (courant != nullptr) {
        Element<Commande*>* temp = courant;
        courant = courant->suivant;
        delete temp->donnee;
    }
    delete commandesEnAttente;
    commandesEnAttente = new Liste<Commande*>();
}

void GestionnaireFichier::setNomFichier(const char* nouveauNom) {
    delete[] nomFichier;
    nomFichier = new char[strlen(nouveauNom) + 1];
    strncpy_s(nomFichier, strlen(nouveauNom) + 1, nouveauNom, strlen(nouveauNom));

    std::ofstream fichier(nomFichier, std::ios::app);
    fichier.close();
}

bool GestionnaireFichier::sauvegarderMenus(const Liste<ElementMenu*>& menus) {
    std::ofstream fichier(nomFichierMenus, std::ios::trunc);
    if (!fichier.is_open()) {
        std::cout << "Erreur: Impossible d'ouvrir le fichier pour sauvegarder les menus." << std::endl;
        return false;
    }

    Element<ElementMenu*>* courant = menus.getTete();
    while (courant != nullptr) {
        fichier << "MENU" << std::endl;
        fichier << courant->donnee->getIdMenu() << std::endl;
        fichier << courant->donnee->getNom() << std::endl;
        fichier << courant->donnee->getType() << std::endl;
        fichier << courant->donnee->getPrix() << std::endl;
        courant = courant->suivant;
    }

    fichier.close();

    viderMenusCache();
    courant = menus.getTete();
    while (courant != nullptr) {
        ElementMenu* menu = new ElementMenu(
            courant->donnee->getIdMenu(),
            courant->donnee->getNom(),
            courant->donnee->getType(),
            courant->donnee->getPrix()
        );
        menusCache->insereFinListe(menu);
        courant = courant->suivant;
    }

    return true;
}

bool GestionnaireFichier::chargerMenusCache() {
    std::ifstream fichier(nomFichierMenus);
    if (!fichier.is_open()) {
        std::cout << "Erreur: Impossible d'ouvrir le fichier des menus en cache." << std::endl;
        return false;
    }

    viderMenusCache();
    char ligne[256];
    ElementMenu* menuCourant = nullptr;

    while (fichier.getline(ligne, 256)) {
        if (strcmp(ligne, "MENU") == 0) {
            menuCourant = new ElementMenu();

            fichier.getline(ligne, 256);
            menuCourant->setIdMenu(atoi(ligne));

            fichier.getline(ligne, 256);
            char* nom = new char[strlen(ligne) + 1];
            strncpy_s(nom, strlen(ligne) + 1, ligne, strlen(ligne));
            menuCourant->setNom(nom);
            delete[] nom;

            fichier.getline(ligne, 256);
            char* type = new char[strlen(ligne) + 1];
            strncpy_s(type, strlen(ligne) + 1, ligne, strlen(ligne));
            menuCourant->setType(type);
            delete[] type;

            fichier.getline(ligne, 256);
            menuCourant->setPrix(static_cast<float>(atof(ligne)));

            menusCache->insereFinListe(menuCourant);
            menuCourant = nullptr;
        }
    }

    fichier.close();
    return true;
}

void GestionnaireFichier::viderMenusCache() {
    Element<ElementMenu*>* courant = menusCache->getTete();
    while (courant != nullptr) {
        Element<ElementMenu*>* temp = courant;
        courant = courant->suivant;
        delete temp->donnee;
    }
    delete menusCache;
    menusCache = new Liste<ElementMenu*>();
}
