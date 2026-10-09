#include "MenuManager.h"
#include <iostream>
#include <iomanip>
#include <cstring>

void libererMenus(Liste<ElementMenu*>& menus) {
    while (menus.getTete()) {
        delete menus.getTete()->donnee;
        menus.supprimeDebut();
    }
}

static bool lireCache(GestionnaireFichier* fichiers, Liste<ElementMenu*>& menus, const char* categorie) {
    if (!fichiers->chargerMenusCache()) return false;
    Element<ElementMenu*>* courant = fichiers->getMenusCache()->getTete();
    while (courant) {
        ElementMenu* menu = courant->donnee;
        if (!categorie || std::strcmp(menu->getType(), categorie) == 0) {
            menus.insereFinListe(new ElementMenu(menu->getIdMenu(), menu->getNom(),
                menu->getType(), menu->getPrix()));
        }
        courant = courant->suivant;
    }
    return true;
}

MenuManager::MenuManager(GestionnaireBD* gbd, GestionnaireFichier* gf) {
    gestionnaireBD = gbd;
    gestionnaireFichier = gf;
}

MenuManager::~MenuManager() {
}

bool MenuManager::chargerTousMenus(Liste<ElementMenu*>& menus) {
    if (gestionnaireFichier->estModeHorsLigne()) {
        return lireCache(gestionnaireFichier, menus, nullptr);
    }
    bool succes = gestionnaireBD->recupererTousMenus(menus);
    if (succes) gestionnaireFichier->sauvegarderMenus(menus);
    return succes;
}

bool MenuManager::chargerMenusParCategorie(const char* categorie, Liste<ElementMenu*>& menus) {
    if (gestionnaireFichier->estModeHorsLigne()) {
        return lireCache(gestionnaireFichier, menus, categorie);
    }
    return gestionnaireBD->recupererMenusParCategorie(categorie, menus);
}

void MenuManager::afficherMenus(const Liste<ElementMenu*>& listeMenus) const {
    std::cout << "\n=== Liste des Menus ===\n";
    std::cout << std::left << std::setw(5) << "ID"
        << std::setw(30) << "Nom"
        << std::setw(15) << "Type"
        << std::setw(10) << "Prix" << "\n";
    std::cout << std::string(60, '-') << "\n";

    Element<ElementMenu*>* courant = listeMenus.getTete();
    while (courant != nullptr) {
        std::cout << std::left << std::setw(5) << courant->donnee->getIdMenu()
            << std::setw(30) << courant->donnee->getNom()
            << std::setw(15) << courant->donnee->getType()
            << std::setw(10) << courant->donnee->getPrix() << " €\n";
        courant = courant->suivant;
    }
    std::cout << std::string(60, '-') << "\n";
}
