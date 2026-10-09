#ifndef ELEMENTMENU_H
#define ELEMENTMENU_H

#include <iostream>
using namespace std;

class ElementMenu {
private:
    int idMenu;
    char* nom;
    char* type;
    float prix;
public:
    ElementMenu();
    ElementMenu(int id, const char* n, const char* t, float p);
    ~ElementMenu();
    void setIdMenu(int id);
    void setNom(const char* n);
    void setType(const char* t);
    void setPrix(float p);
    int getIdMenu() const;
    const char* getNom() const;
    const char* getType() const;
    float getPrix() const;
    void afficher() const;
    static void afficherEnteteTableau();
};

#endif
