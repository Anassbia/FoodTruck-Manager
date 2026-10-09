#ifndef COMMANDE_MANAGER_H
#define COMMANDE_MANAGER_H

#include "GestionnaireBD.h"
#include "GestionnaireFichier.h"
#include "Commande.h"
#include "Liste.h"
#include "ElementMenu.h"
#include "MenuManager.h"

class CommandeManager {
private:
    GestionnaireBD* gestionnaireBD;
    GestionnaireFichier* gestionnaireFichier;
    MenuManager* menuManager;
    Commande* commandeEnCours;
    int idCamionAuthentifie;

public:
    CommandeManager(GestionnaireBD* gbd, GestionnaireFichier* gf);
    ~CommandeManager();

    bool saisirCommande(const Liste<ElementMenu*>& menus);
    void afficherCommandeEnCours();
    double calculerTotal();
    void afficherRecu();
    Commande* getCommandeEnCours();
    void setCamionAuthentifie(int idCamion);
    void ajouterMenu(const Liste<ElementMenu*>& menus);
    void afficherMenus(const Liste<ElementMenu*>& menus) const;
};

#endif
