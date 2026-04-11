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
                                            <a href="?page=book/store" class="btn btn-primary">Tambah Buku</a>
                                        </div>


                                    </div>
                                    <div class="card-body table-border-style">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Kode Peminjaman</th>
                                                        <th>Siswa</th>
                                                        <th>Judul Buku</th>
                                                        <th>Tanggal Pinjam</th>
                                                        <th>Tenggat Waktu Pinjam</th>
                                                        <th>Tanggal Dikembalikan</th>
                                                        <th>Status</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody style="color: white;" id="borrows-tbody">
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
        const getBorrows = async () => {
            const requestGetBorrows = new Request("http://localhost:8080/api/borrows");

            try {
                const responseGetBorrows = await fetch(requestGetBorrows);
                const jsonGetBorrows = await responseGetBorrows.json();


                if (jsonGetBorrows.code === 200 && jsonGetBorrows.success === true) {
                    const listbooks = document.getElementById('borrows-tbody');

                    let index = 0;
                    jsonGetBorrows.data.forEach(borrow => {
                        const row = listbooks.insertRow(index);
                        
                        const cellId = row.insertCell(0);
                        const cellKodePinjam = row.insertCell(1);
                        const cellSiswa = row.insertCell(2);
                        const cellBuku = row.insertCell(3);
                        const cellTanggalPinjam = row.insertCell(4);
                        const cellTenggatWaktu = row.insertCell(5);
                        const cellTanggalKembali = row.insertCell(6);
                        const cellStatus = row.insertCell(7);
                        const cellAksi = row.insertCell(8);

                        cellId.appendChild(document.createTextNode(index + 1));
                        cellKodePinjam.appendChild(document.createTextNode(borrow.borrow_code));
                        cellSiswa.appendChild(document.createTextNode(`${borrow.student} - ${borrow.student_nisn}`));
                        cellBuku.appendChild(document.createTextNode(`${borrow.book_title} - ${borrow.book_isbn}`));
                        cellTanggalPinjam.appendChild(document.createTextNode(borrow.borrow_date));
                        cellTenggatWaktu.appendChild(document.createTextNode(borrow.due_date));
                        cellTanggalKembali.appendChild(document.createTextNode(borrow.return_date == null ? "Belum dikembalikan" : borrow.return_date));
                        cellStatus.appendChild(document.createTextNode(borrow.status));

                        const linkEditActionEl = document.createElement("a");
                        const linkDeleteActionEl = document.createElement("a");

                        linkEditActionEl.setAttribute("href", `?page=borrow/update&id=${borrow.borrow_code}`);
                        linkEditActionEl.setAttribute("class", "btn btn-sm btn-warning");

                        linkDeleteActionEl.setAttribute("href", `?page=borrow/destroy&id=${borrow.borrow_code}`);
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

        getBorrows();
    </script>
</div>
<!-- [ Main Content ] end -->