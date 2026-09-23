#include "Laptop.hpp"

// Constructor Default
Laptop::Laptop() : PerangkatKomputer(), ukuranLayar(""), kapasitasBaterai(""), berat("") {}

// Constructor Parameter (Memanggil Constructor PerangkatKomputer)
Laptop::Laptop(string idProduk, string nama, string brand, double harga,
               string processor, string ram, string storage,
               string ukuranLayar, string kapasitasBaterai, string berat)
    : PerangkatKomputer(idProduk, nama, brand, harga, processor, ram, storage) {
    this->ukuranLayar = ukuranLayar;
    this->kapasitasBaterai = kapasitasBaterai;
    this->berat = berat;
}

// Destructor
Laptop::~Laptop() {}

// Getter dan Setter
string Laptop::getUkuranLayar() const {
    return this->ukuranLayar;
}

void Laptop::setUkuranLayar(const string &ukuranLayar) {
    this->ukuranLayar = ukuranLayar;
}

string Laptop::getKapasitasBaterai() const {
    return this->kapasitasBaterai;
}

void Laptop::setKapasitasBaterai(const string &kapasitasBaterai) {
    this->kapasitasBaterai = kapasitasBaterai;
}

string Laptop::getBerat() const {
    return this->berat;
}

void Laptop::setBerat(const string &berat) {
    this->berat = berat;
}
