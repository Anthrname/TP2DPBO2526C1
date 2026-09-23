#include "ProdukElektronik.hpp"

// Constructor Default
ProdukElektronik::ProdukElektronik() : idProduk(""), nama(""), brand(""), harga(0.0) {}

// Constructor Parameter
ProdukElektronik::ProdukElektronik(string idProduk, string nama, string brand, double harga) {
    this->idProduk = idProduk;
    this->nama = nama;
    this->brand = brand;
    this->harga = harga;
}

// Destructor
ProdukElektronik::~ProdukElektronik() {}

// Getter dan Setter
string ProdukElektronik::getIdProduk() const {
    return this->idProduk;
}

void ProdukElektronik::setIdProduk(const string &idProduk) {
    this->idProduk = idProduk;
}

string ProdukElektronik::getNama() const {
    return this->nama;
}

void ProdukElektronik::setNama(const string &nama) {
    this->nama = nama;
}

string ProdukElektronik::getBrand() const {
    return this->brand;
}

void ProdukElektronik::setBrand(const string &brand) {
    this->brand = brand;
}

double ProdukElektronik::getHarga() const {
    return this->harga;
}

void ProdukElektronik::setHarga(double harga) {
    this->harga = harga;
}
