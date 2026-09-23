<?php

// Base Class (Induk Tingkat 1)
class ProdukElektronik {
    protected $idProduk;
    protected $nama;
    protected $brand;
    protected $harga;

    // Constructor
    public function __construct($idProduk = "", $nama = "", $brand = "", $harga = 0.0) {
        $this->idProduk = $idProduk;
        $this->nama = $nama;
        $this->brand = $brand;
        $this->harga = (float)$harga;
    }

    // Getter dan Setter idProduk
    public function getIdProduk() {
        return $this->idProduk;
    }

    public function setIdProduk($idProduk) {
        $this->idProduk = $idProduk;
    }

    // Getter dan Setter nama
    public function getNama() {
        return $this->nama;
    }

    public function setNama($nama) {
        $this->nama = $nama;
    }

    // Getter dan Setter brand
    public function getBrand() {
        return $this->brand;
    }

    public function setBrand($brand) {
        $this->brand = $brand;
    }

    // Getter dan Setter harga
    public function getHarga() {
        return $this->harga;
    }

    public function setHarga($harga) {
        $this->harga = (float)$harga;
    }
}
?>
