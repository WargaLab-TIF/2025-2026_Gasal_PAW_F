    <!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Laporan - Penjualan XYZ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Penjualan XYZ</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#">Supplier</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Barang</a></li>
                    <li class="nav-item"><a class="nav-link active" href="#">Transaksi</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Rekap Laporan Penjualan</h5>
            </div>
            <div class="card-body">
                <a href="index.php" class="btn btn-secondary mb-3">&lt; Kembali</a>
                
                <form action="report_hasil.php" method="GET">
                    <div class="row g-3 align-items-end">
                        <div class="col-md-5">
                            <label for="tgl_mulai" class="form-label">Dari Tanggal</label>
                            <input type="date" class="form-control" id="tgl_mulai" name="tgl_mulai" value="2023-11-08">
                        </div>
                        <div class="col-md-5">
                            <label for="tgl_selesai" class="form-label">Sampai Tanggal</label>
                            <input type="date" class="form-control" id="tgl_selesai" name="tgl_selesai" value="2023-11-14">
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-success w-100">Tampilkan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

