document.addEventListener("DOMContentLoaded", () => {
  const wrapper = document.querySelector(".log-in-wrapper");
  const panelTitle = document.getElementById("panel-title");
  const panelText = document.getElementById("panel-text");
  const toggleBtn = document.getElementById("toggle-btn");

  if (!wrapper) return;

  let showingRegister = false;

  // Force register view on errors or success
  if (wrapper.dataset.showRegister === "true") {
    wrapper.classList.add("active");
    panelTitle.textContent = "Welcome Back!";
    panelText.textContent = "Already have an account? Login instead.";
    toggleBtn.textContent = "Login";
    showingRegister = true;
  }

  toggleBtn.addEventListener("click", () => {
    wrapper.classList.toggle("active");
    showingRegister = !showingRegister;

    if (showingRegister) {
      panelTitle.textContent = "Welcome Back!";
      panelText.textContent = "Already have an account? Login instead.";
      toggleBtn.textContent = "Login";
    } else {
      panelTitle.textContent = "Don't have an account?";
      panelText.innerHTML = "Organize tasks and to-buys <br> in one place—start today.";
      toggleBtn.textContent = "Sign Up";
    }
  });
});


