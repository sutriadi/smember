SMember Plugin for SLiMS
version 0.5.15.1.2 build 14323528082011

Copyright (c) 1432 H / 2011 M
Indra Sutriadi Pipii (indra@sutriadi.web.id)

-- Persyaratan System
- SLiMS 3 Stable 15 "Matoa"
- Modul Plugins aktif versi 15.1.2 "Bongkai" (download di http://sutriadi.web.id/)

-- Instalasi
- uraikan paket instalasi smember-x.x.tar.gz di dalam direktori ./admin/modules/plugins/include/
  sehingga akan menghasilkan direktori ./admin/modules/plugins/includes/smember/
- masuk ke menu Plugins, kemudian aktifkan plugin SMember

-- Hapus Instalasi
- masuk ke menu Plugins, kemudian non-aktifkan plugin SMember
- hapus direktori smember dari direktori ./admin/modules/plugins/include/ bila perlu

-- Menjalankan Plugin
- masuk ke menu Plugins
- klik link Launch pada baris plugin aktif bernama SMember

CHANGELOG
27.08.2011
- penyesuaian plugin dengan ketentuan modul Plugins versi 15.1.2

20.02.2011
- penambahan fitur instalasi dan deinstalasi sesuai modul Plugins versi 0.3
- penambahan dialog konfigurasi plugin
- single theme untuk penyusutan ukuran file
- menambahkan ./js/custom.js bagi yang ingin membuat javascript sendiri

23.01.2011
- upgrade jquery 1.4.4 and jquery-ui 1.8.9
- menambahkan ./css/custom.css bagi yang ingin membuat stylesheet sendiri
- filter member per kolom
- jumlah item per halaman lebih kecil untuk mengurangi penggunaan resource berlebih
  saat eksekusi perintah
