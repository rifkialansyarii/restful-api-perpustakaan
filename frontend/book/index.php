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
                                            <li class="breadcrumb-item"><a href="?page=book">Modul Buku</a>
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
                                            <h5>Data Buku</h5>
                                            <a href="?page=book/store" class="btn btn-primary">Tambah Data Buku</a>
                                        </div>


                                    </div>
                                    <div class="card-body table-border-style">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>ISBN</th>
                                                        <th>Judul</th>
                                                        <th>Author</th>
                                                        <th>Kategori</th>
                                                        <th>Publisher</th>
                                                        <th>Tahun Publikasi</th>
                                                        <th>Stock</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody style="color: white;" id="books-tbody">
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
        const getBooks = async () => {
            const requestGetBooks = new Request("http://localhost:8080/api/books");

            try {
                const books = await fetch(requestGetBooks).then(res => res.json());

                if (books.code === 200 && books.success === true) {
                    const listbooks = document.getElementById('books-tbody');

                    let index = 0;
                    books.data.forEach(book => {
                        const row = listbooks.insertRow(index);
                        
                        const cellId = row.insertCell(0);
                        const cellIsbn = row.insertCell(1);
                        const cellTitle = row.insertCell(2);
                        const cellAuthor = row.insertCell(3);
                        const cellCategory = row.insertCell(4);
                        const cellPublisher = row.insertCell(5);
                        const cellPublicationYear = row.insertCell(6);
                        const cellStock = row.insertCell(7);
                        const cellAction = row.insertCell(8);

                        cellId.appendChild(document.createTextNode(index + 1));
                        cellIsbn.appendChild(document.createTextNode(book.isbn));
                        cellTitle.appendChild(document.createTextNode(book.title));

                        const authors = book.authors.map(author => author.author_name).join(", ");
                        cellAuthor.appendChild(document.createTextNode(authors));
                        
                        const categories = book.categories.map(category => category.category_name).join(", ");
                        cellCategory.appendChild(document.createTextNode(categories));

                        cellPublisher.appendChild(document.createTextNode(book.publisher));
                        cellPublicationYear.appendChild(document.createTextNode(book.publication_year));
                        cellStock.appendChild(document.createTextNode(book.stock));

                        const linkEditActionEl = document.createElement("a");
                        const linkDeleteActionEl = document.createElement("a");

                        linkEditActionEl.setAttribute("href", `?page=book/update&id=${book.isbn}`);
                        linkEditActionEl.setAttribute("class", "btn btn-sm btn-warning");

                        linkDeleteActionEl.setAttribute("href", `?page=book/destroy&id=${book.isbn}`);
                        linkDeleteActionEl.setAttribute("class", "btn btn-sm btn-danger");
                        linkDeleteActionEl.setAttribute("onclick", "return confirm('Yakin ingin menghapus?')");

                        linkEditActionEl.textContent = "Edit";
                        linkDeleteActionEl.textContent = "Delete";
                        
                        
                        cellAction.append(linkEditActionEl, linkDeleteActionEl);

                        index++;
                    });

                }
            } catch (error) {
                console.error("Error to get Data books: " . error);
            }
        }

        getBooks();
    </script>
</div>
<!-- [ Main Content ] end -->