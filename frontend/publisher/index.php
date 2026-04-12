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
                                            <h5>Data Publisher</h5>
                                            <a href="?page=publisher/store" class="btn btn-primary">Tambah Data Publisher</a>
                                        </div>


                                    </div>
                                    <div class="card-body table-border-style">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Publisher</th>
                                                        <th>Alamat</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody style="color: white;" id="publisher-tbody">
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
        const getPublishers = async () => {
            const requestGetPublishers = new Request("http://localhost:8080/api/publishers");

            try {
                const publishers = await fetch(requestGetPublishers).then(res => res.json());

                if (publishers.code === 200 && publishers.success === true) {
                    const listPublishers = document.getElementById('publisher-tbody');

                    let index = 0;
                    publishers.data.forEach(publisher => {
                        const row = listPublishers.insertRow(index);
                        
                        const cellId = row.insertCell(0);
                        const cellPublisher = row.insertCell(1)
                        const cellAlamat = row.insertCell(2)
                        const cellAksi = row.insertCell(3);

                        cellId.appendChild(document.createTextNode(index + 1));
                        cellPublisher.appendChild(document.createTextNode(publisher.publisher_name));
                        cellAlamat.appendChild(document.createTextNode(publisher.address));

                        const linkEditActionEl = document.createElement("a");
                        const linkDeleteActionEl = document.createElement("a");

                        linkEditActionEl.setAttribute("href", `?page=publisher/update&id=${publisher.id}`);
                        linkEditActionEl.setAttribute("class", "btn btn-sm btn-warning");

                        linkDeleteActionEl.setAttribute("href", `?page=publisher/destroy&id=${publisher.id}`);
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

        getPublishers();
    </script>
</div>
<!-- [ Main Content ] end -->