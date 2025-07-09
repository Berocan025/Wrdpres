# 🎨 Frontend Özelleştirme Kılavuzu - BERAT K

## 🎯 **ÖZELLİK AÇIKLAMASI**

Bu özellik ile müşterileriniz **sadece frontend alanlarında** (sipariş sayfaları ve e-postalar) kendi geliştirici/firma bilgilerini gösterebilir. **Admin paneli ve plugin kodları** tamamen **BERAT K** koruması altında kalır.

---

## 🔐 **KORUMA STRATEJİSİ**

### **✅ Özelleştirilebilir Alanlar (Frontend)**
- 📄 **Sipariş detay sayfaları**
- 📧 **E-posta şablonları** (pending & delivery)
- 🏠 **My Account lisans sayfası**

### **🔒 Korumalı Alanlar (Backend)**
- ⚙️ **Admin paneli** → %100 BERAT K
- 📝 **Plugin kodları** → %100 BERAT K  
- 🔑 **Lisans sistemi** → %100 BERAT K
- 🛡️ **Güvenlik sistemi** → %100 BERAT K

---

## 📋 **KULLANIM ADıMLARı**

### **1. Admin Paneline Giriş**
```
WordPress Admin → Lisans Anahtarları → Frontend Özelleştirme
```

### **2. Ayarları Açma**
```
☑️ "Özel geliştirici bilgilerini kullan" seçeneğini işaretleyin
```

### **3. Bilgi Girişi**
```
📝 Geliştirici/Firma Adı: Firma Adınız
📞 Telefon Numarası: 0XXX XXX XX XX  
💬 WhatsApp Linki: https://wa.me/90XXXXXXXXXX
📧 E-posta Adresi: info@firmaniz.com
```

### **4. Kaydetme**
```
💾 "Ayarları Kaydet" butonuna tıklayın
```

---

## 🖼️ **ÖNİZLEME SİSTEMİ**

Admin panelinde **canlı önizleme** mevcuttur:

### **Özel Bilgi Aktifken:**
```html
👨‍💻 Geliştirici: Firma Adınız
📱 Telefon: 0XXX XXX XX XX
📧 E-posta: info@firmaniz.com
💬 WhatsApp ile İletişim
```

### **Varsayılan (Kapalıyken):**
```html
👨‍💻 Geliştirici: BERAT K
📱 WhatsApp: 0539 511 56 32
```

---

## 📱 **FRONTEND GÖRÜNÜMLERİ**

### **1. Sipariş Detay Sayfası**
```url
https://siteniz.com/hesabim/siparisi-goruntule/1234/
```
**Müşteri kartı altında** özel bilgileriniz görünür.

### **2. E-posta Şablonları**

#### **📧 Pending E-postası:**
```
Subject: [Site] Ürün İçin Lisans Anahtarınız Hazırlanıyor ⏳

Body: 
"...24 saat içinde hazırlanacak..."

Footer: [Özel geliştirici bilgileriniz]
```

#### **📧 Delivery E-postası:**
```
Subject: [Site] Ürün İçin Lisans Anahtarınız 🔑

Body:
"...lisans anahtarınız: [KEY]..."

Footer: [Özel geliştirici bilgileriniz]
```

### **3. My Account Sayfası**
```url
https://siteniz.com/hesabim/license-keys/
```
**Footer alanında** özel bilgileriniz görünür.

---

## ⚙️ **TEKNİK DETAYLAR**

### **Database Seçenekleri:**
```php
ald_frontend_show_custom    → 1/0 (aktif/pasif)
ald_frontend_dev_name       → "Firma Adınız"  
ald_frontend_dev_phone      → "0XXX XXX XX XX"
ald_frontend_dev_whatsapp   → "https://wa.me/90XXX"
ald_frontend_dev_email      → "info@firma.com"
```

### **PHP Fonksiyonu:**
```php
// Özel bilgi kontrolü
$this->get_frontend_developer_info('style');

// Stiller: 'footer', 'email', 'default'
```

### **CSS Classları:**
```css
.ald-developer-footer    → Footer container
.ald-whatsapp-btn       → WhatsApp butonu
```

---

## 🛠️ **MANUEL KOD ÖRNEĞİ**

Tema dosyalarınızda manuel kullanım:

```php
<?php
// Plugin aktif kontrolü
if (class_exists('AutoLicenseDelivery')) {
    $plugin = AutoLicenseDelivery::get_instance();
    
    // Özel geliştirici bilgisi varsa göster
    if (get_option('ald_frontend_show_custom', 0)) {
        $name = get_option('ald_frontend_dev_name', '');
        $phone = get_option('ald_frontend_dev_phone', '');
        echo "Geliştirici: " . $name . " - " . $phone;
    } else {
        echo "Geliştirici: BERAT K - 0539 511 56 32";
    }
}
?>
```

---

## 🔍 **TEST SENARYOLARı**

### **Test 1: Özelleştirme Kapalı**
1. ☐ Admin'de checkbox işaretsiz
2. ☐ Sipariş sayfası → "BERAT K" görünmeli
3. ☐ E-posta → "BERAT K" görünmeli

### **Test 2: Özelleştirme Açık**
1. ☑️ Admin'de checkbox işaretli  
2. ☑️ Firma bilgileri dolu
3. ☐ Sipariş sayfası → "Firma adı" görünmeli
4. ☐ E-posta → "Firma adı" görünmeli

### **Test 3: Kısmi Bilgi**
1. ☑️ Sadece firma adı dolu
2. ☐ Telefon/e-posta boş
3. ☐ Sadece firma adı görünmeli

---

## 🚨 **ÖNEMLİ UYARILAR**

### **❌ Yapılmaması Gerekenler:**
- Admin panelindeki BERAT K bilgilerini değiştirmeye çalışmak
- Plugin kodlarını directly editlemek  
- Güvenlik dosyalarına müdahale etmek

### **✅ Güvenli Kullanım:**
- Sadece admin panelindeki ayarları kullanmak
- Frontend özelleştirmesiyle yetinmek
- Original plugin dosyalarını korumak

---

## 📞 **DESTEK ve İLETİŞİM**

### **BERAT K - Plugin Geliştiricisi**
- 📱 **WhatsApp:** +90 539 511 56 32
- 🔗 **Link:** https://wa.me/905395115632
- 💼 **Hizmetler:** Plugin geliştirme, özelleştirme, destek

### **Destek Konuları:**
- ✅ Frontend özelleştirme sorunları
- ✅ E-posta şablonu problemleri  
- ✅ Admin panel ayarları
- ✅ Yeni özellik talepleri

---

## 📊 **ÖRNEK KULLANIM ALANLARI**

### **1. Ajans Kullanımı**
```
Ajans Adı: "Digital Marketing Pro"
Telefon: "0212 XXX XX XX"
E-posta: "info@digitalmarketingpro.com"
```
**Sonuç:** Müşteriler ajansı geliştirici olarak görür.

### **2. Freelancer Kullanımı**
```
Geliştirici: "Ahmet Yılmaz - Web Developer"  
Telefon: "0535 XXX XX XX"
WhatsApp: "https://wa.me/905XXXXXXXXX"
```
**Sonuç:** Müşteriler freelancer'ı geliştirici olarak görür.

### **3. Firma Kullanımı**
```
Firma: "TechSoft Solutions Ltd."
Telefon: "0312 XXX XX XX"  
E-posta: "destek@techsoft.com.tr"
```
**Sonuç:** Müşteriler firmayı geliştirici olarak görür.

---

## 🎯 **BAŞARI KRİTERLERİ**

✅ **Frontend başarıyla özelleştirildi**  
✅ **Admin paneli BERAT K koruması devam ediyor**  
✅ **E-postalar özel bilgilerle gönderiliyor**  
✅ **Sipariş sayfaları branded görünüyor**  
✅ **Güvenlik sistemi aktif çalışıyor**

---

**© 2024 BERAT K - Plugin Developer**  
**Bu özellik BERAT K tarafından geliştirilmiştir.**  
**Backend hakları tamamen BERAT K'ya aittir.**