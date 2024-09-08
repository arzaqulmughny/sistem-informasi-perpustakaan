<?php

namespace App\Helpers;

class Menu
{
    const MENU = [
        [
            'type' => 'single',
            'label' => 'Beranda',
            'link' => '/',
            'icon' => '<i class="fa fa-fw fa-home"></i>'
        ],
        [
            'type' => 'group',
            'label' => 'Data',
            'links' => [
                [
                    'type' => 'single',
                    'label' => 'Buku',
                    'link' => '/books',
                    'icon' => '<i class="fa fa-fw fa-book" aria-hidden="true"></i>'
                ],
                [
                    'type' => 'single',
                    'label' => 'Anggota',
                    'link' => '/members',
                    'icon' => '<i class="fa fa-fw fa-user" aria-hidden="true"></i>'
                ],
                [
                    'type' => 'single',
                    'label' => 'Kategori Buku',
                    'link' => '/book-categories',
                    'icon' => '<i class="fa fa-fw fa-list" aria-hidden="true"></i>'
                ],
            ]
        ],
        [
            'type' => 'group',
            'label' => 'Transaksi',
            'links' => [
                [
                    'type' => 'single',
                    'label' => 'Peminjaman',
                    'link' => '/loans',
                    'icon' => '<i class="fa fa-fw fa-arrow-right" aria-hidden="true"></i>'
                ],
                [
                    'type' => 'single',
                    'label' => 'Pengembalian',
                    'link' => '/returns',
                    'icon' => '<i class="fa fa-fw fa-arrow-left" aria-hidden="true"></i>'
                ],
            ]
        ],
        [
            'type' => 'group',
            'label' => 'Laporan',
            'links' => [
                [
                    'type' => 'single',
                    'label' => 'Peminjaman',
                    'link' => '/loans-report',
                    'icon' => '<i class="fa fa-fw fa-calendar" aria-hidden="true"></i>'
                ],
                [
                    'type' => 'single',
                    'label' => 'Statistik Buku',
                    'link' => '/books-report',
                    'icon' => '<i class="fa fa-fw fa-history" aria-hidden="true"></i>'
                ],
            ]
        ],
        [
            'type' => 'group',
            'label' => 'Admin',
            'links' => [
                [
                    'type' => 'single',
                    'label' => 'Staff',
                    'link' => '/users',
                    'icon' => '<i class="fa fa-fw fa-users"></i>'
                ],
                [
                    'type' => 'single',
                    'label' => 'Pengaturan Aplikasi',
                    'link' => '/app-settings',
                    'icon' => '<i class="fa fa-fw fa-cog"></i>'
                ],
            ]
        ],
        [
            'type' => 'group',
            'label' => 'Personalisasi',
            'links' => [
                [
                    'type' => 'single',
                    'label' => 'Pengaturan Akun',
                    'link' => '/profile',
                    'icon' => '<i class="fa fa-fw fa-cog"></i>'
                ],
            ]
        ]
    ];
}
