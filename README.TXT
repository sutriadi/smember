SMember Plugin for SLiMS
version 0.5-3.15-2 build 16553903102011

Copyright (c) 1432 H / 2011 M
Indra Sutriadi Pipii (indra@sutriadi.web.id)

Official Website: http://sutriadi.web.id/book/20110112/plugin-smember
Daily Development: https://github.com/sutriadi/smember

# Persyaratan System
- SLiMS 3 Stable 15 "Matoa" (download di http://slims.web.id/)
- Modul Plugins aktif versi 3.15-2.x "Nantu"
  (download di http://sutriadi.web.id/)

# Instalasi
- uraikan paket instalasi smember-x.x-x.x.xtar.gz di dalam direktori
  ./admin/modules/plugins/include/ sehingga akan menghasilkan direktori
  ./admin/modules/plugins/includes/smember/
- masuk ke menu Plugins, kemudian aktifkan plugin SMember
catatan: bila melakukan instalasi dari paket yang diambil dari github,
mohon untuk mengubah nama direktori hasil penguraian
dari ./sutriadi-smember-xxx menjadi ./smember

# Hapus Instalasi
- masuk ke menu Plugins, kemudian non-aktifkan plugin SMember
- hapus item smember dari submenu dataTables bila perlu
- hapus direktori smember dari direktori
  ./admin/modules/plugins/include/ bila perlu

# Menjalankan Plugin
- masuk ke menu Plugins
- klik tombol Launch pada baris plugin aktif bernama SMember

CHANGELOG
03.10.2011
- penyesuaian plugin dengan ketentuan penulisan kode modul Plugins versi 3.15-2.1

27.08.2011
- penyesuaian plugin dengan ketentuan penulisan kode modul Plugins versi 15.1.2

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
