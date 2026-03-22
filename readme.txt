================================================================================
     MAVPOS - HỆ THỐNG QUẢN LÝ BÁN HÀNG TẠI CỬA HÀNG ĐIỆN THOẠI & PHỤ KIỆN
================================================================================

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
1. GIỚI THIỆU
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
MAVPOS là hệ thống ứng dụng web quản lý bán hàng theo mô hình Point of Sale 
(POS). Hệ thống được thiết kế đặc biệt để phục vụ cho nhân viên và quản trị 
viên, hỗ trợ tối ưu các nghiệp vụ như: bán hàng, quản lý sản phẩm, quản lý 
nhân sự và trích xuất báo cáo thống kê. 

Đây là mô hình vận hành được sử dụng rất phổ biến tại các cửa hàng bán lẻ 
ở Việt Nam.

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
2. TRIỂN KHAI & DEMO
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
- 🌐 Website chính thức : https://mavpos.id.vn/
- 🎬 Video Demo dự án   : 

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
3. TÀI KHOẢN ĐĂNG NHẬP
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
Hệ thống phân quyền chi tiết với các nhóm tài khoản sau:

[ 👤 Quản trị viên (Admin) ]
Sử dụng tài khoản mặc định để toàn quyền quản lý hệ thống:
- Username: admin
- Password: admin

[ 👤 Nhân viên (Staff) ]
- Được tạo và cấp phát bởi Admin.
- Đăng nhập lần đầu: Nhân viên sẽ nhận được một đường link qua email để thiết 
  lập và đăng nhập (Link này chỉ có hiệu lực trong vòng 1 phút để bảo mật).

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
4. HƯỚNG DẪN CHẠY DỰ ÁN (LOCAL SETUP)
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
[ Yêu Cầu Hệ Thống ]
- Hệ điều hành      : Windows hoặc macOS.
- Môi trường máy chủ: XAMPP (bao gồm Apache, MySQL, PHP).
- Trình duyệt       : Google Chrome, Firefox, hoặc Edge.

[ Các Bước Cài Đặt Chi Tiết ]

Bước 1: Khởi động môi trường XAMPP
- Tải XAMPP từ trang chủ (https://www.apachefriends.org) và cài đặt.
- Mở XAMPP Control Panel.
- Bật (Start) 2 module: Apache (Web Server) và MySQL (Database).
  *Lưu ý: Đảm bảo cổng 80 (Apache) và 3306 (MySQL) không bị xung đột với các 
   ứng dụng khác trên máy tính.

Bước 2: Lấy mã nguồn (Clone Source Code)
- Mở Terminal / Command Prompt và chạy lệnh:
  git clone https://gitlab.duthu.net/mav/mav-web-pos.git

Bước 3: Thiết lập Cơ sở dữ liệu (Database)
- Truy cập vào phpMyAdmin: http://localhost/phpmyadmin
- Tạo một database mới tên là: mavpos
- Import file cơ sở dữ liệu có sẵn tại đường dẫn: database/schema.sql

Bước 4: Cấu hình kết nối
- Mở file config/database.php trong thư mục mã nguồn.
- Cập nhật thông tin kết nối:
  define('DB_HOST', 'localhost');
  define('DB_NAME', 'mavpos');
  define('DB_USER', 'root');
  define('DB_PASS', '');

Bước 5: Chạy hệ thống
- Đặt project vào thư mục htdocs (của XAMPP).
- Truy cập vào trình duyệt bằng đường dẫn sau:
  http://localhost/mav-web-pos/source/public

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
5. CẤU TRÚC THƯ MỤC
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
Hệ thống được tổ chức theo mô hình MVC giúp tách biệt xử lý logic, dữ liệu và 
giao diện, từ đó dễ bảo trì và mở rộng.

source/
|
+-- app/        : Controllers, Models, Views, Core, Libs
+-- config/     : Các file cấu hình hệ thống
+-- database/   : Chứa file SQL (schema.sql)
+-- public/     : Entry point (index.php) và tài nguyên tĩnh (CSS, JS, Img)

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
6. CÔNG NGHỆ SỬ DỤNG
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
- Backend     : PHP thuần (Core PHP)
- Frontend    : HTML, CSS, JavaScript, Bootstrap, jQuery
- Database    : MySQL
- Kiến trúc   : Mô hình MVC
- Web Server  : Apache (qua XAMPP)

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
7. LƯU Ý QUAN TRỌNG
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
[ Lưu ý khi kiểm thử ]
- Project đã được deploy thành công, bạn có thể truy cập trực tiếp qua link ở 
  Mục 2 mà không cần cài đặt rườm rà.
- Hãy dùng tài khoản Admin (Mục 3) để test đầy đủ các chức năng.
- Khi chạy trên Localhost, BẮT BUỘC phải cấu hình đúng Database (Bước 4), 
  nếu không hệ thống sẽ báo lỗi không thể kết nối.

═════════════════════════════════════════════════════════════════════════════════
                                  END OF README
═════════════════════════════════════════════════════════════════════════════════