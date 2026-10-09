#ifndef LISTE_H
#define LISTE_H

#include <iostream>
#include <cstring>
using namespace std;

template <typename T>
struct Element {
    T donnee;
    Element<T>* suivant;
};

template <typename T>
class Liste {
private:
    Element<T>* tete;
public:
    Liste();
    ~Liste();
    void afficher() const;
    Element<T>* insereDansListeVide(const T& donnee);
    Element<T>* insereDebutListe(const T& donnee);
    Element<T>* insereFinListe(const T& donnee);
    Element<T>* insereAilleurs(const T& donnee, int pos);
    Element<T>* supprimeDebut();
    Element<T>* supprimeAilleurs(int pos);
    Element<T>* getTete() const { return tete; }
};

template <typename T>
Liste<T>::Liste() {
    tete = nullptr;
}

template <typename T>
Liste<T>::~Liste() {
    Element<T>* courant = tete;
    while (courant != nullptr) {
        Element<T>* temp = courant;
        courant = courant->suivant;
        delete temp;
    }
}

template <typename T>
void Liste<T>::afficher() const {
    Element<T>* courant = tete;
    cout << "La liste contient :" << endl;
    while (courant != nullptr) {
        cout << courant->donnee << endl;
        courant = courant->suivant;
    }
}

template <typename T>
Element<T>* Liste<T>::insereDansListeVide(const T& donnee) {
    Element<T>* nouveau_element = new Element<T>;
    if (!nouveau_element) return nullptr;
    nouveau_element->donnee = donnee;
    nouveau_element->suivant = nullptr;
    tete = nouveau_element;
    return tete;
}

template <typename T>
Element<T>* Liste<T>::insereDebutListe(const T& donnee) {
    Element<T>* nouveau_element = new Element<T>;
    if (!nouveau_element) return nullptr;
    nouveau_element->donnee = donnee;
    nouveau_element->suivant = tete;
    tete = nouveau_element;
    return tete;
}

template <typename T>
Element<T>* Liste<T>::insereFinListe(const T& donnee) {
    if (tete == nullptr) {
        return insereDansListeVide(donnee);
    }
    Element<T>* nouveau_element = new Element<T>;
    if (!nouveau_element) return nullptr;
    nouveau_element->donnee = donnee;
    nouveau_element->suivant = nullptr;
    Element<T>* courant = tete;
    while (courant->suivant != nullptr) {
        courant = courant->suivant;
    }
    courant->suivant = nouveau_element;
    return tete;
}

template <typename T>
Element<T>* Liste<T>::insereAilleurs(const T& donnee, int pos) {
    if (tete == nullptr) return nullptr;
    Element<T>* courant = tete;
    for (int i = 1; i < pos && courant->suivant != nullptr; ++i) {
        courant = courant->suivant;
    }
    Element<T>* nouveau_element = new Element<T>;
    if (!nouveau_element) return nullptr;
    nouveau_element->donnee = donnee;
    nouveau_element->suivant = courant->suivant;
    courant->suivant = nouveau_element;
    return tete;
}

template <typename T>
Element<T>* Liste<T>::supprimeDebut() {
    if (tete == nullptr) return nullptr;
    Element<T>* supp_element = tete;
    tete = tete->suivant;
    delete supp_element;
    return tete;
}

template <typename T>
Element<T>* Liste<T>::supprimeAilleurs(int pos) {
    if (tete == nullptr) return nullptr;
    if (pos == 0) return supprimeDebut();
    Element<T>* courant = tete;
    for (int i = 1; i < pos && courant->suivant != nullptr; ++i) {
        courant = courant->suivant;
    }
    Element<T>* supp_element = courant->suivant;
    if (supp_element == nullptr) return tete;
    courant->suivant = supp_element->suivant;
    delete supp_element;
    return tete;
}

#endif
