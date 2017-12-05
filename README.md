GIT & GITHUB

1. Khái niệm
Git là một trong những Hệ thống quản lý phiên bản phân tán.
Lưu trạng thái của file dưới dạng câp nhật lịch sử, nên có thể đưa file đã chỉnh sửa 1 lần v trạng thái cũ hoặc có thể biết được file đã chỉnh sửa chỗ nào.
2. Cài đặt git và các thiết lập
Đầu tiên ta phải cài ứng dụng Git vào máy tính để có thể sử dụng các dòng lệnh của Git. 
Sử dụng lệnh sau để cài đặt git sudo apt-get update sudo apt-get install git
Sau khi cài đặt git xong thì ta tạo SSH Key mới trên tài khoản github. Thay thế địa chỉ email ssh-keygen -t rsa -b 4096 -C "your_email@example.com" Khi bạn được nhắc "Nhập tệp để lưu khóa", nhấn Enter. Nhập mật khẩu: Enter passphrase (empty for no passphrase): [Type a passphrase] Enter same passphrase again: [Type passphrase again] Bắt đầu với ssh-agent eval "$(ssh-agent -s)" Thêm ssh key private ssh-add ~/.ssh/id_rsa Thêm SSH Key vào tài khoản github.
Repository (kho chứa) nghĩa là nơi mà ta sẽ lưu trữ mã ngun và người khác có thể clone lại mã nguồn. Repository có hai loại là Local Repository( kho chứa trên máy tính cá nhân) và Remote Repository( kho chứa trên máy chủ từ xa). Để tạo một repository thì mình cần cd vào thư mục của mã nguồn, sau đó dùng lệnh sau để khởi tạo repository cho thư mục đó $ git init Download tất cả các file và lịch sử tư khi bắt đầu của repository đó ta dùng lênh: git clone https://github.com/at-hieule/Basic_PHP.git
3. Workflow:
Có 3 trạng thái chính trên 1 file là: committed, modified và staged.
+	Commit nghĩa là một hành động để Git lưu lại một bản chụp (snapshot) của các sự thay đổi trong thư mục làm việc, và các tập tin và thư mục được thay đổi đã phải nằm trong Staging Area. ) của các sự thay đổi trong thư mục làm việc, và các tập tin và thư mục được thay đổi đã phải nằm trong Staging Area.
+	Modified nghĩa là thay đổi tập tin mà chưa có hành động commit.
+	Staged nghĩa là đánh dấu một thay đổi tập tin trong phiên bản hiện tại của nó để đưa vào commit snapshot.
Để commit một tập tin ta cần quan tam 2 trạng thái: track và untrack 
Tracked
 – Là tập tin đã được đánh dấu theo dõi trong Git để bạn làm việc với nó. 
Và trạng thái Tracked nó sẽ có thêm các trạng thái phụ khác là Unmodified (chưa chỉnh sửa gì), Modified (đã chỉnh sửa) và Staged (đã sẵn sàng để commit).
 Untracked
 – Là tập tin còn lại mà bạn sẽ không muốn làm việc với nó trong Git.
Thực hiện các lệnh tại các trạng thái trên:
Kiểm tra trạng thái hiện tại của git:	git status
Commit thay đổi : git commit or git commit -m “message”
Staging files:	git add tenfile git add .	// add toan bo
Xem lại lịch sử commit: git log
Tạo nhánh:	git checkout -b tennhanh	// tạo và chuyển nhánh git checkout tennhanh // chuyển nhánh
Git merge git checkout master	// chuyển và master git merge nhanh	// merge nhánh vào master
Git push	git push origin master	// push lên master
Git fetch	git fetch origin
Git pull	git pull origin master
Git diff: Để biết chính xác các thay đổi trong các file và sự thay thay đổi của các file trong folder git diff tenfile	//So sánh trong file git diff //so sánh tất cả các file
GitIgnore: Là 1 file ghi lại những thay đổi, những file mà không được đưa lên git.
Git stash: Git stash được sử dụng khi muốn lưu lại các thay đổi chưa commit, thường rất hữu dụng khi mình muốn đổi sang 1 branch khác mà lại đang làm dở ở branch hiện tại. Muốn lưu toàn bộ nội dung công việc đang làm dở, mình có thể sử dụng: git stash 
Sau khi đã git stash 1 hoặc vài lần, mình có thể xem lại danh sách các lần lưu thay đổi bằng câu lệnh: git stash list 
Muốn lấy lại thay đổi và xoá nội dung thay đổi lưu trong stack đi, khi đó: git stash pop stash{1}
