{{-- <p>Click the link below to verify your email:</p>
<a href="{{ route('verify.email', ['id' => $id, 'token' => $token]) }}">Verify Email</a> --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
</head>
<body style="font-family: Arial, sans-serif; margin: 0; padding: 0; background-color: #f9f9f9;">

<table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="background-color: #ffffff; border: 1px solid #ddd; border-radius: 8px; padding: 20px;">
    <tr>
        <td align="center" style="padding: 20px 0;">
            <!-- Logo -->
            <img src="https://via.placeholder.com/120x40?text=Your+Logo" alt="Company Logo" style="width: 120px; height: auto;">
        </td>
    </tr>
    <tr>
        <td style="padding: 20px; text-align: left; color: #333;">
            <!-- Greeting -->
            <h2 style="font-size: 24px; font-weight: bold; margin: 0;">Hi {{ $username }},</h2>
            <p style="font-size: 16px; margin: 10px 0 20px;">
                Untuk menyelesaikan pendaftaran Anda, harap verifikasi alamat email Anda dengan mengklik tombol di bawah ini:
            </p>
        </td>
    </tr>
    <tr>
        <td align="center" style="padding: 10px 20px;">
            <!-- Button -->
            <a href="{{ route('verify.email', ['id' => $id, 'token' => $token]) }}" 
               style="display: inline-block; background-color: #007BFF; color: #ffffff; text-decoration: none; font-size: 16px; font-weight: bold; padding: 10px 20px; border-radius: 5px;">
                Verify Email
            </a>
        </td>
    </tr>
    <tr>
        <td style="padding: 20px; text-align: left; color: #333;">
            <!-- Alternate Link -->
            <p style="font-size: 14px; margin: 20px 0;">
                Or copy this link and paste it into your web browser:
            </p>
            <p style="font-size: 14px; color: #007BFF; word-break: break-all;">
                <a href="/" style="color: #007BFF; text-decoration: none;">[Verification Link]</a>
            </p>
        </td>
    </tr>
    <tr>
        <td style="padding: 20px; text-align: left; color: #333;">
            <!-- Closing -->
            <p style="font-size: 16px; margin: 20px 0;">
                Regards,<br>
                <strong>Viary Team</strong>
            </p>
        </td>
    </tr>
</table>

</body>
</html>
