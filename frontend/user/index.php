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
                                            <li class="breadcrumb-item"><a href="?page=user">Modul User</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- [ breadcrumb ] end -->
                        <!-- [ Main Content ] start -->
                        <div class="row">
                            <!-- [ basic-table ] start -->
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div
                                            style="flex: auto; justify-content: space-between; display: flex; align-items: center;">
                                            <h5>Data User</h5>
                                            <a href="?page=user/store" class="btn btn-primary">Tambah Data User</a>
                                        </div>


                                    </div>
                                    <div class="card-body table-border-style">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>NISN</th>
                                                        <th>First Name</th>
                                                        <th>Last Name</th>
                                                        <th>No. Whatsapp</th>
                                                        <th>Role</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody style="color: white;" id="user-tbody">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- [ basic-table ] end -->


                            <!-- [ Background-Utilities ] start -->

                            <!-- [ Background-Utilities ] end -->
                        </div>

                        <!-- [ Main Content ] end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const getUsers = async () => {
            const requestGetUsers = new Request("http://localhost:8080/api/users");

            try {
                const users = await fetch(requestGetUsers).then(res => res.json());

                if (users.code === 200 && users.success === true) {
                    const listUsers = document.getElementById("user-tbody");

                    let index = 0;
                    users.data.forEach(user => {
                        const row = listUsers.insertRow(index);
                        
                        const cellId = row.insertCell(0);
                        const cellNisn = row.insertCell(1)
                        const cellFirstName = row.insertCell(2)
                        const cellLastName = row.insertCell(3)
                        const cellWhatsappNumber = row.insertCell(4)
                        const cellRole = row.insertCell(5)
                        const cellAksi = row.insertCell(6);

                        cellId.appendChild(document.createTextNode(index + 1));
                        cellNisn.appendChild(document.createTextNode(user.nisn));
                        cellFirstName.appendChild(document.createTextNode(user.first_name));
                        cellLastName.appendChild(document.createTextNode(user.last_name));
                        cellWhatsappNumber.appendChild(document.createTextNode(user.whatsapp_number));
                        cellRole.appendChild(document.createTextNode(user.role));

                        const linkEditActionEl = document.createElement("a");
                        const linkDeleteActionEl = document.createElement("a");

                        linkEditActionEl.setAttribute("href", `?page=user/update&id=${user.id}`);
                        linkEditActionEl.setAttribute("class", "btn btn-sm btn-warning");

                        linkDeleteActionEl.setAttribute("href", `?page=user/destroy&id=${user.id}`);
                        linkDeleteActionEl.setAttribute("class", "btn btn-sm btn-danger");
                        linkDeleteActionEl.setAttribute("onclick", "return confirm('Yakin ingin menghapus?')");

                        linkEditActionEl.textContent = "Edit";
                        linkDeleteActionEl.textContent = "Delete";
                        
                        
                        cellAksi.append(linkEditActionEl, linkDeleteActionEl);

                        index++;
                    });

                }
            } catch (error) {
                console.error("Error to get Data Borrows: " . error);
            }
        }

        getUsers();
    </script>
</div>
<!-- [ Main Content ] end -->