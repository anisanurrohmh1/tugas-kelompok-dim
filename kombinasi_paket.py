import pulp

# Data barang
barang = {
    'A': {'harga': 10000, 'stok': 50},
    'B': {'harga': 15000, 'stok': 30},
    'C': {'harga': 20000, 'stok': 20}
}

# Membuat masalah linier programming
prob = pulp.LpProblem("Kombinasi_Paket_Penjualan", pulp.LpMaximize)

# Variabel keputusan
x = pulp.LpVariable.dicts("x", barang.keys(), lowBound=0, cat='Integer')

# Fungsi objektif: Maksimalkan total harga
prob += pulp.lpSum([barang[i]['harga'] * x[i] for i in barang.keys()]), "Total_Harga"

# Kendala: Tidak melebihi stok yang tersedia
for i in barang.keys():
    prob += x[i] <= barang[i]['stok'], f"Stok_{i}"

# Menyelesaikan masalah
prob.solve()

# Menampilkan hasil
for v in prob.variables():
    print(f"{v.name} = {v.varValue}")

print(f"Total Harga = {pulp.value(prob.objective)}")
