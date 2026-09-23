<?php

require_once 'PerangkatKomputer.php';

// Derived Class (Turunan Tingkat 2 - Multilevel Inheritance) - Mewarisi PerangkatKomputer
class Laptop extends PerangkatKomputer {
    private $ukuranLayar;
    private $kapasitasBaterai;
    private $berat;
    private $fotoProduk; // Khusus PHP sesuai instruksi tugas

    // Constructor
    public function __construct($idProduk = "", $nama = "", $brand = "", $harga = 0.0,
                                $processor = "", $ram = "", $storage = "",
                                $ukuranLayar = "", $kapasitasBaterai = "", $berat = "",
                                $fotoProduk = "default.png") {
        parent::__construct($idProduk, $nama, $brand, $harga, $processor, $ram, $storage);
        $this->ukuranLayar = $ukuranLayar;
        $this->kapasitasBaterai = $kapasitasBaterai;
        $this->berat = $berat;
        $this->fotoProduk = $fotoProduk;
    }

    // Getter dan Setter ukuranLayar
    public function getUkuranLayar() {
        return $this->ukuranLayar;
    }

    public function setUkuranLayar($ukuranLayar) {
        $this->ukuranLayar = $ukuranLayar;
    }

    // Getter dan Setter kapasitasBaterai
    public function getKapasitasBaterai() {
        return $this->kapasitasBaterai;
    }

    public function setKapasitasBaterai($kapasitasBaterai) {
        $this->kapasitasBaterai = $kapasitasBaterai;
    }

    // Getter dan Setter berat
    public function getBerat() {
        return $this->berat;
    }

    public function setBerat($berat) {
        $this->berat = $berat;
    }

    // Getter dan Setter fotoProduk (Khusus PHP)
    public function getFotoProduk() {
        return $this->fotoProduk;
    }

    public function setFotoProduk($fotoProduk) {
        $this->fotoProduk = $fotoProduk;
    }
}
?>
