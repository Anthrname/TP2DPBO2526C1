// Derived Class (Turunan Tingkat 2 - Multilevel Inheritance) - Mewarisi PerangkatKomputer
public class Laptop extends PerangkatKomputer {
    private String ukuranLayar;
    private String kapasitasBaterai;
    private String berat;

    // Constructor Default
    public Laptop() {
        super();
        this.ukuranLayar = "";
        this.kapasitasBaterai = "";
        this.berat = "";
    }

    // Constructor Parameter (Memanggil super constructor PerangkatKomputer)
    public Laptop(String idProduk, String nama, String brand, double harga,
                  String processor, String ram, String storage,
                  String ukuranLayar, String kapasitasBaterai, String berat) {
        super(idProduk, nama, brand, harga, processor, ram, storage);
        this.ukuranLayar = ukuranLayar;
        this.kapasitasBaterai = kapasitasBaterai;
        this.berat = berat;
    }

    // Getter dan Setter
    public String getUkuranLayar() {
        return ukuranLayar;
    }

    public void setUkuranLayar(String ukuranLayar) {
        this.ukuranLayar = ukuranLayar;
    }

    public String getKapasitasBaterai() {
        return kapasitasBaterai;
    }

    public void setKapasitasBaterai(String kapasitasBaterai) {
        this.kapasitasBaterai = kapasitasBaterai;
    }

    public String getBerat() {
        return berat;
    }

    public void setBerat(String berat) {
        this.berat = berat;
    }
}
