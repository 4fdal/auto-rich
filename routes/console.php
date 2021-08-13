<?php

use App\Models\CategoryProduct;
use App\Models\Discount;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


Artisan::command('product:dummy', function () {

    $idrFormat = function ($number) {
        return "Rp. " . number_format($number, 2, ',', '.');
    };

    DB::beginTransaction();
    try {

        $user = User::create([
            'name' => 'shiro',
            'role_id' => 2,
            'email' => 'shiro@mail.com',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'password' => Hash::make('123456'),
        ]);

        $userAddress = UserAddress::create([
            'user_id' => $user->id,
            'address_line1' => "Jln. Solo, Batu Gadang, Lubuk Kilangan, Batu Gadang, Padang",
            'address_line2' => '-',
            'lat' => '-100.563244',
            'lng' => '0.53123123',
            'disctricts' => 'Batu Gadang',
            'provincie' => 'Sumatera Barat',
            'post_code' => '24534',
            'country' => 'indonesia',
            'telephone' => '0895708870303',
            'mobile' => '0895708870303',
        ]);

        $category = ['scraps', 'recycle', 'donation'];
        $categoryOutData = [];
        foreach ($category as $key => $value) {
            $categoryOutData[$key] = CategoryProduct::insert([
                'id' => $key + 1,
                'category' => $value,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }

        $discountOutData = [];
        $dicountType = ['fixed', 'percent'];
        foreach (range(1, 10) as $key => $value) {

            $type = $dicountType[rand(0, 1)];

            switch ($type) {
                case 'fixed':
                    $value = rand(1000, 10000);
                    $name = "Piece " . $idrFormat($value);
                    break;

                default:
                    $value = rand(1, 100);
                    $name = "Percent {$value}%";
                    break;
            }

            $discountOutData[$key] = Discount::create([
                'name' => $name,
                'value' => $value,
                'type' => $type,
            ]);
        }

        $dataProductFormat = [
            [
                'discount_id' => rand(0, 1) ? $discountOutData[rand(0, 9)]->id : null,
                'productName' => 'Koran Bekas',
                'productCategory' => 1,
                'productNameDetail' => 'Koran Bekas Untuk Kliping Packing Bungkus Barang Kado Buah Sayur',
                'description' => <<<TXT
                Kondisi: Bekas
                Berat: 1.000 Gram
                Kategori: Kertas HVS
                Etalase: Packaging Kemasan
                * Pengiriman Bisa Via JNE, J&T atau untuk dalam kota Semarang via Gosend Gojek / Grab ( by request )

                * Harga untuk pembelian per kilogram

                Koran Bekas Kompas, Suara Merdeka, Jawa Pos... Kondisi Bekas Baca layak pakai, dan sudah di Staples sehingga Cukup Rapi. Sangat dibutuhkan untuk pengepakan barang, juga sangat dibutuhkan bagi pekebun buah sebagai bungkus buah di pohon agar tidak diserang hama maupun bungkus alas buah paska panen.
                TXT,
                'tag' => '["koran"]',
                'photo' => '["https://images.tokopedia.net/img/cache/900/product-1/2019/6/29/4328011/4328011_76654dc8-979d-4211-9d9b-198f45358887_699_699"]',
                'price' => 9800,
                'quantity' => rand(1, 100),
                'weight_kg' => 0.5,
                'user_id' => $user->id,
            ],
            [
                'discount_id' => rand(0, 1) ? $discountOutData[rand(0, 9)]->id : null,
                'productName' => 'SOFA BEKAS',
                'productCategory' => 1,
                'productNameDetail' => 'SOFA BEKAS PAKAI KANTOR BARANG MASIH OK DAN BAGUS',
                'description' => <<<TXT
                Kondisi: Bekas
                Berat: 200 Kilogram
                Kategori: Kursi Kerja
                Etalase: LAIN LAIN
                HARAP VIDEOKAN PROSES PEMBUKAAN PAKET DARI AWAL SAMPAI BARANG TERBUKA.

                KOMPLAIN TANPA VIDEO TERSEBUT DENGAN ALASAN APAPUN TIDAK AKAN DITERIMA.
                TXT,
                'tag' => '["sofa", "kursi"]',
                'photo' => '["https://images.tokopedia.net/img/cache/900/attachment/2019/10/3/157009143787072/157009143787072_ec460a73-90f2-48c1-9a3c-345065600060.png"]',
                'price' => 500000,
                'quantity' => rand(1, 100),
                'weight_kg' => 10,
                'user_id' => $user->id,
            ],
            [
                'discount_id' => rand(0, 1) ? $discountOutData[rand(0, 9)]->id : null,
                'productName' => 'Preloved',
                'productCategory' => 1,
                'productNameDetail' => 'Preloved - Barang Bekas - Kacamata - Merk Brigeseyewear',
                'description' => <<<TXT
                Kondisi: Bekas
                Berat: 50 Gram
                Kategori: Kacamata Wanita
                Etalase: Semua Etalase
                Bismilahirohmanirrohim

                Preloved Barang Bekas, Dijual


                Jenis Produk : Kacamata
                Merk Produk : Brigeseyewear
                Ukuran : M
                Warna : Brown Beige
                Bahan : -
                Kondisi : 90 Persen
                Harga : 565.000
                Ig Pemilik : @farrelmahatir
                Nomer Pemilik : -

                Semua barang dalam Katalog sudah harga Pas dan tidak dapat ditawar, Untuk pembelian aman dapat menggunakan hanya Tokopedia saja.
                TXT,
                'tag' => '["kacamata"]',
                'photo' => '["https://images.tokopedia.net/img/cache/900/VqbcmM/2020/10/6/05659d8a-ccdf-4e45-956e-0e701159ef09.jpg"]',
                'price' => 565000,
                'quantity' => rand(1, 100),
                'weight_kg' => 0.3,
                'user_id' => $user->id,
            ],
            [
                'discount_id' => rand(0, 1) ? $discountOutData[rand(0, 9)]->id : null,
                'productName' => 'Senter Vishiba',
                'productCategory' => 1,
                'productNameDetail' => 'Senter Vishiba • Barang Pajangan Antik Lawas Langka Bekas Klasik',
                'description' => <<<TXT
                Kondisi: Bekas
                Berat: 400 Gram
                Kategori: Senter
                Etalase: Semua Etalase
                Mati. Cocok untuk dijadikan pajangan.

                Semua produk yang tersemat/terpajang dalam etalase kami tersedia. Silakan! 🤘🏻
                TXT,
                'tag' => '["pencahayaan"]',
                'photo' => '["https://images.tokopedia.net/img/cache/900/VqbcmM/2021/3/13/efa39e20-db2d-4208-91ba-407188b4937f.jpg"]',
                'price' => 40000,
                'quantity' => rand(1, 100),
                'weight_kg' => 0.05,
                'user_id' => $user->id,
            ],
            [
                'discount_id' => rand(0, 1) ? $discountOutData[rand(0, 9)]->id : null,
                'productName' => 'Box Kardus',
                'productCategory' => 1,
                'productNameDetail' => 'Box Kardus sepatu barang coklat kondisi bekas 1xpakai',
                'description' => <<<TXT
                Kondisi: Bekas
                Berat: 100 Gram
                Kategori: Kardus
                Etalase: Packaging
                Selamat Datang di Donatshop, menjual segala keperluan packaging dan barang2 lainnya.

                Box/Kardus bekas berkualitas !
                Box Sepatu Sandal ukuran 17x14x11

                Kondisi :
                1. 1x pakai hanya pengangkutan dari pabrik ke gudang
                2. ada tulisan pen kode ada yg 1sisi, ada yg 2sisi (acak)
                3. kondisi bagus 90% tidak sobek
                4. diikat rapih per 50pc

                Cocok untuk box sepatu atau packaging barang olshop atau lainnya, dengan harga yg sangat terjangkau.

                Bisa menggunakan ekspedisi cargo yg murah terjangkau apabila pengambilan dgn jumlah banyak
                TXT,
                'tag' => '["box", "kardus"]',
                'photo' => '["https://images.tokopedia.net/img/cache/900/product-1/2020/6/26/11362873/11362873_7df065cd-a7ec-401e-bccd-0cb549ddb0d0_2048_2048"]',
                'price' => 44950,
                'quantity' => rand(1, 100),
                'weight_kg' => 0.5,
                'user_id' => $user->id,
            ],
            [
                'discount_id' => rand(0, 1) ? $discountOutData[rand(0, 9)]->id : null,
                'productName' => 'SPEAKER',
                'productCategory' => 1,
                'productNameDetail' => 'JUAL SPEAKER BOSE SOUNDLINK 3 / III / iii BEKAS BARANG DISPLAY',
                'description' => <<<TXT
                Kondisi: Bekas
                Berat: 3.000 Gram
                Kategori: Speaker
                Etalase: Semua Etalase

                KONDISI: PENYOK DEPAN
                SPEAKER BOSE SOUNDLINK 3 FULLSET BEKAS BARANG DISPLAY
                PEMAKAIAN 6 BULAN
                TANPA GARANSI
                NOTE: KARDUS AKAN BERBEDA NOMOR SERINYA DENGAN UNIT.
                TXT,
                'tag' => '["speaker"]',
                'photo' => '["https://images.tokopedia.net/img/cache/900/VqbcmM/2021/7/28/77a23722-d4d6-4aa7-8391-9ccb17abc6ff.jpg"]',
                'price' => 3000000,
                'quantity' => rand(1, 100),
                'weight_kg' => 1,
                'user_id' => $user->id,
            ],
            [
                'discount_id' => rand(0, 1) ? $discountOutData[rand(0, 9)]->id : null,
                'productName' => 'kipas',
                'productCategory' => 1,
                'productNameDetail' => 'kipas dc 12v 8x8 bekas copoton barang sudah di tes 100% bagus',
                'description' => <<<TXT
                Kondisi: Bekas
                Berat: 10 Gram
                Kategori: Kipas Angin Listrik
                Etalase: Semua Etalase
                kipas dc 12v copotan barang jamin 100% ok
                TXT,
                'tag' => '["kipas"]',
                'photo' => '["https://images.tokopedia.net/img/cache/900/VqbcmM/2021/1/22/bf49d64e-f4f1-433e-9702-0425959755eb.jpg"]',
                'price' => 4000,
                'quantity' => rand(1, 100),
                'weight_kg' => 0.4,
                'user_id' => $user->id,
            ],
            [
                'discount_id' => rand(0, 1) ? $discountOutData[rand(0, 9)]->id : null,
                'productName' => 'oppo',
                'productCategory' => 1,
                'productNameDetail' => 'oppo f9 second + bonus barang random',
                'description' => <<<TXT
                Kondisi: Bekas
                Berat: 1.000 Gram
                Kategori: Feature Phone
                Etalase: Semua Etalase
                Katalog: Oppo F9
                barang mulus hanya batangan no hf

                garansi uang kembali jika tidak sesuai harapan. + bonus barang random
                TXT,
                'tag' => '["android", "oppo"]',
                'photo' => '["https://images.tokopedia.net/img/cache/900/VqbcmM/2021/3/19/4f4622bb-61a7-4240-8a02-83bcc0efdf11.jpg"]',
                'price' => 1253000,
                'quantity' => rand(1, 100),
                'weight_kg' => 0.5,
                'user_id' => $user->id,
            ],
            [
                'discount_id' => rand(0, 1) ? $discountOutData[rand(0, 9)]->id : null,
                'productName' => 'steam espresso',
                'productCategory' => 1,
                'productNameDetail' => 'steam espresso maker Barang import second murah Dan dijamin bagus.',
                'description' => <<<TXT
                Kondisi: Bekas
                Berat: 4.500 Gram
                Kategori: Coffee & Tea Maker
                Etalase: Barang second kualitas wahit
                Cara menggunakan Flair Espresso Maker:
                Sebelum menggunakan Flair, pembuat espresso portabel ini ada 4 elemen yang perlu Anda ketahui sebelumnya, yaitu tentang level gilingan, dosis, teknik tamping, dan brew atau penyeduhan.

                Level gilingan. Tekstur gilingan adalah salah satu aspek penting untuk menghasilkan kualitas shot yang sempurna. Jika gilingannya terlalu halus, umumnya kopi akan sulit terekstraksi karena kandungannya terlalu padat. Juga membuat hasil seduh yang terlalu pahit dan cenderung terasa seperti gosong. Sebaliknya jika gilingannya terlalu kasar, maka ekstraksi akan terlalu cepat sehingga membuat kopi menjadi watery dan tidak konsisten. Sebaiknya giling kopi dalam level gilingan yang halus saja, sepertinya umumnya untuk membuat espressobukan Turkish coffee.

                Dosis. Dosis adalah jumlah takaran bubuk kopi yang Anda masukkan ke dalam portafilter. Dosis ideal untuk membuat espresso dengan Flair yang direkomendasikan adalah sekitar 14 22 gram.

                Proses tamping. Proses tamping berguna untuk memastikan keseragaman proses ekstraksi kopi. Measuring cup dari Flair juga bisa digunakan untuk alat tamping sekaligus alat untuk melepaskan piston.

                Proses penyeduhan / brew. Letakkan bagian portafilter Flair pada pos utama dan masukkan silinder yang sudah dipanaskan terlebih dahulu di bagian atas. Lalu letakkan cangkir (yang juga sudah dipanaskan) di bagian drip plate.

                Spesifikasi :
                Barang second baru dipake sebentar 4 bulan tutup Karena corona mau Di jual murah aja dijamin masih bagus,tingal Di beliin adaptor nya aja .


                Material : Stainless steel and die cast aluminum
                Dimensi (PxLxT) : 65 x 35 x 45 cm
                Berat : 3.95 kg
                Kapasitas portafilter : 25 - 35 gram
                Kapasitas air : 800ml (Cylinder)
                Sudah termasuk carrying case
                Designed in California, USA
                Made in China

                Catatan: Sebagai rekomendasi, sebelum memulai proses shot, sebaiknya jangan lupa untuk memanaskan terlebih dahulu bagian silinder dan cup dengan air panas.
                TXT,
                'tag' => '["espresso"]',
                'photo' => '["https://images.tokopedia.net/img/cache/900/product-1/2020/5/29/2593418/2593418_cd23543e-dce7-4693-b622-527c6eae022e_1560_1560.jpg"]',
                'price' => 339999,
                'quantity' => rand(1, 100),
                'weight_kg' => 5,
                'user_id' => $user->id,
            ],
            [
                'discount_id' => rand(0, 1) ? $discountOutData[rand(0, 9)]->id : null,
                'productName' => 'recoder',
                'productCategory' => 1,
                'productNameDetail' => 'sepaket barang jadul tape recoder national dan sanyo seken rekondisi',
                'description' => <<<TXT
                Kondisi: Bekas
                Berat: 5 Kilogram
                Kategori: Voice Recorder
                Etalase: BARANG JADUL LAWAS
                Tape recoder jadul, kondisi kurang paham jalan atau gak
                Open price 500k nego ampe deal
                Bisa cod ditangerang
                Disarankan packing kayu biar aman
                Tambah packing kayu 100k, bisa dibagi dua sama seller
                TXT,
                'tag' => '["recoder"]',
                'photo' => '["https://images.tokopedia.net/img/cache/900/VqbcmM/2021/5/29/8cd60672-aff8-4ad7-a3b4-050266d3e865.jpg"]',
                'price' => 50000,
                'quantity' => rand(1, 100),
                'weight_kg' => 5,
                'user_id' => $user->id,
            ],
            [
                'discount_id' => rand(0, 1) ? $discountOutData[rand(0, 9)]->id : null,
                'productName' => 'kardus',
                'productCategory' => 2,
                'productNameDetail' => 'kardus packing ukuran sedang ,kardus bekas buat packing barang',
                'description' => <<<TXT
                Kondisi: Baru
                Berat: 300 Gram
                Kategori: Kardus
                Etalase: Semua Etalase
                kardus paking barang kurang sedang buat packing paket, kardus bekas ,,,di order aja ya barang nya Ready,,,
                TXT,
                'tag' => '["kardus"]',
                'photo' => '["https://images.tokopedia.net/img/cache/900/VqbcmM/2021/7/28/303ef77a-a4a3-436a-b6eb-98e868699f3b.jpg"]',
                'price' => 3600,
                'quantity' => rand(1, 100),
                'weight_kg' => 0.03,
                'user_id' => $user->id,
            ],
            [
                'discount_id' => rand(0, 1) ? $discountOutData[rand(0, 9)]->id : null,
                'productName' => 'kardus',
                'productCategory' => 2,
                'productNameDetail' => 'Kardus Bekas Karton Bekas untuk Packing Barang Kardus Tebal',
                'description' => <<<TXT
                Kondisi: Baru
                Berat: 1.000 Gram
                Kategori: Kotak Karton
                Etalase: Semua Etalase
                WAJIB GRAB / GOJEK KHUSUS MEDAN YA...

                Kardus bekas ini jual eceran yah..Untuk yang jual OL shop yang perlu kardus dan karton bekas bisa ya. Ini ada jual eceran juga.

                HARGA PER 1KG YA...WAJIB GRAB / GOJEK Yahh...
                TXT,
                'tag' => '["kardus"]',
                'photo' => '["https://images.tokopedia.net/img/cache/900/VqbcmM/2021/3/11/2b584c92-40ab-4250-bdd6-d6f8ffb21e0b.jpg"]',
                'price' => 6000,
                'quantity' => rand(1, 100),
                'weight_kg' => 1,
                'user_id' => $user->id,
            ],
            [
                'discount_id' => rand(0, 1) ? $discountOutData[rand(0, 9)]->id : null,
                'productName' => 'Kertas',
                'productCategory' => 2,
                'productNameDetail' => 'Kertas bekas campur untuk alas barang pecah belah',
                'description' => <<<TXT
                Kondisi: Bekas
                Berat: 700 Gram
                Kategori: Kertas HVS
                Etalase: Semua Etalase
                Kertas bekas kondisi campur-campur, berfungsi untuk alas barang pecah belah / elektronik, untuk bungkus dll

                - Harga diatas adalah harga per kilo
                - Minimum order 7 kilo (klik masukkan 7 item)
                - No Complain ya kakak (kertas kita kirimkan random)
                - Ojek sameday bisa bawa 10 kilo (harap konfirmasi dulu ke admin utk di setting berat di sistem).
                TXT,
                'tag' => '["kertas"]',
                'photo' => '["https://images.tokopedia.net/img/cache/900/VqbcmM/2020/9/16/c8ca555b-8114-4260-a459-1933c05a636f.jpg"]',
                'price' => 42000,
                'quantity' => rand(1, 100),
                'weight_kg' => 0.07,
                'user_id' => $user->id,
            ],
            [
                'discount_id' => rand(0, 1) ? $discountOutData[rand(0, 9)]->id : null,
                'productName' => 'koran',
                'productCategory' => 2,
                'productNameDetail' => 'koran bekas / koran kiloan / koran murah buat paking bungkus barang',
                'description' => <<<TXT
                Kondisi: Bekas
                Berat: 1.000 Gram
                Kategori: Tinta & Kuas Kaligrafi
                Etalase: Semua Etalase
                Jual koran bekas layak pakai.
                bisa di pakai untuk keperluan pengepakan atau lapisan pembungkusan lapisan packing pada paket pengiriman online.

                Minimum pembelian 1.000gram (1kg)
                Harga tercantum untuk 1.000 gram (1kg)

                Kondisi koran bekas kami masih bagus dan layak pakai..jadi bisa langsung di pakai oleh seller online

                Pembungkusan kami menggunakan plastik untuk mengirim kemas dari produk kami, agar lebih aman dari panas dan hujan
                TXT,
                'tag' => '["koran"]',
                'photo' => '["https://images.tokopedia.net/img/cache/900/VqbcmM/2020/9/4/d6612b1a-454e-47e7-ab0f-c47ae887a0d4.jpg"]',
                'price' => 18000,
                'quantity' => rand(1, 100),
                'weight_kg' => 1,
                'user_id' => $user->id,
            ],
            [
                'discount_id' => rand(0, 1) ? $discountOutData[rand(0, 9)]->id : null,
                'productName' => 'kardus',
                'productCategory' => 2,
                'productNameDetail' => 'kardus packing barang, kardus bekas ukuran sedang',
                'description' => <<<TXT
                Kondisi: Baru
                Berat: 300 Gram
                Kategori: Kardus
                Etalase: Semua Etalase
                kardus bekas ukuran sedang,kardus packing paket ukuran sedang, kardus bekas,,,
                Barang nya Ready di order aja ya,,,
                TXT,
                'tag' => '["kardus"]',
                'photo' => '["https://images.tokopedia.net/img/cache/900/VqbcmM/2021/5/17/adfdcd30-ecd9-4317-8d90-5c8576168e3c.jpg"]',
                'price' => 3200,
                'quantity' => rand(1, 100),
                'weight_kg' => 0.03,
                'user_id' => $user->id,
            ],
            [
                'discount_id' => rand(0, 1) ? $discountOutData[rand(0, 9)]->id : null,
                'productName' => 'kardus',
                'productCategory' => 2,
                'productNameDetail' => 'Kardus / dus / dos / karton tebal kotak bekas untuk packing barang',
                'description' => <<<TXT
                Kondisi: Bekas
                Berat: 500 Gram
                Kategori: Kotak Karton
                Etalase: KARDUS
                HANYA VIA GOSEND / GRAB

                Kardus bekas packing,
                kondisi bekas layak pakai.
                kardus tebal kokoh double wall (2 lapis)
                ukuran 42 x 22 x 20 cm

                stok tidak terlalu banyak, hanya ada sekitar 40 pcs.

                harga yang tercantum adalah harga per pcs.

                HANYA VIA GOSEND, karena kalau via jne atau j&t akan kena volume.

                silahkan diorder

                terima kasih
                TXT,
                'tag' => '["kardus"]',
                'photo' => '["https://images.tokopedia.net/img/cache/900/product-1/2017/8/24/0/0_a360c449-b086-444d-91bc-7a4d83eaabf9_816_459.jpg"]',
                'price' => 3000,
                'quantity' => rand(1, 100),
                'weight_kg' => 0.05,
                'user_id' => $user->id,
            ],
            [
                'discount_id' => rand(0, 1) ? $discountOutData[rand(0, 9)]->id : null,
                'productName' => 'TROMOL',
                'productCategory' => 2,
                'productNameDetail' => 'TROMOL DRAG DKT THAILAND DAN DISC CEKUNG COAK SEMUA BARANG SEKEN',
                'description' => <<<TXT
                Kondisi: Bekas
                Berat: 2.500 Gram
                Kategori: Kaliper, Cakram dan Tromol Motor
                Etalase: Semua Etalase
                Tromol dkt front and back include disc cekung coak ( pemakaian kontes, kondisi tromol 95% dan disc 89% )

                TXT,
                'tag' => '["tromol"]',
                'photo' => '["https://images.tokopedia.net/img/cache/900/VqbcmM/2021/4/5/09b32401-ed94-4888-b889-bd49ca8b8abf.jpg"]',
                'price' => 1750000,
                'quantity' => rand(1, 100),
                'weight_kg' => 2.5,
                'user_id' => $user->id,
            ],
            [
                'discount_id' => rand(0, 1) ? $discountOutData[rand(0, 9)]->id : null,
                'productName' => 'Kardus',
                'productCategory' => 2,
                'productNameDetail' => 'Box Kardus Putih Sepatu Barang Kondisi Bekas Khusus Pengiriman Instant',
                'description' => <<<TXT
                Kondisi: Bekas
                Berat: 45 Gram
                Kategori: Kardus
                Etalase: Packaging
                Selamat Datang di Donatshop, menjual segala keperluan packaging dan barang2 lainnya.

                Box/Kardus bekas dengan kualitas seperti baruuuu !
                Box Sepatu Sandal ukuran 15x18x13

                Kondisi :
                1. 1x pakai hanya pengangkutan dari pabrik ke gudang
                2. ada tulisan pen kode ada yg 1sisi, ada yg 2sisi (acak)
                3. kondisi bagus 90% tidak sobek, kalau penyok atau kerut ada pasti sedikit tp acak juga kondisinya
                4. diikat rapih per 50pc

                Cocok untuk box sepatu atau packaging barang olshop atau lainnya, dengan harga yg sangat terjangkau.

                Bisa menggunakan ekspedisi cargo yg murah terjangkau apabila pengambilan dgn jumlah banyak

                TXT,
                'tag' => '["kardus"]',
                'photo' => '["https://images.tokopedia.net/img/cache/900/VqbcmM/2021/6/18/bdbad185-d699-412d-b80c-725bb00aadef.jpg"]',
                'price' => 44950,
                'quantity' => rand(1, 100),
                'weight_kg' => 0.45,
                'user_id' => $user->id,
            ],
            [
                'discount_id' => rand(0, 1) ? $discountOutData[rand(0, 9)]->id : null,
                'productName' => 'Kardus',
                'productCategory' => 2,
                'productNameDetail' => 'Kardus Bekas Untuk Packing Tambahan Supaya Barang Lebih Aman',
                'description' => <<<TXT
                Kondisi: Baru
                Berat: 10 Gram
                Kategori: Kardus
                Etalase: Packing Tambahan
                Supaya pesananmu lebih aman jangan lupa tambahkan packing kardus tambahan ya kakak-kakak yang baik 😊
                karna pengiriman di lapangan tidak bisa ditebak kondisinya seperti apa 😉

                Kardus ini cuma kardus tambahan kalau beli barang di pepi yah kak, bukan jualan kardus bekas biasa
                Foto hanya ilustrasi aja ya, bentuk bisa berupa potongan menyesuaikan paketnya

                TXT,
                'tag' => '["kardus"]',
                'photo' => '["https://images.tokopedia.net/img/cache/900/VqbcmM/2021/3/25/a48fe278-ba36-4b72-989f-d9a31bc6d276.jpg"]',
                'price' => 1000,
                'quantity' => rand(1, 100),
                'weight_kg' => 0.1,
                'user_id' => $user->id,
            ],
            [
                'discount_id' => rand(0, 1) ? $discountOutData[rand(0, 9)]->id : null,
                'productName' => 'Kardus',
                'productCategory' => 2,
                'productNameDetail' => 'Packing Tambahan Kardus Second Untuk keamanan Barang pesanannya',
                'description' => <<<TXT
                Kondisi: Baru
                Berat: 150 Gram
                Kategori: Kardus
                Etalase: Lain-lain
                Untuk keamanan dan Perlindungan barang pesanan
                mohon check out
                Menggunakan packing tambahan yang telah kami sediakan seperti :
                - Bubble wrap
                - Kardus Second
                - Bubble Wrap + Kardus Second
                Thank you. ^^

                TXT,
                'tag' => '["kardus"]',
                'photo' => '["https://images.tokopedia.net/img/cache/900/VqbcmM/2021/3/15/7f425dff-5d25-401d-891b-69b1abd5791e.jpg"]',
                'price' => 2000,
                'quantity' => rand(1, 100),
                'weight_kg' => 0.15,
                'user_id' => $user->id,
            ],
            [
                'discount_id' => rand(0, 1) ? $discountOutData[rand(0, 9)]->id : null,
                'productName' => 'Rompi',
                'productCategory' => 3,
                'productNameDetail' => 'Rompi kulit domba ,barang seken tapi 80% bagus - Hitam, L',
                'description' => <<<TXT
                Kondisi: Bekas
                Berat: 1 Kilogram
                Kategori: Jaket Pria
                Etalase: Box
                Rompi kulit kami untuk pemotor atau biskres ,
                Barang seken tapi bagus 80% di jamin

                TXT,
                'tag' => '["rompi"]',
                'photo' => '["https://images.tokopedia.net/img/cache/900/product-1/2018/7/11/3660247/3660247_9565fb10-6f83-4d60-9a7e-21eb74d85d45_1224_1224.jpg"]',
                'price' => 0,
                'quantity' => rand(1, 100),
                'weight_kg' => 1,
                'user_id' => $user->id,
            ],
            [
                'discount_id' => rand(0, 1) ? $discountOutData[rand(0, 9)]->id : null,
                'productName' => 'sepatu',
                'productCategory' => 3,
                'productNameDetail' => 'sepatu golf nike barang second',
                'description' => <<<TXT
                Kondisi: Bekas
                Berat: 500 Gram
                Kategori: Sepatu Golf
                Etalase: Semua Etalase
                sepatu nike second kondisi baru dipake 2x ,ukuran 45 ori made in china
                TXT,
                'tag' => '["sepatu"]',
                'photo' => '["https://images.tokopedia.net/img/cache/900/VqbcmM/2021/2/3/b77e800e-c2ed-4624-aa8c-059630013935.jpg"]',
                'price' => 0,
                'quantity' => rand(1, 100),
                'weight_kg' => 0.5,
                'user_id' => $user->id,
            ],
            [
                'discount_id' => rand(0, 1) ? $discountOutData[rand(0, 9)]->id : null,
                'productName' => 'koran',
                'productCategory' => 3,
                'productNameDetail' => 'KORAN BEKAS (layak pakai) ECERAN',
                'description' => <<<TXT
                Kondisi: Baru
                Berat: 600 Gram
                Kategori: Kertas HVS
                Etalase: Koran Bekas
                Kami menjual kertas koran polos (100% dijamin polos) yg belum tercetak tinta,
                Kondisi kertas koran lebar dan baru (bukan bekas).

                ☆ Spesifikasi: Koran lebar (lebih lebar dr koran baca), bahan kertas koran halus sama seperti koran baca biasa pd umumnya (bukan koran kasar/ KW1/ KW2) dan tidak berbau.
                TXT,
                'tag' => '["koran"]',
                'photo' => '["https://inkuiri.net/i/large/https%2Fs1.bukalapak.com%2Fimg%2F13683577652%2Flarge%2Fdata.jpeg"]',
                'price' => 0,
                'quantity' => rand(1, 100),
                'weight_kg' => 0.5,
                'user_id' => $user->id,
            ],

        ];

        foreach ($dataProductFormat as $key => $value) {
            $product = Product::create([
                'user_id' => $value['user_id'],
                'category_id' => $value['productCategory'],
                'name' => $value['productName'],
            ]);

            $productDetail = ProductDetail::create([
                'user_id' => $value['user_id'],
                'product_id' => $product->id,
                'discount_id' => $value['discount_id'],
                'name' => $value['productNameDetail'],
                'description' => $value['description'],
                'tag' => $value['tag'],
                'photo' => $value['photo'],
                'price' => $value['price'],
                'quantity' => $value['quantity'],
                'weight_kg' => $value['weight_kg'],
            ]);
        }

        DB::commit();
    } catch (Exception $e) {
        DB::rollback();
        throw $e ;
    }
});
