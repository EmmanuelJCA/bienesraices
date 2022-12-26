document.addEventListener('DOMContentLoaded', function() {
  
  eventListeners();

  darkMode();
});

function darkMode() {

  const preferDarkMode = window.matchMedia('(prefers-color-scheme: dark)');

  if(preferDarkMode.matches) {
    document.body.classList.add('dark-mode');
  } else {
    document.body.classList.remove('dark-mode');
  }
  
  preferDarkMode.addEventListener('change', () => {
    if(preferDarkMode.matches) {
      document.body.classList.add('dark-mode');
    } else {
      document.body.classList.remove('dark-mode');
    }
  })

  const darkModeButton = document.querySelector('.dark-mode-button');

  darkModeButton.addEventListener('click', function() {
    document.body.classList.toggle('dark-mode');
  });

}

function eventListeners() {
  
  const mobileMenu = document.querySelector('.mobile-menu');
  mobileMenu.addEventListener('click', toggleMenu);

  // Muestra campos condicionales
  const contactMethod = document.querySelectorAll('input[name="contact[contact]"]');
  contactMethod.forEach(input => input.addEventListener('click', showContactMethods));
}

function toggleMenu(e) {
  const navigation = document.querySelector('.navigation');

  navigation.classList.toggle('show');
}

function showContactMethods(event) {
  const contactDiv = document.querySelector('#contact');

  if(event.target.value === 'phone'){
    contactDiv.innerHTML = `
    <label for="phone">Teléfono</label>
    <input type="tel" placeholder="Tu teléfono" id="phone" name="contact[phone]">
    
    <p>Elija una fecha y hora</p>
    <label for="date">Fecha:</label>
    <input type="date" id="date" name="contact[date]" required> 
    
    <label for="hour">Hora:</label>
    <input type="time" id="hour" min="09:00" max="18:00" name="contact[hour]" required> 
      `;
  } else {
    contactDiv.innerHTML = `
    <label for="email">E-mail</label>
    <input type="email" placeholder="Tu E-mail" id="email" name="contact[email]" required>`
  }
}