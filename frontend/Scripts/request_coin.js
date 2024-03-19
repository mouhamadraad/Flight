const form = document.getElementById("requestCoinsForm");

form.addEventListener("submit", function (event) {
  event.preventDefault();

  const userID = document.getElementById("UserID").value;
  const coinsAmount = document.getElementById("coinsAmount").value;

  const formData = new FormData();
  formData.append("UserID", userID);
  formData.append("coinsAmount", coinsAmount);

  axios
    .post(
      "http://localhost/Flight-System-Website/backend/request_coin.php",
      formData
    )
    .then((response) => {
      const data = response.data;
      if (data.success) {
        alert("Request sent successfully!");
        form.reset();
      } else {
        alert("Error: " + data.message);
      }
    })
    .catch((error) => {
      console.error("Error:", error);
      alert("Error submitting review. Please try again.");
    });
});
