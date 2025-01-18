<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kwitansi Pembayaran</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="receipt">
        <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-lg">
            <div class="flex items-center mb-4">
                <img src="{{ asset('/storage/logo/sekolah_logo.png') }}" alt="Logo Sekolah" class="w-20 h-20 object-contain mr-4">
                <div class="flex-1 text-center">
                    <h2 class="text-2xl font-semibold">{{ $settings->lembaga_nama }}</h2>
                    <p class="text-gray-600">{{ $settings->lembaga_jalan }} No Telp. {{ $settings->lembaga_telp }}</p>
                </div>
                <div class="w-20"></div>
            </div>
            <hr class="mb-4">
            <h5 class="text-center text-xl font-semibold mb-4">Kwitansi Pembayaran</h5>
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <table class="w-full">
                        <tr class="border-b">
                            <th class="text-left py-2 px-4 text-gray-600">Nama Siswa</th>
                            <td class="py-2 px-4">{{ $penagihan->siswa->nama }}</td>
                        </tr>
                        <tr class="border-b">
                            <th class="text-left py-2 px-4 text-gray-600">Nomor Induk</th>
                            <td class="py-2 px-4">{{ $penagihan->siswa->no_induk }}</td>
                        </tr>
                        <tr class="border-b">
                            <th class="text-left py-2 px-4 text-gray-600">Nama Tagihan</th>
                            <td class="py-2 px-4">{{ $penagihan->tagihan->nama }}</td>
                        </tr>
                    </table>
                </div>
                <div>
                    <table class="w-full">
                        <tr class="border-b">
                            <th class="text-left py-2 px-4 text-gray-600">Nominal</th>
                            <td class="py-2 px-4">{{ number_format($penagihan->tagihan->nominal, 2, ',', '.') }}</td>
                        </tr>
                        <tr class="border-b">
                            <th class="text-left py-2 px-4 text-gray-600">Status</th>
                            <td class="py-2 px-4">{{ ucfirst($penagihan->status) }}</td>
                        </tr>
                        <tr class="border-b">
                            <th class="text-left py-2 px-4 text-gray-600">Tanggal Pembayaran</th>
                            <td class="py-2 px-4">
                                {{ $penagihan->tgl_dibayar ? \Carbon\Carbon::parse($penagihan->tgl_dibayar)->translatedFormat('d F Y') : 'Belum dibayar' }}
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <hr class="mb-2">
            <p class="text-center text-gray-600 mb-8">Terima kasih atas pembayaran Anda!</p>
            
            <div class="flex justify-end">
                <div class="text-center">
                    <p class="mb-2">{{ \Carbon\Carbon::parse($penagihan->tgl_dibayar)->translatedFormat('d F Y') }}</p>
                    <p class="mb-20">Bendahara Sekolah</p>
                    <p class="font-semibold">{{ $settings->bendahara_nama ?? 'Joko Tingkir' }}</p>
                    <p>NIP. {{ $settings->bendahara_nip ?? '216218 1281 1224' }}</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>