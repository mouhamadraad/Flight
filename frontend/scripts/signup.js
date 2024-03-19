const registerBtn = document.getElementById("register");
const errorMessage = document.getElementById("error-message");
const loginLink = document.getElementById("login-link");
const emailRegex = /^[^s@]+@[^s@]+.[^s@]+$/;

loginLink.addEventListener("click", () => {
  window.location.href = "/frontend/pages/signin.html";
});

function addUser() {
  try {
    const fullName = document.getElementById("full-name").value;
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;
    const confirmPassword = document.getElementById("confirmPassword").value;
    const gender = document.querySelector('input[name="gender"]:checked').value;
    const formData = new FormData();

    formData.append("email", email);
    formData.append("name", fullName);
    formData.append("password", password);
    formData.append("gender", gender);

    fetch("http://127.0.0.1/Flight-System-Website/backend/signup.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => {
        if (!response.ok) {
          throw new Error("Network response was not ok");
        }
        return response.json();
      })
      .then((data) => {
        console.log("Response from server:", data);

        if (data.status === "error") {
          errorMessage.textContent = data.message;
        } else {
          console.log("You signed in");
          window.location.href = "/frontend/pages/signin.html";
        }
      });
  } catch (error) {
    console.error("Error:", error);
  }
}

registerBtn.addEventListener("click", () => {
  const fullName = document.getElementById("full-name").value;
  const email = document.getElementById("email").value;
  const password = document.getElementById("password").value;
  const confirmPassword = document.getElementById("confirmPassword").value;

  if (password !== confirmPassword) {
    errorMessage.textContent = "Passwords do not match. Try again.";
  } else if (email === "" || fullName === "") {
    errorMessage.textContent = "Inputs can't be empty";
  } else if (!emailRegex.test(email)) {
    errorMessage.textContent = "Invalid email address";
  } else {
    addUser();
  }
});
