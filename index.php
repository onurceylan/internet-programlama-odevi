<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form İşlemleri</title>
    <link rel="stylesheet" href="app.css">
    <script src="script.js"></script>
</head>
<body>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        try {
            $host = 'localhost';
            $dbname = 'ogrenci';
            $username = 'root';
            $password = 'Onur31415926!!!';

            $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $isim = $_POST['isim'];
            $soyisim = $_POST['soyisim'];
            $okul_numarasi = $_POST['okul_numarasi'];

            $stmt = $pdo->prepare("INSERT INTO ogrenciler (isim, soyisim, okul_numarasi) VALUES (:isim, :soyisim, :okul_numarasi)");
            $stmt->execute([
                ':isim' => $isim,
                ':soyisim' => $soyisim,
                ':okul_numarasi' => $okul_numarasi
            ]);

            echo "<div class='message' style='color: green;'>Kayıt başarıyla eklendi!</div>";
        } catch (PDOException $e) {
            echo "<div class='message' style='color: red;'>Hata: " . $e->getMessage() . "</div>";
        }
    }
    ?>

    <h1>Öğrenci Kaydı</h1>
    <form method="POST" action="">
        <input type="text" name="isim" placeholder="İsim" required>
        <input type="text" name="soyisim" placeholder="Soyisim" required>
        <input type="text" name="okul_numarasi" placeholder="Okul Numarası" required>
        <button type="submit">Kaydet</button>
    </form> 
    <?php
    try {
    $stmt = $pdo->query("SELECT * FROM ogrenciler ORDER BY id DESC");
    echo "<h2>Kayıtlı Öğrenciler</h2>";
    echo "<table style='width: 100%; max-width: 800px; margin: 20px auto; border-collapse: collapse;'>";
    echo "<thead>";
    echo "<tr style='background-color: #f2f2f2;'>";
    echo "<th style='padding: 12px; border: 1px solid #ddd; text-align: left;'>İsim</th>";
    echo "<th style='padding: 12px; border: 1px solid #ddd; text-align: left;'>Soyisim</th>";
    echo "<th style='padding: 12px; border: 1px solid #ddd; text-align: left;'>Okul Numarası</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td style='padding: 12px; border: 1px solid #ddd;'>" . htmlspecialchars($row['isim']) . "</td>";
        echo "<td style='padding: 12px; border: 1px solid #ddd;'>" . htmlspecialchars($row['soyisim']) . "</td>";
        echo "<td style='padding: 12px; border: 1px solid #ddd;'>" . htmlspecialchars($row['okul_numarasi']) . "</td>";
        echo "</tr>";
    }
    
    echo "</tbody>";
    echo "</table>";
} catch (PDOException $e) {
    echo "<div class='message' style='color: red;'>Liste görüntülenirken hata oluştu: " . $e->getMessage() . "</div>";
}
?>
    <div class="message" id="message"></div>
</body>
</html>