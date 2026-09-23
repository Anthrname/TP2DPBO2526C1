from ProdukElektronik import ProdukElektronik

# Intermediary Class (Turunan Tingkat 1) - Mewarisi ProdukElektronik
class PerangkatKomputer(ProdukElektronik):
    def __init__(self, id_produk: str = "", nama: str = "", brand: str = "", harga: float = 0.0,
                 processor: str = "", ram: str = "", storage: str = ""):
        super().__init__(id_produk, nama, brand, harga)
        self._processor = processor
        self._ram = ram
        self._storage = storage

    # Getter & Setter processor
    def get_processor(self) -> str:
        return self._processor

    def set_processor(self, processor: str):
        self._processor = processor

    # Getter & Setter ram
    def get_ram(self) -> str:
        return self._ram

    def set_ram(self, ram: str):
        self._ram = ram

    # Getter & Setter storage
    def get_storage(self) -> str:
        return self._storage

    def set_storage(self, storage: str):
        self._storage = storage
