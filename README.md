# Lession2
# Giới thiệu
Mô hình:MVC.
Ngôn ngữ: PHP.
Database: mysql.
Công cụ: Xampp.
SVN: github.
# Cài đặt và cấu hình
Hướng dẫn cài đặt: Mở cmd, sử dụng lệnh git clone https://github.com/thaigiaduc/Lession2.git để clone code xuống. 
Sau đó cài đặt Xampp và đặt thư mục Lession2 vào folder htdocs. Start xampp với apache và mysql, sử dụng lệnh git checkout để qua branch test đây là branch chính.
Vào phpMyAdmin để quản lý database. Tạo ra database với tên tùy chọn ở đây em sử dụng tên de1-category, username là root và password là rỗng (có thể define lại ở thư mục configs/database.php). Tạo ra bảng categories hoặc có thể import file sql trong thư mục sql.
Nhập url http://localhost/Lession2/ để ra trang chính (ở đề không có require nên để như trang category nhưng ko có dữ liệu table). Nhập url http://localhost/Lession2/category hoặc http://localhost/Lession2/danh-muc để vào trang quản lý danh mục.
