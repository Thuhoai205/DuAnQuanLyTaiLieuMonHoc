<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Thông báo hủy phân công môn học</title>
</head>

<body style="margin:0;padding:30px;background:#f8fafc;font-family:Arial,Helvetica,sans-serif;">

    <div
        style="max-width:680px;margin:auto;background:#ffffff;border-radius:12px;overflow:hidden;box-shadow:0 6px 20px rgba(0,0,0,.08);">

        <!-- Header -->
        <div style="background:#dc2626;padding:25px;text-align:center;">

            <h2 style="margin:0;color:#ffffff;">
                Thông báo hủy phân công môn học
            </h2>

        </div>

        <!-- Content -->
        <div style="padding:35px;">

            <p style="font-size:16px;color:#334155;">
                Xin chào <strong>{{ $teacher->full_name }}</strong>,
            </p>

            <p style="color:#475569;line-height:1.8;">

                Quản trị viên đã <strong>hủy phân công</strong> giảng dạy đối với môn học sau:

            </p>

            <table style="width:100%;border-collapse:collapse;margin:25px 0;">

                <tr>

                    <td style="padding:12px;border:1px solid #e2e8f0;background:#f8fafc;width:180px;">

                        <strong>Mã môn học</strong>

                    </td>

                    <td style="padding:12px;border:1px solid #e2e8f0;">

                        {{ $courseSubject->subject_code }}

                    </td>

                </tr>

                <tr>

                    <td style="padding:12px;border:1px solid #e2e8f0;background:#f8fafc;">

                        <strong>Tên môn học</strong>

                    </td>

                    <td style="padding:12px;border:1px solid #e2e8f0;">

                        {{ $courseSubject->subject_name }}

                    </td>

                </tr>

            </table>

            <div style="padding:18px;background:#fef2f2;border-left:4px solid #dc2626;border-radius:6px;">

                <strong>Lưu ý:</strong><br>

                Bạn sẽ không còn quyền quản lý, cập nhật hoặc đăng tải tài liệu cho môn học này.

            </div>

            <p style="margin-top:30px;color:#475569;line-height:1.8;">

                Nếu bạn cho rằng có sự nhầm lẫn hoặc cần hỗ trợ,
                vui lòng liên hệ Quản trị viên.

            </p>

            <div style="margin-top:35px;text-align:center;">

                <a href="{{ url('/login') }}"
                    style="display:inline-block;background:#0f172a;color:#ffffff;padding:14px 28px;text-decoration:none;border-radius:8px;font-weight:bold;">

                    Đăng nhập hệ thống

                </a>

            </div>

        </div>

        <!-- Footer -->
        <div style="background:#f8fafc;padding:20px;text-align:center;border-top:1px solid #e2e8f0;">

            <p style="margin:0;font-size:13px;color:#64748b;">

                Website Quản lý Tài liệu Môn học

            </p>

            <p style="margin-top:8px;font-size:12px;color:#94a3b8;">

                Đây là email tự động, vui lòng không trả lời email này.

            </p>

        </div>

    </div>

</body>

</html>