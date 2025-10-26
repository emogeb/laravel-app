# 🚀 Production Deploy Checklist - Türk Teknik

## ✅ Yerel Değişiklikler (Tamamlandı)

- [x] Telefon numaraları güncellendi: `0546 911 80 61`
- [x] Marka adı değiştirildi: `Fast Teknik` → `Türk Teknik`
- [x] Email güncellendi: `info@turkteknik.com`
- [x] WhatsApp linkleri güncellendi
- [x] JSON-LD SEO güncellendi
- [x] PM2 config güncellendi: `turkteknik-ssr`
- [x] Tüm değişiklikler commit ve push edildi

---

## 🔴 Production'da Yapılması Gerekenler

### 1️⃣ Sunucuya Bağlan
```bash
ssh user@your-production-server
cd /var/www/laravel-app  # veya projenizin yolu
```

### 2️⃣ Kodu Çek
```bash
git pull origin main
```

### 3️⃣ .env Dosyasını Güncelle
```bash
nano .env
```

**Değiştirilmesi Gerekenler:**
```env
# ESKİ:
APP_NAME="Fast Teknik"
APP_URL=https://fastteknik.com

# YENİ:
APP_NAME="Türk Teknik"
APP_URL=https://turkteknik.com  # veya yeni domain
```

⚠️ **NOT:** `DB_DATABASE=fastteknik` **DEĞİŞTİRMEYİN!** (Veritabanı adı aynı kalmalı)

### 4️⃣ Dependencies ve Build
```bash
# Node dependencies
npm install

# Client-side build
npm run build

# SSR build
npm run build:ssr
```

### 5️⃣ Laravel Cache Temizle
```bash
php artisan config:clear
php artisan view:clear
php artisan cache:clear
php artisan route:cache
```

### 6️⃣ PM2 Yeniden Başlat

**Eski PM2 Process'i Sil:**
```bash
pm2 stop fastteknik-ssr
pm2 delete fastteknik-ssr
```

**Yeni PM2 Process Başlat:**
```bash
pm2 start ecosystem.config.cjs
pm2 save
pm2 list
```

**PM2 Logları Kontrol Et:**
```bash
pm2 logs turkteknik-ssr --lines 50
```

### 7️⃣ Nginx/Web Server Güncelle (Eğer Domain Değiştiyse)

**Nginx config:**
```bash
sudo nano /etc/nginx/sites-available/turkteknik.com
```

**Değiştirilecekler:**
```nginx
# ESKİ:
server_name fastteknik.com www.fastteknik.com;

# YENİ:
server_name turkteknik.com www.turkteknik.com;
```

**Nginx Restart:**
```bash
sudo nginx -t
sudo systemctl reload nginx
```

### 8️⃣ SSL Sertifikası (Eğer Domain Değiştiyse)

```bash
sudo certbot --nginx -d turkteknik.com -d www.turkteknik.com
```

---

## ✅ Doğrulama

### 1. SSR Çalışıyor mu?
```bash
curl http://127.0.0.1:13714
# Veya
pm2 status
# turkteknik-ssr online olmalı
```

### 2. Frontend Render Ediliyor mu?
```bash
curl https://turkteknik.com | grep "Türk Teknik"
# "Türk Teknik" metni görünmeli
```

### 3. Google Analytics ve Ads Çalışıyor mu?
- Sayfayı tarayıcıda aç
- Developer Tools → Network
- `gtag` isteklerini kontrol et
- `AW-17624637217` ve `G-2DW9PGYTDR` görünmeli

### 4. Telefon Numaraları Doğru mu?
- Ana sayfada: `0546 911 80 61`
- WhatsApp link: `905469118061`
- Footer: `+90 546 911 80 61`

---

## 🚨 Olası Sorunlar ve Çözümleri

### Sorun 1: PM2 "turkteknik-ssr" Bulunamıyor
**Çözüm:**
```bash
cd /var/www/laravel-app
pm2 start ecosystem.config.cjs
pm2 save
```

### Sorun 2: SSR Bundle Oluşmadı
**Çözüm:**
```bash
npm run build:ssr
ls -lah bootstrap/ssr/ssr.js  # Dosya var mı kontrol et
```

### Sorun 3: Eski Marka Adı Görünüyor
**Çözüm:**
```bash
# Cache temizle
php artisan config:clear
php artisan view:clear

# SSR yeniden başlat
pm2 restart turkteknik-ssr

# Browser cache temizle (Ctrl+Shift+R)
```

### Sorun 4: Google Ads Tracking Çalışmıyor
**Çözüm:**
1. Developer Console açın
2. `window.gtag` yazın, fonksiyon olmalı
3. Network tab'de `gtag.js` yüklenmiş mi kontrol edin

---

## 📊 Deploy Sonrası Kontroller

- [ ] Ana sayfa yükleniyor
- [ ] Telefon numaraları doğru (0546 911 80 61)
- [ ] Marka adı "Türk Teknik" görünüyor
- [ ] WhatsApp butonu çalışıyor
- [ ] Servis talep formu açılıyor
- [ ] SSR meta tagları dolu (View Source yaparak kontrol)
- [ ] Google Analytics çalışıyor
- [ ] Google Ads tracking çalışıyor
- [ ] PM2 online
- [ ] Nginx çalışıyor
- [ ] SSL sertifikası geçerli

---

## 📞 İletişim Bilgileri (Güncel)

- **Telefon:** 0546 911 80 61
- **WhatsApp:** +90 546 911 80 61
- **Email:** info@turkteknik.com
- **Marka:** Türk Teknik

---

## 🔄 Rollback (Geri Alma)

Eğer bir sorun olursa:

```bash
# Önceki commit'e dön
git log --oneline -5  # Önceki commit ID'sini bul
git reset --hard <commit-id>

# PM2 eski config ile başlat
pm2 delete turkteknik-ssr
# Eski ecosystem.config dosyasını geri getir
pm2 start ecosystem.config.cjs
```

---

**Son Güncelleme:** $(date)
**Hazırlayan:** AI Assistant

