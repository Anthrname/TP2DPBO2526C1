// Base Class (Induk Tingkat 1)
public class ProdukElektronik {
    private String idProduk;
    private String nama;
    private String brand;
    private double harga;

    // Constructor Default
    public ProdukElektronik() {
        this.idProduk = "";
        this.nama = "";
        this.brand = "";
        this.harga = 0.0;
    }

    // Constructor Parameter
    public ProdukElektronik(String idProduk, String nama, String brand, double harga) {
        this.idProduk = idProduk;
        this.nama = nama;
        this.brand = brand;
        this.harga = harga;
    }

    // Getter dan Setter
    public String getIdProduk() {
        return idProduk;
    }

    public void setIdProduk(String idProduk) {
        this.idProduk = idProduk;
    }

    public String getNama() {
        return nama;
    }

    public void setNama(String nama) {
        this.nama = nama;
    }

    public String getBrand() {
        return brand;
    }

    public void setBrand(String brand) {
        this.brand = brand;
    }

    public double getHarga() {
        return harga;
    }

    public void setHarga(double harga) {
        this.harga = harga;
    }
}
