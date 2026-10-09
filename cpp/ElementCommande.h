#ifndef ELEMENTCOMMANDE_H
#define ELEMENTCOMMANDE_H

#include <iostream>
using namespace std;

class ElementCommande {
private:
    int idMenu;
    char* nom;
    int quantite;
    float prix;
public:
    ElementCommande();
    ElementCommande(int idMenu, const char* nom, int quantite, float prix);
    ~ElementCommande();
    void setIdMenu(int idMenu);
    void setNom(const char* nom);
    void setQuantite(int quantite);
    void setPrix(float prix);
    int getIdMenu() const;
    const char* getNom() const;
    int getQuantite() const;
    float getPrix() const;
    float getTotal() const;
    void afficher() const;
};

#endif
