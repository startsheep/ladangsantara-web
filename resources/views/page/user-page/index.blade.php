@extends('page.app')
@section('content')
    <section id="hero" class="d-flex align-items-center py-5">
        <div class="container">
            <div class="row">
                <div class="container col-sm position-relative" data-aos="fade-up" data-aos-delay="500">
                    <h1>LADANGSANTARA</h1>
                    <h2>Ladangnya Nusantara</h2>
                    <a href="#about" class="btn-get-started scrollto">Mari Mulai</a>
                </div>
                <div class="col-sm">
                    <img src="{{ asset('assets/images/proto.png') }}" width="550" height="400"
                        style="
                        z-index: 999;
                    position: relative;
                    "
                        class="d-none d-sm-inline">
                </div>
            </div>
        </div>

    </section>

    <main id="main">

        <section id="about" class="about">
            <div class="container">

                <div class="row">
                    <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-left">
                        <img src="{{ asset('assets/images/ladangsantara.png') }}" class="img-fluid"
                            style="width: 500px; height: 500px;">
                    </div>
                    <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content" data-aos="fade-right">
                        <h3>Tentang Kami</h3>
                        <p class="fst-italic">
                            LADANGSANTARA adalah sebuah platform mobile yang menyediakan informasi lengkap tentang
                            buah-buahan dan sayuran, Mulai dari :
                        </p>
                        <ul>
                            <li><i class="bi bi-check-circle"></i> Toko Penjual Buah dan Sayuran Terdekat.</li>
                            <li><i class="bi bi-check-circle"></i> Deteksi Kesegaran Buah Buahan dan Sayuran.</li>
                            <li><i class="bi bi-check-circle"></i> Resep Makanan atau Minuman yang Tepat Berdasarkan Buah
                                atau Sayuran yang Dideteksi.</li>
                        </ul>
                        <p>
                            Aplikasi ini bertujuan untuk memberikan pengetahuan yang bermanfaat kepada pengguna mengenai
                            manfaat kesehatan, nutrisi, dan nilai gizi dari setiap jenis buah-buahan dan sayuran.
                        </p>
                    </div>
                </div>

            </div>
        </section>

        <section id="services" class="services">
            <div class="container">

                <div class="section-title">
                    <span>Layanan Aplikasi</span>
                    <h2>Layanan Aplikasi</h2>
                </div>

                <div class="row">
                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="fade-up">
                        <div class="icon-box">
                            <div class="icon"><i class="bx bx-cart-alt"></i></div>
                            <h4><span>Santara Mall</span></h4>
                            <p class="">Santara mall merupakan fitur yang menyediakan berbagai mitra yang menjual macam buah dan
                                sayuran dan dapat dibeli secara online.
                            </p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="fade-up"
                        data-aos-delay="150">
                        <div class="icon-box">
                            <div class="icon"><i class="bx bx-money"></i></div>
                            <h4><span>Online Payment</span></h4>
                            <p class="">Ladangsantara telah terintegrasi dengan thirdparty payment gateway yaitu Xendit, sehingga
                                pengguna dapat melakukan pembayaran secara online.
                            </p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0" data-aos="fade-up"
                        data-aos-delay="300">
                        <div class="icon-box">
                            <div class="icon"><i class="bx bx-location-plus"></i></div>
                            <h4><span>Geolocation</span></h4>
                            <p class="">Ladangsantara memiliki fitur geolocation yang dapat menunjukkan lokasi pengguna dan
                                lokasi mitra terdekat.
                            </p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4" data-aos="fade-up" data-aos-delay="450">
                        <div class="icon-box">
                            <div class="icon"><i class="bx bx-search-alt"></i></div>
                            <h4><span>Freshness Detection</span></h4>
                            <p class="">Ladangsantara dilengkapi dengan teknologi machine learning sehingga memiliki fitur freshness detection yang dapat mendeteksi kesegaran buah
                                dan sayuran.
                            </p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4" data-aos="fade-up" data-aos-delay="600">
                        <div class="icon-box">
                            <div class="icon"><i class="bx bx-book-bookmark"></i></div>
                            <h4><span>Receipe Recomendation</span></h4>
                            <p class="">Receipe Recomendation merupakan fitur yang dapat memberikan rekomendasi resep makanan atau minuman yang tepat berdasarkan buah atau sayuran yang dideteksi.
                            </p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4" data-aos="fade-up" data-aos-delay="750">
                        <div class="icon-box">
                            <div class="icon"><i class="bx bx-comment"></i></div>
                            <h4><span>Review</span></h4>
                            <p class="">Review merupakan fitur yang dapat memberikan ulasan terhadap produk yang dibeli oleh pengguna.
                            </p>
                        </div>
                    </div>

                </div>

            </div>
        </section>

        <section id="cta" class="cta">
            <div class="container" data-aos="zoom-in">

                <div class="text-center">
                    <a class="cta-btn" href="https://drive.google.com/drive/folders/1aibhSxQhmtJcHs5xgGD2-54uiYQmk1KJ?usp=sharing">Unduh Aplikasi</a>
                </div>

            </div>
        </section>

        <section id="portfolio" class="portfolio">
            <div class="container">

                <div class="section-title">
                    <span>Mitra Kami</span>
                    <h2>Mitra Kami</h2>
                    <p>Berikut Merupakan Mitra Kami</p>
                </div>

                <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="150">

                    @foreach ($stores as $store)
                        <div class="col-lg-4 col-md-6 portfolio-item ">
                            <img src="{{ $store->logo }}" class="img-fluid" alt="">
                            <div class="portfolio-info">
                                <h4>{{ $store->name }}</h4>
                                <p>{{ $store->description }}</p>
                                <a href="{{ $store->logo }}" data-gallery="portfolioGallery"
                                    class="portfolio-lightbox preview-link" title="{{ $store->name }}"><i
                                        class="bx bx-plus"></i></a>
                                <a href="{{ route('web.store.slug', $store->slug) }} class="details-link"
                                    title="More Details"><i class="bx bx-link"></i></a>
                            </div>
                        </div>
                    @endforeach

                </div>

            </div>
        </section>

        <section id="team" class="team">
            <div class="container">

                <div class="section-title">
                    <span>Tim Kami</span>
                    <h2>Tim Kami</h2>
                    <p>Kami merupakan mahasiswa dari Politeknik Negeri Indramayu dan Kami Terdiri Dari </p>
                </div>

                <div class="row">
                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in">
                        <div class="member">
                            <img src="{{ asset('assets/images/team/dzikri.jpg') }}">
                            <h4>Dzikri Faza Hauna</h4>
                            <span>Mobile Developer</span>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in">
                        <div class="member">
                            <img src="{{ asset('assets/images/team/hakim.jpg') }}"
                                style="
                            height: 200px;
                            width: 550px;
                            background-size: cover
                        ">
                            <h4>Hakim Asrori</h4>
                            <span>Web Developer</span>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in">
                        <div class="member">
                            <img src="{{ asset('assets/images/team/nandang.jpg') }}">
                            <h4>Nandang Eka Prasetya</h4>
                            <span>Mobile Developer</span>
                        </div>
                    </div>

                </div>

            </div>
        </section>

        <section id="contact" class="contact">
            <div class="container">

                <div class="section-title">
                    <span>Kontak</span>
                    <h2>Kontak</h2>
                </div>

                <div class="row" data-aos="fade-up">
                    <div class="col-lg-6">
                        <div class="info-box mb-4">
                            <i class="bx bx-map"></i>
                            <h3>Alamat Kami</h3>
                            <p>JL. lohbener lama No.08, Legok, <br> Kec. Lohbener, Kabupaten Indramayu, <br> Jawa Barat
                                45252</p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="info-box  mb-4">
                            <i class="bx bx-envelope"></i>
                            <h3>Email Kami</h3>
                            <p>ladangsantara@gmail.com</p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="info-box  mb-4">
                            <i class="bx bx-phone-call"></i>
                            <h3>Telpon Kami</h3>
                            <p>+6289639490563</p>
                        </div>
                    </div>

                </div>

            </div>
        </section>
    </main>
@endsection
