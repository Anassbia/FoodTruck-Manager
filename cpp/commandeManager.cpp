#include "commandeManager.h"
#include <iostream>
#include <iomanip>
#include <ctime>
#include "Input.h"

CommandeManager::CommandeManager(GestionnaireBD* gbd, GestionnaireFichier* gf) {
    gestionnaireBD = gbd;
    gestionnaireFichier = gf;
    menuManager = new MenuManager(gbd, gf);
    commandeEnCours = new Commande();
    idCamionAuthentifie = 0;
}

CommandeManager::~CommandeManager() {
    if (commandeEnCours) {
        delete commandeEnCours;
    }
    if (menuManager) {
        delete menuManager;
    }
}

bool CommandeManager::saisirCommande(const Liste<ElementMenu*>& menus) {

    time_t now = time(0);
    tm ltm;
    localtime_s(&ltm, &now);
    char dateCommande[30];
    strftime(dateCommande, 30, "%Y-%m-%d", &ltm);
    const char* typePaiement = "cash";

    if (commandeEnCours) delete commandeEnCours;

    int nextId = gestionnaireBD->getNextOrderId();
    commandeEnCours = new Commande(nextId, dateCommande, typePaiement);

    char reponse = 'o';
    while (reponse == 'o' || reponse == 'O') {
        std::cout << "Afficher tous les menus (1) ou filtrer par catégorie (2) ? ";
        int choixMenu;
        if (!lireEntier(choixMenu)) return false;

        Liste<ElementMenu*> listeMenus;
        if (choixMenu == 1) {
            gestionnaireBD->recupererTousMenus(listeMenus);
        }
        else if (choixMenu == 2) {
            char categorie[50];
            std::cout << "Entrez la catégorie : ";
            std::cin.getline(categorie, 50);
            if (!std::cin) { std::cin.clear(); std::cin.ignore(10000, '\n'); return false; }
            gestionnaireBD->recupererMenusParCategorie(categorie, listeMenus);
        }
        else {
            std::cout << "Choix invalide.\n";
            continue;
        }

        ElementMenu::afficherEnteteTableau();
        Element<ElementMenu*>* courant = listeMenus.getTete();
        while (courant != nullptr) {
            courant->donnee->afficher();
            courant = courant->suivant;
        }
        std::cout << "---------------------------------------------------------------" << std::endl;

        int idMenu, quantite;
        std::cout << "ID Menu à ajouter : ";
        if (!lireEntier(idMenu)) { libererMenus(listeMenus); return false; }

        courant = listeMenus.getTete();
        ElementMenu* menuSelectionne = nullptr;
        while (courant != nullptr) {
            if (courant->donnee->getIdMenu() == idMenu) {
                menuSelectionne = courant->donnee;
                break;
            }
            courant = courant->suivant;
        }

        if (menuSelectionne == nullptr) {
            std::cout << "Menu non trouvé !" << std::endl;
            libererMenus(listeMenus);
            continue;
        }

        std::cout << "Quantité : ";
        if (!lireEntier(quantite)) { libererMenus(listeMenus); return false; }

        if (quantite <= 0) {
            std::cout << "La quantité doit être positive !" << std::endl;
            libererMenus(listeMenus);
            continue;
        }

        ElementCommande* elem = new ElementCommande(
            menuSelectionne->getIdMenu(),
            menuSelectionne->getNom(),
            quantite,
            menuSelectionne->getPrix()
        );
        commandeEnCours->getElements().insereFinListe(elem);
        libererMenus(listeMenus);

        std::cout << "Ajouter un autre élément ? (o/n) : ";
        if (!(std::cin >> reponse)) return false;
        std::cin.ignore(std::numeric_limits<std::streamsize>::max(), '\n');
    }
    afficherRecu();
    return commandeEnCours->getElements().getTete() != nullptr;
}

void CommandeManager::ajouterMenu(const Liste<ElementMenu*>& menus) {
    int idMenu;
    std::cout << "Entrez l'ID du menu à ajouter: ";
    std::cin >> idMenu;

    Element<ElementMenu*>* courant = menus.getTete();
    while (courant != nullptr) {
        if (courant->donnee->getIdMenu() == idMenu) {
            int quantite;
            std::cout << "Entrez la quantité: ";
            std::cin >> quantite;
    if (!std::cin || quantite <= 0) return;

            ElementCommande* element = new ElementCommande();
            element->setIdMenu(courant->donnee->getIdMenu());
            element->setNom(courant->donnee->getNom());
            element->setQuantite(quantite);
            element->setPrix(courant->donnee->getPrix());
            commandeEnCours->getElements().insereFinListe(element);
            std::cout << "Menu ajouté avec succès!\n";
            return;
        }
        courant = courant->suivant;
    }
    std::cout << "Menu non trouvé!\n";
}

void CommandeManager::afficherCommandeEnCours() {
    std::cout << "\n=== Commande en cours ===\n";
    const Liste<ElementCommande*>& elements = commandeEnCours->getElements();
    Element<ElementCommande*>* courant = elements.getTete();

    std::cout << std::left << std::setw(5) << "ID"
        << std::setw(30) << "Nom"
        << std::setw(10) << "Quantité"
        << std::setw(10) << "Prix" << "\n";
    std::cout << std::string(55, '-') << "\n";

    while (courant != nullptr) {
        std::cout << std::left << std::setw(5) << courant->donnee->getIdMenu()
            << std::setw(30) << courant->donnee->getNom()
            << std::setw(10) << courant->donnee->getQuantite()
            << std::setw(10) << courant->donnee->getPrix() << " €\n";
        courant = courant->suivant;
    }
    std::cout << std::string(55, '-') << "\n";
    std::cout << "Total: " << calculerTotal() << " €\n";
}

double CommandeManager::calculerTotal() {
    double total = 0.0;
    const Liste<ElementCommande*>& elements = commandeEnCours->getElements();
    Element<ElementCommande*>* courant = elements.getTete();
    while (courant != nullptr) {
        total += courant->donnee->getPrix() * courant->donnee->getQuantite();
        courant = courant->suivant;
    }
    return total;
}

void CommandeManager::afficherRecu() {
    std::cout << "\n=== Reçu ===\n";
    std::cout << "Date: " << commandeEnCours->getDateCommande() << "\n";
    if (idCamionAuthentifie > 0) {
        std::cout << "Camion ID: " << idCamionAuthentifie << "\n";
    }
    std::cout << std::string(55, '-') << "\n";

    const Liste<ElementCommande*>& elements = commandeEnCours->getElements();
    Element<ElementCommande*>* courant = elements.getTete();

    std::cout << std::left << std::setw(5) << "ID"
        << std::setw(30) << "Nom"
        << std::setw(10) << "Quantité"
        << std::setw(10) << "Prix" << "\n";
    std::cout << std::string(55, '-') << "\n";

    while (courant != nullptr) {
        std::cout << std::left << std::setw(5) << courant->donnee->getIdMenu()
            << std::setw(30) << courant->donnee->getNom()
            << std::setw(10) << courant->donnee->getQuantite()
            << std::setw(10) << courant->donnee->getPrix() << " €\n";
        courant = courant->suivant;
    }
    std::cout << std::string(55, '-') << "\n";
    std::cout << "Total: " << calculerTotal() << " €\n";
    std::cout << std::string(55, '-') << "\n";
    std::cout << "Merci de votre commande!\n";
}

Commande* CommandeManager::getCommandeEnCours() {
    return commandeEnCours;
}

void CommandeManager::setCamionAuthentifie(int idCamion) {
    idCamionAuthentifie = idCamion;
}

void CommandeManager::afficherMenus(const Liste<ElementMenu*>& menus) const {
    std::cout << "\n=== Liste des Menus ===\n";
    std::cout << std::left << std::setw(5) << "ID"
        << std::setw(30) << "Nom"
        << std::setw(15) << "Type"
        << std::setw(10) << "Prix" << "\n";
    std::cout << std::string(60, '-') << "\n";

    Element<ElementMenu*>* courant = menus.getTete();
    while (courant != nullptr) {
        std::cout << std::left << std::setw(5) << courant->donnee->getIdMenu()
            << std::setw(30) << courant->donnee->getNom()
            << std::setw(15) << courant->donnee->getType()
            << std::setw(10) << courant->donnee->getPrix() << " €\n";
        courant = courant->suivant;
    }
    std::cout << std::string(60, '-') << "\n";
}
