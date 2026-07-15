<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
</head>

<body>

    <h2>Thông báo phân công môn học</h2>

    <p>Xin chào <strong>{{ $teacher->full_name }}</strong>,</p>

    <p>Bạn vừa được phân công phụ trách môn học:</p>

    <ul>
        <li><strong>Mã môn:</strong> {{ $courseSubject->subject_code }}</li>
        <li><strong>Tên môn:</strong> {{ $courseSubject->subject_name }}</li>
    </ul>

    <p>
        Vui lòng đăng nhập hệ thống để quản lý tài liệu của môn học này.
    </p>

    <p>
        Trân trọng,<br>
        Website Quản lý Tài liệu Môn học
    </p>

</body>

</html>