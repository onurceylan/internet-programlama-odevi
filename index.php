<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form İşlemleri</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        form {
            max-width: 400px;
            margin: auto;
        }
        input {
            display: block;
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 4px;
        }
        button:hover {
            background-color: #45a049;
        }
        .message {
            margin-top: 20px;
            font-weight: bold;
        }
    </style>
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
    <div class="message" id="message"></div>
</body>
</html>