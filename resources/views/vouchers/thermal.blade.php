<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $voucher->unit_name }}</title>

    <style>
        body {
            width: 58mm; /* Sesuaikan: 58mm atau 80mm */
            font-family: monospace;
            font-size: 12px;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        .line {
            border-top: 1px dashed #000;
            margin: 8px 0;
        }

        #qrcode img, #qrcode canvas {
            margin: auto;
        }
    </style>
</head>

<body>

    <div>==============================</div>
    <div><strong>VOUCHER FUEL</strong></div>
    <div>==============================</div>
    <p>{{ $voucher->id }}</p>

    <div style="text-align:left; padding-left:5px;">
        <div class="line"></div>

        <!-- ID       : {{ $voucher->id }}<br> -->
        UNIT: {{ $voucher->unit_name }}<br>
        VOLUME: {{ $voucher->volume }} Liter<br>

        <div class="line"></div>
    </div>

    <div id="qrcode"></div>

    <div class="line"></div>
    <div>Scan untuk verifikasi</div>
    <div>==============================</div>
    <div>PT GORBY PUTRA UTAMA</div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>

    <script>
        new QRCode(document.getElementById("qrcode"), {
            text: "{{ $voucher->id }}",
            width: 120,
            height: 120,
        });

        // auto print
        setTimeout(() => {
            window.print();
        }, 500);
    </script>

</body>
</html>
