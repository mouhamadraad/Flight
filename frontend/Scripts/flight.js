document.addEventListener('DOMContentLoaded', function () {
  // Select all elements with the class 'book-now'
  const bookNowButtons = document.querySelectorAll('.book-now');

  // Add a click event listener to each button
  bookNowButtons.forEach(button => {
      button.addEventListener('click', (event) => {
          // Prevent the default action (navigating to the href)
          event.preventDefault();
          // Show the alert message
          alert('Please signup first.');
      });
  });
});
