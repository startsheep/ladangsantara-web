@extends('page.app')
@section('content')
    <section id="hero" class="d-flex align-items-center">
        <div class="container">
            <div class="row">
                <div class="container col-sm position-relative" data-aos="fade-up" data-aos-delay="500">
                    <h1>LADANGSANTARA</h1>
                    <h2>Ladangnya Nusantara</h2>
                    <a href="#about" class="btn-get-started scrollto">Mari Mulai</a>
                </div>
                <div class="col-sm">
                    <img src="{{ asset('assets/images/about.jpg') }}" width="100" height="100" alt="">
                </div>
            </div>
        </div>

    </section>

    <main id="main">

        <section id="about" class="about">
            <div class="container">

                <div class="row">
                    <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-left">
                        <img src="{{ asset('assets/images/about.jpg') }}" class="img-fluid" alt="">
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
                            <div class="icon"><i class="bx bxl-dribbble"></i></div>
                            <h4><a href="">Santara Mall</a></h4>
                            <p>Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi</p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="fade-up"
                        data-aos-delay="150">
                        <div class="icon-box">
                            <div class="icon"><i class="bx bx-file"></i></div>
                            <h4><a href="">Online Payment</a></h4>
                            <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore</p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0" data-aos="fade-up"
                        data-aos-delay="300">
                        <div class="icon-box">
                            <div class="icon"><i class="bx bx-tachometer"></i></div>
                            <h4><a href="">Geolocation</a></h4>
                            <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia</p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4" data-aos="fade-up" data-aos-delay="450">
                        <div class="icon-box">
                            <div class="icon"><i class="bx bx-world"></i></div>
                            <h4><a href="">Freshness Detection</a></h4>
                            <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis</p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4" data-aos="fade-up" data-aos-delay="600">
                        <div class="icon-box">
                            <div class="icon"><i class="bx bx-slideshow"></i></div>
                            <h4><a href="">Receipe Recomendation</a></h4>
                            <p>Quis consequatur saepe eligendi voluptatem consequatur dolor consequuntur</p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4" data-aos="fade-up" data-aos-delay="750">
                        <div class="icon-box">
                            <div class="icon"><i class="bx bx-arch"></i></div>
                            <h4><a href="">Review</a></h4>
                            <p>Modi nostrum vel laborum. Porro fugit error sit minus sapiente sit aspernatur</p>
                        </div>
                    </div>

                </div>

            </div>
        </section>

        <section id="cta" class="cta">
            <div class="container" data-aos="zoom-in">

                <div class="text-center">
                    <a class="cta-btn" href="#">Unduh Aplikasi</a>
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
                                <a href="{{ route('web.store.slug', $store->slug) }}" class="details-link"
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
                            <img src="assets/img/team/team-1.jpg" alt="">
                            <h4>Walter White</h4>
                            <span>Chief Executive Officer</span>
                            <p>
                                Magni qui quod omnis unde et eos fuga et exercitationem. Odio veritatis perspiciatis quaerat
                                qui aut aut aut
                            </p>
                            <div class="social">
                                <a href=""><i class="bi bi-twitter"></i></a>
                                <a href=""><i class="bi bi-facebook"></i></a>
                                <a href=""><i class="bi bi-instagram"></i></a>
                                <a href=""><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in">
                        <div class="member">
                            <img src="assets/img/team/team-2.jpg" alt="">
                            <h4>Sarah Jhinson</h4>
                            <span>Product Manager</span>
                            <p>
                                Repellat fugiat adipisci nemo illum nesciunt voluptas repellendus. In architecto rerum rerum
                                temporibus
                            </p>
                            <div class="social">
                                <a href=""><i class="bi bi-twitter"></i></a>
                                <a href=""><i class="bi bi-facebook"></i></a>
                                <a href=""><i class="bi bi-instagram"></i></a>
                                <a href=""><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in">
                        <div class="member">
                            <img src="assets/img/team/team-3.jpg" alt="">
                            <h4>William Anderson</h4>
                            <span>CTO</span>
                            <p>
                                Voluptas necessitatibus occaecati quia. Earum totam consequuntur qui porro et laborum toro
                                des clara
                            </p>
                            <div class="social">
                                <a href=""><i class="bi bi-twitter"></i></a>
                                <a href=""><i class="bi bi-facebook"></i></a>
                                <a href=""><i class="bi bi-instagram"></i></a>
                                <a href=""><i class="bi bi-linkedin"></i></a>
                            </div>
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
                            <p>JL. lohbener lama No.08, Legok, Kec. Lohbener, Kabupaten Indramayu, Jawa Barat 45252</p>
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
