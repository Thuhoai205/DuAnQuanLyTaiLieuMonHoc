<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Có tài liệu mới</title>
</head>

<body style="font-family: Arial, Helvetica, sans-serif; line-height:1.6; color:#333;">

    <h2>Xin chào {{ $user->full_name }},</h2>

    <p>
        Môn học
        <strong>{{ $course->subject_name }}</strong>
        vừa được cập nhật tài liệu mới.
    </p>

    <table cellpadding="8" cellspacing="0" style="border-collapse: collapse;">

        <tr>
            <td><strong>Môn học:</strong></td>
            <td>{{ $course->subject_name }}</td>
        </tr>

        <tr>
            <td><strong>Tài liệu:</strong></td>
            <td>{{ $document->title }}</td>
        </tr>

        <tr>
            <td><strong>Loại tài liệu:</strong></td>
            <td>{{ $document->documentType->type_name }}</td>
        </tr>

        <tr>
            <td><strong>Ngày đăng:</strong></td>
            <td>{{ $document->created_at->format('d/m/Y H:i') }}</td>
        </tr>

    </table>

    <p>
        Hãy đăng nhập vào hệ thống để xem và tải tài liệu mới nhất.
    </p>

    <br>


    <p style="margin-top:40px;">
        Trân trọng,<br>
        <strong>Hệ thống Quản lý Tài liệu Môn học</strong>
    </p>

</body>

</html>