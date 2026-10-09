#include "ElementCommande.h"
#include <cstring>
#include <iostream>

using namespace std;

ElementCommande::ElementCommande() {
    idMenu = 0;
    nom = new char[50];
    nom[0] = '\0';
    quantite = 0;
    prix = 0.0f;
}

ElementCommande::ElementCommande(int idMenu_, const char* nom_, int quantite_, float prix_) {
    idMenu = idMenu_;
    nom = new char[50];
    strncpy_s(nom, 50, nom_, 49);
    quantite = quantite_;
    prix = prix_;
}

ElementCommande::~ElementCommande() {
    delete[] nom;
}

void ElementCommande::setIdMenu(int idMenu_) {
    idMenu = idMenu_;
}

void ElementCommande::setNom(const char* nom_) {
    strncpy_s(nom, 50, nom_, 49);
}

void ElementCommande::setQuantite(int quantite_) {
    quantite = quantite_;
}

void ElementCommande::setPrix(float prix_) {
    prix = prix_;
}

int ElementCommande::getIdMenu() const {
    return idMenu;
}

const char* ElementCommande::getNom() const {
    return nom;
}

int ElementCommande::getQuantite() const {
    return quantite;
}

float ElementCommande::getPrix() const {
    return prix;
}

float ElementCommande::getTotal() const {
    return prix * quantite;
}

void ElementCommande::afficher() const {
    cout << "ID Menu : " << idMenu << " | Nom : " << nom << " | Qté : " << quantite << " | Prix : " << prix << " | Total : " << getTotal() << endl;
}
