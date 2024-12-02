<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f9f9f9; margin: 0; padding: 0;">
    <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="background-color: #ffffff; border: 1px solid #ddd; border-radius: 8px; padding: 20px;">
        <tr>
            <td align="center" style="padding: 20px 0;">
                <h2 style="color: #333;">Reset Password</h2>
            </td>
        </tr>
        <tr>
            <td style="padding: 20px; color: #333;">
                <p>Hi <strong>{{ $username }}</strong>,</p>
                <p>Kami menerima permintaan untuk mereset kata sandi Anda. Silakan klik tautan di bawah ini untuk meresetnya:</p>
                <p>
                    <a href="{{ $resetLink }}" style="background-color: #007BFF; color: #ffffff; padding: 10px 20px; text-decoration: none; border-radius: 5px;">
                        Reset Password
                    </a>
                </p>
                <p>Jika Anda tidak meminta ini, abaikan email ini.</p>
            </td>
        </tr>
        <tr>
            <td style="padding: 20px; text-align: center; color: #999; font-size: 12px;">
                <p>&copy; {{ date('Y') }} Vims. All rights reserved.</p>
            </td>
        </tr>
    </table>
</body>
</html>
