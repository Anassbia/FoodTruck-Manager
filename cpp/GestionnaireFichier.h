#ifndef GESTIONNAIREFICHIER_H
#define GESTIONNAIREFICHIER_H

#include "Commande.h"
#include "Liste.h"
#include "GestionnaireBD.h"
#include "ElementMenu.h"
#include <fstream>

class GestionnaireFichier {
private:
    char* nomFichier;
    char* nomFichierMenus;
    Liste<Commande*>* commandesEnAttente;
    Liste<ElementMenu*>* menusCache;
    bool modeHorsLigne;
    GestionnaireBD* gestionnaireBD;

public:
    GestionnaireFichier(GestionnaireBD* gbd, const char* nomFichier = "commandes_attente.txt");
    ~GestionnaireFichier();

    bool estModeHorsLigne() const;
    Liste<Commande*>* getCommandesEnAttente() const;
    const char* getNomFichier() const;
    Liste<ElementMenu*>* getMenusCache() const;

    void setModeHorsLigne(bool mode);
    void setNomFichier(const char* nouveauNom);

    bool sauvegarderCommande(const Commande& commande);
    bool chargerCommandesEnAttente();
    bool synchroniserCommandes();
    void viderCommandesEnAttente();

    bool sauvegarderMenus(const Liste<ElementMenu*>& menus);
    bool chargerMenusCache();
    void viderMenusCache();
};

#endif
