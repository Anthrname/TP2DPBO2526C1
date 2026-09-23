<?php
session_start();
require_once 'Laptop.php';

// Helper function untuk memformat Rupiah
function formatRupiah($nominal) {
    return 'Rp ' . number_format($nominal, 0, ',', '.');
}

// Inisialisasi 5 Data Objek Awal
function getInitialData() {
    return [
        new Laptop("LP-001", "Legion Pro 7i", "Lenovo", 38500000,
                   "Intel Core i9-14900HX", "32GB DDR5 5600MHz", "1TB NVMe PCIe 4.0 SSD",
                   "16.0 WQXGA 240Hz IPS", "99.9 Wh", "2.6 kg", "legion_pro_7i.png"),
        new Laptop("LP-002", "ROG Zephyrus G16", "ASUS", 34000000,
                   "Intel Core Ultra 9 185H", "32GB LPDDR5X", "1TB NVMe PCIe 4.0 SSD",
                   "16.0 2.5K 240Hz OLED", "90 Wh", "1.85 kg", "rog_zephyrus_g16.png"),
        new Laptop("LP-003", "MacBook Pro 16", "Apple", 42999000,
                   "Apple M3 Max 14-Core", "36GB Unified Memory", "1TB Apple SSD",
                   "16.2 Liquid Retina XDR", "100 Wh", "2.14 kg", "macbook_pro_16.png"),
        new Laptop("LP-004", "XPS 14 9440", "Dell", 29500000,
                   "Intel Core Ultra 7 155H", "16GB LPDDR5X", "512GB NVMe PCIe 4.0 SSD",
                   "14.5 3.2K OLED Touch", "69.5 Wh", "1.68 kg", "dell_xps_14.png"),
        new Laptop("LP-005", "Predator Helios 16", "Acer", 25000000,
                   "Intel Core i7-14700HX", "16GB DDR5 5600MHz", "1TB NVMe PCIe 4.0 SSD",
                   "16.0 WQXGA 165Hz IPS", "90 Wh", "2.6 kg", "predator_helios_16.png")
    ];
}

// Reset data jika tombol reset ditekan
if (isset($_GET['action']) && $_GET['action'] === 'reset') {
    $_SESSION['daftar_laptop'] = serialize(getInitialData());
    header('Location: index.php');
    exit;
}

// Cek apakah session sudah berisi daftar laptop
if (!isset($_SESSION['daftar_laptop'])) {
    $_SESSION['daftar_laptop'] = serialize(getInitialData());
}

$daftarLaptop = unserialize($_SESSION['daftar_laptop']);
$notifSuccess = "";
$notifError = "";

// Handle form submission (Add Laptop Baru)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tambah_laptop'])) {
    $idProduk = trim(htmlspecialchars($_POST['idProduk'] ?? ''));
    $nama = trim(htmlspecialchars($_POST['nama'] ?? ''));
    $brand = trim(htmlspecialchars($_POST['brand'] ?? ''));
    $harga = (float)($_POST['harga'] ?? 0);
    $processor = trim(htmlspecialchars($_POST['processor'] ?? ''));
    $ram = trim(htmlspecialchars($_POST['ram'] ?? ''));
    $storage = trim(htmlspecialchars($_POST['storage'] ?? ''));
    $layar = trim(htmlspecialchars($_POST['layar'] ?? ''));
    $baterai = trim(htmlspecialchars($_POST['baterai'] ?? ''));
    $berat = trim(htmlspecialchars($_POST['berat'] ?? ''));
    $fotoProduk = htmlspecialchars($_POST['fotoProduk'] ?? 'default.png');

    // Error Handling: Validasi ID Unik
    $idDuplikat = false;
    foreach ($daftarLaptop as $item) {
        if (strcasecmp($item->getIdProduk(), $idProduk) === 0) {
            $idDuplikat = true;
            break;
        }
    }

    if (empty($idProduk)) {
        $notifError = "ID Produk tidak boleh kosong!";
    } elseif ($idDuplikat) {
        $notifError = "Error: ID Produk '$idProduk' sudah terdaftar! Harap gunakan ID yang unik.";
    } elseif ($harga <= 0) {
        $notifError = "Error: Harga produk harus berupa angka bernilai lebih dari 0!";
    } else {
        // Jika user memilih file upload gambar baru
        if (isset($_FILES['fotoFile']) && $_FILES['fotoFile']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . '/images/';
            $fileName = basename($_FILES['fotoFile']['name']);
            $targetFilePath = $uploadDir . $fileName;
            $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
            $allowedTypes = ['jpg', 'png', 'jpeg', 'webp'];

            if (in_array($fileType, $allowedTypes)) {
                if (move_uploaded_file($_FILES['fotoFile']['tmp_name'], $targetFilePath)) {
                    $fotoProduk = $fileName;
                }
            }
        }

        $laptopBaru = new Laptop($idProduk, $nama, $brand, $harga, $processor, $ram, $storage, $layar, $baterai, $berat, $fotoProduk);
        $daftarLaptop[] = $laptopBaru;
        $_SESSION['daftar_laptop'] = serialize($daftarLaptop);
        $notifSuccess = "Data laptop \"$nama\" ($idProduk) berhasil ditambahkan ke katalog!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Katalog Produk Laptop - Multilevel Inheritance PHP</title>
</head>
<body>
    <h2>Sistem Manajemen Katalog Laptop</h2>
    <p>Implementasi Konsep OOP <b>Multilevel Inheritance</b> (ProdukElektronik &rarr; PerangkatKomputer &rarr; Laptop)</p>
    <hr>

    <?php if (!empty($notifSuccess)): ?>
        <p><b>[SUKSES]</b> <?php echo $notifSuccess; ?></p>
    <?php endif; ?>

    <?php if (!empty($notifError)): ?>
        <p><b>[ERROR]</b> <?php echo $notifError; ?></p>
    <?php endif; ?>

    <h3>Tambah Produk Laptop Baru</h3>
    <form action="index.php" method="POST" enctype="multipart/form-data">
        <table border="0" cellpadding="4">
            <tr>
                <td><label for="idProduk">ID Produk (ProdukElektronik)</label></td>
                <td>: <input type="text" id="idProduk" name="idProduk" placeholder="Contoh: LP-006" required></td>
            </tr>
            <tr>
                <td><label for="nama">Nama Produk (ProdukElektronik)</label></td>
                <td>: <input type="text" id="nama" name="nama" placeholder="Contoh: Razer Blade 16" required></td>
            </tr>
            <tr>
                <td><label for="brand">Brand / Merk (ProdukElektronik)</label></td>
                <td>: 
                    <select id="brand" name="brand" required>
                        <option value="Lenovo">Lenovo</option>
                        <option value="ASUS">ASUS</option>
                        <option value="Apple">Apple</option>
                        <option value="Dell">Dell</option>
                        <option value="Acer">Acer</option>
                        <option value="Razer">Razer</option>
                        <option value="MSI">MSI</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for="harga">Harga (ProdukElektronik)</label></td>
                <td>: <input type="number" id="harga" name="harga" placeholder="Contoh: 52000000" min="1" required></td>
            </tr>
            <tr>
                <td><label for="processor">Processor (PerangkatKomputer)</label></td>
                <td>: <input type="text" id="processor" name="processor" placeholder="Contoh: Intel Core i9-14900HX" required></td>
            </tr>
            <tr>
                <td><label for="ram">RAM (PerangkatKomputer)</label></td>
                <td>: <input type="text" id="ram" name="ram" placeholder="Contoh: 32GB DDR5 5600MHz" required></td>
            </tr>
            <tr>
                <td><label for="storage">Storage / SSD (PerangkatKomputer)</label></td>
                <td>: <input type="text" id="storage" name="storage" placeholder="Contoh: 2TB NVMe PCIe 4.0 SSD" required></td>
            </tr>
            <tr>
                <td><label for="layar">Layar (Laptop)</label></td>
                <td>: <input type="text" id="layar" name="layar" placeholder="Contoh: 16.0 Dual-Mode Mini-LED" required></td>
            </tr>
            <tr>
                <td><label for="baterai">Baterai (Laptop)</label></td>
                <td>: <input type="text" id="baterai" name="baterai" placeholder="Contoh: 95.2 Wh" required></td>
            </tr>
            <tr>
                <td><label for="berat">Bobot / Berat (Laptop)</label></td>
                <td>: <input type="text" id="berat" name="berat" placeholder="Contoh: 2.45 kg" required></td>
            </tr>
            <tr>
                <td><label for="fotoProduk">Pilihan Foto Preset</label></td>
                <td>: 
                    <select id="fotoProduk" name="fotoProduk">
                        <option value="razer_blade_16.png">Razer Blade 16 (Preset)</option>
                        <option value="msi_titan_18.png">MSI Titan 18 (Preset)</option>
                        <option value="legion_pro_7i.png">Lenovo Legion (Preset)</option>
                        <option value="rog_zephyrus_g16.png">ROG Zephyrus (Preset)</option>
                        <option value="macbook_pro_16.png">MacBook Pro (Preset)</option>
                        <option value="dell_xps_14.png">Dell XPS (Preset)</option>
                        <option value="predator_helios_16.png">Predator Helios (Preset)</option>
                        <option value="default.png" selected>Default Placeholder</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for="fotoFile">Atau Upload Gambar Baru</label></td>
                <td>: <input type="file" id="fotoFile" name="fotoFile" accept="image/*"></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <br>
                    <input type="submit" name="tambah_laptop" value="Tambah Data Laptop">
                    <a href="index.php?action=reset"><button type="button">Reset ke 5 Data Awal</button></a>
                </td>
            </tr>
        </table>
    </form>

    <hr>

    <h3>Daftar Lengkap Produk Laptop (Multilevel Inheritance)</h3>
    <p>Total: <?php echo count($daftarLaptop); ?> Laptop</p>

    <table border="1" cellpadding="6" cellspacing="0">
        <thead>
            <tr bgcolor="#f0f0f0">
                <th>No</th>
                <th>Foto Produk</th>
                <th>ID Produk</th>
                <th>Nama Produk</th>
                <th>Brand</th>
                <th>Harga</th>
                <th>Processor</th>
                <th>RAM</th>
                <th>Storage</th>
                <th>Layar</th>
                <th>Baterai</th>
                <th>Berat</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($daftarLaptop as $index => $laptop): ?>
                <tr>
                    <td align="center"><?php echo $index + 1; ?></td>
                    <td align="center">
                        <img src="images/<?php echo htmlspecialchars($laptop->getFotoProduk()); ?>" 
                             alt="<?php echo htmlspecialchars($laptop->getNama()); ?>" 
                             width="80"
                             onerror="this.src='images/default.png';">
                    </td>
                    <td><?php echo htmlspecialchars($laptop->getIdProduk()); ?></td>
                    <td><b><?php echo htmlspecialchars($laptop->getNama()); ?></b></td>
                    <td><?php echo htmlspecialchars($laptop->getBrand()); ?></td>
                    <td><?php echo formatRupiah($laptop->getHarga()); ?></td>
                    <td><?php echo htmlspecialchars($laptop->getProcessor()); ?></td>
                    <td><?php echo htmlspecialchars($laptop->getRam()); ?></td>
                    <td><?php echo htmlspecialchars($laptop->getStorage()); ?></td>
                    <td><?php echo htmlspecialchars($laptop->getUkuranLayar()); ?></td>
                    <td><?php echo htmlspecialchars($laptop->getKapasitasBaterai()); ?></td>
                    <td><?php echo htmlspecialchars($laptop->getBerat()); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <hr>
    <p>Tugas Praktikum 2 &copy; 2026 - Desain Pemrograman Berorientasi Objek (DPBO)</p>
</body>
</html>
