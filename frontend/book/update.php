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
                                            <li class="breadcrumb-item"><a href="?page=book">Modul Buku</a></li>
                                            <li class="breadcrumb-item"><a href="?page=book/update">Update Data Buku</a></li>
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
                                        <h5>Update Data Buku</h5>
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
                                                    const urlParams = new URLSearchParams(window.location.search);
                                                    const bookIsbnParam = urlParams.get('id');
                                                    let authorOptionsHTML = '';
                                                    let categoryOptionsHTML = '';
                                                    let authorCount = 1;
                                                    let categoryCount = 1;

                                                    async function fetchMasterData() {
                                                        try {
                                                            const [publishers, authors, categories] = await Promise.all([
                                                                fetch("http://localhost:8080/api/publishers").then(res => res.json()),
                                                                fetch("http://localhost:8080/api/authors").then(res => res.json()),
                                                                fetch("http://localhost:8080/api/categories").then(res => res.json()),
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

                                                    function createInputField(inputName, count) {
                                                        const labelText = `${inputName.charAt(0).toUpperCase() + inputName.slice(1)} ${count}`;
                                                        const selectId = `${inputName}s-${count}`;
                                                        const optionsHTML = inputName === 'author' ? authorOptionsHTML : categoryOptionsHTML;

                                                        return `
                                                            <div class="${inputName}-item mt-3">
                                                                <label class="form-label" for="${selectId}">${labelText}</label>
                                                                <div class="d-flex gap-2">
                                                                    <select class="form-control" id="${selectId}" name="${inputName}[]" required>
                                                                        <option value="">-- Pilih ${inputName.charAt(0).toUpperCase() + inputName.slice(1)} --</option>
                                                                        ${optionsHTML}
                                                                    </select>
                                                                    <button type="button" class="btn btn-danger btn-hapus">X</button>
                                                                </div>
                                                            </div>
                                                        `;
                                                    }

                                                    function addAndDestroyInputHandler(inputName) {
                                                        const buttonAddInput = document.getElementById(`tambah-${inputName}`);
                                                        const form = document.getElementById(`form-${inputName}`);

                                                        buttonAddInput.addEventListener('click', () => {
                                                            if (inputName === 'author') {
                                                                authorCount++;
                                                                form.insertAdjacentHTML('beforeend', createInputField(inputName, authorCount));
                                                            } else {
                                                                categoryCount++;
                                                                form.insertAdjacentHTML('beforeend', createInputField(inputName, categoryCount));
                                                            }
                                                        });

                                                        form.addEventListener('click', (event) => {
                                                            if (event.target.matches('.btn-hapus')) {
                                                                if (inputName === 'author' && authorCount > 1) {
                                                                    authorCount--;
                                                                }
                                                                if (inputName === 'kategori' && categoryCount > 1) {
                                                                    categoryCount--;
                                                                }

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

                                                    function renderAuthorInputs(authors) {
                                                        const form = document.getElementById('form-author');
                                                        form.innerHTML = '';
                                                        authorCount = Math.max(authors.length, 1);
                                                        authors.forEach((author, index) => {
                                                            const number = index + 1;
                                                            const html = `
                                                                <div class="author-item${index > 0 ? ' mt-3' : ''}">
                                                                    <label class="form-label" for="authors-${number}">Author ${number}</label>
                                                                    <div class="d-flex gap-2">
                                                                        <select class="form-control" id="authors-${number}" name="author[]" required>
                                                                            <option value="">-- Pilih Author --</option>
                                                                            ${authorOptionsHTML}
                                                                        </select>
                                                                        ${number > 1 ? '<button type="button" class="btn btn-danger btn-hapus">X</button>' : ''}
                                                                    </div>
                                                                </div>
                                                            `;
                                                            form.insertAdjacentHTML('beforeend', html);
                                                        });

                                                        if (authors.length === 0) {
                                                            form.insertAdjacentHTML('beforeend', createInputField('author', 1));
                                                        }

                                                        authors.forEach((author, index) => {
                                                            const selectEl = document.getElementById(`authors-${index + 1}`);
                                                            if (selectEl) {
                                                                selectEl.value = author.author_name;
                                                            }
                                                        });
                                                    }

                                                    function renderCategoryInputs(categories) {
                                                        const form = document.getElementById('form-kategori');
                                                        form.innerHTML = '';
                                                        categoryCount = Math.max(categories.length, 1);
                                                        categories.forEach((category, index) => {
                                                            const number = index + 1;
                                                            const html = `
                                                                <div class="kategori-item${index > 0 ? ' mt-3' : ''}">
                                                                    <label class="form-label" for="kategoris-${number}">Kategori ${number}</label>
                                                                    <div class="d-flex gap-2">
                                                                        <select class="form-control" id="kategoris-${number}" name="kategori[]" required>
                                                                            <option value="">-- Pilih Kategori --</option>
                                                                            ${categoryOptionsHTML}
                                                                        </select>
                                                                        ${number > 1 ? '<button type="button" class="btn btn-danger btn-hapus">X</button>' : ''}
                                                                    </div>
                                                                </div>
                                                            `;
                                                            form.insertAdjacentHTML('beforeend', html);
                                                        });

                                                        if (categories.length === 0) {
                                                            form.insertAdjacentHTML('beforeend', createInputField('kategori', 1));
                                                        }

                                                        categories.forEach((category, index) => {
                                                            const selectEl = document.getElementById(`kategoris-${index + 1}`);
                                                            if (selectEl) {
                                                                selectEl.value = category.category_name;
                                                            }
                                                        });
                                                    }

                                                    async function getDetailBook() {
                                                        if (!bookIsbnParam) {
                                                            console.error('Book ID tidak ditemukan di URL.');
                                                            return;
                                                        }

                                                        const requestDetailBook = new Request(`http://localhost:8080/api/books/${bookIsbnParam}`);
                                                        try {
                                                            const responseGetDetailBook = await fetch(requestDetailBook);
                                                            const jsonDetailBook = await responseGetDetailBook.json();

                                                            if (jsonDetailBook.code === 200 && jsonDetailBook.success === true) {
                                                                document.getElementById('isbn').value = jsonDetailBook.data.isbn;
                                                                document.getElementById('title').value = jsonDetailBook.data.title;
                                                                document.getElementById('publisher').value = jsonDetailBook.data.publisher;
                                                                document.getElementById('publication_year').value = jsonDetailBook.data.publication_year;
                                                                document.getElementById('stock').value = jsonDetailBook.data.stock;

                                                                renderAuthorInputs(jsonDetailBook.data.authors || [{ author_name: '' }]);
                                                                renderCategoryInputs(jsonDetailBook.data.categories || [{ category_name: '' }]);
                                                            }
                                                        } catch (error) {
                                                            console.error('Error get detail book: ' + error);
                                                        }
                                                    }

                                                    function validateForm(...arrayInput) {
                                                        let isValid = true;
                                                        arrayInput.forEach(item => {
                                                            if (!item) {
                                                                isValid = false;
                                                            }
                                                        });
                                                        if (!isValid) {
                                                            alert('Semua field harus diisi');
                                                        }
                                                        return isValid;
                                                    }

                                                    async function sendUpdateBook() {
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

                                                        if (!validateForm(bookIsbn, bookTitle, bookPublisher, bookPublicationYear, bookStock)) {
                                                            return;
                                                        }

                                                        const request = new Request(`http://localhost:8080/api/books/${bookIsbnParam}`, {
                                                            method: "PATCH",
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
                                                                "stock": parseInt(bookStock, 10),
                                                            })
                                                        });

                                                        try {
                                                            const response = await fetch(request);
                                                            const json = await response.json();
                                                            if (json.code === 200 && json.success === true) {
                                                                alert("Berhasil Mengupdate Buku");
                                                            }
                                                        } catch (error) {
                                                            console.error("Error fetch: " + error);
                                                        }
                                                    }

                                                    (async function init() {
                                                        await fetchMasterData();
                                                        await getDetailBook();
                                                        addAndDestroyInputHandler('author');
                                                        addAndDestroyInputHandler('kategori');
                                                    })();

                                                    document.forms['bookForm'].onsubmit = (event) => {
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