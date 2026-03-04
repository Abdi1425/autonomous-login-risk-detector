function submitLogin() {
    const attempts = document.getElementById('attempts').value;
    const hour = document.getElementById('hour').value;
    const location = document.getElementById('location').value;

    fetch('./backend/riskController.php', { // <-- remove ../
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({attempts, hour, location})
    })
    .then(res => res.json())
    .then(data => {
        document.getElementById('result').innerText =
            `Decision: ${data.decision} | Risk Score: ${data.score}`;
    })
    .catch(err => {
        console.error("Error:", err);
        document.getElementById('result').innerText = "Error contacting server.";
    });
}
