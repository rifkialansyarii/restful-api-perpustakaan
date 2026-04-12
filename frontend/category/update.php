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
                                            <li class="breadcrumb-item"><a href="?page=category">Modul Kategori Buku</a>
                                            </li>
                                            <li class="breadcrumb-item"><a href="?page=category/update">Update Data
                                                    Kategori Buku</a></li>
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
                                        <h5>Update Data Kategori Buku</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <form method="POST" name="categoryForm">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="kategori">Kategori</label>
                                                        <input type="text" class="form-control" id="kategori"
                                                            name="kategori" placeholder="Masukkan Kategori" required>
                                                    </div>
                                                    <button type="submit" name="simpan"
                                                        class="btn btn-primary mb-4">Submit</button>
                                                </form>

                                                <script>
                                                    const urlParams = new URLSearchParams(window.location.search);
                                                    const categoryId = urlParams.get('id');

                                                    async function loadCategoryData() {
                                                        if (!categoryId) {
                                                            console.error('Category ID tidak ditemukan di URL.');
                                                            return;
                                                        }

                                                        try {
                                                            const categories = await fetch(`http://localhost:8080/api/categories/${categoryId}`).then(ref => ref.json());

                                                            if (categories.code === 200 && categories.success === true) {
                                                                const data = categories.data;

                                                                const catEl =document.getElementById("kategori");
                                                                catEl.value = data.category_name;
                                                            }
                                                        } catch (error) {
                                                            console.error("Gagal mengambil data kategori buku:", error);
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
                                                        const catEl = document.getElementById('kategori').value;

                                                        if (!validateForm(catEl)) {
                                                            return;
                                                        }

                                                        const request = new Request(`http://localhost:8080/api/categories/${categoryId}`, {
                                                            method: "PATCH",
                                                            headers: {
                                                                "Content-Type": "application/json",
                                                                "Accept": "application/json",
                                                            },
                                                            body: JSON.stringify({
                                                                "category_name": catEl,
                                                            })
                                                        });

                                                        try {
                                                            const response = await fetch(request);
                                                            const json = await response.json();
                                                            if (json.code === 200 && json.success === true) {
                                                                alert("Berhasil Mengupdate Data Kategori Buku");
                                                            } else {
                                                                alert("Gagal mengupdate data");
                                                            }
                                                        } catch (error) {
                                                            console.error("Error update data:", error);
                                                        }
                                                    }

                                                    loadCategoryData();

                                                    document.forms['categoryForm'].onsubmit = (event) => {
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