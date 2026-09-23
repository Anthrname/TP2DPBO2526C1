from PerangkatKomputer import PerangkatKomputer

# Derived Class (Turunan Tingkat 2 - Multilevel Inheritance) - Mewarisi PerangkatKomputer
class Laptop(PerangkatKomputer):
    def __init__(self, id_produk: str = "", nama: str = "", brand: str = "", harga: float = 0.0,
                 processor: str = "", ram: str = "", storage: str = "",
                 ukuran_layar: str = "", kapasitas_baterai: str = "", berat: str = ""):
        super().__init__(id_produk, nama, brand, harga, processor, ram, storage)
        self._ukuran_layar = ukuran_layar
        self._kapasitas_baterai = kapasitas_baterai
        self._berat = berat

    # Getter & Setter ukuran_layar
    def get_ukuran_layar(self) -> str:
        return self._ukuran_layar

    def set_ukuran_layar(self, ukuran_layar: str):
        self._ukuran_layar = ukuran_layar

    # Getter & Setter kapasitas_baterai
    def get_kapasitas_baterai(self) -> str:
        return self._kapasitas_baterai

    def set_kapasitas_baterai(self, kapasitas_baterai: str):
        self._kapasitas_baterai = kapasitas_baterai

    # Getter & Setter berat
    def get_berat(self) -> str:
        return self._berat

    def set_berat(self, berat: str):
        self._berat = berat
