# 🔒 BERAT K - Eklenti Koruma Sistemi

## 🎯 **GÜVENLİK KATMANları**

### **1. 📁 Dosya Yapısı Koruması**
```
auto-license-delivery/
├── auto-license-delivery.php (Ana dosya - Şifrelenmiş)
├── includes/
│   ├── security-protection.php (Güvenlik katmanı)
│   ├── functions.php (Yardımcı fonksiyonlar)
│   └── woocommerce.php (WooCommerce entegrasyonu)
└── readme.txt
```

### **2. 🔐 Ana Koruma Yöntemleri**

#### **A) AES-256 Şifreleme**
- Geliştirici bilgileri şifrelenmiş
- Hash tabanlı doğrulama
- Dinamik anahtar sistemi

#### **B) Domain Bazlı Lisans**
```php
// Yetkili domainler (hash'lenmiş)
$authorized_domains = array(
    hash('sha256', 'unrivaled.store'),
    hash('sha256', 'localhost'),
    hash('sha256', '127.0.0.1')
);
```

#### **C) Dosya Bütünlük Kontrolü**
- SHA-256 hash kontrolü
- Otomatik değişiklik tespiti
- Güvenlik ihlali logları

#### **D) Anti-Tampering Sistemi**
- Kod değişikliği algılama
- Otomatik plugin deaktivasyonu
- Remote uyarı sistemi

### **3. 🛡️ Koruma Seviyelerine Göre Tepkiler**

#### **Seviye 1: Uyarı** ⚠️
- Yetkisiz domain kullanımı
- Küçük dosya değişiklikleri

#### **Seviye 2: Engelleme** 🚫
- Kritik kod değişikliği
- Geliştirici bilgisi değiştirilmesi

#### **Seviye 3: Deaktive** ❌
- Güvenlik sistemi bypass edilmesi
- Lisans anahtarı değiştirilmesi

### **4. 🔧 Kullanım Kılavuzu**

#### **Yeni Domain Ekleme:**
```php
// security-protection.php içinde
$this->authorized_domains[] = hash('sha256', 'yeni-domain.com');
```

#### **Lisans Anahtarı Güncelleme:**
```php
// wp-admin/options.php üzerinden
update_option('ald_license_key_hash', hash('sha256', 'YENİ-LİSANS-ANAHTARI'));
```

#### **Güvenlik Loglarını İnceleme:**
```php
$logs = get_option('ald_security_logs', array());
foreach ($logs as $log) {
    echo "Tip: " . $log['type'] . " - Tarih: " . $log['timestamp'];
}
```

### **5. 🚨 Güvenlik İhlali Durumunda**

#### **Otomatik Tepkiler:**
1. **Plugin deaktive edilir**
2. **Admin panelde uyarı gösterilir**
3. **Güvenlik logu kaydedilir**
4. **Sahte geliştirici bilgisi gösterilir**

#### **Manuel Müdahale:**
1. Orijinal dosyaları yeniden yükleyin
2. Güvenlik loglarını kontrol edin
3. Yetkisiz erişimi engelleyin

### **6. ⭐ Gelişmiş Özellikler**

#### **A) Dinamik Şifreleme**
```php
// Her seferinde farklı şifreleme anahtarı
$security_key = hash('sha256', date('Y-m-d') . 'BERAT_K_SECRET');
```

#### **B) Remote Doğrulama** (Opsiyonel)
```php
// Lisans sunucusuna bağlantı
wp_remote_post('https://beratk-licenses.com/verify', $license_data);
```

#### **C) Zaman Bazlı Kontrol**
```php
// Günlük güvenlik kontrolü
if (time() - get_option('last_security_check') > 86400) {
    $this->security_check();
}
```

### **7. 🔒 Kod Örneği - Korumalı Geliştirici Bilgisi**

```php
<?php
// Normal kod (kolay değiştirilebilir)
echo "Geliştirici: BERAT K - 0539 511 56 32";

// Korumalı kod (şifrelenmiş)
$security = BeratKSecurityProtection::get_instance();
echo $security->display_secure_developer_info('footer');
?>
```

### **8. 📱 Müşteri Yönetimi**

#### **Lisanslı Müşteriler:**
- ✅ **unrivaled.store** - Tam lisans
- ✅ **localhost** - Geliştirme lisansı
- ❌ **Diğer domainler** - Yetkisiz

#### **Lisans Türleri:**
- **Tam Lisans:** Tüm özellikler aktif
- **Geliştirme Lisansı:** Localhost'ta çalışır
- **Demo Lisansı:** 30 gün sınırlı

### **9. 🛠️ Sorun Giderme**

#### **Problem:** Plugin çalışmıyor
**Çözüm:**
```php
// wp-config.php'ye ekleyin
define('ALD_DEBUG_MODE', true);
```

#### **Problem:** Güvenlik uyarısı alıyorum
**Çözüm:**
1. Domain'i yetkili listesine ekleyin
2. Lisans anahtarını kontrol edin

#### **Problem:** Dosya değişikliği uyarısı
**Çözüm:**
```php
// Hash'i sıfırlayın
delete_option('ald_file_hash');
```

### **10. 📞 Destek İletişim**

**BERAT K**
- 📱 **WhatsApp:** +90 539 511 56 32
- 🔗 **Link:** https://wa.me/905395115632
- 💼 **Hizmetler:** Plugin geliştirme, güvenlik, özelleştirme

---

## ⚡ **Hızlı Kurulum**

1. **Plugin dosyalarını yükleyin**
2. **Domain'i authorize edin**
3. **Lisans anahtarını girin**
4. **Güvenlik testini çalıştırın**

```bash
# Test komutu
wp eval "echo BeratKSecurityProtection::get_instance()->get_security_status();"
```

---

**© 2024 BERAT K - Tüm hakları saklıdır**
**Bu koruma sistemi BERAT K tarafından geliştirilmiştir.**