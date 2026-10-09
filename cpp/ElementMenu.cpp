#include "ElementMenu.h"
#include <cstring>
#include <iomanip>
#include <cstdio>

ElementMenu::ElementMenu() {
    idMenu = 0;
    nom = new char[50];
    type = new char[50];
    prix = 0.0f;
    nom[0] = '\0';
    type[0] = '\0';
}

ElementMenu::ElementMenu(int id, const char* n, const char* t, float p) {
    idMenu = id;
    nom = new char[50];
    type = new char[50];
    strncpy_s(nom, 50, n, 49);
    strncpy_s(type, 50, t, 49);
    prix = p;
}

ElementMenu::~ElementMenu() {
    delete[] nom;
    delete[] type;
}

void ElementMenu::setIdMenu(int id) {
    idMenu = id;
}

void ElementMenu::setNom(const char* n) {
    strncpy_s(nom, 50, n, 49);
}

void ElementMenu::setType(const char* t) {
    strncpy_s(type, 50, t, 49);
}

void ElementMenu::setPrix(float p) {
    prix = p;
}

int ElementMenu::getIdMenu() const {
    return idMenu;
}

const char* ElementMenu::getNom() const {
    return nom;
}

const char* ElementMenu::getType() const {
    return type;
}

float ElementMenu::getPrix() const {
    return prix;
}

void ElementMenu::afficher() const {

    cout << "| ";
    if (idMenu < 10) cout << "  " << idMenu << "  ";
    else if (idMenu < 100) cout << " " << idMenu << "  ";
    else if (idMenu < 1000) cout << " " << idMenu << " ";
    else cout << idMenu;
    cout << " | ";

    int lenNom = static_cast<int>(strlen(nom));
    int leftNom = (20 - lenNom) / 2;
    int rightNom = 20 - lenNom - leftNom;
    for (int i = 0; i < leftNom; ++i) cout << " ";
    cout << nom;
    for (int i = 0; i < rightNom; ++i) cout << " ";
    cout << " | ";

    int lenType = static_cast<int>(strlen(type));
    int leftType = (13 - lenType) / 2;
    int rightType = 13 - lenType - leftType;
    for (int i = 0; i < leftType; ++i) cout << " ";
    cout << type;
    for (int i = 0; i < rightType; ++i) cout << " ";
    cout << " | ";

    char prixTexte[32];
    std::snprintf(prixTexte, sizeof(prixTexte), "%.2f", prix);
    int lenPrix = static_cast<int>(strlen(prixTexte));
    int leftPrix = (12 - lenPrix) / 2;
    int rightPrix = 12 - lenPrix - leftPrix;
    for (int i = 0; i < leftPrix; ++i) cout << " ";
    cout << prixTexte;
    for (int i = 0; i < rightPrix; ++i) cout << " ";
    cout << " |" << endl;
}

void ElementMenu::afficherEnteteTableau() {
    cout << "---------------------------------------------------------------" << endl;
    cout << "| ID   |     Nom du menu      |   Catégorie   |  Prix (DA)   |" << endl;
    cout << "---------------------------------------------------------------" << endl;
}

