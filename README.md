
<p align="center">
  <img src="/public/assets/img/Background.png" alt="Diamond Online Banner" width="80%" />
</p>

<h1 align="center">💎 Diamond Online - Hệ thống đặt phòng khách sạn</h1>

<p align="center">
  <b>Một hệ thống đặt phòng khách sạn cao cấp, hiện đại, trực quan - xây dựng bằng PHP thuần</b><br/>
  <i>Không sử dụng thư viện ngoài • Tối ưu học tập và triển khai thực tế</i>
</p>

---

## ✨ Giới thiệu

**Diamond Online** là nền tảng đặt phòng khách sạn với thiết kế đơn giản, thân thiện và tính năng đầy đủ.  
Hệ thống hỗ trợ người dùng tra cứu phòng, đặt phòng theo thời gian thực và hỗ trợ quản lý chi tiết qua trang quản trị.

> Dự án phù hợp với sinh viên đang tìm hiểu lập trình web muốn học về PHP thuần theo mô hình MVC.

---



## 🧩 Tính năng nổi bật

### 👤 Người dùng
- Xem danh sách phòng theo bộ lọc (giá, diện tích, tiện nghi,...)
- Đặt phòng theo ngày check-in / check-out, số lượng người
- Tự động kiểm tra phòng trống
- Đăng ký / đăng nhập hệ thống

### 🛠️ Quản trị viên (Admin)
- Quản lý phòng, loại phòng, tiện nghi
- Duyệt hoặc hủy đặt phòng
- Quản lý người dùng, khách lưu trú, giao dịch
- Xem lịch sử booking & thống kê doanh thu

---

## ⚙️ Công nghệ sử dụng

| Công nghệ  | Mô tả                             |
|------------|-----------------------------------|
| PHP        | Xử lý logic backend               |
| MySQL      | Lưu trữ và truy vấn dữ liệu       |
| HTML/CSS   | Tạo giao diện người dùng          |
| JavaScript | Tương tác client (form, filter...)|

---

## 🚀 Hướng dẫn cài đặt

### 1. Yêu cầu
- ✅ PHP >= 7.4
- ✅ MySQL hoặc MariaDB
- ✅ [XAMPP](https://www.apachefriends.org)
- ✅ Trình duyệt Chrome, Firefox, Edge...

### 2. Các bước cài đặt

```bash
# Bước 1: Tải mã nguồn
git clone https://github.com/nguyentrongduc2005/hotel_booking_online.git

# Bước 2: Di chuyển vào thư mục htdocs của XAMPP
mv diamond-online-booking/ /xampp/htdocs/
```

- Mở XAMPP → Start Apache & MySQL
- Truy cập `http://localhost/phpmyadmin`
- Tạo database `hotel` → Import file `hotel.sql` trong thư mục `/database/`
- Mở file `core/db.php` và sửa:
```php
private $host = 'localhost';
private $dbName = 'hotel';
private $username = 'root';
private $password = '';
```

### 3. Truy cập hệ thống

- Trang người dùng: `http://localhost/diamond-online`
- Trang admin: `http://localhost/diamond-online/admin`

**Tài khoản mặc định:**

```
Username: admin
Password: 123456
```

---

## 👨‍💻 Tác giả

- **NAME** 
- **GitHub:** [(https://github.com/yourusername)](https://github.com/nguyentrongduc2005/hotel_booking_online.git)

---

## 📚 Tài liệu tham khảo

- [W3Schools - PHP](https://www.w3schools.com/php/)
- [MDN Web Docs](https://developer.mozilla.org/)
- [MySQL Docs](https://dev.mysql.com/doc/)
- Cộng đồng Viblo, VietnamDev, Stack Overflow

---

## 🛡️ Giấy phép

Dự án này được phát triển với mục đích **học tập, nghiên cứu phi thương mại**.  
Vui lòng ghi rõ nguồn nếu sử dụng lại một phần hoặc toàn bộ dự án.

---
