<script>
    const urlSearchParams = new URLSearchParams(window.location.search);
    const authorId = urlSearchParams.get("id");

    const destroyAuthor = async () => {
        const requestDestroyAuthor = new Request(`http://localhost:8080/api/authors/${authorId}`,{
            method: "DELETE",
            headers:  {"Accept": "application/json"},
        });
        
        const responseDestroyAuthor = await fetch(requestDestroyAuthor);
        const jsonResponseDestroyAuthor = await responseDestroyAuthor.json();

        if(jsonResponseDestroyAuthor.code === 200 && jsonResponseDestroyAuthor.success === true){
            alert("Author berhasil dihapus");
            window.location.href = "http://localhost:8081/?page=author/index"
        }
    }

    destroyAuthor();
</script>