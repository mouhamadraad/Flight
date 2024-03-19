const userGreeting = document.getElementById("user-greeting");
const userGender = document.getElementById("user-gender");
const editBtn = document.getElementById("edit-btn");
const confirmBtn = document.getElementById("confirm-btn");
const cancelBtn = document.getElementById("cancel-btn");
const overlay = document.getElementById("overlay");
const editPopup = document.getElementById("edit-popup");
const userID = localStorage.getItem("UserID");

function toggleButtons() {
  editBtn.classList.add("hidden");
  confirmBtn.classList.remove("hidden");
  cancelBtn.classList.remove("hidden");
  overlay.classList.remove("hidden");
  editPopup.classList.remove("hidden");
}

function exitEditing() {
  editBtn.classList.remove("hidden");
  confirmBtn.classList.add("hidden");
  cancelBtn.classList.add("hidden");
  overlay.classList.add("hidden");
  editPopup.classList.add("hidden");
}

cancelBtn.addEventListener("click", () => {
  exitEditing();
});

editBtn.addEventListener("click", () => {
  toggleButtons();
});

try {
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
        userGreeting.innerHTML = "Hi " + `<b> ${data.user_info[0].name}</b>`;
        userGender.textContent = data.user_info[0].gender;
      }
    });
} catch (error) {
  console.error("Error:", error);
}

confirmBtn.addEventListener("click", () => {
  const fullName = document.getElementById("full-name").value;
  const email = document.getElementById("email").value;
  const gender = document.querySelector('input[name="gender"]:checked').value;
  const accessibility = document.getElementById("accessibility").value;
  const seat = document.getElementById("seat").value;
  const assistance = document.getElementById("assistance").value;
  toggleButtons();

  formData = new FormData();
  formData.append("UserID", userID);
  formData.append("name", fullName);
  formData.append("email", email);
  formData.append("gender", gender);
  formData.append("accessibility", accessibility);
  formData.append("seat", seat);
  formData.append("assistance", assistance);

  try {
    fetch("http://127.0.0.1/Flight-System-Website/backend/updateUser.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => {
        console.log(response);
        return response.json();
      })
      .then((data) => {
        console.log("Response from server:", data);
        if (data.status === "error") {
          console.log("Error updating data");
        } else if (data.status === "success") {
          exitEditing();
        }
      });
  } catch (error) {
    console.error("Error:", error);
  }
});
