# Ứng Dụng Thi Trắc Nghiệm - HPC

## Giới Thiệu
Đây là một ứng dụng thi trắc nghiệm dành cho sinh viên của trường Cao Đẳng Công Nghệ Bách Khoa Hà Nội (HPC). Ứng dụng được phát triển nhằm giúp nhà trường tổ chức các kỳ thi một cách hiệu quả, với các tính năng quản lý kỳ thi, ca thi, đề thi, câu hỏi... và kết quả thi.

## Công Nghệ Sử Dụng
- **Backend**: Laravel 11 (PHP Framework)
- **Frontend**: HTML, CSS, JavaScript
- **Cơ sở dữ liệu**: MySQL
- **Client-Side**: C#
- **API Authentication**: Laravel Sanctum

## Chức Năng
1. **Quản lý sinh viên**: Thêm, sửa, xóa sinh viên.
2. **Quản lý câu hỏi thi**: Thêm câu hỏi, cập nhật và xóa câu hỏi.
3. **Tổ chức kỳ thi**: Tạo kỳ thi, gán câu hỏi cho kỳ thi và phân công sinh viên tham gia.
4. **Tính điểm tự động**: Tính toán và lưu trữ điểm của sinh viên sau khi hoàn thành bài thi.
5. **Hệ thống đăng nhập bảo mật**: Sử dụng Laravel Sanctum để xác thực người dùng.
6. **API RESTful**: Tích hợp API cho ứng dụng thi, cho phép sử dụng trên nhiều nền tảng.

## Cài Đặt và Cấu Hình

```bash
git clone [https://github.com/your-repo-url/hpc-thi-trac-nghiem.git](https://github.com/copecute/trac-nghiem-hpc.git)
cd hpc-thi-trac-nghiem
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```
## Cấu Trúc Dự Án
- app/Models: Chứa các model như SinhVien, CauHoi, KyThi, ...
- app/Http/Controllers: Chứa các controller điều khiển logic.
- resources/views: Chứa các view blade cho giao diện người dùng.
- routes/web.php: Định nghĩa các route web.
- routes/api.php: Định nghĩa các route API cho ứng dụng.

## Thực Hiện Test
Chạy tất cả các Unit và Feature test với lệnh:
```bash
php artisan test
```
## License
sắp có
