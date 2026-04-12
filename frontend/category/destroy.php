<script>
    const urlSearchParams = new URLSearchParams(window.location.search);
    const categoryCode = urlSearchParams.get("id");

    const destroyBorrow = async () => {
        const requestDestroyCategory = new Request(`http://localhost:8080/api/categories/${categoryCode}`,{
            method: "DELETE",
            headers:  {"Accept": "application/json"},
        });
        
        const responseDestroyCategory = await fetch(requestDestroyCategory);
        const jsonResponseDestroyCategory = await responseDestroyCategory.json();

        if(jsonResponseDestroyCategory.code === 200 && jsonResponseDestroyCategory.success === true){
            alert("Data kategori buku berhasil dihapus");
            window.location.href = "http://localhost:8081/?page=category/index"
        }
    }

    destroyBorrow();
</script>