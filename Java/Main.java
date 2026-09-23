import java.text.DecimalFormat;
import java.text.DecimalFormatSymbols;
import java.util.ArrayList;
import java.util.List;
import java.util.Locale;
import java.util.Scanner;

public class Main {

    // Helper format mata uang Rupiah
    public static String formatRupiah(double nominal) {
        DecimalFormat kursIndonesia = (DecimalFormat) DecimalFormat.getCurrencyInstance();
        DecimalFormatSymbols formatRp = new DecimalFormatSymbols(new Locale("id", "ID"));
        formatRp.setCurrencySymbol("Rp ");
        formatRp.setMonetaryDecimalSeparator(',');
        formatRp.setGroupingSeparator('.');
        kursIndonesia.setDecimalFormatSymbols(formatRp);
        kursIndonesia.setMaximumFractionDigits(0);
        return kursIndonesia.format(nominal);
    }

    // Error Handling: Cek apakah ID Produk sudah ada di katalog
    public static boolean isIdExists(List<Laptop> daftarLaptop, String idProduk) {
        for (Laptop l : daftarLaptop) {
            if (l.getIdProduk().equalsIgnoreCase(idProduk.trim())) {
                return true;
            }
        }
        return false;
    }

    // Fungsi print separator dinamis
    private static void printSeparator(int[] colWidths) {
        StringBuilder sb = new StringBuilder("+");
        for (int w : colWidths) {
            for (int i = 0; i < w + 2; i++) {
                sb.append("-");
            }
            sb.append("+");
        }
        System.out.println(sb.toString());
    }

    // Fungsi tampilkan tabel lengkap
    public static void tampilkanTabel(List<Laptop> daftarLaptop) {
        if (daftarLaptop.isEmpty()) {
            System.out.println("\n[!] Data katalog laptop kosong.");
            return;
        }

        String[] headers = {
            "No", "ID Produk", "Nama Produk", "Brand", "Harga",
            "Processor", "RAM", "Storage", "Layar", "Baterai", "Berat"
        };

        int numCols = headers.length;
        int[] colWidths = new int[numCols];

        for (int i = 0; i < numCols; i++) {
            colWidths[i] = headers[i].length();
        }

        List<String[]> rows = new ArrayList<>();
        for (int idx = 0; idx < daftarLaptop.size(); idx++) {
            Laptop l = daftarLaptop.get(idx);
            String[] row = {
                String.valueOf(idx + 1),
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
            rows.add(row);

            for (int i = 0; i < numCols; i++) {
                if (row[i].length() > colWidths[i]) {
                    colWidths[i] = row[i].length();
                }
            }
        }

        System.out.println("\n============================================================");
        System.out.println("           KATALOG PRODUK LAPTOP (MULTILEVEL INHERITANCE)");
        System.out.println("============================================================");

        // Print header
        printSeparator(colWidths);
        StringBuilder headerLine = new StringBuilder("|");
        for (int i = 0; i < numCols; i++) {
            headerLine.append(String.format(" %-" + colWidths[i] + "s |", headers[i]));
        }
        System.out.println(headerLine.toString());
        printSeparator(colWidths);

        // Print rows
        for (String[] row : rows) {
            StringBuilder rowLine = new StringBuilder("|");
            for (int i = 0; i < numCols; i++) {
                rowLine.append(String.format(" %-" + colWidths[i] + "s |", row[i]));
            }
            System.out.println(rowLine.toString());
        }
        printSeparator(colWidths);
        System.out.println("Total Data: " + daftarLaptop.size() + " laptop\n");
    }

    public static void main(String[] args) {
        List<Laptop> daftarLaptop = new ArrayList<>();

        // Inisialisasi 5 Objek Awal
        daftarLaptop.add(new Laptop("LP-001", "Legion Pro 7i", "Lenovo", 38500000,
                "Intel Core i9-14900HX", "32GB DDR5 5600MHz", "1TB NVMe PCIe 4.0 SSD",
                "16.0 WQXGA 240Hz IPS", "99.9 Wh", "2.6 kg"));
        daftarLaptop.add(new Laptop("LP-002", "ROG Zephyrus G16", "ASUS", 34000000,
                "Intel Core Ultra 9 185H", "32GB LPDDR5X", "1TB NVMe PCIe 4.0 SSD",
                "16.0 2.5K 240Hz OLED", "90 Wh", "1.85 kg"));
        daftarLaptop.add(new Laptop("LP-003", "MacBook Pro 16", "Apple", 42999000,
                "Apple M3 Max 14-Core", "36GB Unified Memory", "1TB Apple SSD",
                "16.2 Liquid Retina XDR", "100 Wh", "2.14 kg"));
        daftarLaptop.add(new Laptop("LP-004", "XPS 14 9440", "Dell", 29500000,
                "Intel Core Ultra 7 155H", "16GB LPDDR5X", "512GB NVMe PCIe 4.0 SSD",
                "14.5 3.2K OLED Touch", "69.5 Wh", "1.68 kg"));
        daftarLaptop.add(new Laptop("LP-005", "Predator Helios 16", "Acer", 25000000,
                "Intel Core i7-14700HX", "16GB DDR5 5600MHz", "1TB NVMe PCIe 4.0 SSD",
                "16.0 WQXGA 165Hz IPS", "90 Wh", "2.6 kg"));

        System.out.println("===============================================================");
        System.out.println("    SELAMAT DATANG DI SISTEM MANAJEMEN PRODUK ELEKTRONIK");
        System.out.println("               (PRAKTIKUM 2 DPBO - INHERITANCE)");
        System.out.println("===============================================================");

        Scanner scanner = new Scanner(System.in);

        while (scanner.hasNextLine()) {
            System.out.println("\n[MENU UTAMA]");
            System.out.println("1. Tampilkan Seluruh Data Laptop (Tabel Dinamis)");
            System.out.println("2. Tambah Data Laptop Baru (Add Data)");
            System.out.println("3. Keluar");
            System.out.print("Pilih opsi (1-3): ");

            String inputPilihan = scanner.nextLine().trim();
            if (inputPilihan.isEmpty()) {
                continue;
            }

            if (inputPilihan.equals("1")) {
                tampilkanTabel(daftarLaptop);
            } else if (inputPilihan.equals("2")) {
                System.out.println("\n--- FORM TAMBAH DATA LAPTOP BARU ---");
                
                // Error Handling: Validasi ID Unik
                String idProduk = "";
                while (true) {
                    System.out.print("Masukkan ID Produk         : ");
                    idProduk = scanner.nextLine().trim();
                    if (idProduk.isEmpty()) {
                        System.out.println("[!] ID Produk tidak boleh kosong!");
                        continue;
                    }
                    if (isIdExists(daftarLaptop, idProduk)) {
                        System.out.println("[!] Error: ID Produk '" + idProduk + "' sudah terdaftar! Harap gunakan ID yang unik.");
                    } else {
                        break;
                    }
                }

                System.out.print("Masukkan Nama Produk       : ");
                String nama = scanner.nextLine().trim();
                System.out.print("Masukkan Brand/Merk        : ");
                String brand = scanner.nextLine().trim();

                // Error Handling: Validasi Harga Numerik Positif
                double harga = 0.0;
                while (true) {
                    System.out.print("Masukkan Harga (Angka > 0) : ");
                    String hargaStr = scanner.nextLine().trim();
                    try {
                        harga = Double.parseDouble(hargaStr);
                        if (harga <= 0) {
                            System.out.println("[!] Error: Harga harus bernilai lebih dari 0!");
                            continue;
                        }
                        break;
                    } catch (NumberFormatException e) {
                        System.out.println("[!] Error: Input harga tidak valid! Harap masukkan angka saja.");
                    }
                }

                System.out.print("Masukkan Processor         : ");
                String processor = scanner.nextLine().trim();
                System.out.print("Masukkan Kapasitas RAM     : ");
                String ram = scanner.nextLine().trim();
                System.out.print("Masukkan Storage/SSD       : ");
                String storage = scanner.nextLine().trim();
                System.out.print("Masukkan Ukuran/Tipe Layar : ");
                String layar = scanner.nextLine().trim();
                System.out.print("Masukkan Kapasitas Baterai : ");
                String baterai = scanner.nextLine().trim();
                System.out.print("Masukkan Bobot/Berat       : ");
                String berat = scanner.nextLine().trim();

                Laptop laptopBaru = new Laptop(idProduk, nama, brand, harga, processor, ram, storage, layar, baterai, berat);
                daftarLaptop.add(laptopBaru);

                System.out.println("\n[+] Sukses! Data laptop \"" + nama + "\" (" + idProduk + ") berhasil ditambahkan ke katalog.");
                tampilkanTabel(daftarLaptop);
            } else if (inputPilihan.equals("3")) {
                System.out.println("\nTerima kasih telah menggunakan program ini. Sampai jumpa!");
                break;
            } else {
                System.out.println("\n[!] Pilihan tidak valid. Silakan pilih 1, 2, atau 3.");
            }
        }

        scanner.close();
    }
}
