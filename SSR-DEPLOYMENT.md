# Fast Teknik - SSR Production Deployment

## 🚀 İlk Kurulum

### 1. Sunucuda Gereksinimler
```bash
# PM2 kurulumu (global)
npm install -g pm2

# Node.js minimum v18 (önerilen v20+)
node --version
```

### 2. Proje Dependencies
```bash
cd /var/www/laravel-app

# Production dependencies yükle
npm install --production

# Eğer dev dependencies de gerekiyorsa (build için)
npm install
```

### 3. Build
```bash
# Tüm asset'leri build et
npm run build:ssr

# Dosyaların oluştuğunu kontrol et
ls -la bootstrap/ssr/ssr.js
ls -la bootstrap/ssr/ssr-manifest.json
ls -la public/build/manifest.json
```

### 4. .env Ayarları
```env
# SSR'ı aktif et
INERTIA_SSR_ENABLED=true
INERTIA_SSR_URL=http://127.0.0.1:13714

# Production
NODE_ENV=production
APP_ENV=production
```

### 5. Laravel Cache Temizleme
```bash
php artisan config:clear
php artisan view:clear
php artisan route:cache
php artisan optimize
```

### 6. PM2 ile SSR Başlatma
```bash
# SSR sunucusunu başlat
pm2 start ecosystem.config.cjs

# Durum kontrolü
pm2 status

# Online olduğunu doğrula
pm2 logs fastteknik-ssr --lines 20
```

### 7. Kalıcı Hale Getirme
```bash
# Sistem başlangıcında otomatik başlat
pm2 startup
# (Çıkan komutu çalıştır)

# Mevcut durumu kaydet
pm2 save
```

## 🔄 Güncelleme (Deployment)

### Yöntem 1: Manuel
```bash
cd /var/www/laravel-app

# 1. Kodu güncelle
git pull origin main

# 2. Dependencies güncelle
npm install --production

# 3. Build
npm run build:ssr

# 4. Laravel cache temizle
php artisan config:clear
php artisan view:clear

# 5. SSR restart
pm2 restart fastteknik-ssr

# 6. Durum kontrol
pm2 status
pm2 logs fastteknik-ssr --lines 20
```

### Yöntem 2: Deployment Script
```bash
# Tek komut
./deploy-ssr.sh
```

## ✅ SSR Doğrulama

### 1. PM2 Durum Kontrolü
```bash
pm2 status
# fastteknik-ssr | online olmalı

pm2 logs fastteknik-ssr
# "Inertia SSR server started." mesajı olmalı
```

### 2. Port Kontrolü
```bash
lsof -i :13714
# node process çalışıyor olmalı

curl http://127.0.0.1:13714/health
# {"status":"OK","timestamp":...}
```

### 3. Laravel SSR Test
```bash
# HTML'i al
curl -s https://yourdomain.com | head -100

# Meta tagları kontrol et
curl -s https://yourdomain.com | grep -E '<meta (name|property)="(description|og:)'
```

**SSR Çalışıyorsa:**
- Meta taglar HTML'de direkt görünür
- `<meta property="og:title">`, `<meta name="description">` vs.

**SSR Çalışmıyorsa:**
- Sadece `<div id="app" data-page="..."></div>` görünür
- Meta taglar yok

### 4. Browser Test
```javascript
// Chrome DevTools > Network
// Document response'u incele
// HTML'de meta taglar var mı?

// View Source (Ctrl+U)
// <meta property="og:title"> görünüyor mu?
```

## 🔧 Sorun Giderme

### SSR Sunucusu Başlamıyor
```bash
# Logları kontrol et
pm2 logs fastteknik-ssr --err

# Manuel test
cd /var/www/laravel-app
node bootstrap/ssr/ssr.js

# Port kullanımda mı?
lsof -i :13714
kill -9 <PID>
```

### Script Not Found
```bash
# bootstrap/ssr/ssr.js var mı?
ls -la bootstrap/ssr/ssr.js

# Yoksa tekrar build
npm run build:ssr

# Manifest var mı?
ls -la public/build/manifest.json
```

### Memory Limit
```bash
# ecosystem.config.cjs'de ayarla
max_memory_restart: '300M'  # 500M yap

# Restart
pm2 restart fastteknik-ssr
```

### Port Değiştirme
```bash
# ecosystem.config.cjs
env: {
  SSR_PORT: 13715  # Yeni port
}

# .env
INERTIA_SSR_URL=http://127.0.0.1:13715

# Restart
pm2 restart fastteknik-ssr
php artisan config:clear
```

## 📊 Monitoring

### PM2 Commands
```bash
# Real-time monitor
pm2 monit

# Tüm loglar
pm2 logs

# Sadece SSR
pm2 logs fastteknik-ssr

# Son 50 satır
pm2 logs fastteknik-ssr --lines 50

# Sadece errors
pm2 logs fastteknik-ssr --err
```

### Log Dosyaları
```bash
# PM2 logs
tail -f ./storage/logs/ssr-out.log
tail -f ./storage/logs/ssr-error.log

# Laravel logs
tail -f ./storage/logs/laravel.log
```

## 🔒 Security

### Firewall
```bash
# SSR port'u sadece localhost'tan erişilebilir
# 13714 portunu dışarıya açma!

# Nginx/Apache Laravel'e proxy yapsın
# SSR sunucusu internal olarak kalmalı
```

### Permissions
```bash
# PM2 non-root user ile çalışmalı
pm2 startup
# User: www-data veya laravel

# Dosya izinleri
chown -R www-data:www-data /var/www/laravel-app
chmod -R 755 /var/www/laravel-app
```

## 📈 Performance

### Multiple Instances (Opsiyonel)
```javascript
// ecosystem.config.cjs
{
  instances: 2,  // CPU core sayısına göre
  exec_mode: 'cluster'
}
```

### Cache
```bash
# Laravel cache
php artisan route:cache
php artisan config:cache
php artisan view:cache

# OPcache aktif
php -i | grep opcache.enable
```

## 🆘 Emergency - SSR Devre Dışı

```bash
# .env
INERTIA_SSR_ENABLED=false

# Cache temizle
php artisan config:clear

# Site hala çalışır, sadece SSR olmadan
# SEO meta tagları blade'den gelir
```

## ✨ Özet Checklist

- [ ] PM2 kuruldu
- [ ] `npm run build:ssr` başarılı
- [ ] `bootstrap/ssr/ssr.js` var
- [ ] `pm2 start ecosystem.config.cjs` çalıştı
- [ ] `pm2 status` - fastteknik-ssr **online**
- [ ] `curl http://127.0.0.1:13714/health` - OK
- [ ] HTML'de meta taglar görünüyor
- [ ] `pm2 save` yapıldı
- [ ] Sistem startup'ında otomatik başlıyor

Hepsi ✅ ise SSR production'da çalışıyor! 🎉

