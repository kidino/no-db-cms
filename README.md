# No DB CMS

## Objektif

* Membina sebuah content management system tanpa database dan tanpa framework
* Menunjukajar konsep-konsep asas dalam pengaturcaraan dan PHP

## Proses

* Saya tidak merancang pelajaran dengan teliti
* Saya akan coding dan merakam terus pelajaran
* Saya akan melakukan kesilapan
* CMS akan dibangunkan secara berperingkat

## Kod Sumber dan Rujukan

* Github - https://github.com/kidino/no-db-cms
* Perhatikan Release untuk peringkat-peringkat kod sumber dikemaskini

## Alatan Saya

* Windows 10
* XAMPP untuk Apache & PHP7
* Adobe Brackets untuk code editor
	- Emmet plugin -- membantu menulis kod dengan pantas
	- Markdown plugin -- untuk menulis dokumentasi dan pelajaran ini

## Pemasangan

* letak sahaja di mana-mana webroot
* /admin untuk ke Admin
* password admin adalah *admin*

## Struktur Data

* kandungan halaman (pages) disimpan di /pages/{page_slug}.php
* kandungan disimpan dalam format HTML, dengan syntax HEREDOC
* senarai kandungan disimpan di /config/pages.php
* ianya disimpan sebagai Array PHP
* password admin disimpan di /admin/util/passwd.php
* ianya disimpan dalam format PHP Password Hash

