<head>
    <link href={{ asset('css/bootstrap.min.css') }} rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #f4f4f4;
            display: flex;
        }

        header {
            padding: 1rem;
            text-align: center;
        }

        .carousel {
            position: relative;
            width: 90%;               
            max-width: 960px;         
            height: 540px;            
            overflow: hidden;
            margin: 2rem auto;        
            border-radius: 12px;      
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2); 
        }

        @keyframes slide {
            0%   { margin-left: 0; }
            25%  { margin-left: -100%; }
            50%  { margin-left: -200%; }
            75%  { margin-left: -300%; }
            100% { margin-left: 0; }
        }

        .section {
            padding: 2rem;
            text-align: center;
        }

        .members, .services {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 1.5rem;
        }

        .card {
            background: white;
            padding: 1rem;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            width: 200px;
        }

        .card img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 50%; /* Makes the image a perfect circle */
            margin: 0 auto;
            display: block;
        }

        .card h3 {
            margin: 0.5rem 0 0.2rem;
        }

        .card p {
            margin: 0;
            font-size: 0.9rem;
            color: #555;
        }

        .sidebar {
            width: 80px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
        }

        .main-content {
            margin-left: 80px;
            padding: 2rem;
            flex: 1;
        }

        #announcementCarousel {
            max-width: 800px;
            height: 400px;
            margin: 2rem auto;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        /* Image fits the container cleanly */
        .carousel-item img {
            width: 100%;
            height: 100%;
            object-fit: cover; /* or try "contain" if you prefer no cropping */
            border-radius: 12px;
        }
    </style>
</head>


<body>
@include('tab.homeSidebar')

<div style="margin-left: 80px;" class="main-content" id="main-content">
    @yield('content')


    <header>
        <h1>OLPC Connect</h1>
    </header>
    
        <!-- Image Carousel -->
        <div class="container mt-4">
            <div id="announcementCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner h-100">
                        @foreach($announcements as $index => $announcement)
                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                <img src="{{ asset('storage/' . $announcement->image_path) }}" class="d-block w-100" alt="Announcement Image">
                            </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#announcementCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#announcementCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
        </div>

        <!-- Members Section -->
        <section class="section">
            <h2>Meet Our Members</h2>
            <div class="members">
                <div class="card">
                    <h4>Myrna L. Macarubbo, RL, MSLS</h4>
                    <p>Cheif Librarian</p>
                </div>
            </div>
            <p></p>
            <div class="members">
                <div class="card">
                    <h4>Jona V. Castilla, RL, LPT</h4>
                    <p>Librarian Elementary Department</p>
                </div>
                <div class="card">
                    <h4>Rhea Jane L. Tumaliuan, RL, MLIS</h4>
                    <p>Technical Librarian College-Graduate School Department</p>
                </div>
                <div class="card">
                    <h4>Jamaica B. Magmanlac</h4>
                    <p>Assistant Librarian College Department</p>
                </div>
                <div class="card">
                    <h4>Rugene M. Mejia, jr., LPT</h4>
                    <p>Support Staff College Department</p>
                </div>
            </div>
        </section>

        <!-- Services Section -->
        <section class="section" style="background-color: #eef2ff;">
            <h2>Our Services</h2>
            <div class="services">
                <div class="card">
                    <h3>Book Circulation</h3>
                    <p>Borrowing and returning of books.</p>
                </div>
                <div class="card">
                    <h3>OLP Connect</h3>
                    <p>Website viewing of eBooks.</p>
                </div>
                <div class="card">
                    <h3>Internet Library</h3>
                    <p>Public access computers for students to use.</p>
                </div>
            </div>
        </section>

    <script>
            // Adjust margin based on sidebar open/closed
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('main-content');

            const resizeObserver = new ResizeObserver(() => {
                const width = sidebar.offsetWidth;
                mainContent.style.marginLeft = width + 'px';
            });

            resizeObserver.observe(sidebar);
    </script>

</div>


<script src={{ asset('js/bootstrap.bundle.min.js') }}></script>
</body>
