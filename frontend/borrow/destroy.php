<script>
    const urlSearchParams = new URLSearchParams(window.location.search);
    const bookId = urlSearchParams.get("id");

    const destroybook = async () => {
        const requestDestroyBook = new Request(`http://localhost:8080/api/books/${bookId}`,{
            method: "DELETE",
            headers:  {"Accept": "application/json"},
        });
        
        const responseDestroyBook = await fetch(requestDestroyBook);
        const jsonResponseDestroyBook = await responseDestroyBook.json();

        if(jsonResponseDestroyBook.code === 200 && jsonResponseDestroyBook.success === true){
            alert("book berhasil dihapus");
            window.location.href = "http://localhost:8081/?page=book/index"
        }
    }

    destroybook();
</script>