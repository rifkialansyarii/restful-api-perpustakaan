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
                                            <li class="breadcrumb-item"><a href="?page=user">Modul User</a></li>
                                            <li class="breadcrumb-item"><a href="?page=user/store">Tambah Data
                                                    User</a></li>
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
                                        <h5>Tambah Data User</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <form method="POST" name="userForm">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="nisn">NISN</label>
                                                        <input type="text" class="form-control" id="nisn" name="nisn"
                                                            placeholder="Masukkan NISN">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="first_name">First Name</label>
                                                        <input type="text" class="form-control" id="first_name"
                                                            name="first_name" placeholder="Masukkan First Name"
                                                            required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="last_name">Last Name</label>
                                                        <input type="text" class="form-control" id="last_name"
                                                            name="last_name" placeholder="Masukkan Last Name" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="whatsapp_number">No. Whatsapp</label>
                                                        <input type="text" class="form-control" id="whatsapp_number"
                                                            name="whatsapp_number" placeholder="Masukkan Nomor Whatsapp" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="role">Role</label>
                                                        <select class="form-control" id="role" name="role" required>
                                                            <option value="">-- Pilih Role --</option>
                                                            <option value="student">Student</option>
                                                            <option value="admin">Admin</option>
                                                        </select>
                                                    </div>
                                                    <button type="submit" name="simpan"
                                                        class="btn btn-primary mb-4">Submit</button>
                                                </form>

                                                <script>

                                                    async function sendStoreUser() {
                                                        const nisnEl = document.getElementById('nisn').value;
                                                        const firstNameEl = document.getElementById('first_name').value;
                                                        const lastNameEl = document.getElementById('last_name').value;
                                                        const whatsappNumEl = document.getElementById('whatsapp_number').value;
                                                        const roleEl = document.getElementById('role').value;
                                                    
                                                        const request = new Request(`http://localhost:8080/api/users`, {
                                                            method: "POST",
                                                            headers: {
                                                                "Content-Type": "application/json",
                                                                "Accept": "application/json",
                                                            },
                                                            body: JSON.stringify({
                                                                "nisn": nisnEl,
                                                                "first_name": firstNameEl,
                                                                "last_name": lastNameEl,
                                                                "whatsapp_number": whatsappNumEl,
                                                                "role": roleEl,
                                                            })
                                                        });

                                                        try {
                                                            const response = await fetch(request);
                                                            const json = await response.json();
                                                            if (json.code === 201 && json.success === true) {
                                                                alert("Berhasil Menambahkan Data User");
                                                            } else {
                                                                alert("Gagal menambahkan data");
                                                            }
                                                        } catch (error) {
                                                            console.error("Error menambahkan data:", error);
                                                        }
                                                    }


                                                    document.forms['userForm'].onsubmit = (event) => {
                                                        event.preventDefault();
                                                        sendStoreUser();
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