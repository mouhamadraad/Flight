const userGreeting = document.getElementById("user-greeting");
const userGender = document.getElementById("user-gender");

try {
  const userID = localStorage.getItem("UserID");

  fetch(
    "http://127.0.0.1/Flight-System-Website/backend/signup.php?UserID=" +
      userID,
    {
      method: "GET",
    }
  )
    .then((response) => response.json())
    .then((data) => {
      console.log("Response from server:", data);

      if (data.status === "error") {
        console.log(data.message);
      } else if (data.status === "success") {
        console.log(data.user_info[0]);
        console.log("UserID retrieved successfully");
        userGreeting.textContent = "Hi " + data.user_info[0].name;
        userGender.textContent = data.user_info[0].gender;
      }
    });
} catch (error) {
  console.error("Error:", error);
}
