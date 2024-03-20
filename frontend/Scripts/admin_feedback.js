const tableBody = document.getElementById("feedbackBody");

axios
    .get("http://localhost/Flight-System-Website/backend/get_feedback.php")
    .then(response => {
        const data = response.data;
        data.forEach(feedback => {
            const row = document.createElement("tr");
            row.innerHTML = `
            <td>${feedback.UserID}</td>
            <td>${feedback.FlightID}</td>
            <td>${feedback.Rating}</td>
            <td>${feedback.reviewText}</td>
          `;
            tableBody.appendChild(row);
        });
    })
    .catch(error => {
        console.error("Error:", error);
    });
