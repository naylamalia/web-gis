<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $sistemInfo = [
            'nama' => 'SIKUPAS',
            'nama_lengkap' => 'Sistem Informasi Kelurahan Penerima Bantuan Sosial',
            'deskripsi' => 'Platform digital untuk mengelola data keluarga penerima bantuan sosial dengan fitur pemetaan spasial dan analisis data yang komprehensif.',
            'versi' => '1.0.0',
            'tahun' => '2025'
        ];

        $anggotaTim = [
            [
                'nama' => 'Tjut Najmi Hayati',
                'nim' => 'H1101231014',
                'role' => 'Project Manager & Backend Developer'
            ],
            [
                'nama' => 'Kayla Maudy Ananda',
                'nim' => 'H1101231015',
                'role' => 'Frontend Developer & UI/UX Designer'
            ],
            [
                'nama' => 'Rofi Dwi Firezeki',
                'nim' => 'H1101231023',
                'role' => 'Database Administrator & GIS Specialist'
            ],
            [
                'nama' => 'Miranda',
                'nim' => 'H1101231030',
                'role' => 'System Analyst & Quality Assurance'
            ],
            [
                'nama' => 'Nayla Nurul Amalia',
                'nim' => 'H1101231060',
                'role' => 'Documentation & Testing Specialist'
            ]
        ];

        return view('about.index', compact('sistemInfo', 'anggotaTim'));
    }
}
