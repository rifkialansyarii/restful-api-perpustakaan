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
                                            <li class="breadcrumb-item"><a href="?page=borrow/store">Tambah Data
                                                    Peminjaman</a></li>
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
                                        <h5>Tambah Data Peminjaman</h5>
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
                                                    <button type="submit" name="simpan"
                                                        class="btn btn-primary mb-4">Submit</button>
                                                </form>

                                                <script>
                                                    async function fetchDataMaster() {
                                                        const userRequest = new Request("http://127.0.0.1:8080/api/users");
                                                        const bookRequest = new Request("http://127.0.0.1:8080/api/books");

                                                        const [users, books] = await Promise.all([
                                                            fetch(userRequest).then(res => res.json()),
                                                            fetch(bookRequest).then(res => res.json())
                                                        ]);


                                                        const selectUserEl = document.getElementById("siswa");
                                                        users.data.forEach(user => {
                                                            if (user.role === "student") {
                                                                selectUserEl.insertAdjacentHTML("beforeend", `<div class="mb-3">
                                                                    <label class="form-label" for="siswa">Siswa</label>
                                                                    <select class="form-control" id="siswa" name="siswa" required>
                                                                        <option value="${user.first_name} ${user.last_name} - ${user.nisn}">${user.first_name} ${user.last_name} - ${user.nisn}</option>
                                                                    </select>
                                                                </div>`)
                                                            }
                                                        });

                                                        const selectBookEl = document.getElementById("buku");
                                                        books.data.forEach(book => {
                                                            selectBookEl.insertAdjacentHTML("beforeend", `<div class="mb-3">
                                                        <label class="form-label" for="buku">Buku</label>
                                                        <select class="form-control" id="buku" name="buku" required>
                                                            <option value="${book.title} - ${book.isbn}">${book.title} - ${book.isbn}</option>
                                                        </select>
                                                    </div>`)
                                                        });
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

                                                    async function sendStoreBorrow() {
                                                        const siswaEl = document.getElementById('siswa').value;
                                                        const bukuEl = document.getElementById('buku').value;

                                                        if (!validateForm(siswaEl, bukuEl)) {
                                                            return;
                                                        }

                                                        const request = new Request(`http://localhost:8080/api/borrows`, {
                                                            method: "POST",
                                                            headers: {
                                                                "Content-Type": "application/json",
                                                                "Accept": "application/json",
                                                            },
                                                            body: JSON.stringify({
                                                                "user": siswaEl,
                                                                "book": bukuEl,
                                                            })
                                                        });

                                                        try {
                                                            const response = await fetch(request);
                                                            const json = await response.json();
                                                            if (json.code === 201 && json.success === true) {
                                                                alert("Berhasil Menambahkan Data Peminjaman");
                                                            } else {
                                                                alert("Gagal menambahkan data");
                                                            }
                                                        } catch (error) {
                                                            console.error("Error menambahkan data:", error);
                                                        }
                                                    }

                                                    fetchDataMaster();

                                                    document.forms['borrowForm'].onsubmit = (event) => {
                                                        event.preventDefault();
                                                        sendStoreBorrow();
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