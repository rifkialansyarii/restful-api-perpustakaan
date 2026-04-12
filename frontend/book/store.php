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
                            <!-- [ basic-form ] start -->
                            <div class="col-md-12">

                                <div class="card">
                                    <div class="card-header">
                                        <h5>Form Buku</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <form method="POST" name="bookForm">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="isbn">ISBN</label>
                                                        <input type="text" class="form-control" id="isbn" name="isbn"
                                                            placeholder="Masukkan ISBN" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="title">Judul</label>
                                                        <input type="text" class="form-control" id="title" name="judul"
                                                            placeholder="Masukkan Judul" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="publisher">Publisher</label>
                                                        <select class="form-control" id="publisher" name="publisher"
                                                            required>
                                                            <option value="">-- Pilih Publisher --</option>
                                                        </select>
                                                    </div>

                                                    <div class="mb-3" id="form-author">
                                                        <div class="author-item">
                                                            <label class="form-label" for="authors-1">Author 1</label>
                                                            <select class="form-control" id="authors-1" name="author[]"
                                                                required>
                                                                <option value="">-- Pilih Author --</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <button type="button" name="tambah-author" id="tambah-author"
                                                        class="btn btn-primary mb-4">+ Tambah Author</button>

                                                    <div class="mb-3" id="form-kategori">
                                                        <div class="kategori-item">
                                                            <label class="form-label" for="kategoris-1">Kategori
                                                                1</label>
                                                            <select class="form-control" id="kategoris-1"
                                                                name="kategori[]" required>
                                                                <option value="">-- Pilih Kategori --</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <button type="button" name="tambah-categori" id="tambah-kategori"
                                                        class="btn btn-primary mb-4">+ Tambah Kategori</button>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="publication_year">Tahun
                                                            Publikasi</label>
                                                        <input type="text" class="form-control" id="publication_year"
                                                            name="publication_year"
                                                            placeholder="Masukkan Tahun Publikasi" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="stock">Stock</label>
                                                        <input type="number" class="form-control" id="stock"
                                                            name="stock" placeholder="Masukkan Stock" required>
                                                    </div>
                                                    <button type="submit" name="simpan"
                                                        class="btn btn-primary mb-4">Submit</button>
                                                </form>

                                                <script>
                                                    let authorOptionsHTML = '';
                                                    let categoryOptionsHTML = '';

                                                    async function fetchMasterData() {
                                                        try {
                                                            const [publishers, authors, categories] = await Promise.all([
                                                                fetch("http://localhost:8080/api/publishers").then(res => res.json()),
                                                                fetch("http://localhost:8080/api/authors").then(res => res.json()),
                                                                fetch("http://localhost:8080/api/categories").then(res => res.json())
                                                            ]);

                                                            const publisherSelect = document.getElementById('publisher');
                                                            if (publishers.success) {
                                                                publishers.data.forEach(pub => {
                                                                    publisherSelect.insertAdjacentHTML('beforeend', `<option value="${pub.publisher_name}">${pub.publisher_name}</option>`);
                                                                });
                                                            }

                                                            const authorSelect1 = document.getElementById('authors-1');
                                                            if (authors.success) {
                                                                authors.data.forEach(auth => {
                                                                    const opt = `<option value="${auth.author_name}">${auth.author_name}</option>`;
                                                                    authorOptionsHTML += opt;
                                                                    authorSelect1.insertAdjacentHTML('beforeend', opt);
                                                                });
                                                            }

                                                            const categorySelect1 = document.getElementById('kategoris-1');
                                                            if (categories.success) {
                                                                categories.data.forEach(cat => {
                                                                    const opt = `<option value="${cat.category_name}">${cat.category_name}</option>`;
                                                                    categoryOptionsHTML += opt;
                                                                    categorySelect1.insertAdjacentHTML('beforeend', opt);
                                                                });
                                                            }
                                                        } catch (error) {
                                                            console.error("Gagal mengambil data master:", error);
                                                        }
                                                    }


                                                    function addAndDestroyInputHandler(inputName) {
                                                        const buttonAddInput = document.getElementById(`tambah-${inputName}`);
                                                        const form = document.getElementById(`form-${inputName}`);

                                                        let count = 1;

                                                        let newInputForm;

                                                        buttonAddInput.addEventListener('click', () => {
                                                            count++;

                                                            if (inputName === 'author') {
                                                                newInputForm = `
                                                                    <div class="${inputName}-item mt-3">
                                                                        <label class="form-label" for="${inputName}s-${count}">${inputName.charAt(0).toUpperCase() + inputName.slice(1)} ${count}</label>
                                                                        <div class="d-flex gap-2">
                                                                            <select class="form-control" id="${inputName}s-${count}" name="${inputName}[]" required>
                                                                                <option value="">-- Pilih ${inputName.charAt(0).toUpperCase() + inputName.slice(1)} --</option>
                                                                                ${authorOptionsHTML}
                                                                            </select>
                                                                            <button type="button" class="btn btn-danger btn-hapus">X</button>
                                                                        </div>
                                                                    </div>
                                                                `;
                                                            } else if (inputName === 'kategori') {
                                                                newInputForm = `
                                                                    <div class="${inputName}-item mt-3">
                                                                        <label class="form-label" for="${inputName}s-${count}">${inputName.charAt(0).toUpperCase() + inputName.slice(1)} ${count}</label>
                                                                        <div class="d-flex gap-2">
                                                                            <select class="form-control" id="${inputName}s-${count}" name="${inputName}[]" required>
                                                                                <option value="">-- Pilih ${inputName.charAt(0).toUpperCase() + inputName.slice(1)} --</option>
                                                                                ${categoryOptionsHTML}
                                                                            </select>
                                                                            <button type="button" class="btn btn-danger btn-hapus">X</button>
                                                                        </div>
                                                                    </div>
                                                                `;
                                                            }

                                                            form.insertAdjacentHTML('beforeend', newInputForm);

                                                        })


                                                        form.addEventListener('click', (event) => {

                                                            if (event.target.matches('.btn-hapus')) {
                                                                count--;

                                                                event.target.closest(`.${inputName}-item`).remove();
                                                                const allInput = document.querySelectorAll(`.${inputName}-item`);


                                                                allInput.forEach((element, index) => {
                                                                    const newNumber = index + 1;


                                                                    const labelSelector = element.querySelector('.form-label');
                                                                    const inputSelector = element.querySelector('.form-control');

                                                                    labelSelector.textContent = `${inputName.charAt(0).toUpperCase() + inputName.slice(1)} ${newNumber}`;
                                                                    labelSelector.setAttribute('for', `${inputName}s-${newNumber}`);

                                                                    inputSelector.id = `${inputName}s-${newNumber}`;
                                                                });


                                                            }


                                                        });
                                                    }

                                                    function validateForm(...arrayInput) {

                                                        arrayInput.forEach(item => {
                                                            if (!item) {
                                                                alert('Semua field harus diisi');
                                                                return false;
                                                            }
                                                        });

                                                    }

                                                    async function sendCreatebook() {
                                                        const bookIsbn = document.getElementById('isbn').value.trim();
                                                        const bookTitle = document.getElementById('title').value.trim();
                                                        const bookPublisher = document.getElementById('publisher').value.trim();

                                                        const authorSelects = document.querySelectorAll('select[name="author[]"]');
                                                        const bookAuthors = [];
                                                        authorSelects.forEach(select => {
                                                            if (select.value !== "") {
                                                                bookAuthors.push({ "author_name": select.value });
                                                            }
                                                        });

                                                        const categorySelects = document.querySelectorAll('select[name="kategori[]"]');
                                                        const bookCategories = [];
                                                        categorySelects.forEach(select => {
                                                            if (select.value !== "") {
                                                                bookCategories.push({ "category_name": select.value });
                                                            }
                                                        });

                                                        const bookPublicationYear = document.getElementById('publication_year').value.trim();
                                                        const bookStock = document.getElementById('stock').value.trim();

                                                        validateForm([bookIsbn, bookTitle, bookPublisher, bookPublicationYear, bookStock]);

                                                        const request = new Request("http://localhost:8080/api/books", {
                                                            method: "POST",
                                                            headers: {
                                                                "Content-Type": "application/json",
                                                                "Accept": "application/json",
                                                            },
                                                            body: JSON.stringify({
                                                                "isbn": bookIsbn,
                                                                "title": bookTitle,
                                                                "publisher_name": bookPublisher,
                                                                "authors": bookAuthors,
                                                                "categories": bookCategories,
                                                                "publication_year": bookPublicationYear,
                                                                "stock": parseInt(bookStock),
                                                            })
                                                        });


                                                        try {
                                                            const response = await fetch(request).then(res => res.json());
                                                            if (response.code === 201 && response.success === true) {
                                                                alert("Berhasil Menambahkan Buku");
                                                            }
                                                        } catch (error) {
                                                            console.error("Error fetch: " + error);
                                                        }

                                                    }

                                                    fetchMasterData();
                                                    addAndDestroyInputHandler("author");
                                                    addAndDestroyInputHandler("kategori");

                                                    document.forms['bookForm'].onsubmit = (event) => {
                                                        sendCreatebook();
                                                        event.preventDefault();
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