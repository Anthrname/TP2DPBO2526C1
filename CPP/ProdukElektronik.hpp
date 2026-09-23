#ifndef PRODUK_ELEKTRONIK_HPP
#define PRODUK_ELEKTRONIK_HPP

#include <string>

using namespace std;

// Base Class (Induk Tingkat 1)
class ProdukElektronik {
private:
    string idProduk;
    string nama;
    string brand;
    double harga;

public:
    // Constructor Default
    ProdukElektronik();

    // Constructor Parameter
    ProdukElektronik(string idProduk, string nama, string brand, double harga);

    // Destructor
    virtual ~ProdukElektronik();

    // Getter dan Setter
    string getIdProduk() const;
    void setIdProduk(const string &idProduk);

    string getNama() const;
    void setNama(const string &nama);

    string getBrand() const;
    void setBrand(const string &brand);

    double getHarga() const;
    void setHarga(double harga);
};

#endif
