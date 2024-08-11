# SendMail - PHPMailer Toplu E-posta Gönderim Scripti

## Türkçe

Bu proje, PHPMailer kullanarak toplu e-posta gönderimi yapmanıza olanak tanıyan bir PHP betiği içerir. E-postaları bir dosyadan veya doğrudan formdan yükleyerek gönderebilirsiniz. Bu script, kişiselleştirilmiş mesajlar ve sabit bir HTML e-posta şablonu kullanarak e-postalarınızı göndermenizi sağlar.

### Kurulum

1. **PHPMailer'i Yükleyin**
   
   ```bash
   composer require phpmailer/phpmailer
   ```

Proje dosyalarını web sunucunuzun ana dizinine kopyalayın.

   ```bash
cp -r * /path/to/your/webroot/
```
Düzenle
```php 
$mail->Host = 'mail.yourdomain.com'; // SMTP sunucusu
$mail->Username = 'mail@yourdomain.com'; // SMTP kullanıcı adı
$mail->Password = 'yourpassword'; // SMTP şifresi
```

Kullanım
E-posta Gönderimi

Web tarayıcınızdan index.php sayfasına gidin ve e-posta gönderme işlemini başlatın.

Dosya Yükleme

E-posta adreslerini ve isimleri içeren bir dosya yükleyin veya doğrudan formu kullanarak e-posta adreslerini girin.

Mesaj ve Konu Ayarları

Gönderim sırasında mesajınız ve konu başlığınız belirleyin.

# SendMail - PHPMailer Bulk Email Sending Script

## Engilish

This project includes a PHP script that allows you to send bulk emails using PHPMailer. You can send emails by uploading them from a file or directly from the form. This script allows you to send your emails using personalized messages and a fixed HTML email template.

### Setup

1. **Install PHPMailer**
   
   ```bash
   composer require phpmailer/phpmailer
   ```

Copy the project files to your web server's home directory.

   ```bash
cp -r * /path/to/your/webroot/
```
Edit
```php 
$mail->Host = 'mail.yourdomain.com'; //SMTP server
$mail->Username = 'mail@yourdomain.com'; //SMTP username
$mail->Password = 'yourpassword'; // SMTP password
```

Use
Email Sending

Go to index.php from your web browser and start sending emails.

File Upload

Upload a file with email addresses and names or enter email addresses directly using the form.

Message and Topic Settings

Determine your message and subject title when sending.

# ArX Developers


  
![Logo](https://arxdevelopers.github.io/assets/img/arx-logo.png)

    