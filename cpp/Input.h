#ifndef INPUT_H
#define INPUT_H

#include <iostream>
#include <limits>

inline bool lireEntier(int& valeur) {
    while (!(std::cin >> valeur)) {
        if (std::cin.eof()) return false;
        std::cin.clear();
        std::cin.ignore(std::numeric_limits<std::streamsize>::max(), '\n');
        std::cout << "Entrez un nombre entier : ";
    }
    std::cin.ignore(std::numeric_limits<std::streamsize>::max(), '\n');
    return true;
}

#endif
