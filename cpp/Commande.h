#ifndef COMMANDE_H
#define COMMANDE_H

#include <iostream>
#include "ElementCommande.h"
#include "Liste.h"
using namespace std;

class Commande {
private:
    int idCommande;
    char* dateCommande;
    char* typePaiement;
    Liste<ElementCommande*> elements;
public:
    Commande();
    Commande(int id, const char* date, const char* typePay);
    Commande(const Commande& autre);
    Commande& operator=(const Commande& autre);
    ~Commande();
    void setIdCommande(int id);
    void setDateCommande(const char* date);
    void setTypePaiement(const char* typePay);
    int getIdCommande() const;
    const char* getDateCommande() const;
    const char* getTypePaiement() const;
    Liste<ElementCommande*>& getElements();
    const Liste<ElementCommande*>& getElements() const;
};

#endif
