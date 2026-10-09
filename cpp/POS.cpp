#include "POS.h"
#include <iostream>
#include <cstring>
#include "Input.h"

using namespace std;

POS::POS() {
    gestionnaireBD = nullptr;
    gestionnaireFichier = nullptr;
    camionManager = nullptr;
    menuManager = nullptr;
    commandeManager = nullptr;
    camion = nullptr;
}

POS::POS(GestionnaireBD* gbd, GestionnaireFichier* gf, CamionManager* cm, MenuManager* mm, CommandeManager* comm) {
    gestionnaireBD = gbd;
    gestionnaireFichier = gf;
    camionManager = cm;
    menuManager = mm;
    commandeManager = comm;
    camion = new Camion();
}

POS::~POS() {
    if (camion) {
        delete camion;
    }
}

void POS::menuPrincipal() {
    int choix = 0;
    do {
        std::cout << "\n=== Menu Principal ===\n";
        std::cout << "1. Afficher tous les menus\n";
        std::cout << "2. Filtrer par catégorie\n";
        std::cout << "3. Nouvelle Commande\n";
        std::cout << "4. Quitter\n";
        std::cout << "Votre choix: ";
        if (!lireEntier(choix)) return;

        switch (choix) {
        case 1:
            afficherTousMenus();
            break;
        case 2:
            afficherMenusParCategorie();
            break;
        case 3:
            nouvelleCommande();
            break;
        case 4:
            std::cout << "Au revoir!\n";
            break;
        default:
            std::cout << "Choix invalide!\n";
        }
    } while (choix != 4);
}

void POS::afficherTousMenus() {
    Liste<ElementMenu*> menus;
    if (menuManager->chargerTousMenus(menus)) {
        std::cout << "\n=== Tous les menus ===\n";
        Element<ElementMenu*>* courant = menus.getTete();
        while (courant != nullptr) {
            std::cout << "ID: " << courant->donnee->getIdMenu()
                << " | Nom: " << courant->donnee->getNom()
                << " | Prix: " << courant->donnee->getPrix() << " €\n";
            courant = courant->suivant;
        }
    }
    else {
        std::cout << "Erreur lors du chargement des menus!\n";
    }
    libererMenus(menus);
}

void POS::afficherMenusParCategorie() {
    char categorie[50];
    std::cout << "Entrez la catégorie: ";
    std::cin.getline(categorie, 50);
    if (!std::cin) { std::cin.clear(); std::cin.ignore(10000, '\n'); return; }

    Liste<ElementMenu*> menus;
    if (menuManager->chargerMenusParCategorie(categorie, menus)) {
        std::cout << "\n=== Menus de la catégorie: " << categorie << " ===\n";
        Element<ElementMenu*>* courant = menus.getTete();
        while (courant != nullptr) {
            std::cout << "ID: " << courant->donnee->getIdMenu()
                << " | Nom: " << courant->donnee->getNom()
                << " | Prix: " << courant->donnee->getPrix() << " dh\n";
            courant = courant->suivant;
        }
    }
    else {
        std::cout << "Erreur lors du chargement des menus!\n";
    }
    libererMenus(menus);
}

void POS::authentifierCamion() {
    char matricule[50];
    char motdepasse[50];
    std::cout << "Entrez le matricule du camion: ";
    std::cin.getline(matricule, 50);
    if (!std::cin) { std::cin.clear(); std::cin.ignore(10000, '\n'); return; }
    std::cout << "Entrez le mot de passe: ";
    std::cin.getline(motdepasse, 50);
    if (!std::cin) { std::cin.clear(); std::cin.ignore(10000, '\n'); return; }

    Camion camionAuth;
    if (camionManager->authentifierCamion(matricule, motdepasse, camionAuth)) {
        if (camion) {
            delete camion;
        }
        camion = new Camion(camionAuth.getIdCamion(),
            camionAuth.getMatricule(),
            camionAuth.getMotdepasse(),
            camionAuth.getLocalisation());
        commandeManager->setCamionAuthentifie(camion->getIdCamion());
    }
}

void POS::nouvelleCommande() {
    if (!camion || camion->getIdCamion() == 0) {
        std::cout << "Veuillez vous authentifier d'abord!\n";
        authentifierCamion();
        if (!camion || camion->getIdCamion() == 0) {
            std::cout << "Authentification échouée. Impossible de créer une commande.\n";
            return;
        }
    }

    Liste<ElementMenu*> menus;
    if (menuManager->chargerTousMenus(menus)) {
        if (!commandeManager->saisirCommande(menus)) { libererMenus(menus); return; }
        if (gestionnaireBD->insererCommande(*commandeManager->getCommandeEnCours(), camion->getIdCamion())) {
            std::cout << "Commande enregistrée avec succès!\n";
        }
        else {
            std::cout << "Erreur lors de l'enregistrement de la commande!\n";
        }
    }
    else {
        std::cout << "Erreur lors du chargement des menus!\n";
    }
    libererMenus(menus);
}

void POS::synchroniserCommandes() {
    std::cout << "La synchronisation n'est pas disponible.\n";
}

void POS::setModeHorsLigne(bool mode) {
    if (gestionnaireFichier) gestionnaireFichier->setModeHorsLigne(mode);
}
