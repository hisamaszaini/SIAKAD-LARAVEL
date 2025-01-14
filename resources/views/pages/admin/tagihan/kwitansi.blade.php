<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kwitansi Pembayaran</title>
    <link rel="stylesheet" href="/assets/css/custom.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 0;
            background-color: #f8f8f8;
        }
        .receipt {
            max-width: 600px; /* Set maximum width */
            margin: auto; /* Center the receipt */
            border: 1px solid #000;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            text-align: left;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #000;
        }
        .thank-you {
            margin-top: 20px;
            font-size: 16px;
            font-weight: bold;
            text-align: center;
        }
        hr {
            border: 0;
            border-top: 1px solid #000;
            margin: 10px 0;
        }
        
        /* Print styles */
        @media print {
            body * {
                visibility: hidden; /* Hide all elements */
            }
            .receipt, .receipt * {
                visibility: visible; /* Show only the receipt */
            }
            .receipt {
                position: absolute;
                left: 0;
                top: 0; /* Align receipt to the top-left corner */
                max-width: 600px; /* Keep the max-width */
            }
        }
    </style>
</head>
<body>

<div class="receipt">
    <table>
        <tr>
            <td style="width: 80px;">
                <img src="path_to_logo/logo.png" alt="Logo Sekolah" style="max-width: 100px;"> <!-- Update with the actual logo path -->
            </td>
            <td>
                <h2 style="margin: 0;">Nama Sekolah</h2>
                <p style="margin: 5px 0;">Alamat Sekolah</p>
            </td>
        </tr>
    </table>
    <hr>
    <h5 style="text-align: center;">Kwitansi Pembayaran</h5>
    <table>
        <tr>
            <th>Nama Siswa</th>
            <td>{{ $penagihan->siswa->nama }}</td>
        </tr>
        <tr>
            <th>Nomor Induk</th>
            <td>{{ $penagihan->siswa->no_induk }}</td>
        </tr>
        <tr>
            <th>Nama Tagihan</th>
            <td>{{ $penagihan->tagihan->nama }}</td>
        </tr>
        <tr>
            <th>Nominal</th>
            <td>{{ number_format($penagihan->tagihan->nominal, 2, ',', '.') }}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td>{{ ucfirst($penagihan->status) }}</td>
        </tr>
        <tr>
            <th>Tanggal Pembayaran</th>
            <td>
                {{ $penagihan->tgl_dibayar ? \Carbon\Carbon::parse($penagihan->tgl_dibayar)->translatedFormat('d F Y') : 'Belum dibayar' }}
            </td>
        </tr>
    </table>
    <hr>
    <p class="thank-you">Terima kasih atas pembayaran Anda!</p>
</div>

<!-- Print Button -->
<button onclick="printReceipt()" class="btn btn-primary">Print Kwitansi</button>

<script>
    function printReceipt() {
        window.print(); // Open the print dialog
    }
</script>

</body>
</html>
