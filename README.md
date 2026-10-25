# 🛒 MAVPOS

**Hệ thống quản lý bán hàng (POS) cho cửa hàng điện thoại & phụ kiện**

[![PHP](https://img.shields.io/badge/PHP-Core-777BB4?logo=php&logoColor=white)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-Database-4479A1?logo=mysql&logoColor=white)](https://www.mysql.com/)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-5-7952B3?logo=bootstrap&logoColor=white)](https://getbootstrap.com/)
[![Architecture](https://img.shields.io/badge/Architecture-MVC-0d6efd)](#-cấu-trúc-thư-mục)

[🌐 Website](https://mavpos.id.vn/) · [🎬 Video demo](https://youtu.be/XUnjpKDaIz0?si=_gls3KzaP9-unIie) · [✉️ Liên hệ](mailto:mavpos.project@gmail.com)

---

## 📋 Mục lục

1. [Giới thiệu](#-giới-thiệu)
2. [Tính năng](#-tính-năng)
3. [Tài khoản đăng nhập](#-tài-khoản-đăng-nhập)
4. [Cài đặt & chạy local](#-cài-đặt--chạy-local)
5. [Cấu trúc thư mục](#-cấu-trúc-thư-mục)
6. [Công nghệ](#-công-nghệ)
7. [Bảo mật](#-bảo-mật)
8. [Lưu ý khi kiểm thử](#-lưu-ý-khi-kiểm-thử)

---

## 📖 Giới thiệu

MAVPOS là ứng dụng web quản lý bán hàng theo mô hình **Point of Sale (POS)**, phục vụ nhân viên và quản trị viên: bán hàng, quản lý sản phẩm và tồn kho, quản lý nhân sự, và thống kê báo cáo. Đây là mô hình vận hành phổ biến tại các cửa hàng bán lẻ ở Việt Nam.

## ✨ Tính năng

| Nhóm | Chức năng | Admin | Nhân viên |
|---|---|:---:|:---:|
| **Bán hàng** | Tìm sản phẩm theo tên/mã vạch, giỏ hàng, thanh toán, in hóa đơn | – | ✅ |
| **Khách hàng** | Tự nhận diện khách theo SĐT, xem lịch sử mua hàng | ✅ | ✅ |
| **Sản phẩm** | Xem danh sách, tồn kho | ✅ | ✅ (không thấy giá nhập) |
| | Thêm / sửa / xóa, ảnh, giá nhập, tồn kho | ✅ | – |
| **Danh mục** | Quản lý danh mục sản phẩm | ✅ | – |
| **Nhân viên** | Tạo tài khoản qua email, khóa / mở khóa, xem lịch sử bán | ✅ | – |
| **Báo cáo** | Doanh thu, đơn hàng, biểu đồ theo giờ/ngày, theo danh mục | Toàn cửa hàng + lợi nhuận | Chỉ của mình |
| **Hồ sơ** | Đổi thông tin, ảnh đại diện, mật khẩu | ✅ | ✅ |

**Tồn kho:** hệ thống trừ kho tự động khi bán, từ chối đơn nếu không đủ hàng và không bao giờ cho tồn kho xuống dưới 0.

## 🔑 Tài khoản đăng nhập

| Vai trò | Cách có tài khoản | Ghi chú |
|---|---|---|
| 👑 **Quản trị viên** | Tài khoản mặc định `admin` / `admin` | ⚠️ Đổi mật khẩu ngay sau lần đăng nhập đầu tiên |
| 👤 **Nhân viên** | Do Admin tạo | Nhận email gồm link kích hoạt (hiệu lực **30 phút**) và mật khẩu tạm thời, sau đó bắt buộc đổi mật khẩu |

## 🚀 Cài đặt & chạy local

### Yêu cầu

- Windows hoặc macOS
- [XAMPP](https://www.apachefriends.org) (Apache, MySQL, PHP 7.4 trở lên)
- Trình duyệt Chrome, Firefox hoặc Edge

### Các bước

**1️⃣ Khởi động XAMPP**
Mở XAMPP Control Panel và **Start** hai module **Apache** và **MySQL**.

> 💡 Đảm bảo cổng `80` (Apache) và `3306` (MySQL) không bị ứng dụng khác chiếm.

**2️⃣ Lấy mã nguồn** vào thư mục `htdocs` của XAMPP

```bash
cd C:/xampp/htdocs
git clone https://gitlab.duthu.net/mav/mav-web-pos.git
```

**3️⃣ Tạo cơ sở dữ liệu**

1. Mở phpMyAdmin: <http://localhost/phpmyadmin>
2. Tạo database tên **`mavpos`** (bảng mã `utf8mb4`)
3. Chọn database vừa tạo, vào tab **Import** và chọn file `source/database/schema.sql`

**4️⃣ Cấu hình kết nối**

Sao chép file mẫu rồi điền thông tin của bạn:

```bash
cp source/config/config.local.example.php source/config/config.local.php
```

```php
<?php
define('DB_NAME', 'mavpos');
define('DB_USER', 'root');
define('DB_PASS', '');

// Dùng để gửi email kích hoạt cho nhân viên (Gmail App Password)
define('SMTP_USERNAME', 'ten@gmail.com');
define('SMTP_PASSWORD', 'app-password-gmail');

// Bật hiển thị lỗi khi phát triển (mặc định: tắt)
// define('APP_DEBUG', true);
```

> 🔒 `config.local.php` đã nằm trong `.gitignore`, **không bao giờ commit** file này.

**5️⃣ Chạy hệ thống**

Mở: <http://localhost/mav-web-pos/source/public>

> Nếu bạn đặt project ở đường dẫn khác, sửa `APP_URL` trong `config.local.php` và `RewriteBase` trong `source/public/.htaccess`.

### 🍎 Lưu ý khi chạy trên macOS

Cấp quyền ghi cho thư mục tải ảnh lên:

```bash
chmod -R 775 /Applications/XAMPP/xamppfiles/htdocs/mav-web-pos/source/public/uploads
```

Nếu vẫn lỗi quyền truy cập, có thể tạm dùng `777`:

```bash
chmod -R 777 /Applications/XAMPP/xamppfiles/htdocs/mav-web-pos/source/public/uploads
```

> ⚠️ `chmod 777` chỉ nên dùng trong môi trường local để debug.

## 📁 Cấu trúc thư mục

Dự án theo mô hình **MVC**, tách biệt xử lý logic, dữ liệu và giao diện để dễ bảo trì và mở rộng.

```text
source/
├── app/
│   ├── Controllers/   # Xử lý request, phân quyền
│   ├── Models/        # Truy vấn cơ sở dữ liệu (PDO)
│   ├── Views/         # Giao diện
│   ├── Core/          # Router, Controller/Model gốc, Security (CSRF, session)
│   └── Libs/          # PHPMailer
├── config/            # Cấu hình (config.php + config.local.php)
├── database/          # schema.sql
└── public/            # Entry point (index.php), uploads, tài nguyên tĩnh
```

## 🧰 Công nghệ

| Thành phần | Công nghệ |
|---|---|
| Backend | PHP thuần (Core PHP), PDO |
| Frontend | HTML, CSS, JavaScript, Bootstrap 5, jQuery, Chart.js |
| Cơ sở dữ liệu | MySQL / MariaDB |
| Gửi email | PHPMailer (SMTP) |
| Máy chủ | Apache (qua XAMPP) |

## 🛡️ Bảo mật

- Mật khẩu băm bằng `password_hash`; khóa tài khoản tạm thời sau 5 lần đăng nhập sai
- Bảo vệ **CSRF** cho mọi request thay đổi dữ liệu; cookie phiên `HttpOnly` + `SameSite`
- Truy vấn dùng prepared statements; dữ liệu hiển thị được escape để chống XSS
- Phân quyền Admin / Nhân viên được kiểm tra ở phía server, quyền được nạp lại từ DB ở mỗi request
- Ảnh tải lên được kiểm tra nội dung thật, đổi tên ngẫu nhiên, thư mục `uploads` không cho chạy script
- Đơn hàng được ghi trong transaction; giá luôn lấy từ DB, không tin dữ liệu từ trình duyệt

## 🧪 Lưu ý khi kiểm thử

- Bản đã deploy tại <https://mavpos.id.vn/> có thể dùng ngay, không cần cài đặt.
- Dùng tài khoản **Admin** để thử đầy đủ chức năng.
- Chạy local **bắt buộc** cấu hình đúng database (bước 4), nếu không hệ thống sẽ báo không thể kết nối.

---

<div align="center">

**MAVPOS** · Liên hệ hỗ trợ: [mavpos.project@gmail.com](mailto:mavpos.project@gmail.com)

</div>
