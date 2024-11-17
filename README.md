# Kriptografi - Proyek Akhir

Dosen : Pak Bagus\
Mata kuliah : Kriptografi\
Link Presentasi : [Link Presentasi](https://www.canva.com/design/DAGWrCdB14Q/kBnr0uFJrjXlXlSU6swMzQ/edit?utm_content=DAGWrCdB14Q&utm_campaign=designshare&utm_medium=link2&utm_source=sharebutton)

## Penjelasan Tugas : 
Perintah ada di folder `Soal`, gambarnya ada disitu. Simpelnya :\
Buat aplikasi dengna kriteria sebagai berikut
1. Login, di enkripsi dan masuk db, enkripsi dengna algoritma modern. = SHA256
2. Text, di super enkripsi, tradisional + modern. = AES + Ceasar Chiper
3. Gambar, gunakan metode steganografi = Steganografi
4. File, gunakan metode bebas, tapi di enkripsi = AES
5. Dideplot + harus https kasih SSL

## Tema : 
Disini saya mengambil tema Dukcapil. Sebuah daerah fiktif bernama Supernova. Jadi di tema ini, terdapat dua role yaitu pegawai dan admin. Dimaan pegawai hanya bisa, input data penduduk, melalukan steganografi dengan gambar, dan enkripsi file. Hal tersebut dilakukan demi keamanan daerah Supernova. Dan nanti admin yang bisa melihat pesan yang telah di amankan oleh pegawai.

## Recap :
- Pegawai\
--> Input data penduduk (akan di enkripsi)\
--> Melakukan steganografi dengan gambar\
--> Melakukan enkripsi file
- Admin\
--> Melihat data penduduk yang telah di enkripsi\
--> Melihat pesan dari steganogtafi gambar\
--> Melihat file yang telah di enkripsi\
--> Melihat user yang mendaftar

## Penjelasan Folder
- `component` biar gak ngulang ngulang
- `img` buat nyimpen gambar buat ui web
- `logic` buat naruh logic function
- `uploads` buat nyimpen file file upload
- -> `files` buat nyimpen file yang terenksirpsi
- -> `image` nyimpen foto yang dinput
- -> `steganografi` nyimpen foto yang udah di steganografi
- -> `upload` nyimpen file upload asli dari file dan steganografi

## Note : 
Data untuk Login : 
- Pegawai\
--> Username : 123\
--> Password : 123
- Admin\
--> Username : admin\
--> Password : admin

## Cara Menggunakan Proyek Ini : 
1. Silahkan git clone atau download projek ini
2. Taruh di `xampp/htdocs` kalian
3. Jangan lupa masukin database yang ada di folder `database`
4. Jangan lupa nyalakan `xampp` kalian
5. Silahkan buka lewat `localhost/...` sesuai nama kalian bikin tadi\
\
Kurang lebih kayak gitu, seperti pada umumnya web php gitu


