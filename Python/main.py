import sys
from Laptop import Laptop

def format_rupiah(nominal: float) -> str:
    """Format angka ke format mata uang Rupiah"""
    nilai = int(nominal)
    formatted = f"{nilai:,}".replace(",", ".")
    return f"Rp {formatted}"

def is_id_exists(daftar_laptop: list[Laptop], id_produk: str) -> bool:
    """Error Handling: Cek apakah ID Produk sudah ada di katalog"""
    return any(l.get_id_produk().lower() == id_produk.strip().lower() for l in daftar_laptop)

def print_separator(col_widths: list[int]):
    """Mencetak baris garis pemisah tabel sesuai lebar kolom dinamis"""
    border = "+" + "+".join("-" * (w + 2) for w in col_widths) + "+"
    print(border)

def tampilkan_tabel(daftar_laptop: list[Laptop]):
    """Menampilkan seluruh data laptop dalam satu tabel dinamis lengkap"""
    if not daftar_laptop:
        print("\n[!] Data katalog laptop kosong.")
        return

    headers = [
        "No", "ID Produk", "Nama Produk", "Brand", "Harga",
        "Processor", "RAM", "Storage", "Layar", "Baterai", "Berat"
    ]

    # Ambil baris data dalam bentuk list string
    rows = []
    for idx, l in enumerate(daftar_laptop, start=1):
        rows.append([
            str(idx),
            l.get_id_produk(),
            l.get_nama(),
            l.get_brand(),
            format_rupiah(l.get_harga()),
            l.get_processor(),
            l.get_ram(),
            l.get_storage(),
            l.get_ukuran_layar(),
            l.get_kapasitas_baterai(),
            l.get_berat()
        ])

    # Hitung lebar maksimal per kolom secara dinamis
    col_widths = [len(h) for h in headers]
    for row in rows:
        for i, val in enumerate(row):
            if len(val) > col_widths[i]:
                col_widths[i] = len(val)

    print("\n" + "=" * 60)
    print("           KATALOG PRODUK LAPTOP (MULTILEVEL INHERITANCE)")
    print("=" * 60)

    # Cetak header
    print_separator(col_widths)
    header_row = "| " + " | ".join(f"{headers[i]:<{col_widths[i]}}" for i in range(len(headers))) + " |"
    print(header_row)
    print_separator(col_widths)

    # Cetak setiap baris data
    for row in rows:
        data_row = "| " + " | ".join(f"{row[i]:<{col_widths[i]}}" for i in range(len(row))) + " |"
        print(data_row)

    print_separator(col_widths)
    print(f"Total Data: {len(daftar_laptop)} laptop\n")

def main():
    # Inisialisasi 5 Objek Awal (sebelum ada input user)
    daftar_laptop = [
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
    ]

    print("===============================================================")
    print("    SELAMAT DATANG DI SISTEM MANAJEMEN PRODUK ELEKTRONIK")
    print("               (PRAKTIKUM 2 DPBO - INHERITANCE)")
    print("===============================================================")

    while True:
        print("\n[MENU UTAMA]")
        print("1. Tampilkan Seluruh Data Laptop (Tabel Dinamis)")
        print("2. Tambah Data Laptop Baru (Add Data)")
        print("3. Keluar")

        try:
            pilihan = input("Pilih opsi (1-3): ").strip()
        except EOFError:
            break

        if not pilihan:
            continue

        if pilihan == "1":
            tampilkan_tabel(daftar_laptop)
        elif pilihan == "2":
            print("\n--- FORM TAMBAH DATA LAPTOP BARU ---")
            try:
                # Error Handling: Validasi ID Unik
                while True:
                    id_produk = input("Masukkan ID Produk         : ").strip()
                    if not id_produk:
                        print("[!] ID Produk tidak boleh kosong!")
                        continue
                    if is_id_exists(daftar_laptop, id_produk):
                        print(f"[!] Error: ID Produk '{id_produk}' sudah terdaftar! Harap gunakan ID yang unik.")
                    else:
                        break

                nama = input("Masukkan Nama Produk       : ").strip()
                brand = input("Masukkan Brand/Merk        : ").strip()

                # Error Handling: Validasi Harga Numerik Positif
                while True:
                    harga_str = input("Masukkan Harga (Angka > 0) : ").strip()
                    try:
                        harga = float(harga_str)
                        if harga <= 0:
                            print("[!] Error: Harga harus bernilai lebih dari 0!")
                            continue
                        break
                    except ValueError:
                        print("[!] Error: Input harga tidak valid! Harap masukkan angka saja.")

                processor = input("Masukkan Processor         : ").strip()
                ram = input("Masukkan Kapasitas RAM     : ").strip()
                storage = input("Masukkan Storage/SSD       : ").strip()
                layar = input("Masukkan Ukuran/Tipe Layar : ").strip()
                baterai = input("Masukkan Kapasitas Baterai : ").strip()
                berat = input("Masukkan Bobot/Berat       : ").strip()
            except EOFError:
                break

            laptop_baru = Laptop(id_produk, nama, brand, harga, processor, ram, storage, layar, baterai, berat)
            daftar_laptop.append(laptop_baru)

            print(f"\n[+] Sukses! Data laptop \"{nama}\" ({id_produk}) berhasil ditambahkan ke katalog.")
            tampilkan_tabel(daftar_laptop)
        elif pilihan == "3":
            print("\nTerima kasih telah menggunakan program ini. Sampai jumpa!")
            break
        else:
            print("\n[!] Pilihan tidak valid. Silakan pilih 1, 2, atau 3.")

if __name__ == "__main__":
    main()
