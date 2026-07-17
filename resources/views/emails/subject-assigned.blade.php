<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Thông báo phân công môn học</title>
</head>

<body style="
    margin:0;
    padding:30px;
    background:#f8fafc;
    font-family:Arial, Helvetica, sans-serif;
">

    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center">

                <table width="620" cellpadding="0" cellspacing="0" style="
                        background:#ffffff;
                        border-radius:12px;
                        overflow:hidden;
                        border:1px solid #e5e7eb;
                    ">

                    <!-- HEADER -->
                    <tr>
                        <td style="
                                background:#2563eb;
                                color:#ffffff;
                                text-align:center;
                                padding:24px;
                            ">

                            <h2 style="margin:0;">
                                📚 Thông báo phân công môn học
                            </h2>

                        </td>
                    </tr>

                    <!-- CONTENT -->
                    <tr>
                        <td style="padding:30px; color:#334155;">

                            <p style="margin-top:0;">
                                Xin chào
                                <strong>{{ $teacher->full_name }}</strong>,
                            </p>

                            <p>
                                Bạn đã được <strong>phân công phụ trách</strong>
                                môn học sau:
                            </p>

                            <table width="100%" cellpadding="10" cellspacing="0" style="
                                    margin:20px 0;
                                    border:1px solid #dbeafe;
                                    border-radius:8px;
                                    background:#eff6ff;
                                ">

                                <tr>
                                    <td width="140">
                                        <strong>Mã môn học</strong>
                                    </td>

                                    <td>
                                        {{ $courseSubject->subject_code }}
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <strong>Tên môn học</strong>
                                    </td>

                                    <td>
                                        {{ $courseSubject->subject_name }}
                                    </td>
                                </tr>

                            </table>

                            <p>
                                Bạn có thể đăng nhập vào hệ thống để quản lý,
                                cập nhật và đăng tải tài liệu cho môn học này.
                            </p>

                            <p>
                                Xin cảm ơn sự hợp tác của bạn.
                            </p>

                        </td>
                    </tr>

                    <!-- FOOTER -->
                    <tr>
                        <td style="
                                background:#f8fafc;
                                padding:20px;
                                text-align:center;
                                color:#64748b;
                                font-size:13px;
                                border-top:1px solid #e5e7eb;
                            ">

                            Website Quản lý Tài liệu Môn học

                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>

</html>