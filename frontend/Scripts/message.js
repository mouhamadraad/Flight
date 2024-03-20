document
  .getElementById("messageForm")
  .addEventListener("submit", function (event) {
    event.preventDefault(); // Prevent the default form submission

    var message = document.getElementById("message").value.trim();
    var senderID = localStorage.getItem("UserID"); // Get sender's ID from localStorage
    var recipientID = 1; // Fixed recipient ID

    // Check if the message is not empty
    if (message === "") {
      alert("Please enter a message.");
      return;
    }

    // Create a FormData object and append data
    var formData = new FormData();
    formData.append("send_message", "true");
    formData.append("UserID", senderID);
    formData.append("recipientID", recipientID);
    formData.append("message", message);

    // Create a new XMLHttpRequest object
    var xhr = new XMLHttpRequest();

    // Set up the request
    xhr.open(
      "POST",
      "http://127.0.0.1/Flight-System-Website/backend/message.php",
      true
    );

    // Set up a handler for when the request finishes
    xhr.onload = function () {
      if (xhr.status === 200) {
        // Request was successful, do something if needed
        console.log("Message sent:", xhr.responseText);
        console.log(recipientID);
        // Optionally, clear the message input after sending
        document.getElementById("message").value = "";
      } else {
        // Request failed, handle error if needed
        console.error("Failed to send message:", xhr.responseText);
      }
    };

    // Send the request with the FormData object as the data
    xhr.send(formData);
  });
