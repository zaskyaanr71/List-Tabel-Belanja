
<?php
require_once "proses.php";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>List Belanja</title>

    <!-- Menghubungkan file CSS -->
    <link rel="stylesheet" href="style.css">
</head>

<body>
<div class="container">

    <div class="header">
        <h1>🛒 List Belanja</h1>
        <p>Belanja hari ini, hidup lebih mudah!</p>
    </div>

    <div class="card">

        <!-- Form tambah barang -->
        <form action="proses.php" method="POST" class="form-tambah">
            <input type="text" name="nama"
                   placeholder="Nama barang..." required>

            <input type="text" name="jumlah"
                   placeholder="Jumlah barang..." required>

            <button type="submit" name="tambah" class="btn-tambah">
                + Tambah
            </button>
        </form>

        <!-- Tabel daftar belanja -->
        <div class="tabel-wrapper">
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
            <?php if ($total > 0): ?>
                <?php foreach ($_SESSION["belanja"] as $id => $barang): ?>
                <tr>
                    <td><?= $id + 1 ?></td>

                    <td class="nama-barang">
                        <span class="<?= $barang["selesai"] ? 'terbeli' : '' ?>">
                            <?= htmlspecialchars($barang["nama"]) ?>
                        </span>
                    </td>

                    <td><?= htmlspecialchars($barang["jumlah"]) ?></td>

                    <td>
                        <form action="proses.php" method="POST">
                            <input type="hidden" name="id" value="<?= $id ?>">
                            <input type="hidden" name="ubah_status" value="1">

                            <label class="pilihan-status">
                                <input type="checkbox" name="selesai"
                                    onchange="this.form.submit()"
                                    <?= $barang["selesai"] ? "checked" : "" ?>>

                                <span class="status <?= $barang["selesai"]
                                    ? 'status-selesai' : 'status-belum' ?>">
                                    <?= $barang["selesai"]
                                        ? "Selesai Dibeli" : "Belum Dibeli" ?>
                                </span>
                            </label>
                        </form>
                    </td>

                    <td>
                        <form action="proses.php" method="POST"
                            onsubmit="return confirm('Hapus barang ini?')">
                            <input type="hidden" name="id" value="<?= $id ?>">

                            <button type="submit" name="hapus" class="btn-hapus">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">Belum ada barang dalam daftar.</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
        </div>

        <!-- Ringkasan belanja -->
        <div class="ringkasan">
            <p>
                Total: <strong><?= $total ?></strong> barang |
                Sudah dibeli: <strong><?= $sudah ?></strong> |
                Belum dibeli: <strong><?= $belum ?></strong>
            </p>

            <form action="proses.php" method="POST">
                <button type="submit" name="semua_selesai"
                    class="btn-selesai">
                    Tandai Semua Selesai
                </button>
            </form>
        </div>

    </div>
</div>
</body>
</html>
