<!DOCTYPE html>
<html>
<head>
    <title>Rekap Laporan Penjualan</title>
</head>

<body style="font-family: Arial; background: #f3f3f3; margin: 0; padding: 0;">

<div style="width: 90%; margin: 30px auto;">

    <div style="background: white; border: 1px solid #ccc; border-radius: 5px;">

        <div style="background: #174372ff; padding: 15px; color: white; font-weight: bold;">
            Rekap Laporan Penjualan
        </div>

        <div style="padding: 20px;">

            <a href="transaksi.php"
               style="background: #007bff; color: white; padding: 8px 15px;
                      border-radius: 5px; text-decoration: none;">
               Kembali
            </a>

            <!-- Form Filter -->
            <form method="GET" style="margin-top: 20px;">

                <input type="date" name="start"
                       style="padding: 8px; border: 1px solid #ccc; border-radius: 5px;">

                <input type="date" name="end"
                       style="padding: 8px; border: 1px solid #ccc; border-radius: 5px; margin-left: 10px;">

                <button type="submit"
                        style="background: green; color: white; padding: 9px 18px;
                               border-radius: 5px; border: none; margin-left: 10px; cursor: pointer;">
                    Tampilkan
                </button>

            </form>

        </div>

    </div>

</div>

</body>
</html>
