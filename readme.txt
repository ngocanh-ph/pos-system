========================================================================
MAVPOS - HỆ THỐNG QUẢN LÝ BÁN HÀNG TẠI CỬA HÀNG ĐIỆN THOẠI VÀ PHỤ KIỆN
========================================================================

1. GIỚI THIỆU
MAVPOS là hệ thống web quản lý bán hàng tại cửa hàng điện thoại và phụ kiện
theo mô hình Point of Sale (POS). Hệ thống phục vụ cho nhân viên và quản trị viên,
hỗ trợ các chức năng như bán hàng, quản lý sản phẩm, nhân viên và báo cáo thống kê.
Mô hình này được sử dụng phổ biến trong các cửa hàng bán lẻ tại Việt Nam.

------------------------------------------------------------
2. LINK TRIỂN KHAI (DEPLOY)
Website: https://mavpos.id.vn/
------------------------------------------------------------

3. TÀI KHOẢN ĐĂNG NHẬP
Admin:
- Username: admin
- Password: admin

Nhân viên:
- Được tạo bởi admin
- Đăng nhập lần đầu qua link email (hiệu lực 1 phút)
------------------------------------------------------------

4. HƯỚNG DẪN CHẠY PROJECT (LOCAL)

Bước 1: Clone source code
https://gitlab.duthu.net/mav/mav-web-pos.git

Bước 2: Tạo và import database
- Mở phpMyAdmin
- Tạo database: mavpos (nếu chưa có)
- Import file: database/schema.sql

Bước 3: Cấu hình database
Mở file: config/database.php

Cập nhật thông tin kết nối:
define('DB_HOST', 'localhost');
define('DB_NAME', 'mavpos');
define('DB_USER', 'root');
define('DB_PASS', '');

Bước 4: Chạy hệ thống
- Đặt project vào thư mục htdocs (XAMPP)
- Truy cập:
  http://localhost/mav-web-pos/source/public
------------------------------------------------------------

5. VIDEO DEMO
Link video: 
------------------------------------------------------------

6. CẤU TRÚC THƯ MỤC
source/
│
├── app/       : Controllers, Models, Views, Core, Libs
├── config/    : Cấu hình hệ thống
├── database/  : File SQL
└── public/    : Entry point (index.php) và tài nguyên tĩnh

Ghi chú:
Hệ thống được tổ chức theo mô hình MVC giúp tách biệt xử lý logic,
dữ liệu và giao diện, từ đó dễ bảo trì và mở rộng.
------------------------------------------------------------

7. CÔNG NGHỆ SỬ DỤNG

- Backend  : PHP thuần 
- Frontend : HTML, CSS, JavaScript, Bootstrap, jQuery
- Database : MySQL
- Mô hình  : MVC
- Server   : Apache
------------------------------------------------------------

8. GHI CHÚ

- Không sử dụng framework theo yêu cầu đồ án
- Áp dụng cơ chế Routing (Front Controller)
- Có ràng buộc dữ liệu tại database để đảm bảo toàn vẹn
- Backend thực hiện kiểm tra và tính toán lại dữ liệu 
------------------------------------------------------------

9. LƯU Ý

- Project đã được deploy và có thể truy cập trực tiếp
- Sử dụng tài khoản admin để kiểm tra đầy đủ chức năng
- Khi chạy local cần cấu hình database như hướng dẫn
- Nếu không cấu hình đúng database, hệ thống sẽ không kết nối được
------------------------------------------------------------