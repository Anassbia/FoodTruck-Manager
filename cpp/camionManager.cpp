#include "camionManager.h"
#include <cstring>
#include <iostream>

CamionManager::CamionManager(GestionnaireBD* gbd) {
    gestionnaireBD = gbd;
}

CamionManager::~CamionManager() {
}

bool CamionManager::authentifierCamion(const char* matricule, const char* motdepasse, Camion& camion) {
    if (gestionnaireBD->recupererCamion(matricule, camion)) {
        if (strcmp(camion.getMotdepasse(), motdepasse) == 0) {
            std::cout << "Authentification réussie !" << std::endl;
            return true;
        }
        else {
            std::cout << "Mot de passe incorrect." << std::endl;
            return false;
        }
    }
    else {
        std::cout << "Aucun camion trouvé avec ce matricule." << std::endl;
        return false;
    }
}
