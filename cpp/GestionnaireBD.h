#ifndef GESTIONNAIREBD_H
#define GESTIONNAIREBD_H

#include <mysql_driver.h>
#include <mysql_connection.h>
#include <cppconn/resultset.h>
#include <cppconn/statement.h>
#include <cppconn/prepared_statement.h>
#include <cppconn/exception.h>
#include "Camion.h"
#include "ElementMenu.h"
#include "Liste.h"
#include "Commande.h"

class GestionnaireBD {
private:
    char* utilisateur;
    char* motdepasse;
    char* nomBD;
    sql::Connection* connexion;
public:
    GestionnaireBD(const char* user, const char* mdp, const char* nom);
    ~GestionnaireBD();
    bool connecter();
    bool recupererCamion(const char* matricule, Camion& camion);
    void deconnecter();
    bool recupererTousMenus(Liste<ElementMenu*>& listeMenus);
    bool recupererMenusParCategorie(const char* categorie, Liste<ElementMenu*>& listeMenus);
    bool insererCommande(const Commande& commande, int idCamion);
    int getNextOrderId();
};

#endif
