<html>
<head>
    <title>Absensi Asisten Dosen</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"></link>
    <style>
        .dropdown-content {
            display: none;
        }
        .dropdown:hover .dropdown-content {
            display: block;
        }
        .dropdown-content div:hover {
            background-color: #033a8c;
        }
    </style>
    <script>
        function toggleDropdown() {
            var dropdown = document.getElementById("dropdown-content");
            if (dropdown.style.display === "none" || dropdown.style.display === "") {
                dropdown.style.display = "block";
            } else {
                dropdown.style.display = "none";
            }
        }
    </script>
</head>
<body class="bg-white flex items-center justify-center h-screen">
    <div class="w-2/3">
        <h1 class="text-center text-3xl font-serif mb-8">Absensi Asisten Dosen</h1>
        <div class="border rounded-lg">
            <div class="flex">
                <button class="w-1/2 py-4 border-r border-b">Ganjil</button>
                <button class="w-1/2 py-4 bg-[#0446b0] text-white border-b">Genap</button>
            </div>
            <div class="p-8">
                <div class="border rounded-lg mb-4 p-4 flex justify-between items-center">
                    <span>Proyek Sistem Multimedia</span>
                    <div class="relative">
                        <button class="text-[#0446b0]" onclick="toggleDropdown()"><i class="fas fa-chevron-right"></i></button>
                        <div id="dropdown-content" class="absolute right-0 mt-2 w-24 bg-[#0446b0] text-white rounded-lg shadow-lg">
                            <div class="p-2 border-b border-white">Kelas</div>
                            <div class="p-2 border-b border-white cursor-pointer">A1</div>
                            <div class="p-2 border-b border-white cursor-pointer">A2</div>
                            <div class="p-2 border-b border-white cursor-pointer">B1</div>
                            <div class="p-2 cursor-pointer">B3</div>
                        </div>
                    </div>
                </div>
                <div class="bg-[#0446b0] text-white rounded-lg mb-4 p-4 flex justify-between items-center">
                    <span>Proyek Aljabar Linear</span>
                    <button class="text-white"><i class="fas fa-chevron-right"></i></button>
                </div>
                <div class="bg-[#0446b0] text-white rounded-lg mb-4 p-4 flex justify-between items-center">
                    <span>Proyek Pengantar Basis Data</span>
                    <button class="text-white"><i class="fas fa-chevron-right"></i></button>
                </div>
                <div class="bg-[#0446b0] text-white rounded-lg mb-4 p-4 flex justify-between items-center">
                    <span>Proyek Sistem Operasi</span>
                    <button class="text-white"><i class="fas fa-chevron-right"></i></button>
                </div>
                <div class="bg-[#0446b0] text-white rounded-lg mb-4 p-4 flex justify-between items-center">
                    <span>Proyek Rekayasa Perangkat Lunak</span>
                    <button class="text-white"><i class="fas fa-chevron-right"></i></button>
                </div>
                <div class="bg-[#0446b0] text-white rounded-lg p-4 flex justify-between items-center">
                    <span>Proyek Pemrograman Berbasis Kerangka Kerja</span>
                    <button class="text-white"><i class="fas fa-chevron-right"></i></button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>