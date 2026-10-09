#include "Commande.h"
#include <cstring>
#include <iostream>

using namespace std;

Commande::Commande() {
    idCommande = 0;
    dateCommande = new char[30];
    typePaiement = new char[30];
    dateCommande[0] = '\0';
    typePaiement[0] = '\0';
}

Commande::Commande(int id, const char* date, const char* typePay) {
    idCommande = id;
    dateCommande = new char[30];
    typePaiement = new char[30];
    strncpy_s(dateCommande, 30, date, 29);
    strncpy_s(typePaiement, 30, typePay, 29);
}

Commande::Commande(const Commande& autre)
    : Commande(autre.idCommande, autre.dateCommande, autre.typePaiement) {
    Element<ElementCommande*>* courant = autre.elements.getTete();
    while (courant) {
        ElementCommande* item = courant->donnee;
        elements.insereFinListe(new ElementCommande(item->getIdMenu(), item->getNom(),
            item->getQuantite(), item->getPrix()));
        courant = courant->suivant;
    }
}

Commande& Commande::operator=(const Commande& autre) {
    if (this == &autre) return *this;
    while (elements.getTete()) {
        delete elements.getTete()->donnee;
        elements.supprimeDebut();
    }
    idCommande = autre.idCommande;
    setDateCommande(autre.dateCommande);
    setTypePaiement(autre.typePaiement);
    Element<ElementCommande*>* courant = autre.elements.getTete();
    while (courant) {
        ElementCommande* item = courant->donnee;
        elements.insereFinListe(new ElementCommande(item->getIdMenu(), item->getNom(),
            item->getQuantite(), item->getPrix()));
        courant = courant->suivant;
    }
    return *this;
}

Commande::~Commande() {
    while (elements.getTete()) {
        delete elements.getTete()->donnee;
        elements.supprimeDebut();
    }
    delete[] dateCommande;
    delete[] typePaiement;
}

void Commande::setIdCommande(int id) {
    idCommande = id;
}

void Commande::setDateCommande(const char* date) {
    strncpy_s(dateCommande, 30, date, 29);
}

void Commande::setTypePaiement(const char* typePay) {
    strncpy_s(typePaiement, 30, typePay, 29);
}

int Commande::getIdCommande() const {
    return idCommande;
}

const char* Commande::getDateCommande() const {
    return dateCommande;
}

const char* Commande::getTypePaiement() const {
    return typePaiement;
}
Liste<ElementCommande*>& Commande::getElements() {
    return elements;
}

const Liste<ElementCommande*>& Commande::getElements() const {
    return elements;
}
