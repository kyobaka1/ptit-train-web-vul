# ptit-train-web-vul
PTITHCM-IS Trainning là ứng dụng web trên nền tảng PHP/MySQL. Phục vụ quá trình nghiên cứu và thực hành các lỗ hổng trên website.
Đồ án tốt nghiệp:
- Sinh viên: Đoàn Ngọc Vương
- GVHD: Huỳnh Trọng Thưa
# Những lưu ý trong quá trình cài đặt
Ứng dụng phục vụ quá trình học tập, nghiên cứu, thực hành những lỗ hổng trên website. Nên ứng dụng cũng tồn tại những lỗ hổng này.
Do đó, ứng dụng được triển khai bằng cách cung cấp mã nguồn mở và cho phép mỗi người dùng cài đặt và thiết lập máy chủ theo ý của mình. 
Khi người dùng tấn công, kiểm thử trên máy chủ của mình. Sẽ không gặp phải những khó khăn trong trách nhiệm với pháp luật, có thể tuỳ chỉnh cấu hình, mã nguồn theo ý nghĩ của bản thân.
**Lưu ý**: Không nên cài đặt và triển khai ứng dụng trên máy chủ để cung cấp cho người dùng khác. Những lỗ hổng có thể dẫn đến việc người dùng có thể chiếm quyền kiểm soát máy chủ.
# Nền tảng Linux / Ubuntu
##	Bước 1: Chuẩn bị máy chủ
Hãy cài đặt và chuẩn bị một máy Linux hoặc Ubuntu, có thể là máy ảo hoặc máy thật.
Hướng dẫn ở ubuntu tutorials:
> https://tutorials.ubuntu.com/tutorial/tutorial-install-ubuntu-desktop
Cấu hình tối thiểu cho máy chủ là:
•	RAM: 512 Mb
•	Bộ nhớ: 20Gb
##	Bước 2: Cài đặt Apache2
Apache (Apache HTTP Server) là một chương trình trên máy chủ đối thoại qua giao thức HTTP, là một trong những phần mềm phổ biến nhất thế giới.
Nhiệm vụ chính của Apache là thiết lập kết nối giữa máy chủ và trình duyệt của người dùng, sau đó chịu trách nhiệm chuyển thông tin qua lại giữa máy chủ và trình duyệt.
Cài đặt Apache2 theo câu lệnh:
> sudo apt-get update && sudo apt-get install apache2 –y

Có thể tìm hiểu thêm về cấu hình tuỳ ý theo mong muốn của bạn.
## Bước 3: Cài đặt PHP và những thư viện hỗ trợ
Bằng câu lệnh sau:
> sudo apt-get install -y php libapache2-mod-php php-mcrypt php-mysql php-cli

## Bước 4: Cài đặt MySQL
Cài đặt MySQL server bằng câu lệnh:
> sudo apt-get install mysql-server

Sau đó, ta vào mysql để setup những thông tin cấu hình cơ bản cho ứng dụng cần thiết bao gồm:
•	Database
•	Username/Password của tài khoản có quyền trên database đó.
Theo hướng dẫn:
```sql
mysql -u root –p
CREATE DATABASE ptittrain;
GRANT ALL PRIVILEGES ON ptittran.* TO 'ptit_user'@'localhost' IDENTIFIED BY '123';
FLUSH PRIVILEGES;
exit;
```
## Bước 5: Khởi động lại các service để thay đổi thông tin đã cấu hình
> sudo service apache2 restart

## Bước 6: Tải source mã nguồn từ github và cài đặt.
Có 2 cách để tải mã nguồn ứng dụng về từ github, đó là dowload file zip về theo cách truyền thống bằng trình duyệt theo đường dẫn:
> https://github.com/kyobaka1/ptit-train-web-vul

Hoặc thực hiện cài đặt và sử dụng phần mềm git:
```bash
Sudo apt-get install git
cd ~/Desktop && git clone https://github.com/kyobaka1/ptit-train-web-vul.git
sudo mv –R ptit-train-web-vul/* /var/www/html
sudo chown  -R www-data:www-data /var/www/html
sudo chmod 755 –R /var/www/html
```

Những câu lệnh trên sẽ dowload mã nguồn từ git về, sau đó chuyển nó vào thư mục web root hiện hành là /var/www/html rồi cấp quyền thư mục cho user www-data có thể thao tác. Bởi vì quyền mặc định của /var là của user root.
# Nền tảng Windows
## Bước 1: Chuẩn bị máy chủ
Cài đặt máy chủ Windows bất kì, cách cài đặt và triển khai có thể tìm kiếm trên mạng. Hoặc dùng máy đang dùng hiện tại làm máy chủ là tiện lợi và tốt nhất.
## Bước 2: Cài đặt XAMPP
XAMPP là ứng dụng máy chủ,được tích hợp sẵn Apache, PHP, MySQL (MariaDB), FPT Server, MailServer và các công cụ như phpMyAdmin.
Ta có thể chủ động bật tắt hoặc khởi động lại dịch vụ bất cứ khi nào.
Tải về và cài đặt theo đường dẫn:
> https://www.apachefriends.org/download.html

## Bước 3: Tải mã nguồn ứng dụng
Truy cập đường dẫn để mã nguồn ứng dụng trên git:
> https://github.com/kyobaka1/ptit-train-web-vul
Tải file zip về và giải nén.
## Bước 4: Copy mã nguồn vào web root.
XAMPP cung cấp web root mặc định theo địa chỉ:
> C:\xampp\htdocs

Ta chỉ cần copy toàn bộ mã nguồn trong folder ptit-train-web-vul vào htdocs.
Khởi động lại Apache và MySQL bằng ứng dụng giao diện của XAMPP.
## Bước 5: Cấu hình cơ sở dữ liệu (database)
XAMPP cung cấp sẵn ứng dụng quản lý CSDL là phpMyAdmin.
Ta có thể truy cập bằng trình duyệt vào đường dẫn:
> http://localhost/phpmyadmin

User mặc định của CSDL là: root / mật khẩu để trống
Nếu cài ở máy chủ khác, thay localhost bằng domain hoặc địa chỉ IP của máy chủ.
Sau đó tạo một CSDL và tài khoản có quyền trên CSDL đó. Hoặc dùng mặc định cung cấp là tài khoản root.

> https://beezo.vn
> [Beezo](https://www.google.com)
