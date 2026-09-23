#ifndef LAPTOP_HPP
#define LAPTOP_HPP

#include "PerangkatKomputer.hpp"

// Derived Class (Turunan Tingkat 2 - Multilevel Inheritance) - Mewarisi PerangkatKomputer
class Laptop : public PerangkatKomputer {
private:
    string ukuranLayar;
    string kapasitasBaterai;
    string berat;

public:
    // Constructor Default
    Laptop();

    // Constructor Parameter
    Laptop(string idProduk, string nama, string brand, double harga,
           string processor, string ram, string storage,
           string ukuranLayar, string kapasitasBaterai, string berat);

    // Destructor
    virtual ~Laptop();

    // Getter dan Setter
    string getUkuranLayar() const;
    void setUkuranLayar(const string &ukuranLayar);

    string getKapasitasBaterai() const;
    void setKapasitasBaterai(const string &kapasitasBaterai);

    string getBerat() const;
    void setBerat(const string &berat);
};

#endif
