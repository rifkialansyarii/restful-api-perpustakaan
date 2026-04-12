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
                                            <h5>Data Kategori Buku</h5>
                                            <a href="?page=category/store" class="btn btn-primary">Tambah Data Kategori Buku</a>
                                        </div>


                                    </div>
                                    <div class="card-body table-border-style">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Kategori</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody style="color: white;" id="categories-tbody">
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
        const getCategories = async () => {
            const requestGetCategories = new Request("http://localhost:8080/api/categories");

            try {
                const categories = await fetch(requestGetCategories).then(res => res.json());

                if (categories.code === 200 && categories.success === true) {
                    const listbooks = document.getElementById('categories-tbody');

                    let index = 0;
                    categories.data.forEach(category => {
                        const row = listbooks.insertRow(index);
                        
                        const cellId = row.insertCell(0);
                        const cellNamaKategori = row.insertCell(1)
                        const cellAksi = row.insertCell(2);

                        cellId.appendChild(document.createTextNode(index + 1));
                        cellNamaKategori.appendChild(document.createTextNode(category.category_name));

                        const linkEditActionEl = document.createElement("a");
                        const linkDeleteActionEl = document.createElement("a");

                        linkEditActionEl.setAttribute("href", `?page=category/update&id=${category.id}`);
                        linkEditActionEl.setAttribute("class", "btn btn-sm btn-warning");

                        linkDeleteActionEl.setAttribute("href", `?page=category/destroy&id=${category.id}`);
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

        getCategories();
    </script>
</div>
<!-- [ Main Content ] end -->