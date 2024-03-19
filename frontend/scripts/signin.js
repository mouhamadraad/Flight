const errorMessage = document.getElementById("error-message");
const login = document.getElementById("login");
const signupLink = document.getElementById("signup-link");

signupLink.addEventListener("click", () => {
  window.location.href = "/frontend/pages/signup.html";
});

login.addEventListener("click", () => {
  try {
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;

    formData = new FormData();

    formData.append("email", email);
    formData.append("password", password);

    fetch("http://127.0.0.1/Flight-System-Website/backend/signin.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.json())
      .then((data) => {
        console.log("Response from server:", data);

        if (data.status === "error") {
          errorMessage.textContent = data.message;
        } else if (data.status === "success") {
          console.log(data.UserID);
          localStorage.setItem("UserID", data.UserID);
          window.location.href = "/frontend/pages/profile.html";
          console.log("Sign in successfully");
        }
      });
  } catch (error) {
    console.error("Error:", error);
  }
});
