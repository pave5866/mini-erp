# Mini ERP Sistemi

<p align="center">
<img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
</p>

![minierpresim](https://github.com/user-attachments/assets/a42bd43c-4cb6-41ac-b1b6-b60f55f1e9b9)

## Proje Hakkında

Bu proje, küçük ve orta ölçekli işletmeler için geliştirilmiş mini bir ERP (Kurumsal Kaynak Planlama) sistemidir. Laravel framework'ü kullanılarak geliştirilmiştir ve temel iş süreçlerini yönetmek için gerekli modülleri içermektedir.

## Özellikler

- **Kullanıcı Yönetimi**: Rol tabanlı yetkilendirme sistemi
- **Stok Yönetimi**: Ürün takibi, stok hareketleri
- **Satış Yönetimi**: Siparişler, faturalar, müşteri takibi
- **Satın Alma Yönetimi**: Tedarikçi yönetimi, satın alma siparişleri
- **Finans Yönetimi**: Gelir-gider takibi, raporlama
- **Raporlama**: Çeşitli iş süreçleri için detaylı raporlar

## Sistem Gereksinimleri
- PHP >= 8.1
- Composer
- MySQL veya başka bir veritabanı sistemi
- Node.js ve NPM (frontend varlıkları için)
## Kullanım
Sisteme giriş yaptıktan sonra, sol menüden ilgili modüllere erişebilirsiniz. Her modül kendi içinde alt bölümlere ayrılmıştır ve kullanıcı rolüne göre erişim hakları değişmektedir.

## Geliştirme
Projeye katkıda bulunmak istiyorsanız:

1. Bu repository'yi fork edin
2. Yeni bir branch oluşturun ( git checkout -b yeni-ozellik )
3. Değişikliklerinizi commit edin ( git commit -m 'Yeni özellik eklendi' )
4. Branch'inizi push edin ( git push origin yeni-ozellik )
5. Pull Request oluşturun
## Lisans
Bu proje MIT lisansı altında lisanslanmıştır. Daha fazla bilgi için LICENSE dosyasını inceleyin.


## Kurulum

Projeyi yerel geliştirme ortamınıza kurmak için aşağıdaki adımları izleyin:

```bash
# Projeyi klonlayın
git clone https://github.com/kullaniciadi/mini-erp.git

# Proje dizinine gidin
cd mini-erp

# Bağımlılıkları yükleyin
composer install

# .env dosyasını oluşturun
cp .env.example .env

# Uygulama anahtarını oluşturun
php artisan key:generate

# Veritabanı tablolarını oluşturun
php artisan migrate

# (Opsiyonel) Örnek verileri yükleyin
php artisan db:seed
```
