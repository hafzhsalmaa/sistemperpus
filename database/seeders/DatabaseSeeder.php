<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Anggota;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate([
            'email' => 'admin@perpus.com',
        ], [
            'name' => 'Admin',
            'password' => Hash::make('admin123'),
        ]);

        $books = [
            [
                'kode_buku' => 'BK-001',
                'judul' => 'Laskar Pelangi',
                'penulis' => 'Andrea Hirata',
                'penerbit' => 'Bentang Pustaka',
                'tahun_terbit' => 2005,
                'stok' => 12,
            ],
            [
                'kode_buku' => 'BK-002',
                'judul' => 'Bumi Manusia',
                'penulis' => 'Pramoedya Ananta Toer',
                'penerbit' => 'Lentera Dipantara',
                'tahun_terbit' => 1980,
                'stok' => 8,
            ],
            [
                'kode_buku' => 'BK-003',
                'judul' => 'Atomic Habits',
                'penulis' => 'James Clear',
                'penerbit' => 'Gramedia',
                'tahun_terbit' => 2019,
                'stok' => 15,
            ],
            [
                'kode_buku' => 'BK-004',
                'judul' => 'Negeri 5 Menara',
                'penulis' => 'Ahmad Fuadi',
                'penerbit' => 'Gramedia',
                'tahun_terbit' => 2009,
                'stok' => 10,
            ],
            [
                'kode_buku' => 'BK-005',
                'judul' => 'Ayat-Ayat Cinta',
                'penulis' => 'Habiburrahman El Shirazy',
                'penerbit' => 'Republika',
                'tahun_terbit' => 2004,
                'stok' => 7,
            ],
            [
                'kode_buku' => 'BK-006',
                'judul' => 'Pulang',
                'penulis' => 'Tere Liye',
                'penerbit' => 'Republika',
                'tahun_terbit' => 2015,
                'stok' => 11,
            ],
            [
                'kode_buku' => 'BK-007',
                'judul' => 'Pergi',
                'penulis' => 'Tere Liye',
                'penerbit' => 'Sabak Grip',
                'tahun_terbit' => 2018,
                'stok' => 9,
            ],
            [
                'kode_buku' => 'BK-008',
                'judul' => 'Rindu',
                'penulis' => 'Tere Liye',
                'penerbit' => 'Republika',
                'tahun_terbit' => 2014,
                'stok' => 6,
            ],
            [
                'kode_buku' => 'BK-009',
                'judul' => 'Hujan',
                'penulis' => 'Tere Liye',
                'penerbit' => 'Gramedia',
                'tahun_terbit' => 2016,
                'stok' => 13,
            ],
            [
                'kode_buku' => 'BK-010',
                'judul' => 'Bulan',
                'penulis' => 'Tere Liye',
                'penerbit' => 'Gramedia',
                'tahun_terbit' => 2015,
                'stok' => 9,
            ],
            [
                'kode_buku' => 'BK-011',
                'judul' => 'Dilan 1990',
                'penulis' => 'Pidi Baiq',
                'penerbit' => 'Pastel Books',
                'tahun_terbit' => 2014,
                'stok' => 8,
            ],
            [
                'kode_buku' => 'BK-012',
                'judul' => 'Mariposa',
                'penulis' => 'Luluk HF',
                'penerbit' => 'Coconut Books',
                'tahun_terbit' => 2018,
                'stok' => 10,
            ],
            [
                'kode_buku' => 'BK-013',
                'judul' => 'Filosofi Teras',
                'penulis' => 'Henry Manampiring',
                'penerbit' => 'Kompas',
                'tahun_terbit' => 2018,
                'stok' => 14,
            ],
            [
                'kode_buku' => 'BK-014',
                'judul' => 'Sebuah Seni untuk Bersikap Bodo Amat',
                'penulis' => 'Mark Manson',
                'penerbit' => 'Gramedia',
                'tahun_terbit' => 2018,
                'stok' => 12,
            ],
            [
                'kode_buku' => 'BK-015',
                'judul' => 'Rich Dad Poor Dad',
                'penulis' => 'Robert T. Kiyosaki',
                'penerbit' => 'Gramedia',
                'tahun_terbit' => 2000,
                'stok' => 5,
            ],
            [
                'kode_buku' => 'BK-016',
                'judul' => 'Think and Grow Rich',
                'penulis' => 'Napoleon Hill',
                'penerbit' => 'Elex Media',
                'tahun_terbit' => 2009,
                'stok' => 7,
            ],
            [
                'kode_buku' => 'BK-017',
                'judul' => 'The Psychology of Money',
                'penulis' => 'Morgan Housel',
                'penerbit' => 'Penerbit Baca',
                'tahun_terbit' => 2021,
                'stok' => 16,
            ],
            [
                'kode_buku' => 'BK-018',
                'judul' => 'Deep Work',
                'penulis' => 'Cal Newport',
                'penerbit' => 'Gramedia',
                'tahun_terbit' => 2017,
                'stok' => 9,
            ],
            [
                'kode_buku' => 'BK-019',
                'judul' => 'Start With Why',
                'penulis' => 'Simon Sinek',
                'penerbit' => 'Gramedia',
                'tahun_terbit' => 2019,
                'stok' => 6,
            ],
            [
                'kode_buku' => 'BK-020',
                'judul' => 'The Lean Startup',
                'penulis' => 'Eric Ries',
                'penerbit' => 'Bentang',
                'tahun_terbit' => 2012,
                'stok' => 8,
            ],
            [
                'kode_buku' => 'BK-021',
                'judul' => 'Clean Code',
                'penulis' => 'Robert C. Martin',
                'penerbit' => 'Informatika',
                'tahun_terbit' => 2010,
                'stok' => 11,
            ],
            [
                'kode_buku' => 'BK-022',
                'judul' => 'Algoritma dan Pemrograman',
                'penulis' => 'Rinaldi Munir',
                'penerbit' => 'Informatika',
                'tahun_terbit' => 2016,
                'stok' => 10,
            ],
            [
                'kode_buku' => 'BK-023',
                'judul' => 'Basis Data',
                'penulis' => 'Abdul Kadir',
                'penerbit' => 'Andi',
                'tahun_terbit' => 2014,
                'stok' => 8,
            ],
            [
                'kode_buku' => 'BK-024',
                'judul' => 'Jaringan Komputer',
                'penulis' => 'Tanenbaum',
                'penerbit' => 'Pearson',
                'tahun_terbit' => 2011,
                'stok' => 7,
            ],
            [
                'kode_buku' => 'BK-025',
                'judul' => 'Pemrograman Web dengan Laravel',
                'penulis' => 'Jubilee Enterprise',
                'penerbit' => 'Elex Media',
                'tahun_terbit' => 2022,
                'stok' => 12,
            ],
        ];

        foreach ($books as $book) {
            Book::updateOrCreate([
                'kode_buku' => $book['kode_buku'],
            ], $book);
        }

        $anggota = [
            [
                'kode_anggota' => 'AG-001',
                'nama' => 'Aulia Rahma',
                'kelas' => '12 IPA 1',
                'jenis_kelamin' => 'Perempuan',
                'no_hp' => '081234567001',
                'alamat' => 'Jl. Melati No. 12',
            ],
            [
                'kode_anggota' => 'AG-002',
                'nama' => 'Bima Pratama',
                'kelas' => '12 IPA 2',
                'jenis_kelamin' => 'Laki-laki',
                'no_hp' => '081234567002',
                'alamat' => 'Jl. Kenanga No. 8',
            ],
            [
                'kode_anggota' => 'AG-003',
                'nama' => 'Citra Lestari',
                'kelas' => '11 IPS 1',
                'jenis_kelamin' => 'Perempuan',
                'no_hp' => '081234567003',
                'alamat' => 'Jl. Mawar No. 5',
            ],
            [
                'kode_anggota' => 'AG-004',
                'nama' => 'Dimas Saputra',
                'kelas' => '11 IPA 1',
                'jenis_kelamin' => 'Laki-laki',
                'no_hp' => '081234567004',
                'alamat' => 'Jl. Cendana No. 10',
            ],
            [
                'kode_anggota' => 'AG-005',
                'nama' => 'Eka Wulandari',
                'kelas' => '10 IPS 2',
                'jenis_kelamin' => 'Perempuan',
                'no_hp' => '081234567005',
                'alamat' => 'Jl. Anggrek No. 3',
            ],
        ];

        foreach ($anggota as $item) {
            Anggota::updateOrCreate([
                'kode_anggota' => $item['kode_anggota'],
            ], $item);
        }
    }
}
