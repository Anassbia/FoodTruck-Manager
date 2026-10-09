#include "Camion.h"
#include <cstring>

Camion::Camion() {
    idCamion = 0;
    matricule = new char[50];
    motdepasse = new char[50];
    localisation = new char[50];
    matricule[0] = '\0';
    motdepasse[0] = '\0';
    localisation[0] = '\0';
}

Camion::Camion(int id, const char* mat, const char* mdp, const char* loc) {
    idCamion = id;
    matricule = new char[50];
    motdepasse = new char[50];
    localisation = new char[50];
    strncpy_s(matricule, 50, mat, 49);
    strncpy_s(motdepasse, 50, mdp, 49);
    strncpy_s(localisation, 50, loc, 49);
}

Camion::~Camion() {
    delete[] matricule;
    delete[] motdepasse;
    delete[] localisation;
}

void Camion::setIdCamion(int id) {
    idCamion = id;
}

void Camion::setMatricule(const char* mat) {
    strncpy_s(matricule, 50, mat, 49);
}

void Camion::setMotdepasse(const char* mdp) {
    strncpy_s(motdepasse, 50, mdp, 49);
}

void Camion::setLocalisation(const char* loc) {
    strncpy_s(localisation, 50, loc, 49);
}

int Camion::getIdCamion() const {
    return idCamion;
}

const char* Camion::getMatricule() const {
    return matricule;
}

const char* Camion::getMotdepasse() const {
    return motdepasse;
}

const char* Camion::getLocalisation() const {
    return localisation;
}

bool Camion::authentifier(const char* mat, const char* mdp) const {
    return (strcmp(matricule, mat) == 0 && strcmp(motdepasse, mdp) == 0);
}

void Camion::afficher() const {
    cout << "===============================" << endl;
    cout << "        Informations Camion      " << endl;
    cout << "===============================" << endl;
    cout << " ID Camion    : " << idCamion << endl;
    cout << " Matricule    : " << matricule << endl;
    cout << " Localisation : " << localisation << endl;
    cout << "===============================" << endl;
}
