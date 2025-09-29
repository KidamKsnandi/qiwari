<!-- ======= Footer ======= -->
<footer id="footer" class="footer">

    <div class="footer-top">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-5 col-md-12 footer-info">
                    <a href="/" class="logo d-flex align-items-center">
                        {{-- <img src="assets/img/logo.png" alt=""> --}}
                        {{-- <span>Terapis</span> --}}
                        <img src="{{ asset('images/logo-balanja.png') }}" alt="Logo">
                    </a>
                    {{-- <p>Bandung, Indonesia.</p> --}}
                    <div class="social-links mt-3">
                        <a href="#" style="color: black" class="twitter"><i class="bi bi-twitter"></i></a>
                        <a href="#" style="color: black" class="facebook"><i class="bi bi-facebook"></i></a>
                        <a href="#" style="color: black" class="instagram"><i class="bi bi-instagram"></i></a>
                        <a href="#" style="color: black" class="youtube"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>

                <div class="col-lg-2 col-6 footer-links">
                    <h4>Tentang Matrial</h4>
                    <ul>
                        {{-- <li><i class="bi bi-chevron-right"></i> <a href="#">Blog</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Kabar Terbaru</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Karir</a></li> --}}
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Ketentuan dan Kebijakan Privasi</a>
                        </li>
                        <li><i class="bi bi-chevron-right"></i> <a href="/privacy-policy">Privacy Policy</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-6 footer-links">
                    <h4>Kerja Sama</h4>
                    <ul>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Affiliate Program</a></li>
                        {{-- <li><i class="bi bi-chevron-right"></i> <a href="#">Jual Di Terapis</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">B2B Program</a></li> --}}
                    </ul>
                </div>

                <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start text-white">
                    <h4>Kontak Kami</h4>
                    <p>
                        Bandung, Indonesia <br>
                        <strong>Phone:</strong>085861345339<br>
                        <strong>Email:</strong> info.Matrial@gmail.com<br>
                    </p>

                </div>

            </div>
        </div>
    </div>

    <div class="container">
        <div class="copyright">
            &copy; Copyright <strong><span>Matrial {{ date('Y') }}</span></strong>. All Rights Reserved
        </div>

    </div>
</footer><!-- End Footer -->
