import pulp
import mysql.connector
import sys

try:
    # Membuat koneksi ke database
    db = mysql.connector.connect(
        host="localhost",
        user="root",
        password="Rahasia",
        database="tugas_db",
        ssl_disabled=True
    )

    # Membuat cursor
    cursor = db.cursor()

    # Mengambil data barang dari database
    query = "SELECT nama, harga, stok FROM barang"
    cursor.execute(query)
    result = cursor.fetchall()

    # Menutup koneksi
    cursor.close()
    db.close()

    barang = {}
    for row in result:
        nama, harga, stok = row
        barang[nama] = {'harga': float(harga), 'stok': stok}

    # Debug: Cetak data barang yang diambil dari database
    print("Data barang dari database:", barang, file=sys.stderr)

    # Membuat masalah linier programming
    prob = pulp.LpProblem("Kombinasi_Paket_Penjualan", pulp.LpMaximize)

    # Variabel keputusan
    x = pulp.LpVariable.dicts("x", barang.keys(), lowBound=0, cat='Integer')

    prob += pulp.lpSum([barang[i]['harga'] * x[i] for i in barang.keys()]), "Total_Harga"

    for i in barang.keys():
        prob += x[i] <= barang[i]['stok'], f"Stok_{i}"

    prob.solve()

    for v in prob.variables():
        print(f"{v.name} = {v.varValue}")

    print(f"Total Harga = {pulp.value(prob.objective)}")

except mysql.connector.Error as err:
    print(f"Error: {err}", file=sys.stderr)
except Exception as e:
    print(f"Unexpected error: {e}", file=sys.stderr)
