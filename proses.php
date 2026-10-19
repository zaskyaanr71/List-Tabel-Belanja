
<?php
session_start();

// Array untuk menyimpan daftar belanja
if (!isset($_SESSION["belanja"])) {
    $_SESSION["belanja"] = [
        ["nama" => "Beras", "jumlah" => "2 kg", "selesai" => false],
        ["nama" => "Minyak Goreng", "jumlah" => "1 liter", "selesai" => false],
        ["nama" => "Telur", "jumlah" => "1 kg", "selesai" => false],
        ["nama" => "Jagung", "jumlah" => "2 kg", "selesai" => false],
        ["nama" => "Gula", "jumlah" => "1 kg", "selesai" => false],
        ["nama" => "Susu UHT", "jumlah" => "2 box", "selesai" => false],
        ["nama" => "Tepung Terigu", "jumlah" => "1 kg", "selesai" => false],
        ["nama" => "Sabun cair", "jumlah" => "2", "selesai" => false],
        ["nama" => "Kopi", "jumlah" => "1 sachet", "selesai" => false],
        ["nama" => "Shampo", "jumlah" => "1 botol", "selesai" => false],
        ["nama" => "Sirup Marjan", "jumlah" => "1 botol", "selesai" => false],
        ["nama" => "Tisu", "jumlah" => "2 box", "selesai" => false],
        ["nama" => "Tepung Serbaguna", "jumlah" => "1 kg", "selesai" => false],
        ["nama" => "Minyak Ikan", "jumlah" => "1 botol", "selesai" => false],
        ["nama" => "Teh", "jumlah" => "1 sachet", "selesai" => false],
        ["nama" => "Anggur", "jumlah" => "1 kg", "selesai" => false],
        ["nama" => "Jeruk", "jumlah" => "1 kg", "selesai" => false],
        ["nama" => "Kecap", "jumlah" => "2 botol", "selesai" => false],
        ["nama" => "Saos Pedas", "jumlah" => "1 kemasan", "selesai" => false],
        ["nama" => "Margarin", "jumlah" => "1", "selesai" => false],
        ["nama" => "Daging Ayam", "jumlah" => "1 kg", "selesai" => false]
    ];
}

// Menambah barang
if (isset($_POST["tambah"])) {
    $nama = trim($_POST["nama"] ?? "");
    $jumlah = trim($_POST["jumlah"] ?? "");

    if ($nama !== "" && $jumlah !== "") {
        $_SESSION["belanja"][] = [
            "nama" => $nama,
            "jumlah" => $jumlah,
            "selesai" => false
        ];
    }

    header("Location: index.php");
    exit;
}

// Mengubah status barang
if (isset($_POST["ubah_status"])) {
    $id = (int) ($_POST["id"] ?? -1);

    if (isset($_SESSION["belanja"][$id])) {
        $_SESSION["belanja"][$id]["selesai"] =
            !$_SESSION["belanja"][$id]["selesai"];
    }

    header("Location: index.php");
    exit;
}

// Menghapus barang
if (isset($_POST["hapus"])) {
    $id = (int) ($_POST["id"] ?? -1);

    if (isset($_SESSION["belanja"][$id])) {
        array_splice($_SESSION["belanja"], $id, 1);
    }

    header("Location: index.php");
    exit;
}

// Menandai semua barang selesai
if (isset($_POST["semua_selesai"])) {
    foreach ($_SESSION["belanja"] as &$barang) {
        $barang["selesai"] = true;
    }

    unset($barang);

    header("Location: index.php");
    exit;
}

// Menghitung jumlah barang
$total = count($_SESSION["belanja"]);
$sudah = 0;

foreach ($_SESSION["belanja"] as $barang) {
    if ($barang["selesai"]) {
        $sudah++;
    }
}

$belum = $total - $sudah;
?>
