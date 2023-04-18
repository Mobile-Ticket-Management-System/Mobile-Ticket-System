function submitForm() {
    const name = document.getElementById("name").value;
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;
    const confirmPassword = document.getElementById("confirm-password").value;
  
    if (password !== confirmPassword) {
      alert("Passwords do not match");
      return;
    }
  
    alert(`Name: ${name}\nEmail: ${email}\nPassword: ${password}`);
  }