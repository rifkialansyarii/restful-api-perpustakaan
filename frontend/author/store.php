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
                                            <li class="breadcrumb-item"><a href="?page=author">Author Modul</a>
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
                                        <h5>Author Form</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <form method="POST" name="authorForm">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="author_name">Author Name</label>
                                                        <input type="text" class="form-control" id="author_name"
                                                            name="author_name" placeholder="Enter Author Name" required>
                                                    </div>
                                                    <button type="submit" name="simpan"
                                                        class="btn btn-primary mb-4">Submit</button>
                                                </form>

                                                <script>
                                                    function validateForm(authorName) {
                                                        if (!authorName) {
                                                            alert('Semua field harus diisi');
                                                            return false;
                                                        }
                                                    }

                                                   async function sendCreateAuthor(){
                                                        const authorName = document.getElementById('author_name').value.trim();

                                                        validateForm(authorName);

                                                        const request = new Request("http://localhost:8080/api/authors", {
                                                            method: "POST",
                                                            headers: {
                                                                "Content-Type": "application/json",
                                                                "Accept": "application/json",
                                                            },
                                                            body: JSON.stringify({
                                                                "author_name":authorName
                                                            })
                                                        });


                                                        try{
                                                            const response = await fetch(request);
                                                            const json = await response.json();
                                                            if (json.code === 201 && json.success === true && json.message === "Author added successfully") {
                                                                alert("Berhasil Menambahkan Author");                                                         
                                                            }
                                                        }catch(error){
                                                            console.error("Error fetch: " + error);
                                                        }
                                                        
                                                    }

                                                    document.forms['authorForm'].onsubmit = (event) => {
                                                        sendCreateAuthor();
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