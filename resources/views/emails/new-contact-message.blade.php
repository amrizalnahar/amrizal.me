<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Pesan Baru</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #C3110C; color: #fff; padding: 20px; text-align: center; border-radius: 8px 8px 0 0; }
        .content { background: #f9f9f9; padding: 20px; border: 1px solid #e5e5e5; }
        .field { margin-bottom: 12px; }
        .field-label { font-weight: bold; color: #555; }
        .field-value { margin-top: 4px; }
        .footer { text-align: center; padding: 20px; font-size: 12px; color: #999; }
        .btn { display: inline-block; padding: 10px 20px; background: #C3110C; color: #fff; text-decoration: none; border-radius: 4px; margin-top: 16px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Pesan Baru Diterima</h1>
        </div>
        <div class="content">
            <div class="field">
                <div class="field-label">Nama</div>
                <div class="field-value">{{ $contact->name }}</div>
            </div>
            <div class="field">
                <div class="field-label">Email</div>
                <div class="field-value">{{ $contact->email }}</div>
            </div>
            <div class="field">
                <div class="field-label">Subjek</div>
                <div class="field-value">{{ $contact->subject }}</div>
            </div>
            <div class="field">
                <div class="field-label">Pesan</div>
                <div class="field-value">{!! nl2br(e($contact->message)) !!}</div>
            </div>

            <a href="{{ url('/admin/contacts/' . $contact->id) }}" class="btn">Lihat di Admin</a>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} amrizal.me — Dikirim otomatis oleh sistem.
        </div>
    </div>
</body>
</html>
