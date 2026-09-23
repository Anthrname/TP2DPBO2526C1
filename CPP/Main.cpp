#include <iostream>
#include <vector>
#include <string>
#include <iomanip>
#include <sstream>
#include <algorithm>
#include <cctype>
#include "Laptop.hpp"

using namespace std;

// Helper function untuk format mata uang Rupiah
string formatRupiah(double nominal) {
    long long nilai = static_cast<long long>(nominal);
    string str = to_string(nilai);
    string res = "";
    int count = 0;
    for (int i = str.length() - 1; i >= 0; --i) {
        res += str[i];
        count++;
        if (count % 3 == 0 && i != 0) {
            res += '.';
        }
    }
    reverse(res.begin(), res.end());
    return "Rp " + res;
}

// Fungsi cek apakah ID Produk sudah terdaftar (Error Handling: Unique ID)
bool isIdExists(const vector<Laptop>& daftarLaptop, const string& idProduk) {
    for (const auto& l : daftarLaptop) {
        if (l.getIdProduk() == idProduk) {
            return true;
        }
    }
    return false;
}

// Fungsi untuk mencetak baris pembatas tabel secara dinamis
void printSeparator(const vector<int>& colWidths) {
    cout << "+";
    for (int w : colWidths) {
        cout << string(w + 2, '-') << "+";
    }
    cout << "\n";
}

// Fungsi untuk menampilkan seluruh data dalam SATU TABEL DINAMIS LENGKAP
void tampilkanTabel(const vector<Laptop>& daftarLaptop) {
    if (daftarLaptop.empty()) {
        cout << "\n[!] Data katalog laptop kosong.\n";
        return;
    }

    vector<string> headers = {
        "No", "ID Produk", "Nama Produk", "Brand", "Harga",
        "Processor", "RAM", "Storage", "Layar", "Baterai", "Berat"
    };

    int numCols = headers.size();
    vector<int> colWidths(numCols, 0);

    for (int i = 0; i < numCols; ++i) {
        colWidths[i] = headers[i].length();
    }

    // Hitung lebar kolom dinamis berdasarkan data
    for (size_t idx = 0; idx < daftarLaptop.size(); ++idx) {
        const Laptop& l = daftarLaptop[idx];
        vector<string> row = {
            to_string(idx + 1),
            l.getIdProduk(),
            l.getNama(),
            l.getBrand(),
            formatRupiah(l.getHarga()),
            l.getProcessor(),
            l.getRam(),
            l.getStorage(),
            l.getUkuranLayar(),
            l.getKapasitasBaterai(),
            l.getBerat()
        };

        for (int i = 0; i < numCols; ++i) {
            if ((int)row[i].length() > colWidths[i]) {
                colWidths[i] = row[i].length();
            }
        }
    }

    cout << "\n" << string(60, '=') << "\n";
    cout << "           KATALOG PRODUK LAPTOP (MULTILEVEL INHERITANCE)\n";
    cout << string(60, '=') << "\n";

    // Header tabel
    printSeparator(colWidths);
    cout << "|";
    for (int i = 0; i < numCols; ++i) {
        cout << " " << left << setw(colWidths[i]) << headers[i] << " |";
    }
    cout << "\n";
    printSeparator(colWidths);

    // Isi tabel
    for (size_t idx = 0; idx < daftarLaptop.size(); ++idx) {
        const Laptop& l = daftarLaptop[idx];
        vector<string> row = {
            to_string(idx + 1),
            l.getIdProduk(),
            l.getNama(),
            l.getBrand(),
            formatRupiah(l.getHarga()),
            l.getProcessor(),
            l.getRam(),
            l.getStorage(),
            l.getUkuranLayar(),
            l.getKapasitasBaterai(),
            l.getBerat()
        };

        cout << "|";
        for (int i = 0; i < numCols; ++i) {
            cout << " " << left << setw(colWidths[i]) << row[i] << " |";
        }
        cout << "\n";
    }
    printSeparator(colWidths);
    cout << "Total Data: " << daftarLaptop.size() << " laptop\n\n";
}

int main() {
    // Inisialisasi 5 Objek Awal (Sebelum input user)
    vector<Laptop> daftarLaptop = {
        Laptop("LP-001", "Legion Pro 7i", "Lenovo", 38500000,
               "Intel Core i9-14900HX", "32GB DDR5 5600MHz", "1TB NVMe PCIe 4.0 SSD",
               "16.0 WQXGA 240Hz IPS", "99.9 Wh", "2.6 kg"),
        Laptop("LP-002", "ROG Zephyrus G16", "ASUS", 34000000,
               "Intel Core Ultra 9 185H", "32GB LPDDR5X", "1TB NVMe PCIe 4.0 SSD",
               "16.0 2.5K 240Hz OLED", "90 Wh", "1.85 kg"),
        Laptop("LP-003", "MacBook Pro 16", "Apple", 42999000,
               "Apple M3 Max 14-Core", "36GB Unified Memory", "1TB Apple SSD",
               "16.2 Liquid Retina XDR", "100 Wh", "2.14 kg"),
        Laptop("LP-004", "XPS 14 9440", "Dell", 29500000,
               "Intel Core Ultra 7 155H", "16GB LPDDR5X", "512GB NVMe PCIe 4.0 SSD",
               "14.5 3.2K OLED Touch", "69.5 Wh", "1.68 kg"),
        Laptop("LP-005", "Predator Helios 16", "Acer", 25000000,
               "Intel Core i7-14700HX", "16GB DDR5 5600MHz", "1TB NVMe PCIe 4.0 SSD",
               "16.0 WQXGA 165Hz IPS", "90 Wh", "2.6 kg")
    };

    cout << "===============================================================\n";
    cout << "    SELAMAT DATANG DI SISTEM MANAJEMEN PRODUK ELEKTRONIK\n";
    cout << "               (PRAKTIKUM 2 DPBO - INHERITANCE)\n";
    cout << "===============================================================\n";

    string pilihanStr;
    while (true) {
        cout << "\n[MENU UTAMA]\n";
        cout << "1. Tampilkan Seluruh Data Laptop (Tabel Dinamis)\n";
        cout << "2. Tambah Data Laptop Baru (Add Data)\n";
        cout << "3. Keluar\n";
        cout << "Pilih opsi (1-3): ";
        
        if (!(cin >> pilihanStr)) {
            break; // End of file / stream input
        }
        cin.ignore(); // Bersihkan sisa newline

        if (pilihanStr == "1") {
            tampilkanTabel(daftarLaptop);
        } else if (pilihanStr == "2") {
            string idProduk, nama, brand, processor, ram, storage, layar, baterai, berat;
            double harga = 0.0;

            cout << "\n--- FORM TAMBAH DATA LAPTOP BARU ---\n";
            
            // Error Handling: Validasi ID Unik
            while (true) {
                cout << "Masukkan ID Produk         : ";
                if (!getline(cin, idProduk)) break;
                if (idProduk.empty()) {
                    cout << "[!] ID Produk tidak boleh kosong!\n";
                    continue;
                }
                if (isIdExists(daftarLaptop, idProduk)) {
                    cout << "[!] Error: ID Produk '" << idProduk << "' sudah terdaftar! Harap gunakan ID yang unik.\n";
                } else {
                    break;
                }
            }

            cout << "Masukkan Nama Produk       : ";
            getline(cin, nama);
            cout << "Masukkan Brand/Merk        : ";
            getline(cin, brand);
            
            // Error Handling: Validasi Angka Harga Positif
            while (true) {
                cout << "Masukkan Harga (Angka > 0) : ";
                string hargaInput;
                if (!getline(cin, hargaInput)) break;
                stringstream ss(hargaInput);
                if (ss >> harga && harga > 0) {
                    break;
                } else {
                    cout << "[!] Error: Harga harus berupa angka positif!\n";
                }
            }

            cout << "Masukkan Processor         : ";
            getline(cin, processor);
            cout << "Masukkan Kapasitas RAM     : ";
            getline(cin, ram);
            cout << "Masukkan Storage/SSD       : ";
            getline(cin, storage);
            cout << "Masukkan Ukuran/Tipe Layar : ";
            getline(cin, layar);
            cout << "Masukkan Kapasitas Baterai : ";
            getline(cin, baterai);
            cout << "Masukkan Bobot/Berat       : ";
            getline(cin, berat);

            Laptop laptopBaru(idProduk, nama, brand, harga, processor, ram, storage, layar, baterai, berat);
            daftarLaptop.push_back(laptopBaru);

            cout << "\n[+] Sukses! Data laptop \"" << nama << "\" (" << idProduk << ") berhasil ditambahkan ke katalog.\n";
            tampilkanTabel(daftarLaptop);
        } else if (pilihanStr == "3") {
            cout << "\nTerima kasih telah menggunakan program ini. Sampai jumpa!\n";
            break;
        } else {
            cout << "\n[!] Pilihan tidak valid. Silakan pilih 1, 2, atau 3.\n";
        }
    }

    return 0;
}
