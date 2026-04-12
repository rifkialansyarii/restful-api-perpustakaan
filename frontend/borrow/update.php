<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-wrapper">
        <div class="pcoded-content">
            <div class="pcoded-inner-content">
                <div class="main-body">
                    <div class="page-wrapper">
                        <!-- [ breadcrumb ] start -->
                        <div class="page-header">
                            <div class="page-block">
                                <div class="row align-items-center">
                                    <div class="col-md-12">
                                        <div class="page-header-title">
                                            <h5>Home</h5>
                                        </div>
                                        <ul class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="index.php"><i
                                                        class="feather icon-home"></i></a></li>
                                            <li class="breadcrumb-item"><a href="?page=borrow">Modul Peminjaman</a></li>
                                            <li class="breadcrumb-item"><a href="?page=borrow/update">Update Data Peminjaman</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- [ breadcrumb ] end -->
                        <!-- [ Main Content ] start -->
                        <div class="row">
                            <!-- [ basic-form ] start -->
                            <div class="col-md-12">

                                <div class="card">
                                    <div class="card-header">
                                        <h5>Update Data Peminjaman</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <form method="POST" name="borrowForm">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="siswa">Siswa</label>
                                                        <select class="form-control" id="siswa" name="siswa" required>
                                                            <option value="">-- Pilih Siswa --</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="buku">Buku</label>
                                                        <select class="form-control" id="buku" name="buku" required>
                                                            <option value="">-- Pilih Buku --</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="status">Status</label>
                                                        <select class="form-control" id="status" name="status" required>
                                                            <option id="status-default" value="">-- Pilih Status --
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <button type="submit" name="simpan"
                                                        class="btn btn-primary mb-4">Submit</button>
                                                </form>

                                                <script>
                                                    const urlParams = new URLSearchParams(window.location.search);
                                                    const borrowCode = urlParams.get('id');

                                                    async function loadBorrowData() {
                                                        if (!borrowCode) {
                                                            console.error('Borrow ID tidak ditemukan di URL.');
                                                            return;
                                                        }

                                                        try {
                                                            const response = await fetch(`http://localhost:8080/api/borrows/${borrowCode}`);
                                                            const json = await response.json();

                                                            if (json.code === 200 && json.success === true) {
                                                                const data = json.data;

                                                                const siswaSelect = document.getElementById('siswa');
                                                                const siswaValue = `${data.student} - ${data.student_nisn}`;
                                                                siswaSelect.innerHTML = `<option value="">-- Pilih Siswa --</option>
                                     <option value="${siswaValue}" selected>${siswaValue}</option>`;

                                                                const bukuSelect = document.getElementById('buku');
                                                                const bukuValue = `${data.book_title} - ${data.book_isbn}`;
                                                                bukuSelect.innerHTML = `<option value="">-- Pilih Buku --</option>
                                    <option value="${bukuValue}" selected>${bukuValue}</option>`;


                                                                const statusSelect = document.getElementById('status');
                                                                const currentStatus = data.status; // Data status dari API (pastikan huruf kecil/besarnya sesuai)

                                                                statusSelect.innerHTML = `
                                                                    <option value="">-- Pilih Status --</option>
                                                                    <option value="borrowed" ${currentStatus === 'borrowed' ? 'selected' : ''}>Borrowed</option>
                                                                    <option value="canceled" ${currentStatus === 'canceled' ? 'selected' : ''}>Canceled</option>
                                                                    <option value="overdue"  ${currentStatus === 'overdue' ? 'selected' : ''}>Overdue</option>
                                                                    <option value="returned"  ${currentStatus === 'returned' ? 'selected' : ''}>Returned</option>
                                                                `;

                                                            }
                                                        } catch (error) {
                                                            console.error("Gagal mengambil data peminjaman:", error);
                                                        }
                                                    }

                                                    function validateForm(...arrayInput) {
                                                        let isValid = true;
                                                        arrayInput.forEach(item => {
                                                            if (!item || item.trim() === "") {
                                                                isValid = false;
                                                            }
                                                        });
                                                        if (!isValid) {
                                                            alert('Semua field harus diisi dengan benar');
                                                        }
                                                        return isValid;
                                                    }

                                                    async function sendUpdateBook() {
                                                        const siswaEl = document.getElementById('siswa').value;
                                                        const bukuEl = document.getElementById('buku').value;
                                                        const statusEl = document.getElementById('status').value;

                                                        if (!validateForm(siswaEl, bukuEl, statusEl)) {
                                                            return;
                                                        }

                                                        console.info(siswaEl);
                                                        const request = new Request(`http://localhost:8080/api/borrows/${borrowCode}`, {
                                                            method: "PATCH",
                                                            headers: {
                                                                "Content-Type": "application/json",
                                                                "Accept": "application/json",
                                                            },
                                                            body: JSON.stringify({
                                                                "user": siswaEl,
                                                                "book": bukuEl,
                                                                "status": statusEl,
                                                            })
                                                        });

                                                        try {
                                                            const response = await fetch(request);
                                                            const json = await response.json();
                                                            if (json.code === 200 && json.success === true) {
                                                                alert("Berhasil Mengupdate Data Peminjaman");
                                                            } else {
                                                                alert("Gagal mengupdate data");
                                                            }
                                                        } catch (error) {
                                                            console.error("Error update data:", error);
                                                        }
                                                    }

                                                    // Inisialisasi data saat halaman dimuat
                                                    loadBorrowData();

                                                    document.forms['borrowForm'].onsubmit = (event) => {
                                                        event.preventDefault();
                                                        sendUpdateBook();
                                                    }
                                                </script>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- [ basic-form] end -->


                            <!-- [ Background-Utilities ] start -->

                            <!-- [ Background-Utilities ] end -->
                        </div>

                        <!-- [ Main Content ] end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- [ Main Content ] end -->