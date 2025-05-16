<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>1StormE - Cửa hàng điện tử</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <header class="header">
        <div class="header-top">
            <div class="logo">
                <img src="{{ asset('images/manhinhdangnhap/logo.png') }}" alt="1StormE Logo">
            </div>
            <div class="menu">
                <div class="menu-title">Danh Mục</div>
            </div>
            <div class="search-bar">
                <input type="text" placeholder="Tìm kiếm sản phẩm">
                <button type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>


            <div class="account">
                @if(auth()->check())
                @php
                $isAdmin = false;
                foreach(auth()->user()->roles as $role) {
                if($role->name === 'admin') {
                $isAdmin = true;
                break;
                }
                }
                @endphp

                @if($isAdmin)
                <div class="dropdown">
                    <button class="dropbtn">
                        <i class="fas fa-user-shield"></i> {{ auth()->user()->name }} <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="dropdown-content">
                        <a href="{{ route('user.updateUser', ['id' => $user->id]) }}"><i class="fas fa-user-edit"></i> Thông tin cá nhân</a>
                        <a href="{{ route('admin.users') }}"><i class="fas fa-users-cog"></i> Quản lý tài khoản</a>
                        <a href="{{ route('admin.users') }}"><i class="fas fa-users-cog"></i> Quản lý sản phẩm</a>
                        <a href="{{ route('logout') }}"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a>
                    </div>
                </div>
                @else
                <div class="dropdown">
                    <button class="dropbtn">
                        <i class="fas fa-user-shield"></i> {{ auth()->user()->name }} <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="dropdown-content">
                        <a href="{{ route('user.updateUser', ['id' => $user->id]) }}"><i class="fas fa-user-edit"></i> Thông tin cá nhân</a>
                        <a href="{{ route('logout') }}"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a>
                    </div>
                </div>
                @endif
                @else
                <a href="{{ route('login') }}">Đăng Nhập/Đăng Ký</a>
                @endif
            </div>


            <div class="cart">
                <a href="{{ route('cart') }}">
                    <i class="fas fa-shopping-cart"></i>
                </a>
            </div>
        </div>
    </header>

    <main>
        <section class="categories">
            <div class="category-container">
                <div class="category-item">
                    <div class="category-image">
                        <img src=" {{ asset('images/manhinhtrangchu/categories/dienthoai.png') }}" alt=" Điện Thoại">

                    </div>
                    <div class="category-name">Điện Thoại</div>
                </div>

                <div class="category-item">
                    <div class="category-image">
                        <img src="{{ asset('images/manhinhtrangchu/categories/laptop.png') }}" alt="Laptop">
                    </div>
                    <div class="category-name">Laptop</div>
                </div>

                <div class="category-item">
                    <div class="category-image">
                        <img src="{{ asset('images/manhinhtrangchu/categories/mayanh.png') }}" alt="Máy Ảnh">
                    </div>
                    <div class="category-name">Máy Ảnh</div>
                </div>

                <div class="category-item">
                    <div class="category-image">
                        <img src="{{ asset('images/manhinhtrangchu/categories/tainghe.png') }}" alt="Tai Nghe">
                    </div>
                    <div class="category-name">Tai Nghe</div>
                </div>

                <div class="category-item">
                    <div class="category-image">
                        <img src="{{ asset('images/manhinhtrangchu/categories/manhinh.png') }}" alt="Màn Hình">
                    </div>
                    <div class="category-name">Màn Hình</div>
                </div>

                <div class="category-item">
                    <div class="category-image">
                        <img src="{{ asset('images/manhinhtrangchu/categories/chuotmaytinh.png') }}" alt="Chuột Máy Tính">
                    </div>
                    <div class="category-name">Chuột Máy Tính</div>
                </div>

                <div class="category-item">
                    <div class="category-image">
                        <img src="{{ asset('images/manhinhtrangchu/categories/phukien.png') }}" alt="Phụ Kiện Khác">
                    </div>
                    <div class="category-name">Phụ Kiện Khác</div>
                </div>
            </div>
        </section>

        <section class="banner-slider">
            <div class="slider-container">
                <div class="slider-navigation left">
                    <i class="fas fa-chevron-left"></i>
                </div>
                <div class="slider-wrapper">
                    <div class="slide active">

                        <img src="{{ asset('images/manhinhtrangchu/banners/gaming_laptop.png') }}" alt="Tuần lễ laptop gaming">
                    </div>
                    <div class="slide active">

                        <img src="{{ asset('images/manhinhtrangchu/banners/laptop_acer_nitro5.png') }}" alt="Tuần lễ laptop gaming">
                    </div>
                    <div class="slide active">

                        <img src="{{ asset('images/manhinhtrangchu/banners/thang12laptopuudai.png') }}" alt="Tuần lễ laptop gaming">
                    </div>
                    <!-- Thêm các slides khác nếu cần -->
                </div>
                <div class="slider-navigation right">
                    <i class="fas fa-chevron-right"></i>
                </div>
            </div>
        </section>

        <section class="flash-sale">
            <div class="section-header">
                <div class="title">Flash Sale | Còn lại:</div>
                <div class="countdown">
                    <span id="countdown-timer">02:40:41</span>
                </div>
            </div>

            <div class="products-container">
                @for ($i = 1; $i <= 8; $i++)
                    <div class="product-item">
                    <div class="product-image">
                        <img src="{{ asset('images/manhinhtrangchu/products/iphone12promax.png') }}" alt="Điện thoại">
                    </div>
                    <div class="product-price">16.500.000đ</div>
                    <div class="product-action">
                        <button class="buy-button">Mua ngay</button>
                    </div>
            </div>
            @endfor
            </div>
        </section>
    </main>

    <footer>
        <div class="footer-container">
            <div class="footer-column">
                <h3>KẾT NỐI VỚI 1STORME</h3>
                <p>Tổng đài miễn phí</p>
                <p class="hotline">1800 9999</p>
                <p>(Từ 8h đến 21h hàng ngày)</p>
            </div>

            <div class="footer-column">
                <h3>VỀ CHÚNG TÔI</h3>
                <ul>
                    <li><a href="#">Giới thiệu về công ty</a></li>
                    <li><a href="#">Quy chế hoạt động</a></li>
                    <li><a href="#">Hệ thống cửa hàng</a></li>
                    <li><a href="#">Tuyển dụng</a></li>
                </ul>
            </div>

            <div class="footer-column">
                <h3>CHÍNH SÁCH</h3>
                <ul>
                    <li><a href="#">Chính sách bảo hành</a></li>
                    <li><a href="#">Chính sách đổi trả</a></li>
                    <li><a href="#">Chính sách thanh toán</a></li>
                    <li><a href="#">Chính sách bảo vệ</a></li>
                </ul>
            </div>

            <div class="footer-column">
                <h3>HỖ TRỢ THANH TOÁN</h3>
                <div class="payment-methods">
                    <img src="{{ asset('images/payment/payment-methods.png') }}" alt="Phương thức thanh toán">
                </div>
                <div class="certification">
                    <p>CHỨNG NHẬN</p>
                    <img src="{{ asset('images/certifications/cert.png') }}" alt="Chứng nhận">
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Countdown Timer
        function updateCountdown() {
            const countdownElement = document.getElementById('countdown-timer');
            let timeArray = countdownElement.textContent.split(':');
            let hours = parseInt(timeArray[0]);
            let minutes = parseInt(timeArray[1]);
            let seconds = parseInt(timeArray[2]);

            seconds--;
            if (seconds < 0) {
                seconds = 59;
                minutes--;
                if (minutes < 0) {
                    minutes = 59;
                    hours--;
                    if (hours < 0) {
                        hours = 0;
                        minutes = 0;
                        seconds = 0;
                    }
                }
            }

            countdownElement.textContent =
                (hours < 10 ? '0' + hours : hours) + ':' +
                (minutes < 10 ? '0' + minutes : minutes) + ':' +
                (seconds < 10 ? '0' + seconds : seconds);
        }

        setInterval(updateCountdown, 1000);

        // Banner Slider
        const prevButton = document.querySelector('.slider-navigation.left');
        const nextButton = document.querySelector('.slider-navigation.right');
        const slides = document.querySelectorAll('.slide');
        let currentSlide = 0;

        function showSlide(index) {
            slides.forEach((slide, i) => {
                slide.classList.remove('active');
                if (i === index) {
                    slide.classList.add('active');
                }
            });
        }

        prevButton.addEventListener('click', () => {
            currentSlide = (currentSlide - 1 + slides.length) % slides.length;
            showSlide(currentSlide);
        });

        nextButton.addEventListener('click', () => {
            currentSlide = (currentSlide + 1) % slides.length;
            showSlide(currentSlide);
        });

        // Auto slide
        setInterval(() => {
            currentSlide = (currentSlide + 1) % slides.length;
            showSlide(currentSlide);
        }, 5000);
    </script>
</body>

</html>