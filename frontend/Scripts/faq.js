const faqQuestion = document.querySelectorAll(".faq-question");
const overlay = document.getElementById("overlay");
const editPopup = document.getElementById("edit-popup");
const cancelBtn = document.getElementById("cancel-btn");
const questionText = document.getElementById("question-text");
const profile = document.getElementById("profile");
const questions = document.getElementById("questions");

const faqContent = [
  "Commercial airplane flights fly at a cruising altitude between 30,000ft-42,000ft and maximum of 45,000ft. This converts to approximately from 9000 metres / 9 km / 5.6 miles up to just under 14,000 metres / 14km / 8.5 miles.",

  "The higher you go up in the air the thinner the air and therefore less resistance/drag. Making for better fuel and engine efficiency, and higher speeds to get you to your destination quicker. Flying at such altitudes also avoids bad weather and storms, as you are above the clouds where most of the storm activity comes from. This gives you a better flying experience and smoother journey.",

  "Yes, absolutely. Planes are built with a protective metal that’s engineered to prevent electric build up while protecting from power surges.",

  "The lights are to signal planes crossing in their path. The red light is always on the left side, while the green light is always on the right. This way, the crew is able to determine the direction the plane is traveling.",

  "Even though smoking has been prohibited for a long time, the FAA actually made ash trays a requirement. Apparently, some passengers still ignore the various announcements (and common sense). When this happens, the air crew needs a completely safe place to put the suckers out.",

  "Contrary to what you might think, it’s not dropped over the ocean! Instead, the contents are stored in a holding tank that sits in the plane. On the ground, the tank is transported for proper disposal.",
  // Add more questions and content as needed
];

function testing(arg) {
  let items = "";
  for (let i = 0; i < arg.length; i++) {
    items += `<li>${arg[i]}</li>`;
  }
  return items;
}

function popup(content) {
  overlay.classList.remove("hidden");
  editPopup.classList.remove("hidden");
  questionText.textContent = content;
}

function closePopup() {
  overlay.classList.add("hidden");
  editPopup.classList.add("hidden");
}

profile.addEventListener("click", () => {
  window.location.href = "/frontend/pages/profile.html";
});
logout.addEventListener("click", () => {
  window.location.href = "/frontend/pages/signin.html";
});
questions.addEventListener("click", () => {
  window.location.href = "/frontend/pages/faq.html";
});

cancelBtn.addEventListener("click", () => {
  closePopup();
});

faqQuestion.forEach((faqQuestion, index) => {
  faqQuestion.addEventListener("click", () => {
    popup(faqContent[index]);
  });
});
