<script>
    const urlSearchParams = new URLSearchParams(window.location.search);
    const publisherId = urlSearchParams.get("id");

    const destroyPublisher = async () => {
        const requestDestroyPublisher = new Request(`http://localhost:8080/api/publishers/${publisherId}`,{
            method: "DELETE",
            headers:  {"Accept": "application/json"},
        });
        
        const responseDestroyPublisher = await fetch(requestDestroyPublisher);
        const jsonResponseDestroyPublisher = await responseDestroyPublisher.json();

        if(jsonResponseDestroyPublisher.code === 200 && jsonResponseDestroyPublisher.success === true){
            alert("Data publisher berhasil dihapus");
            window.location.href = "http://localhost:8081/?page=publisher/index"
        }
    }

    destroyPublisher();
</script>