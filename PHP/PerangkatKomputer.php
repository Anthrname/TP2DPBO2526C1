<?php

require_once 'ProdukElektronik.php';

// Intermediary Class (Turunan Tingkat 1) - Mewarisi ProdukElektronik
class PerangkatKomputer extends ProdukElektronik {
    protected $processor;
    protected $ram;
    protected $storage;

    // Constructor
    public function __construct($idProduk = "", $nama = "", $brand = "", $harga = 0.0,
                                $processor = "", $ram = "", $storage = "") {
        parent::__construct($idProduk, $nama, brand: $brand, harga: $harga);
        $this->processor = $processor;
        $this->ram = $ram;
        $this->storage = $storage;
    }

    // Getter dan Setter processor
    public function getProcessor() {
        return $this->processor;
    }

    public function setProcessor($processor) {
        $this->processor = $processor;
    }

    // Getter dan Setter ram
    public function getRam() {
        return $this->ram;
    }

    public function setRam($ram) {
        $this->ram = $ram;
    }

    // Getter dan Setter storage
    public function getStorage() {
        return $this->storage;
    }

    public function setStorage($storage) {
        $this->storage = $storage;
    }
}
?>
