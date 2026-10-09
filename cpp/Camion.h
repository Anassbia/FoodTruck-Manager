#ifndef CAMION_H
#define CAMION_H

#include <iostream>
using namespace std;

class Camion {
private:
    int idCamion;
    char* matricule;
    char* motdepasse;
    char* localisation;
public:
    Camion();
    Camion(int id, const char* mat, const char* mdp, const char* loc);
    ~Camion();
    void setIdCamion(int id);
    void setMatricule(const char* mat);
    void setMotdepasse(const char* mdp);
    void setLocalisation(const char* loc);
    int getIdCamion() const;
    const char* getMatricule() const;
    const char* getMotdepasse() const;
    const char* getLocalisation() const;
    bool authentifier(const char* mat, const char* mdp) const;
    void afficher() const;
};

#endif
