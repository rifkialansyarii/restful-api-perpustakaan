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
                                            <li class="breadcrumb-item"><a href="?page=author">Modul Author</a>
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
                                            <h5>Data Author</h5>
                                            <a href="?page=author/store" class="btn btn-primary">Tambah
                                                Author</a>
                                        </div>


                                    </div>
                                    <div class="card-body table-border-style">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Nama Author</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody style="color: white;" id="authors-tbody">
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
        const getAuthors = async () => {
            const requestGetAuthors = new Request("http://localhost:8080/api/authors");

            try {
                const authors = await fetch(requestGetAuthors).then(res => res.json());

                if (authors.code === 200 && authors.success === true) {
                    const listAuthors = document.getElementById('authors-tbody');

                    let index = 0;
                    authors.data.forEach(author => {
                        const row = listAuthors.insertRow(index);
                        const cellId = row.insertCell(0);
                        const cellName = row.insertCell(1);
                        const cellAction = row.insertCell(2);

                        cellId.appendChild(document.createTextNode(index + 1));
                        cellName.appendChild(document.createTextNode(author.author_name));

                        const linkEditActionEl = document.createElement("a");
                        const linkDeleteActionEl = document.createElement("a");

                        linkEditActionEl.setAttribute("href", `?page=author/update&id=${author.id}`);
                        linkEditActionEl.setAttribute("class", "btn btn-sm btn-warning");

                        linkDeleteActionEl.setAttribute("href", `?page=author/destroy&id=${author.id}`);
                        linkDeleteActionEl.setAttribute("class", "btn btn-sm btn-danger");
                        linkDeleteActionEl.setAttribute("onclick", "return confirm('Yakin ingin menghapus?')");

                        linkEditActionEl.textContent = "Edit";
                        linkDeleteActionEl.textContent = "Delete";
                        
                        
                        cellAction.append(linkEditActionEl, linkDeleteActionEl);

                        index++;
                    });

                }
            } catch (error) {
                console.error("Error to get Data Authors: " . error);
            }
        }

        getAuthors();
    </script>
</div>
<!-- [ Main Content ] end -->