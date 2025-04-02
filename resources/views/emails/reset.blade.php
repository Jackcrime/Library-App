<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
</head>
<body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #f4f4f4;">

    <!-- Email Container -->
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#f4f4f4">
        <tr>
            <td align="center">
                <table role="presentation" width="600" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" style="margin: 40px auto; border-radius: 10px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);">
                    
                    <!-- Header -->
                    <tr>
                        <td align="center" style="padding: 20px 0; background: linear-gradient(to right, #2b7fff, #38b2ac); border-top-left-radius: 10px; border-top-right-radius: 10px;">
                            <img src="{{ asset('assets/Logo.png') }}" alt="Library Logo" width="120">
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding: 30px 40px;">
                            <h2 style="color: #333; text-align: center;">Reset Your Password</h2>
                            <p style="color: #666; text-align: center; font-size: 16px;">
                                You requested a password reset. Click the button below to set a new password.
                            </p>
                            <div style="text-align: center; margin: 30px 0;">
                                <a href="{{ url('/reset-password/'.$token) }}" style="
                                    background: linear-gradient(to right, #2b7fff, #38b2ac);
                                    color: white;
                                    text-decoration: none;
                                    padding: 12px 24px;
                                    border-radius: 25px;
                                    font-size: 16px;
                                    display: inline-block;
                                    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
                                    transition: all 0.3s ease;">
                                    Reset Password
                                </a>
                            </div>
                            <p style="color: #999; text-align: center; font-size: 14px;">
                                If you did not request this, please ignore this email.
                            </p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="padding: 20px; text-align: center; background-color: #f4f4f4; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
                            <p style="color: #777; font-size: 12px;">
                                &copy; 2024 Cerdas Terpelajar Library. All rights reserved.
                            </p>
                            <p style="margin-top: 10px;">
                                <a href="#" style="margin: 0 5px; text-decoration: none; color: #38b2ac;">Facebook</a> |
                                <a href="#" style="margin: 0 5px; text-decoration: none; color: #38b2ac;">Twitter</a> |
                                <a href="#" style="margin: 0 5px; text-decoration: none; color: #38b2ac;">Instagram</a>
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>

</body>
</html>
