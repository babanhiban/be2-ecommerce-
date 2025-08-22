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
    @if (session('error'))
        <div id="notification" class="notification error">
            <span class="icon">⚠️</span>
            <span>{{ session('error') }}</span>
            <button onclick="closeNotification()" class="close-btn">&times;</button>
        </div>
    @endif

    @if (session('success'))
        <div id="notification" class="notification success">
            <span class="icon">✅</span>
            <span>{{ session('success') }}</span>
            <button onclick="closeNotification()" class="close-btn">&times;</button>
        </div>
    @endif
    <header class="header">
        <div class="header-top">
            <div class="logo">
                <img src="{{ asset('images/manhinhdangnhap/logo.png') }}" alt="1StormE Logo">
            </div>
            <div class="menu">
                <div class="menu-title">Danh Mục</div>
            </div>
            <form class="search-bar" action="{{ route('product.search_result') }}" method="GET">
                <div>
                    <input type="text" name="query" placeholder="Tìm kiếm sản phẩm...">
                    <button type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>


            <!-- kiểm tra xem tài khoản vừa đăng nhập là admin hay member nếu là admin sẽ hiển thị icon và các chức năng dành cho admin , ngược lại với member cũng vậy -->
            <div class="account">

                <!-- Kiểm tra role tài khoản vừa đăng nhập là gì -->
                @if (auth()->check())
                    @php
                        $isAdmin = false;
                        foreach (auth()->user()->roles as $role) {
                            if ($role->name === 'admin') {
                                $isAdmin = true;
                                break;
                            }
                        }
                    @endphp

                    <!-- Nếu là admin thì sẽ thay đổi phần thông tin ở tashbar theo admin  -->
                    @if ($isAdmin)
                        <div class="dropdown">
                            <button class="dropbtn">
                                <i class="fas fa-user-shield"></i> {{ auth()->user()->name }} <i
                                    class="fas fa-chevron-down"></i>
                            </button>
                            <div class="dropdown-content">
                                <a href="{{ route('user.updateUser', ['id' => $user->id]) }}"><i
                                        class="fas fa-user-edit"></i> Thông tin cá nhân</a>
                                <a href="{{ route('admin.users') }}"><i class="fas fa-users-cog"></i> Quản lý tài
                                    khoản</a>
                                <a href="{{ route('admin.products') }}"><i class="fas fa-users-cog"></i> Quản lý sản
                                    phẩm</a>
                                <a href="{{ route('orders.index') }}"><i class="fas fa-users-cog"></i> Quản lý đơn
                                    hàng</a>
                                    <a href="{{ route('admin.products') }}"><i class="fas fa-users-cog"></i> Quản lý voucher</a>
                                    
                                <a href="{{ route('logout') }}"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a>
                            </div>
                        </div>

                        <!-- Còn nếu là member hay staff thì sẽ thay đổi phần thông tin ở tashbar theo member hoặc staff  -->
                    @else
                        <div class="dropdown">
                            <button class="dropbtn">
                                <i class="fas fa-user-shield"></i> {{ auth()->user()->name }} <i
                                    class="fas fa-chevron-down"></i>
                            </button>
                            <div class="dropdown-content">
                                <a href="{{ route('user.updateUser', ['id' => $user->id]) }}"><i
                                        class="fas fa-user-edit"></i> Thông tin cá nhân</a>
                                <a href="{{ route('logout') }}"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a>
                            </div>
                        </div>
                    @endif

                    <!-- Nếu không đăng nhập tài khoản nào thì sẽ hiển thị Đăng nhập / Đăng ký giúp chuyển hướng trang về lại đăng nhập -->
                @else
                    <a href="{{ route('login') }}">Đăng Nhập/Đăng Ký</a>
                @endif
            </div>


            <div class="cart">
                <a href="{{ route('cart.index') }}">
                    <i class="fas fa-shopping-cart"></i>
                </a>
            </div>
        </div>
    </header>

    <main>
        <section class="categories">
            <div class="category-container">
                @foreach ($categories as $category)
                    <div class="category-item">
                        <div class="category-image">
                            <a href="{{ route('product.categoryId_Product', $category->id) }}">
                                <img src="{{ asset('images/manhinhtrangchu/categories/' . $category->image) }}"
                                    alt="{{ $category->name }}" style="width:200px; height:auto;">
                            </a>
                        </div>
                        <div class="category-name">{{ $category->name }}</div>
                    </div>
                @endforeach


            </div>
        </section>

        <section class="banner-slider">
            <div class="slider-container">
                <div class="slider-navigation left">
                    <i class="fas fa-chevron-left"></i>
                </div>
                <div class="slider-wrapper">
                    <div class="slide active">

                        <img src="{{ asset('images/manhinhtrangchu/banners/gaming_laptop.png') }}"
                            alt="Tuần lễ laptop gaming">
                    </div>
                    <div class="slide active">

                        <img src="{{ asset('images/manhinhtrangchu/banners/laptop_acer_nitro5.png') }}"
                            alt="Tuần lễ laptop gaming">
                    </div>
                    <div class="slide active">

                        <img src="{{ asset('images/manhinhtrangchu/banners/thang12laptopuudai.png') }}"
                            alt="Tuần lễ laptop gaming">
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
                @foreach ($products as $product)
                    <div class="product-item">
                        <div class="product-image">
                            <img src="{{ asset('images/manhinhsanpham/' . $product->image) }}" alt="Not Found">
                        </div>
                        <div class="product-name">{{ $product->name }}</div>
                        <div class="product-price">Giá: {{ number_format($product->price, 0, ',', '.') }} VND</div>

                        @if ($product->quantity > 0)
                            <div class="product-detail-link">
                                <a href="{{ route('product.show', $product->id) }}">Xem chi tiết</a>
                            </div>
   
                            <div>
                                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="add-button">Thêm vào giỏ</button>
                                </form>
                            </div>
                        @else
                            <p class="text-muted mt-3">⚠️ <strong>Hết hàng</strong></p>
                            <button class="btn btn-secondary mt-2" disabled>Không thể mua</button>
                        @endif



                    </div>
                @endforeach
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

        function closeNotification() {
            const notification = document.getElementById('notification');
            if (notification) {
                notification.style.animation = 'slideOut 0.3s ease-in';
                setTimeout(() => {
                    notification.remove();
                }, 300);
            }
        }

        // Tự động ẩn thông báo sau 5 giây
        document.addEventListener('DOMContentLoaded', function() {
            const notification = document.getElementById('notification');
            if (notification) {
                setTimeout(() => {
                    closeNotification();
                }, 5000);
            }
        });
    </script>
</body>

</html>
