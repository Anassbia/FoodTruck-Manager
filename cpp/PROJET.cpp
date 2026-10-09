#include "POS.h"
#include "GestionnaireBD.h"
#include "GestionnaireFichier.h"
#include "camionManager.h"
#include "MenuManager.h"
#include "commandeManager.h"
#include <iostream>
#include <cstdlib>

int main() {

    char user[100] = {}, password[100] = {}, database[100] = {};
    size_t longueur = 0;
    getenv_s(&longueur, user, sizeof(user), "FOODTRUCK_DB_USER");
    getenv_s(&longueur, password, sizeof(password), "FOODTRUCK_DB_PASSWORD");
    getenv_s(&longueur, database, sizeof(database), "FOODTRUCK_DB_NAME");
    GestionnaireBD* gbd = new GestionnaireBD(*user ? user : "root", password,
        *database ? database : "food_truck");
    if (!gbd->connecter()) {
        std::cout << "Erreur de connexion à la base de données!\n";
        delete gbd;
        return 1;
    }

    GestionnaireFichier* gf = new GestionnaireFichier(gbd);

    CamionManager* cm = new CamionManager(gbd);
    MenuManager* mm = new MenuManager(gbd, gf);
    CommandeManager* comm = new CommandeManager(gbd, gf);

    POS pos(gbd, gf, cm, mm, comm);

    pos.menuPrincipal();

    delete comm;
    delete mm;
    delete cm;
    delete gf;
    delete gbd;

    return 0;
}
