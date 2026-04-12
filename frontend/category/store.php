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
                                            <li class="breadcrumb-item"><a href="?page=category">Modul Kategori Buku</a></li>
                                            <li class="breadcrumb-item"><a href="?page=category/store">Tambah Data
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
                                        <h5>Tambah Data Kategori Buku</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <form method="POST" name="categoryForm">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="kategori">Kategori</label>
                                                        <input type="text" class="form-control" id="kategori" name="kategori"
                                                            placeholder="Masukkan Kategori" required>
                                                    </div>
                                                    <button type="submit" name="simpan"
                                                        class="btn btn-primary mb-4">Submit</button>
                                                </form>

                                                <script>
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

                                                    async function sendStoreCategory() {
                                                        const categoryEl = document.getElementById('kategori').value;

                                                        if (!validateForm(categoryEl)) {
                                                            return;
                                                        }

                                                        const request = new Request(`http://localhost:8080/api/categories`, {
                                                            method: "POST",
                                                            headers: {
                                                                "Content-Type": "application/json",
                                                                "Accept": "application/json",
                                                            },
                                                            body: JSON.stringify({
                                                                "category_name": categoryEl,
                                                            })
                                                        });

                                                        try {
                                                            const response = await fetch(request);
                                                            const json = await response.json();
                                                            if (json.code === 201 && json.success === true) {
                                                                alert("Berhasil Menambahkan Data Kategori Buku");
                                                            } else {
                                                                alert("Gagal menambahkan data");
                                                            }
                                                        } catch (error) {
                                                            console.error("Error menambahkan data:", error);
                                                        }
                                                    }


                                                    document.forms['categoryForm'].onsubmit = (event) => {
                                                        event.preventDefault();
                                                        sendStoreCategory();
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