#ifndef PERANGKAT_KOMPUTER_HPP
#define PERANGKAT_KOMPUTER_HPP

#include "ProdukElektronik.hpp"

// Intermediary Class (Turunan Tingkat 1) - Mewarisi ProdukElektronik
class PerangkatKomputer : public ProdukElektronik {
private:
    string processor;
    string ram;
    string storage;

public:
    // Constructor Default
    PerangkatKomputer();

    // Constructor Parameter
    PerangkatKomputer(string idProduk, string nama, string brand, double harga,
                      string processor, string ram, string storage);

    // Destructor
    virtual ~PerangkatKomputer();

    // Getter dan Setter
    string getProcessor() const;
    void setProcessor(const string &processor);

    string getRam() const;
    void setRam(const string &ram);

    string getStorage() const;
    void setStorage(const string &storage);
};

#endif
