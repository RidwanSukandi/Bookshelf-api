<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

-   [Simple, fast routing engine](https://laravel.com/docs/routing).
-   [Powerful dependency injection container](https://laravel.com/docs/container).
-   Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
-   Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
-   Database agnostic [schema migrations](https://laravel.com/docs/migrations).
-   [Robust background job processing](https://laravel.com/docs/queues).
-   [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

-   **[Vehikl](https://vehikl.com/)**
-   **[Tighten Co.](https://tighten.co)**
-   **[WebReinvent](https://webreinvent.com/)**
-   **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
-   **[64 Robots](https://64robots.com)**
-   **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
-   **[Cyber-Duck](https://cyber-duck.co.uk)**
-   **[DevSquad](https://devsquad.com/hire-laravel-developers)**
-   **[Jump24](https://jump24.co.uk)**
-   **[Redberry](https://redberry.international/laravel/)**
-   **[Active Logic](https://activelogic.com)**
-   **[byte5](https://byte5.de)**
-   **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Kriteria 1 : APi menyimpan buku

API yang Anda buat harus dapat menyimpan buku melalui route:

-   Method : `POST`
-   URL : `/books`
-   Body Request:

```json
{

    "name": string,
    "year": number,
    "author": string,
    "summary": string,
    "publisher": string,
    "page_count": number,
    "read_paage": number,
    "reading": boolean

}

```

Objek buku yang disimpan pada server harus memiliki struktur seperti contoh di bawah ini:

```json
{
    "data": [
        {
            "status": "success",
            "data": {
                "book": {
                    "idbooks": 10,
                    "name": "Buku A",
                    "year": 2023,
                    "author": "John Doe",
                    "summary": "Lorem ipsum dolor sit amet",
                    "publisher": "indonesia",
                    "pageCount": 100,
                    "readPage": 100,
                    "finished": true,
                    "reading": true
                }
            }
        }
    ]
}
```

Properti yang ditebalkan diolah dan didapatkan di sisi server. Berikut penjelasannya:

-   `id` : nilai `id` haruslah unik.
-   `finished` : merupakan properti boolean yang menjelaskan apakah buku telah selesai dibaca atau belum. Nilai finished didapatkan dari observasi `page_count === read_page.`

Server harus merespons gagal bila:

Client tidak melampirkan properti namepada request body. Bila hal ini terjadi, maka server akan merespons dengan:

-   Status Code : `400`
-   Response Body :

```json
{
    "errors": {
        "status": "fail",
        "message": [
            {
                "name": ["The name field is required."]
            }
        ]
    }
}
```

Client melampirkan nilai properti read_page yang lebih besar dari nilai properti page_count. Bila hal ini terjadi, maka server akan merespons dengan:

-   Status Code : `400`
-   Response Body:

```json
{
    "errors": {
        "status": "fail",
        "message": "Gagal menambahkan buku. read_page tidak boleh lebih besar dari page_count"
    }
}
```

Bila buku berhasil dimasukkan, server harus mengembalikan respons dengan:

-   Status Code : `201`
-   Response Body:

```json
{
    "status": "success",
    "message": "Buku berhasil di tambahkan",
    "data": {
        "idbooks": 16
    }
}
```

### Kriteria 2 : API dapat menampilkan seluruh buku

API yang Anda buat harus dapat menampilkan seluruh buku yang disimpan melalui route:

-   Method : `GET`
-   URL: `/books`

Server mengembalikan respons dengan:

-   Status Code : `200`
-   Response Body:

```json
{
    "data": [
        {
            "status": "success",
            "data": {
                "books": {
                    "idbooks": 10,
                    "name": "Buku A",
                    "publisher": "indonesia"
                }
            }
        },
        {
            "status": "success",
            "data": {
                "books": {
                    "idbooks": 11,
                    "name": "Buku B",
                    "publisher": "indonesia"
                }
            }
        },
        {
            "status": "success",
            "data": {
                "books": {
                    "idbooks": 13,
                    "name": "Buku c",
                    "publisher": "indonesia"
                }
            }
        },
        {
            "status": "success",
            "data": {
                "books": {
                    "idbooks": 14,
                    "name": "Buku d",
                    "publisher": "indonesia"
                }
            }
        },
        {
            "status": "success",
            "data": {
                "books": {
                    "idbooks": 16,
                    "name": "Buku F",
                    "publisher": "indonesia"
                }
            }
        }
    ]
}
```

Jika belum terdapat buku yang dimasukkan, server bisa merespons dengan array books kosong.

```json
{
    "status": "success",
    "data": {
        "books": []
    }
}
```

### Kriteria 3 : API dapat menampilkan detail buku

API yang Anda buat harus dapat menampilkan seluruh buku yang disimpan melalui route:

-   Method : `GET`
-   URL: `/books/{bookId}`

Bila buku dengan id yang dilampirkan oleh client tidak ditemukan, maka server harus mengembalikan respons dengan:

-   Status Code : `404`
-   Response Body:

```json
{
    "errors": {
        "status": "fail",
        "message": "Buku tidak ditemukan"
    }
}
```

Bila buku dengan id yang dilampirkan ditemukan, maka server harus mengembalikan respons dengan:

-   Status Code : `200`
-   Response Body:

```json
{
    "data": [
        {
            "status": "success",
            "data": {
                "book": {
                    "idbooks": 10,
                    "name": "Buku A",
                    "year": 2023,
                    "author": "John Doe",
                    "summary": "Lorem ipsum dolor sit amet",
                    "publisher": "indonesia",
                    "pageCount": 100,
                    "readPage": 100,
                    "finished": true,
                    "reading": true
                }
            }
        }
    ]
}
```

### Kriteria 4 : API dapat mengubah data buku

API yang Anda buat harus dapat mengubah data buku berdasarkan id melalui route:

-   Method : `PUT`
-   URL : `/books/{bookId}`
-   Body Request:

```json
{
    "name": string,
    "year": number,
    "author": string,
    "summary": string,
    "publisher": string,
    "pageCount": number,
    "readPage": number,
    "reading": boolean
}
```

Server harus merespons gagal bila:

Client tidak melampirkan properti name pada request body. Bila hal ini terjadi, maka server akan merespons dengan:

-   Status Code : `400`
-   Response Body:

```json
{
    "errors": {
        "status": "fail",
        "message": [
            {
                "name": ["The name field is required."]
            }
        ]
    }
}
```

Client melampirkan nilai properti readPage yang lebih besar dari nilai properti pageCount. Bila hal ini terjadi, maka server akan merespons dengan:

-   Status Code : `400`
-   Response Body:

```json
{
    "errors": {
        "status": "fail",
        "message": "Gagal menambahkan buku. read_page tidak boleh lebih besar dari page_count"
    }
}
```

Idyang dilampirkan oleh client tidak ditemukkan oleh server. Bila hal ini terjadi, maka server akan merespons dengan:

-   Status Code : `404`
-   Response Body:

```json
{
    "errors": {
        "status": "fail",
        "message": "Gagal memperbarui buku. Id tidak ditemukan"
    }
}
```

Bila buku berhasil diperbarui, server harus mengembalikan respons dengan:

-   Status Code : `200`
-   Response Body:

```json
{
    "status": "success",
    "message": "Buku berhasil diperbarui"
}
```

### Kriteria 5 : API dapat menghapus buku

API yang Anda buat harus dapat menghapus buku berdasarkan id melalui route berikut:

-   Method : `DELETE`
-   URL: `/books/{bookId}`
    Bila id yang dilampirkan tidak dimiliki oleh buku manapun, maka server harus mengembalikan respons berikut:

-   Status Code : `404`
-   Response Body:

```json
{
    "status": "fail",
    "message": "Buku gagal dihapus. Id tidak ditemukan"
}
```

Bila id dimiliki oleh salah satu buku, maka buku tersebut harus dihapus dan server mengembalikan respons berikut:

-   Status Code : `200`
-   Response Body:

```json
{
    "status": "success",
    "message": "Buku berhasil dihapus"
}
```

### Kriteria 5 : API dapat menghapus buku

API yang Anda buat harus dapat menghapus buku berdasarkan id melalui route berikut:

-   Method : `DELETE`
-   URL: `/books/{bookId}`
    Bila id yang dilampirkan tidak dimiliki oleh buku manapun, maka server harus mengembalikan respons berikut:

-   Status Code : `404`
-   Response Body:

```json
{
    "errors": {
        "status": "fail",
        "message": "Buku gagal dihapus. Id tidak ditemukan"
    }
}
```

Bila id dimiliki oleh salah satu buku, maka buku tersebut harus dihapus dan server mengembalikan respons berikut:

-   Status Code : `200`
-   Response Body:

```json
{
    "status": "success",
    "message": "Buku berhasil dihapus"
}
```
