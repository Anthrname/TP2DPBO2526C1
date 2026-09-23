// Intermediary Class (Turunan Tingkat 1) - Mewarisi ProdukElektronik
public class PerangkatKomputer extends ProdukElektronik {
    private String processor;
    private String ram;
    private String storage;

    // Constructor Default
    public PerangkatKomputer() {
        super();
        this.processor = "";
        this.ram = "";
        this.storage = "";
    }

    // Constructor Parameter (Memanggil super constructor ProdukElektronik)
    public PerangkatKomputer(String idProduk, String nama, String brand, double harga,
                             String processor, String ram, String storage) {
        super(idProduk, nama, brand, harga);
        this.processor = processor;
        this.ram = ram;
        this.storage = storage;
    }

    // Getter dan Setter
    public String getProcessor() {
        return processor;
    }

    public void setProcessor(String processor) {
        this.processor = processor;
    }

    public String getRam() {
        return ram;
    }

    public void setRam(String ram) {
        this.ram = ram;
    }

    public String getStorage() {
        return storage;
    }

    public void setStorage(String storage) {
        this.storage = storage;
    }
}
