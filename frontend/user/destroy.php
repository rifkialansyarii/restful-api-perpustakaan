<script>
    const urlSearchParams = new URLSearchParams(window.location.search);
    const userId = urlSearchParams.get("id");

    const destroyUser = async () => {
        const requestDestroyUser = new Request(`http://localhost:8080/api/users/${userId}`,{
            method: "DELETE",
            headers:  {"Accept": "application/json"},
        });
        
        const responseDestroyUser = await fetch(requestDestroyUser);
        const jsonResponseDestroyUser = await responseDestroyUser.json();

        if(jsonResponseDestroyUser.code === 200 && jsonResponseDestroyUser.success === true){
            alert("Data user berhasil dihapus");
            window.location.href = "http://localhost:8081/?page=user/index"
        }
    }

    destroyUser();
</script>