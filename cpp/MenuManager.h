#ifndef MENU_MANAGER_H
#define MENU_MANAGER_H

#include "GestionnaireBD.h"
#include "GestionnaireFichier.h"
#include "Liste.h"
#include "ElementMenu.h"

void libererMenus(Liste<ElementMenu*>& menus);

class MenuManager {
private:
    GestionnaireBD* gestionnaireBD;
    GestionnaireFichier* gestionnaireFichier;

public:
    MenuManager(GestionnaireBD* gbd, GestionnaireFichier* gf);
    ~MenuManager();

    bool chargerTousMenus(Liste<ElementMenu*>& menus);
    bool chargerMenusParCategorie(const char* categorie, Liste<ElementMenu*>& menus);
    void afficherMenus(const Liste<ElementMenu*>& listeMenus) const;
};

#endif
