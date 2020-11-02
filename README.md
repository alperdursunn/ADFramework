# ADFramework
 Php öğrenmeye başlayanlar ve zorluk yaşayanlar için kolaylaştırılmış bir mini framework

# Kullanımı
ADFramework.php isimli dosyayı proje klasörünüze atın ve kullanacağınız sayfalara dahil edin.

## Veritabanı İşlemleri
```php
//Veritabanına bağlanma
$baglan = baglan("host", "dbname", "username", "password");

//Veritabanına veri ekleme
$ekle = veriEkle($baglan, "tablo", array(stun isimleri), array(veriler));

//Veritabanından çoklu veri çek
$cek = veriCek($baglan, "tablo");
foreach($cek as $a){
 echo $cek['veriable'];
}

//Veritabanından tekli veri çek
$cek = veriCek($baglan, "tablo", "sorgu", "veri");
echo $cek->veriable;

//Veritabanından veri sil
$sil = veriSil($baglan, "tablo", "sorgu", "veri");

//Veritabanında veri güncelle
$guncelle = veriGuncelle($baglan, "tablo", array(stun isimleri), array(veriler), "sorgu", "veri");

//Veritabanındaki verileri say
echo veriSay($baglan, "tablo");
```
