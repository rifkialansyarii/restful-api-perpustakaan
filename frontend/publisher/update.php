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
                                            <li class="breadcrumb-item"><a href="?page=publisher">Modul Publisher</a>
                                            </li>
                                            <li class="breadcrumb-item"><a href="?page=publisher/update">Update Data
                                                    Publisher</a></li>
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
                                        <h5>Update Data Publisher</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <form method="POST" name="publisherForm">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="publisher">publisher</label>
                                                        <input type="text" class="form-control" id="publisher"
                                                            name="publisher" placeholder="Masukkan publisher" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="alamat">Alamat</label>
                                                        <textarea class="form-control" id="alamat" name="alamat"
                                                            placeholder="Masukkan alamat" rows="6" required></textarea>
                                                    </div>
                                                    <button type="submit" name="simpan"
                                                        class="btn btn-primary mb-4">Submit</button>
                                                </form>

                                                <script>
                                                    const urlParams = new URLSearchParams(window.location.search);
                                                    const publisherId = urlParams.get('id');

                                                    async function loadPublisherData() {
                                                        if (!publisherId) {
                                                            console.error('Publisher ID tidak ditemukan di URL.');
                                                            return;
                                                        }

                                                        try {
                                                            const publishers = await fetch(`http://localhost:8080/api/publishers/${publisherId}`).then(ref => ref.json());

                                                            if (publishers.code === 200 && publishers.success === true) {
                                                                const data = publishers.data;

                                                                const pubEl = document.getElementById("publisher");
                                                                pubEl.value = data.publisher_name;

                                                                const alamatEl = document.getElementById("alamat");
                                                                alamat.value = data.address;
                                                            }
                                                        } catch (error) {
                                                            console.error("Gagal mengambil data Publisher:", error);
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

                                                    async function sendUpdatePublisher() {
                                                        const pubEl = document.getElementById('publisher').value;
                                                        const alamatEl = document.getElementById('alamat').value;

                                                        if (!validateForm(pubEl, alamatEl)) {
                                                            return;
                                                        }

                                                        const request = new Request(`http://localhost:8080/api/publishers/${publisherId}`, {
                                                            method: "PATCH",
                                                            headers: {
                                                                "Content-Type": "application/json",
                                                                "Accept": "application/json",
                                                            },
                                                            body: JSON.stringify({
                                                                "publisher_name": pubEl,
                                                                "address": alamatEl,
                                                            })
                                                        });

                                                        try {
                                                            const response = await fetch(request);
                                                            const json = await response.json();
                                                            if (json.code === 200 && json.success === true) {
                                                                alert("Berhasil Mengupdate Data Publisher");
                                                            } else {
                                                                alert("Gagal mengupdate data");
                                                            }
                                                        } catch (error) {
                                                            console.error("Error update data:", error);
                                                        }
                                                    }

                                                    loadPublisherData();

                                                    document.forms['publisherForm'].onsubmit = (event) => {
                                                        event.preventDefault();
                                                        sendUpdatePublisher();
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