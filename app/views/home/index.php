<body class="flex flex-col min-h-screen bg-gray-100">
    <!-- Navbar -->
    <nav class="bg-gradient-to-r from-blue-600 to-blue-800 text-white p-4 shadow-lg">
        <div class="container mx-auto flex justify-between items-center">
            <div class="text-2xl font-bold">Logo</div>
            <div class="hidden md:flex space-x-6 nav-links">
                <a href="#" class="hover:text-blue-200 transition-colors">Trang chủ</a>
                <a href="#" class="hover:text-blue-200 transition-colors">Giới thiệu</a>
                <a href="#" class="hover:text-blue-200 transition-colors">Dịch vụ</a>
                <a href="#" class="hover:text-blue-200 transition-colors">Liên hệ</a>
            </div>
            <button class="md:hidden text-2xl menu-toggle">☰</button>
        </div>
    </nav>

    <!-- Main Container -->
    <div class="flex flex-1">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-xl p-6 fixed h-full md:static sidebar sidebar-hidden md:sidebar">
            <ul class="space-y-4">
                <li><a href="#"
                        class="text-gray-700 hover:text-blue-600 hover:bg-blue-50 block p-2 rounded transition-colors">Danh
                        mục 1</a></li>
                <li><a href="#"
                        class="text-gray-700 hover:text-blue-600 hover:bg-blue-50 block p-2 rounded transition-colors">Danh
                        mục 2</a></li>
                <li><a href="#"
                        class="text-gray-700 hover:text-blue-600 hover:bg-blue-50 block p-2 rounded transition-colors">Danh
                        mục 3</a></li>
                <li><a href="#"
                        class="text-gray-700 hover:text-blue-600 hover:bg-blue-50 block p-2 rounded transition-colors">Danh
                        mục 4</a></li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6 md:ml-64">
            <div class="container mx-auto">
                <h1 class="text-3xl font-bold text-gray-800 mb-4">Nội dung chính</h1>
                <p class="text-gray-600">Đây là khu vực nội dung chính của trang web. Bạn có thể thêm văn bản, hình ảnh,
                    hoặc các thành phần khác tại đây.</p>
            </div>
        </main>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center p-4 mt-auto">
        <p>© 2025 - Bản quyền thuộc về Công ty ABC</p>
    </footer>

    <script>
        const menuToggle = document.querySelector('.menu-toggle');
        const navLinks = document.querySelector('.nav-links');
        const sidebar = document.querySelector('.sidebar');

        menuToggle.addEventListener('click', () => {
            navLinks.classList.toggle('nav-links-hidden');
            navLinks.classList.toggle('flex');
            navLinks.classList.toggle('flex-col');
            navLinks.classList.toggle('absolute');
            navLinks.classList.toggle('top-16');
            navLinks.classList.toggle('left-0');
            navLinks.classList.toggle('w-full');
            navLinks.classList.toggle('bg-blue-700');
            navLinks.classList.toggle('p-4');
            sidebar.classList.toggle('sidebar-hidden');
        });
    </script>
</body>