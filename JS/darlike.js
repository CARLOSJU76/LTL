
//==================================================================================================================

function incrementarLike(comentarioId, liker) {
    let sesionInciada = localStorage.getItem('sesionIniciada');   

    if (sesionInciada === 'true') {

        const currentDate = new Date().toLocaleDateString('en-CA'); // Formato: YYYY-MM-DD
       

        return fetch('index.php?action=dando_like', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ id: comentarioId, name: liker, currentDate: currentDate })
        })
        .then(response => response.json())
        .then(result => {
            location.reload();
            alert(result.message);
            document.getElementById('comments').style.display = "block";
        })
        .catch(error => console.error('Error:', error));

    } else {
        alert("Debes iniciar sesión para interactuar en los comentarios.");
    }
}
