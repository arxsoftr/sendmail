<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toplu E-posta Gönderimi</title>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;500&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Ubuntu', sans-serif;
            background-color: #000;
            color: #fff;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }
        .header {
            position: absolute;
            top: 10px;
            left: 10px;
            display: flex;
            gap: 10px;
        }
        .header select {
            background-color: #333;
            color: #fff;
            border: 1px solid #444;
            border-radius: 5px;
            padding: 5px;
            font-family: 'Ubuntu', sans-serif;
        }
        .container {
            background-color: #1c1c1c;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.1);
            max-width: 100%;
            width: 100%;
            box-sizing: border-box;
            position: relative;
        }
        h1 {
            text-align: center;
            color: #c89f3e;
        }
        label {
            display: block;
            margin-bottom: 10px;
            color: #ddd;
        }
        input[type="file"],
        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #444;
            border-radius: 5px;
            background-color: #333;
            color: #fff;
            box-sizing: border-box;
        }
        textarea {
            height: 100px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #c89f3e;
            border: none;
            border-radius: 5px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #a87b2e;
        }
        footer {
            margin-top: 20px;
            color: #888;
            font-size: 14px;
            text-align: center;
        }
        .loading {
            display: none;
            margin-top: 20px;
            text-align: center;
        }
        .loading img {
            width: 50px;
            height: 50px;
        }
        .success-message {
            display: none;
            margin-top: 20px;
            color: #c89f3e;
            font-size: 18px;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="header">
    <label for="language">Dil:</label>
    <select id="language" name="language" onchange="changeLanguage(this.value)">
        <option value="tr">Türkçe</option>
        <option value="en">English</option>
    </select>
</div>

<div class="container">
    <h1 data-tr="Toplu E-posta Gönderimi" data-en="Bulk Email Sending">Toplu E-posta Gönderimi</h1>
    <form id="emailForm" action="send_emails.php" method="POST" enctype="multipart/form-data">
        <label for="mailFile" data-tr="Mail Listesi (Dosya):" data-en="Mail List (File):">Mail Listesi (Dosya):</label>
        <input type="file" name="mailFile" id="mailFile">

        <label for="emails" data-tr="Mail Adresleri (Manuel):" data-en="Email Addresses (Manual):">Mail Adresleri (Manuel):</label>
        <input type="text" name="emails" id="emails" placeholder="Örn: email1@example.com, email2@example.com">

        <label for="subject" data-tr="Konu:" data-en="Subject:">Konu:</label>
        <input type="text" name="subject" id="subject" placeholder="E-posta konusu" required>

        <label for="message" data-tr="Mesaj:" data-en="Message:">Mesaj:</label>
        <textarea name="message" id="message" placeholder="Merhaba {{name}}, ..."></textarea>

        <button type="submit" data-tr="Gönder" data-en="Send">Gönder</button>
    </form>
    <div class="loading">
        <img src="https://i.imgur.com/QxmpMd5.gif" alt="Yükleniyor...">
    </div>
    <div class="success-message" data-tr="Başarıyla gönderildi!" data-en="Successfully sent!">Başarıyla gönderildi!</div>
</div>

<footer data-tr="Coded by ArX Developers" data-en="Coded by ArX Developers">Coded by ArX Developers</footer>

<script>
    function changeLanguage(lang) {
        document.querySelectorAll('[data-tr]').forEach(el => {
            el.textContent = el.getAttribute(`data-${lang}`);
        });
    }

    const savedLang = localStorage.getItem('lang') || 'tr';
    document.getElementById('language').value = savedLang;
    changeLanguage(savedLang);

    document.getElementById('language').addEventListener('change', (e) => {
        localStorage.setItem('lang', e.target.value);
    });

    document.getElementById('emailForm').addEventListener('submit', function(e) {
        e.preventDefault();
        document.querySelector('.loading').style.display = 'block';
        fetch(this.action, {
            method: 'POST',
            body: new FormData(this),
        })
        .then(response => response.text())
        .then(result => {
            document.querySelector('.loading').style.display = 'none';
            document.querySelector('.success-message').style.display = 'block';
            setTimeout(() => {
                document.querySelector('.success-message').style.display = 'none';
                document.getElementById('emailForm').reset();
            }, 3000);
        })
        .catch(error => {
            document.querySelector('.loading').style.display = 'none';
            alert('Bir hata oluştu.');
        });
    });
</script>

</body>
</html>
