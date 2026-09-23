# Base Class (Induk Tingkat 1)
class ProdukElektronik:
    def __init__(self, id_produk: str = "", nama: str = "", brand: str = "", harga: float = 0.0):
        self._id_produk = id_produk
        self._nama = nama
        self._brand = brand
        self._harga = float(harga)

    # Getter & Setter id_produk
    def get_id_produk(self) -> str:
        return self._id_produk

    def set_id_produk(self, id_produk: str):
        self._id_produk = id_produk

    # Getter & Setter nama
    def get_nama(self) -> str:
        return self._nama

    def set_nama(self, nama: str):
        self._nama = nama

    # Getter & Setter brand
    def get_brand(self) -> str:
        return self._brand

    def set_brand(self, brand: str):
        self._brand = brand

    # Getter & Setter harga
    def get_harga(self) -> float:
        return self._harga

    def set_harga(self, harga: float):
        self._harga = float(harga)
