document.getElementById('ogrenciForm').addEventListener('submit', function (e) {
    e.preventDefault();

    const formData = new FormData(this);

    fetch('index.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        const messageDiv = document.getElementById('message');
        if (data.success) {
            messageDiv.textContent = data.message;
            messageDiv.style.color = 'green';
            this.reset();
        } else {
            messageDiv.textContent = data.message;
            messageDiv.style.color = 'red';
        }
    })
    .catch(error => {
        document.getElementById('message').textContent = 'Bir hata oluştu.';
        document.getElementById('message').style.color = 'red';
    });
});
