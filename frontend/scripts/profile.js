const fullName = document.getElementById("full-name");
const email = document.getElementById("email");
const userGreeting = document.getElementById("user-greeting");
const userGender = document.getElementById("user-gender");
const editBtn = document.getElementById("edit-btn");
const confirmBtn = document.getElementById("confirm-btn");
const cancelBtn = document.getElementById("cancel-btn");
const overlay = document.getElementById("overlay");
const editPopup = document.getElementById("edit-popup");
const userAccessibility = document.getElementById("user-accessibility");
const userSeat = document.getElementById("user-seat");
const userAssistance = document.getElementById("user-assistance");
const logout = document.getElementById("logout");
const questions = document.getElementById("questions");
const profile = document.getElementById("profile");
const amount = document.getElementById("amount");

logout.addEventListener("click", () => {
  window.location.href = "/frontend/pages/signin.html";
});
profile.addEventListener("click", () => {
  window.location.href = "/frontend/pages/profile.html";
});
questions.addEventListener("click", () => {
  window.location.href = "/frontend/pages/faq.html";
});

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

function editButtonInfo(data) {
  const fullName = userGreeting.textContent.trim().replace("Hi ", "");
  document.getElementById("full-name").value = fullName;
  document.getElementById("email").value = data.user_info[0].email;
  const gender = userGender.textContent;
  document.getElementById(gender.toLowerCase()).checked = true;
  document.getElementById("accessibility").value =
    userAccessibility.textContent;
  document.getElementById("seat").value = userSeat.textContent;
  document.getElementById("assistance").value = userAssistance.textContent;
  document.getElementById("amount").value = data.user_info[0].amount;
}

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
        console.log("UserID retrieved successfully");
        userGreeting.innerHTML = "Hi " + `<b> ${data.user_info[0].name}</b>`;
        userGender.textContent = data.user_info[0].gender;
        userAccessibility.textContent = data.user_info[0].accessibility;
        userSeat.textContent = data.user_info[0].seat;
        userAssistance.textContent = data.user_info[0].assistance;
        amount.textContent = data.user_info[0].amount;

        editBtn.addEventListener("click", () => {
          toggleButtons();
          editButtonInfo(data);
        });
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
  formData.append("amount", amount);

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
        if (data.status === "error") {
          console.error("Error updating data:", data.message);
        } else if (data.status === "success") {
          exitEditing();
          userGreeting.innerHTML = "Hi " + `<b> ${fullName}</b>`;
          userGender.textContent = gender;
          userAccessibility.textContent = accessibility;
          userSeat.textContent = seat;
          userAssistance.textContent = assistance;
          amount.textContent = data.user_info.amount;
        }
      });
  } catch (error) {
    console.error("Error:", error);
  }
});
