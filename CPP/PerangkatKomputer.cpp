#include "PerangkatKomputer.hpp"

// Constructor Default
PerangkatKomputer::PerangkatKomputer() : ProdukElektronik(), processor(""), ram(""), storage("") {}

// Constructor Parameter (Memanggil Constructor Parent ProdukElektronik)
PerangkatKomputer::PerangkatKomputer(string idProduk, string nama, string brand, double harga,
                                     string processor, string ram, string storage)
    : ProdukElektronik(idProduk, nama, brand, harga) {
    this->processor = processor;
    this->ram = ram;
    this->storage = storage;
}

// Destructor
PerangkatKomputer::~PerangkatKomputer() {}

// Getter dan Setter
string PerangkatKomputer::getProcessor() const {
    return this->processor;
}

void PerangkatKomputer::setProcessor(const string &processor) {
    this->processor = processor;
}

string PerangkatKomputer::getRam() const {
    return this->ram;
}

void PerangkatKomputer::setRam(const string &ram) {
    this->ram = ram;
}

string PerangkatKomputer::getStorage() const {
    return this->storage;
}

void PerangkatKomputer::setStorage(const string &storage) {
    this->storage = storage;
}
