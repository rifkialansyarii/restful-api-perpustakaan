<script>
    const urlSearchParams = new URLSearchParams(window.location.search);
    const borrowCode = urlSearchParams.get("id");

    const destroyBorrow = async () => {
        const requestDestroyBorrow = new Request(`http://localhost:8080/api/borrows/${borrowCode}`,{
            method: "DELETE",
            headers:  {"Accept": "application/json"},
        });
        
        const responseDestroyBorrow = await fetch(requestDestroyBorrow);
        const jsonResponseDestroyBorrow = await responseDestroyBorrow.json();

        if(jsonResponseDestroyBorrow.code === 200 && jsonResponseDestroyBorrow.success === true){
            alert("book berhasil dihapus");
            window.location.href = "http://localhost:8081/?page=borrow/index"
        }
    }

    destroyBorrow();
</script>