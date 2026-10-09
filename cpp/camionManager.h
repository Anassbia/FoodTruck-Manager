#ifndef CAMIONMANAGER_H
#define CAMIONMANAGER_H

#include "GestionnaireBD.h"
#include "Camion.h"

class CamionManager {
private:
    GestionnaireBD* gestionnaireBD;
public:
    CamionManager(GestionnaireBD* gbd);
    ~CamionManager();
    bool authentifierCamion(const char* matricule, const char* motdepasse, Camion& camion);
};

#endif
