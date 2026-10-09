#ifndef POS_H
#define POS_H

#include "GestionnaireBD.h"
#include "camionManager.h"
#include "MenuManager.h"
#include "commandeManager.h"
#include "GestionnaireFichier.h"
#include "Camion.h"

class POS {
private:
    GestionnaireBD* gestionnaireBD;
    CamionManager* camionManager;
    MenuManager* menuManager;
    CommandeManager* commandeManager;
    GestionnaireFichier* gestionnaireFichier;
    Camion* camion;

    void afficherTousMenus();
    void afficherMenusParCategorie();
    void authentifierCamion();

public:
    POS();
    POS(GestionnaireBD* gbd, GestionnaireFichier* gf, CamionManager* cm, MenuManager* mm, CommandeManager* comm);
    ~POS();

    void menuPrincipal();
    void nouvelleCommande();
    void synchroniserCommandes();
    void setModeHorsLigne(bool mode);
};

#endif
